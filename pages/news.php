<?php 
if (isset($_SESSION['logged_in'])) 
{
	news($row,$news_limit,$row_news,$bbcode,$count_news_comment,$lang,$x);
}
else
{
	news($row,$news_limit,$row_news,$bbcode,$count_news_comment,$lang,$x);
}
?>