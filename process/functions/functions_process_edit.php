<?php
function news_section_edit($id,$news_id) 
{
	#error_reporting(E_ALL);
	#ini_set('display_errors', '1');
	
	$news_id = (INT)$_GET['news_id'];
	
	if ($id == $news_id) 
	{
		$news_select = mysql_query("SELECT * FROM news WHERE id = ".$id." ") or die(mysql_error());
		while($news_edit = mysql_fetch_array($news_select))
		{
		
			$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM news WHERE id = '$id' ");
			while ($id_filter = mysql_fetch_array($id_select_filter))
			{
				if ($id_filter['MAX(id)'] == $id)
				{					
					$edit_news_title = mysql_real_escape_string($_POST['title']);
					$edit_news_title = htmlentities($_POST['title']);
					$edit_news_title = trim($_POST['title']);
					$edit_news_title = stripslashes($_POST['title']);
					$edit_news_title = addslashes($_POST['title']);
					
					$edit_news_category = mysql_real_escape_string($_POST['category']);
					$edit_news_category = htmlentities($_POST['category']);
					$edit_news_category = trim($_POST['category']);
					$edit_news_category = stripslashes($_POST['category']);
					$edit_news_category = addslashes($_POST['category']);
					
					$edit_news_image = mysql_real_escape_string($_POST['image']);
					$edit_news_image = htmlentities($_POST['image']);
					$edit_news_image = trim($_POST['image']);
					$edit_news_image = stripslashes($_POST['image']);
					$edit_news_image = addslashes($_POST['image']);
					
					$edit_news_text_short = mysql_real_escape_string($_POST['shortext']);
					$edit_news_text_short = htmlentities($_POST['shortext']);
					$edit_news_text_short = trim($_POST['shortext']);
					$edit_news_text_short = stripslashes($_POST['shortext']);
					$edit_news_text_short = addslashes($_POST['shortext']);
					
					
					$edit_news_text_long = mysql_real_escape_string($_POST['longtext']);
					$edit_news_text_long = htmlentities($_POST['longtext']);
					$edit_news_text_long = trim($_POST['longtext']);
					$edit_news_text_long = stripslashes($_POST['longtext']);
					$edit_news_text_long = addslashes($_POST['longtext']);
						
					if (isset($_POST['Submit']))
					{					
						if (mysql_query("UPDATE news SET title = '".$edit_news_title."',category = '".$edit_news_category."',image = '".$edit_news_image."',text_short = '".$edit_news_text_short."',text_long = '".$edit_news_text_long."' WHERE id = '".$id."'  ") or die(mysql_error()))
						{
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
						}
						else
						{
							echo "<div class='pagination'>Possible Hack</div>";
						}
						
					}
						
		echo "<div class='subholder'>
           	  <form  method='post'>
                	<h1 class='post_title'>News Edit</h1>
                    
                    <label>
                    	<span>Title:</span> <input name='title' type='text' id='title' value='{$news_edit['title']}' />
                    </label>
				
                <label>
                    	<span>Category:</span> 
                        <select name='category' id='category'>";
						if ($news_edit['category'] == "Devlopment") 
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Updates")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "News")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>									
									";
						}
						elseif ($news_edit['category'] == "Bugs")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Game Server")
						{
							echo "<option>".$news_edit['category']."</option>
									
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Game Servers")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>									
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Network")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Hardware")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Downloads</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Downloads")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Members</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Members")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Server Issues</option>
									";
						}
						elseif ($news_edit['category'] == "Server Issues")
						{
							echo "<option>".$news_edit['category']."</option>
									<option>Devlopment</option>
									<option>Updates</option>
									<option>News</option>
									<option>Bugs</option>
									<option>Game Server</option>
									<option>Game Servers</option>
									<option>Security</option>
									<option>Network</option>
									<option>Hardware</option>
									<option>Downloads</option>
									<option>Members</option>
									";
						}
                        echo "</select>
                </label>
                    
				
                <label>
     	 				<span title='[img]mana bilde[/img]'>Image:</span><input name='image' type='text' id='image' value='{$news_edit['image']}'/>
                </label>
                    
				
                
                    	<label><span>Short Text:</span> <textarea name='shortext' id='shortext' >{$news_edit['text_short']}</textarea></label>
               

				
                    	<label>
				<span>Long Text:</span> <textarea name='longtext' id='longtext' >{$news_edit['text_long']}</textarea>
                  </label> 
                    
                    
                  <input name='Submit' type='submit' id='submit_b' value='Update' /> 
                </form>
            </div>";
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
}

function news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id) 
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');
	
	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 0;
	$attr_method = 0;
	$xss_auto = 0;
	
	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End
	
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
			#$edit_comment_text = $myFilter->process($_POST["text"]);
			
			if (isset($_POST['Submit'])) 
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."'  ")) 
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
				}
				else
				{
					echo "<div class='pagination'>Possible Hack</div>";
				}
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
}


function blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id)
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');

	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 1;
	$attr_method = 1;
	$xss_auto = 1;

	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End

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
			#$edit_comment_text = $myFilter->process($_POST["text"]);
				
			if (isset($_POST['Submit']))
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."'  "))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
				}
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
}

function forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id)
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');

	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 1;
	$attr_method = 1;
	$xss_auto = 1;

	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End

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
			#$edit_comment_text = $myFilter->process($_POST["text"]);
				
			if (isset($_POST['Submit']))
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."'  "))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
				}
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
}

function news_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id) 
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');
	
	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 1;
	$attr_method = 1;
	$xss_auto = 1;
	
	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End
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
			#$edit_comment_text = $myFilter->process($_POST["text"]);
									
			if (isset($_POST['Submit']))
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' "))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
				}
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
}

function blog_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id)
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');

	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 1;
	$attr_method = 1;
	$xss_auto = 1;

	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End
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
			#$edit_comment_text = $myFilter->process($_POST["text"]);
				
			if (isset($_POST['Submit']))
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' "))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
				}
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
}

function forum_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id)
{
	#input filter
	require_once ('security/modules/inputfilter/class.inputfilter_clean.php');

	$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
	$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
	$tag_method = 1;
	$attr_method = 1;
	$xss_auto = 1;

	// more info on parameters in documentation.
	$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
	//Input filter End
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
			#$edit_comment_text = $myFilter->process($_POST["text"]);

			if (isset($_POST['Submit']))
			{
				if (mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' "))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
				}
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
}
?>