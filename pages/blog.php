<?php 
if ($_SESSION['logged_in']) 
{
	blog($row,$news_limit,$row_blog,$bbcode,$count_news_comment,$lang,$x);
}
else
{
	blog($row,$news_limit,$row_blog,$bbcode,$count_news_comment,$lang,$x);
}	
?>