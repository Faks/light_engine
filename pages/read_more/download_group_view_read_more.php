<?php
if ($_SESSION['logged_in']) 
{
	download_group($id,$redirect);
}
else
{
	download_group($id,$redirect);
}
?>