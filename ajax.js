var xmlHttp;
var name = false, pwd1 = false, pwd2 = false, email = false;
function GetXmlHttpObject() {
	var objXMLHttp = null;
	
	if ( window.XMLHttpRequest ) {
		objXMLHttp = new XMLHttpRequest();
	}
	else if ( window.ActiveXObject ) {
		objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return objXMLHttp;
}
function checkname(str) {
	
	if (str == ''){
		document.getElementById("namehint").innerHTML='Please input your name!';
		name = false;
	} else {
		xmlHttp = GetXmlHttpObject();
		if( xmlHttp == null ) {
			alert( "Browser does not support HTTP Request" );
			return;
		}
		var url = "callback_username.php";
		url = url + "?name=" + str;
		url = url+ "&sid=" + Math.random();
		//alert( "url " + url);
		xmlHttp.onreadystatechange = stateChanged;
		xmlHttp.open("GET", url, true);
		xmlHttp.send(null);
	}
}
function checkPwd1(str) {
	if (str.length < 6) {
		document.getElementById("password1hint").innerHTML='Password need 6-30 characters!';
		pwd1 = false;
	} else if(document.getElementById("password2").value == str ){
		document.getElementById("password1hint").innerHTML='Congratulations!';
		document.getElementById("password2hint").innerHTML='Congratulations!';
		pwd1 = true;
		pwd2 = true;
	} else{
		document.getElementById("password1hint").innerHTML='Congratulations!';
		document.getElementById("password2hint").innerHTML='Please input password again!';
		pwd1 = true;
		pwd2 = false;
	}
}
function checkPwd2(str){
	if(str =='' ){
		document.getElementById("password2hint").innerHTML='Please input password again!';
		pwd2 = false;
	} else if(str == document.getElementById("password1").value){
		document.getElementById("password2hint").innerHTML='Congratulations!';
		pwd2 = true;
	} else{
		document.getElementById("password2hint").innerHTML='The passwords you entered do not match!';
		pwd2 = false;
	}
}
function checkEmail(str) 
{	
	//alert('fadsgad');
	if(str==''){
		document.getElementById("emailhint").innerHTML="Please input your email!";
		email=false;
	}  
	else if(str.indexOf("@")==-1){  
		document.getElementById("emailhint").innerHTML="That is not a valid email address!";
		email=false;
	}else{  
		document.getElementById("emailhint").innerHTML="Congratulations!";
		email=true;
	}
}

function stateChanged() {
	if ( xmlHttp.readyState == 4 || xmlHttp.readyState == "complete" ) {
		var content=xmlHttp.responseText;
		if (content == 0) {
			document.getElementById("namehint").innerHTML='Congratulations!';
			name = true;
		} else {
			document.getElementById("namehint").innerHTML='The username has been used!';
			name = false;
		}
	}
} 
//output comment to the page
function checkComment() {
	var comment = document.getElementById('comment_text').value;
	var photoid = document.getElementById("photoid").value;
	if ( comment == '') {
		alert('Please input comment!');
	} else {
		if (photoid != 0) {
			xmlHttp = GetXmlHttpObject();
			if( xmlHttp == null ) {
				alert( "Browser does not support HTTP Request" );
				return;
			}
			var url = "callback_comment.php";
			url = url + "?comment=" + comment;
			url = url + "&photoid=" + photoid;
			url = url+ "&sid=" + Math.random();
			
			xmlHttp.onreadystatechange = stateChanged2;
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			alert('There is no photo!');
		}
	}
}
function stateChanged2() {
	if ( xmlHttp.readyState == 4 || xmlHttp.readyState == "complete" ) {
		var content=xmlHttp.responseText;
		var strs= new Array(); 
		strs=content.split("@@@");
		var result = strs[0];
		var time = strs[1];
		var newCount = document.getElementById("count").value;
		var user = document.getElementById("un").value;
		var comment = document.getElementById("comment_text").value;
		if (result == 1) {
			var obj=document.createElement("DIV");
			obj.id = "div" + newCount;
			obj.className = "comments";
			obj.innerHTML='<p>Author: ' + user + ' | PostTime: ' + time + '</p><p>Comment: ' + comment + '</p>';
			document.getElementById("comment-content").appendChild(obj); 
			document.getElementById("comment_text").value = '';
		} else {
			alert('Failed!');
		}
	}
} 
function checkSubmit()
{
	if (name && pwd1 && email && pwd2) {
		return true;
	} else {
		alert('Please input correct information!');
		return false;
	}
}
