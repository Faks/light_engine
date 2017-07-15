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
		
				echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0' id='TableRoundCorners'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>My Information</strong> </h3>
        <hr align='center' noshade='noshade' />
        Total Contact Messages<br />
        <a href='#' class='tooltip'>1<span>Active tickets whom require attention</span></a>  | ~
        <hr align='center' noshade='noshade' />
        </p>
       Total News Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Blog Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Treads <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        <strong>Light User Panel <br />
        Version | 0.0.1 <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <td width='665' valign='top' >
    <table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='ticket' id='border' >
        <tr>";
	
		$news = mysql_query("SELECT * FROM hosting_news WHERE hosting_id_news = '$id' ") or die(mysql_error());	
		if (mysql_num_rows($news) != 0)
		{
			while ($row_news = mysql_fetch_array($news))
			{
				echo "<tr><td width='200' ><b>".$row_news['hosting_title_news']."</b> <a href='/?section=viewprofile&name={$row_news['hosting_author_news']}'>{$row_news['hosting_author_news']}</a> ".$row_news['hosting_time_news']."</td></tr>
			        <tr>
          <td><table width='664' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><p>".$row_news['hosting_short_news']."<br'
                <p>&nbsp;</p></td>
              </tr>
            <tr>";
			}
		}
		else 
		{
			echo $redirect;
		}	
	
		echo "<td><h3>{$lang['BODY_NEWS_COMMENT_COMMENTS']}</h3>";
		
		$sql = "SELECT COUNT(hosting_comment_news_id) FROM hosting_comment WHERE hosting_comment_news_id = '$id'";
		$result = mysql_query($sql);
		$r = mysql_fetch_row($result);
		$numrows = $r[0];
		
		// find out total pages
		$totalpages = ceil($numrows / $comment_limit);
		
		if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))		
		{
			$page = (int)$_GET['page'];
		}
		else 
		{
			$page = 1;
		}
		// if current page is greater than total pages...
		if ($page > $totalpages) {
		// set current page to last page
		 	$page = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($page < 1) {
		// set current page to first page
		$page = 1;
		} // end if
	
		// the offset of the list, based on current page 
		$offset = ($page - 1) * $comment_limit;
		
		$comment = mysql_query("SELECT hosting_comment_id,hosting_comment_news_id,hosting_comment_text,hosting_comment_nick,hosting_comment_date FROM hosting_comment WHERE hosting_comment_news_id = '$id' "."limit $offset, $comment_limit") or die(mysql_error());
		if (mysql_num_rows($comment) != 0)
		{
			while ($row_news_comment = mysql_fetch_array($comment))
			{
				echo "<a href='/?section=viewprofile&name={$row_news_comment['hosting_comment_nick']}'>{$row_news_comment['hosting_comment_nick']}</a> ".'&nbsp;'.$row_news_comment['hosting_comment_date'].'&nbsp;';
				
					if ($_SESSION['permission'] == 2)
					{
						if ($row_news_comment['hosting_comment_nick'] == $_SESSION['nick'])
						{
							echo "<a href='/?section=edit&id=".$id."&comment=nwedit&id_edit=".$row_news_comment['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;";
							#."<a href='/?section=nwcomment&id=".$id."&comment=delete&id_delete=".$row_news_comment['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>"
							/*
							if ($_GET['comment'] == 'delete') 
							{
								$comment_id_delete = (INT)$_GET['id_delete'];
								mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=nwcomment&id=".$id."'>"; 
							}
							*/
						}
					}
					elseif ($_SESSION['permission'] == 6)
					{
						echo "<a href='/?section=edit&id=".$id."&comment=nwedit&id_edit=".$row_news_comment['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=nwcomment&id=".$id."&comment=delete&id_delete=".$row_news_comment['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>";
						if ($_GET['comment'] == 'delete') 
						{
							$comment_id_delete = (INT)$_GET['id_delete'];
							mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' ") or die (mysql_error());
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=nwcomment&id=".$id."'>"; 
						}
					}
				echo '<p>'.$row_news_comment['hosting_comment_text'].'<hr>';
			}
				/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) {
					  // if we're on current page...
					  if ($x == $page) {
						 // 'highlight' it but don't make a link
						 echo "$x ";
					  // if not current page...
					  } else {
						 // make it a link
						 echo "<a href='/?section=nwcomment&id=$id&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center>";
				/****** end build pagination links ******/	
		}
		else 
		{
			echo $lang['BODY_NEWS_COMMENT_COMMENTS_NOT_YET_DONE'].'<p>';	
		}

	if (isset($_POST['Submit']))
	{
	    $errors = array(); // set the errors array to empty, by default
	    $fields = array(); // stores the field values
	    $success_message = "Paldies J�su Inform�cija Nos�t�ta";	
		// import the validation library
	    #require("include/validation.php");
	    require ("include/validation.php");
	    $rules = array(); // stores the validation rules

	  	// standard form fields
	  	$rules[] = "required,comment_text,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
	  
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
	 			
	 		$comment_text = $_POST['comment_text'];
	 		$comment_text = htmlentities($_POST['comment_text']);
			$comment_text = mysql_real_escape_string($_POST['comment_text']);
			$comment_text = trim($_POST['comment_text']);
			$comment_text = stripslashes($_POST['comment_text']);
			$comment_text = strip_script($_POST['comment_text']);
			$comment_text = bbcode_parser($_POST['comment_text']);
			$id 		  = (int)$_GET['id'];
			unset($_POST['token']);
			unset($_POST['comment_text']);
		
				if (mysql_query("INSERT INTO hosting_comment (hosting_comment_nick,hosting_comment_date,hosting_comment_text,hosting_comment_news_id) VALUES ('".$_SESSION['nick']."','".$last_time_seen."','".$comment_text."','".$id."')")) 
				{
					echo "<meta http-equiv='REFRESH' content='0'/>"; 
				}
				else
				{
					echo "Having Issue";
		 		}
	 		}
  		}
	}
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
	
	if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
	
		echo "<h4>{$lang['BODY_NEWS_COMMENT_COMMENT_ADD']}</h4>
		<form id='form1' name='form1' method='post'>
  		<p>
    	<textarea name='comment_text' cols='50' rows='10' id='textarea'>{$lang['BODY_NEWS_COMMENT_HINT']}
  		</textarea>
		<input type='hidden' name='token' value='{$token}'/> 
		<p>
		<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
		<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
		</p>
		</form></td>
		</tr>
          </table>            </td>
        </tr>
    </table></td>
  </tr>
</table>";
	}
}
else 
{
	echo $lang['BODY_NEWS_COMMENT_REGISTER_TO_COMMENT'];
}
?>