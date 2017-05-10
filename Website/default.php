<style>
* {
	font-family: arial;
}
body{
	padding: 0px;
	margin: 0px;
}
.header_bar{
	background: #bef;
	padding: 5px;
}

.table, .table1{
	width: 100%;
	background: #fff;
}
.table, .table td, .table th, .table1, .table1 td, .table1 th{
	border-collapse: collapse;
	border:solid 1px #bef;
	padding: 7px;
}
.table th, .table1 th{
	color: #489;
}

.table tr:hover{
	background: #bef;
	cursor: pointer;
}

.header{
	background: #171e2e;
	color: #ffffff;
	font-weight: bold;
	font-size: 25px;
	padding: 15px;
	text-align: center;
	border-radius: 5px 5px 0px 0px;
}
.wadah{
	width: 80%;
	position: absolute;
	left: 10%;
	margin: 10px 0px;
}

.input1{ /*button submit*/
	border: solid 1px #bcd;
	font-weight: bolder;
	margin:6px;
	min-width: 50px;
	padding: 3px;
	outline: none;

	border-radius: 3px;
}
.input1:hover{ 
	background: #def;
}
.input1:active{ 
	background: #fff;
}

.input{
	background: #ffffff;
	border: solid 1px #bbb;
	font-style: italic;
	margin:6px;
	padding: 5px;
	width: 170px;
	outline: none;

	border-radius: 3px;
	transition-duration: 0.5s;
}

.input:focus {
	border:solid 1px #ade;
	background: #ffffff;
	font-style: italic;
	width: 170px;
	outline: none;

}

.working{
	color:#bbb;
}

</style>
<div class="header_bar">
	<center>
		<img src="milc.png" style="height: 100px;margin: 5px;">
	</center>
</div>
<div class="wadah">
<div class="header">Informasi Dispenser</div>
<table class="table" id="t1">
</table>
</div>

<script>



var pause = false;

function pause_false(){
	pause=false;
	//window.setTimeout(function(){if(pause)pause=false},5000);
}

window.onload = function(){
	load_info_berkala();
}

function load_info_berkala(){
	if(!pause){
		load_info();
	}
	window.setTimeout("load_info_berkala()", 1000);
}

tulis_info=a=>document.getElementById('t1').outerHTML=a;

function load_info(){

	var request;
	if(window.XMLHttpRequest){
		request=new XMLHttpRequest();
	}else{
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
			
	
	request.open("GET","info.php");
	request.setRequestHeader('Pragma', 'no-cache');
	request.setRequestHeader('Cache-Control', 'no-cache');
	//request.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
	request.send();
	
	request.onreadystatechange=function(){
		if(request.readyState==4){
			tulis_info(request.responseText);
		}
	}
}

function terima(a){
	a = encodeURI(a);

	var request;
	if(window.XMLHttpRequest){
		request=new XMLHttpRequest();
	}else{
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
			
	
	request.open("GET","terima.php?c="+a);
	request.setRequestHeader('Pragma', 'no-cache');
	request.setRequestHeader('Cache-Control', 'no-cache');
	//request.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
	request.send();
	
	request.onreadystatechange=function(){
		if(request.readyState==4){
			//tulis_info(request.responseText);
		}
	}
}
</script>