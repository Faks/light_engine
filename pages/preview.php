<?php
#bbcode parser
require("../include/modules/nbbc/nbbc.php");

#define bbcode izsaukumu klasi
$bbcode = new BBCode;

#met prom negaiditus cieminus
$redirect = ("<meta http-equiv='REFRESH' content='0;url=/?section=news'>");

if ($_POST['data']) 
{
	echo $bbcode->Parse($_POST["data"]);
}
else
{
	echo $redirect;
}
?>