function validateInput(second){
if(document.getElementById("search_keyword_input").value==""){
alert("検索キーワードを入力してください。");
return false;
}
if(document.getElementById("current_genre").innerHTML=="ジャンルを選択してください"){
alert("ジャンルを選択してから検索してください。全ての商品から検索する場合は、「全てのジャンル」を選択してください。");
return false;
}
id=findGenreId(document.getElementById("current_genre").innerHTML.split(":")[1]);
if(id==-1){
alert("指定されたジャンルが見つかりませんでした。");
return false;
}
location.href="exp_page2.php?second="+second+"&keyword="+document.getElementById("search_keyword_input").value+"&genre="+id;
}

function findGenreId(name){
var found=-1;
for(var i=0;i<genre_names.length;i++){
if(name==genre_names[i]){
found=i;
break;
}
}
if(found==-1) return -1;
return genre_ids[i];
}

function updateLastAction(event) {
document.getElementById("current_genre").innerHTML="ジャンル:"+event.currentTarget.innerHTML;
}

window.onload=function() {
  var menubutton = new Menubutton(document.getElementById('menubutton1'));
  menubutton.init();
}
