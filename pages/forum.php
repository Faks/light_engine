<?php
if ($_SESSION['logged_in'])
{
	forum($forum_group_name,$forum_show,$topic_count,$lang,$date);
}
else
{
	forum($forum_group_name,$forum_show,$topic_count,$lang,$date);
}
?>