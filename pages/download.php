<?php
if ($_SESSION['logged_in']) 
{
	download_game($bbcode);
}
else
{
	download_game($bbcode);
} 
?>