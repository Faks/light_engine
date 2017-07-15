<?php
function commenent_delete() #Custom delete kods darbojas gan zinas,bloga prieks servera staff
{
	$comment_id_delete = (INT)$_GET['id_delete'];
	mysql_query("DELETE FROM comment WHERE id = '".$comment_id_delete."' ") or die (mysql_error());
}

function commenet_vip_delete_news($vip_id,$comment_vip_delete,$id)
{
	$vip_id = (INT)$_GET['vip_id'];
	$select_vip_delete = mysql_query("SELECT id,text,author FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
	$comment_vip_delete = mysql_fetch_array($select_vip_delete);

	if ($comment_vip_delete['author'] == $_SESSION['nick'])
	{
		if (mysql_query("DELETE FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' "))
		{
			echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
		}
	}
	else
	{
		echo $redirect;
	}
}

function commenet_vip_delete_blog($vip_id,$comment_vip_delete,$id) 
{
	$vip_id = (INT)$_GET['vip_id'];
	$select_vip_delete = mysql_query("SELECT id,text,author FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
	$comment_vip_delete = mysql_fetch_array($select_vip_delete);
							
	if ($comment_vip_delete['author'] == $_SESSION['nick'])
	{						
		if (mysql_query("DELETE FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' "))
		{
			echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
		}					
	}
	else
	{
		echo $redirect;
	}
}

function commenet_vip_delete_forum($vip_id,$comment_vip_delete,$id)
{
	$vip_id = (INT)$_GET['vip_id'];
	$select_vip_delete = mysql_query("SELECT id,text,author FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
	$comment_vip_delete = mysql_fetch_array($select_vip_delete);
		
	if ($comment_vip_delete['author'] == $_SESSION['nick'])
	{
		if (mysql_query("DELETE FROM comment WHERE id = '".$vip_id."' AND author = '".$_SESSION['nick']."' "))
		{
			echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
		}
	}
	else
	{
		echo $redirect;
	}
}

function download_game_delete() 
{
	$download_id_delete = (INT)$_GET['id_delete'];
	mysql_query("DELETE FROM download_game WHERE id = '".$download_id_delete."' ") or die (mysql_error());
}

function download_category_delete() 
{
	$download_subgroup_id_delete = (INT)$_GET['id_delete'];
	$select_download_id = mysql_query("SELECT id,download_game_id FROM download_category WHERE id = '{$download_subgroup_id_delete}' ");
	$download_id = mysql_fetch_array($select_download_id);
	if (mysql_query("DELETE FROM download_category WHERE id = '".$download_subgroup_id_delete."' ")) 
	{
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadmore&id={$download_id['download_game_id']}'>";
	}
}

function download_topic_delete() 
{
	$download_topic_id_delete = (INT)$_GET['id_delete'];
	$select_download_topic_id = mysql_query("SELECT id,download_category_id FROM download_topic WHERE id = '{$download_topic_id_delete}' ");
	$download_topic_id = mysql_fetch_array($select_download_topic_id);
	if (mysql_query("DELETE FROM download_topic WHERE id = '".$download_topic_id_delete."' ")) 
	{
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadgroup&id={$download_topic_id['download_category_id']}'>";
	}
}
?>