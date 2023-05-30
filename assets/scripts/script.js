function pp()
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","showrfid.php",false);
	document.getElementById("pp1").innerHTML=xmlhttp.responseText;
	
}