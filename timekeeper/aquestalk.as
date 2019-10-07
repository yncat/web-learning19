#ifndef __AQUESTALK__
#define __AQUESTALK__
//aquesTalkÇ≈âπê∫çáê¨
#module aquesTalk
#uselib "AquesTalk.dll"
#func AquesTalk_Synthe "AquesTalk_Synthe" str, int, int
#func AquesTalk_FreeWave "AquesTalk_FreeWave" int
#deffunc aquestalk_speak str moji, int mode
	if ptWavedata!0 : AquesTalk_FreeWave ptWavedata
AquesTalk_Synthe moji,150, varptr(wavesize)
s=stat
if s=0:dialog "error":return
	ptWavedata = s
	sdim wavedata, wavesize
	dupptr wavedata, ptWavedata, wavesize
memfile wavedata
if mode=0:{
mmload "mem:a.wav",0
}else{
mmload "mem:a.wav",0,2
}
mmplay 0
return
#global
#endif
