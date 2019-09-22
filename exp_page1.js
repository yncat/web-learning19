function validateInput(){
if(document.getElementById("search_keyword_input").value==""){
alert("検索キーワードを入力してください。");
return false;
}
return true;
}

function updateLastAction(event) {
document.getElementById("current_jenre").innerHTML="ジャンル: "+event.currentTarget.innerHTML;
}

window.onload=function() {
  var menubutton = new Menubutton(document.getElementById('menubutton1'));
  menubutton.init();
}
