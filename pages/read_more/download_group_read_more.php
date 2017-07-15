<?php
if ($_SESSION['logged_in']) 
{
	download_more($id,$download_validation_check,$redirect);
}
else
{
	download_more($id,$download_validation_check,$redirect);
}
?>