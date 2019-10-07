var number_voices = []
var answer = []
var ANSWER_LENGTH = 5;
var playing_step = 0;
var TRIGGER_INTERVAL = 1500;

window.onload = function () {
	for (var i = 0; i < 10; i++) {
		number_voices.push(new Audio("captcha/" + i + ".ogg"));
	}
	for (var i = 0; i < ANSWER_LENGTH; i++) {
		answer.push(Math.floor(Math.random() * 10));
	}
}

function _trigger() {
	number_voices[answer[playing_step]].play();
	playing_step++;
	if (playing_step == ANSWER_LENGTH) {
		playing_step = 0;
		document.getElementById("play_button").disabled = null;
	} else {
		setTimeout("_trigger();", TRIGGER_INTERVAL);
	}
}

function playCaptcha() {
	document.getElementById("play_button").disabled = "true";
	setTimeout("_trigger();", TRIGGER_INTERVAL);
	document.getElementById("captcha_input").focus();
}

function submitHook() {
	in_ref = document.getElementById("captcha_input");
	var input_answer = in_ref.value;
	if (input_answer.length != ANSWER_LENGTH) {
		alert("音声による認証に失敗しました。文字数が一致しません。もう一度「再生」ボタンを押し、正確に数字を入力し直してください。");
		in_ref.value = "";
		return false;
	}
	var ok = true;
	for (var i = 0; i < ANSWER_LENGTH; i++) {
		if (answer[i] != input_answer[i]) {
			ok = false;
			break;
		}
	}
	if (!ok) {
		alert("音声による認証に失敗しました。入力された数字が正しくありません。もう一度「再生」ボタンを押し、正確に数字を入力し直してください。");
		in_ref.value = "";
		return false;
	}
	return true;
}
