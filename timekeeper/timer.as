#ifndef __TIMER__
#define __TIMER__
#module timer
//Œo‰ßŽžŠÔ‚ðŒv‚é‚¾‚¯
#uselib "winmm"
#cfunc timeGetTime "timeGetTime"
#deffunc timer_start int _end_ms
started=timeGetTime()
end_ms=_end_ms
return

#defcfunc timer_getElapsed
if started==0: return 0
return timeGetTime()-started

#deffunc timer_getRemaining
return end_ms-timer_getElapsed()

#defcfunc timer_getEnded
return timer_getElapsed()>=end_ms
#global
#endif
