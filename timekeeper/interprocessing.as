#ifndef __INTERPROCESSING__
//タイムキーパーのプロセス間通信
#define __INTERPROCESSING__
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
exist "__interprocessing__"
if strsize==-1:{
sdim b,64
bsave "__interprocessing__",b,0
}
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

#deffunc CleanupAppRunChecker onexit
	if (hMutex != 0) {
		CloseHandle hMutex
		hMutex = 0
	}
	return

#defcfunc interprocessing_getLastMessage
exist "__interprocessing__"
sdim b,strsize+1
bload "__interprocessing__",b
msg=b
if strlen(b)==0: return ""
sdim b,64
bsave "__interprocessing__",b,0
return msg

#global
#endif