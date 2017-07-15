<?php
function edit_sysop()
{
	$comment_edit_news = (INT)$_GET['comment_id'];
	$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' ") or die (mysql_error());
	$comment_edit = mysql_fetch_array($select_comment_edit);
	
	$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM comment WHERE id = '$comment_edit_news' ");
	while ($id_filter = mysql_fetch_array($id_select_filter))
	{
		if ($id_filter['MAX(id)'] == $comment_edit_news)
		{
			$comment_texts 	   = $comment_edit['text'];
			$edit_comment_text = mysql_real_escape_string($_POST['text']);
			$edit_comment_text = htmlentities($_POST['text']);
			$edit_comment_text = trim($_POST['text']);
			$edit_comment_text = stripslashes($_POST['text']);
			$edit_comment_text = addslashes($_POST['text']);
			$edit_comment_text = $myFilter->process($_POST["text"]);
				
			if(isset($_POST['text']))
			{
				mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."'  ") or die (mysql_error());
			}
				
			if (isset($_POST['Submit']))
			{
				echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
			}
	
	
				
			echo "<form  id='edit_comment' name='edit_comment' method='post' class='pagination'>
			<p>
			<textarea name='text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
			<p>
			<input type='hidden' name='token' value='{$token}'/>
			<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
			<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
			</p>
			</form>";
		}
		else
		{
			echo $redirect;
		}
	}
	return;
}