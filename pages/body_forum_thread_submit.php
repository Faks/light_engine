<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
		{
			true;
		}
		else 
		{
			echo $redirect.false;
		}
		
		$submit_select_check = mysql_query("SELECT MIN(hosting_forum_id),MAX(hosting_forum_id) FROM hosting_forum WHERE hosting_forum_id  = '$id'");
		while ($submit_validation_check = mysql_fetch_array($submit_select_check))
		{
		if ($submit_validation_check['MAX(hosting_forum_id)'] == $id)
		{
		if (isset($_POST['submit']))
		{
	    $errors = array(); // set the errors array to empty, by default
	    $fields = array(); // stores the field values
	    $success_message = "Paldies Jûsu Informâcija Nosûtîta";	
		// import the validation library
	    #require("include/validation.php");
	    require ("include/validation.php");
	    $rules = array(); // stores the validation rules

	  // standard form fields
	  $rules[] = "required,thread_title,{$lang['BODY_FORUM_THREAD_VALIDATION_FILL_TITLE']}";
	  $rules[] = "required,thread_text,{$lang['BODY_FORUM_THREAD_VALIDATION_FILL_TEXT']}";
	  
	  $errors = validateFields($_POST, $rules);
	
	  // if there were errors, re-populate the form fields
	  if (!empty($errors))
	  {  
	    $fields = $_POST;
	  }
  
  // no errors! redirect the user to the thankyou page (or whatever)
  else 
  {
  	if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
  	{		
		$thread_title = mysql_real_escape_string($_POST['thread_title']);
		$thread_title = htmlentities($_POST['thread_title']);
		$thread_title = trim($_POST['thread_title']);
		$thread_title = stripslashes($_POST['thread_title']);
		$thread_title = addslashes($_POST['thread_title']);
		
		$thread_text =  mysql_real_escape_string($_POST['thread_text']);
		$thread_text =  htmlentities($_POST['thread_text']);
		$thread_text =  trim($_POST['thread_text']);
		$thread_text =  stripslashes($_POST['thread_text']);
		$thread_text = addslashes($_POST['thread_text']);
		$thread_text = strip_script($_POST['thread_text']);
		$thread_text = bbcode_parser($_POST['thread_text']);
		$id 		 = (int)$_GET['id'];
		unset($_POST['token']);
		
		$forum_thread_insert = "INSERT INTO hosting_forum_thread (hosting_forum_thread_title,hosting_forum_thread_text,hosting_forum_thread_author,hosting_forum_id,hosting_forum_thread_date) VALUES('".$thread_title."','".$thread_text."','".$_SESSION['nick']."','".$id."','".$last_time_seen."')";
		mysql_query($forum_thread_insert) or die (mysql_error());
		
  	 	{
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumview&id=".$id."'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

 if (!empty($errors))
{
	{
		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_FORUM_THREAD_VALIDATION_TEXT']}</b><br>";
		foreach ($errors as $error)
		echo "<span style='color:darkred'>$error</span><br>";
		echo "</ul></div>"; 
    }
if (!empty($message))
	{
		echo "<div class='notify'>$success_message</div>";
	}
}

	echo "<div align='center' class='thread'>{$lang['BODY_FORUM_TITLE']}</div><br>";
		 echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>
		  <tr>
		    <td><form method='post'>
		{$lang['BODY_FORUM_THREAD_TITLE']}<br />
		<input name='thread_title' type='text' id='threadname' value='' size='146' value='{$fields['thread_title']}' />
		<br />
		<br />
		{$lang['BODY_FORUM_THREAD_TEXT']}<br />
		<textarea name='thread_text' cols='110' rows='10' id='threadtext' value='{$fields['thread_text']}' ></textarea>
		<br />
		<br />
		<input type='hidden' name='token' value='{$token}'/> 
		<input type='submit' name='submit' id='button' value='{$lang['BODY_FORUM_BUTTON_SUBMIT']}' />
		<input type='reset' name='Reset' id='button' value='{$lang['BODY_FORUM_BUTTON_RESET']}' />
		    </form></td>
		  </tr>
		</table>";
	}	
		else
		{
			echo $redirect;
		}
	}


	}
}
else 
{
	echo $redirect;
}	
?>