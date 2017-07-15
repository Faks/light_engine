<?php
if ($_SESSION['logged_in']) 
{
	download_topic($id,$lang,$redirect);
}
else
{
	download_topic($id,$lang,$redirect);
}
?>