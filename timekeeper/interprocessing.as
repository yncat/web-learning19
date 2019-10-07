//タイムキーパーのプロセス間通信
#define interprocessing_setMessageCallback(%1) oncmd gosub%1, 0x004A
#module interprocessing
#uselib "kernel32"
#func CloseHandle "CloseHandle" sptr
#define CreateMutex CreateMutexA
#cfunc CreateMutexA "CreateMutexA" sptr,sptr,sptr
#cfunc GetLastError "GetLastError"
#uselib "user32"
#define FindWindowEx FindWindowExA
#cfunc FindWindowExA "FindWindowExA" sptr,sptr,sptr,sptr

#define ERROR_ALREADY_EXISTS    183
#define WM_COPYDATA 0x004A

	#defcfunc interprocessing_init str _appName, str _windowTitle
appName=_appName
windowTitle=_windowTitle
	if (hMutex == 0) {
		hMutex = CreateMutex(0, 0, appName)
		if (GetLastError() == ERROR_ALREADY_EXISTS) {
			alreadyRunningStatus = 1
		} else {
			alreadyRunningStatus = 0
		}
	}
	return alreadyRunningStatus

#defcfunc interProcessing_sendMessage str msg
s=findWindowEx(0,0,0,windowTitle)
if s=0:return 0
	send_content=msg
	dim cds,3
	cds(0)=0
	cds(1)=strlen(send_content)
	cds(2)=varptr(send_content)
	sendmsg s, WM_COPYDATA, hwnd, varptr(cds)
return 1


#deffunc CleanupAppRunChecker onexit
	if (hMutex != 0) {
		CloseHandle hMutex
		hMutex = 0
	}
	return

#defcfunc interprocessing_getMessage int ptr
	dupptr recieved,ptr,12
	size=lpeek(recieved,4)
	contentPtr=lpeek(recieved,8)
	dupptr recieved_data,contentPtr,size
	sdim final_data,size+1	//領域確保
	memcpy final_data,recieved_data,size
return final_data

#global
