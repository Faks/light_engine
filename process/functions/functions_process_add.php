<?php
function download_add_game($errors,$error,$token,$lang) 
{
	if (isset($_POST['Submit']))
	{
		$errors = array(); // set the errors array to empty, by default
		$fields = array(); // stores the field values
		$success_message = "Paldies J�su Inform�cija Nos�t�ta";
		// import the form_validation library
		require ("include/library/form_validation.php");
		$rules = array(); // stores the form_validation rules
						
		// standard form fields
		$rules[] = "required,icon,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
		$rules[] = "required,name,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
		$rules[] = "required,description,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
						
		$errors = validateFields($_POST, $rules);
						
		// if there were errors, re-populate the form fields
		if (!empty($errors))
		{
			$fields = $_POST;
		}	// no errors! redirect the user to the thankyou page (or whatever)
		else
		{
			if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
			{
				$download_icon = mysql_real_escape_string($_POST['icon']);
				$download_icon = htmlentities($_POST['icon']);			
				$download_icon = trim($_POST['icon']);
				$download_icon = stripslashes($_POST['icon']);
				$download_icon = addslashes($_POST['icon']);

				$download_name = mysql_real_escape_string($_POST['name']);
				$download_name = htmlentities($_POST['name']);
				$download_name = trim($_POST['name']);
				$download_name = stripslashes($_POST['name']);
				$download_name = addslashes($_POST['name']);
				
				$download_description = mysql_real_escape_string($_POST['description']);
				$download_description = htmlentities($_POST['description']);
				$download_description = trim($_POST['description']);
				$download_description = stripslashes($_POST['description']);
				$download_description = addslashes($_POST['description']);
									
				// process input
				unset($_POST['token']);
				unset($_POST['icon']);
				unset($_POST['description']);
						
				if (mysql_query("INSERT INTO download_game (icon,description,name) VALUES ('".$download_icon."','".$download_description."','".$download_name."')"))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=download'>";
				}
				else
				{
					echo "<div class='pagination'>Having Issue</div>";
				}
			}
		}
	}
	
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
							
		if (!empty($errors))
		{
			{
				echo "<div class='pagination'><div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
				foreach ($errors as $error)
				echo "<span style='color:darkred'>$error</span><br>";		
				echo "</ul></div></div>";
			}
						
			if (!empty($message))
			{
				echo "<div class='notify'>$success_message</div>";
			}
		}
		
		echo "<div class='subholder'>
            

           	  <form action='' method='post' name='form1' id='form1'>
                	<h1 class='post_title'>Download Add Game</h1>
                    
                <label>
                    	<span>Game Icon:</span> 
                    	<input name='icon' type='text' id='icon'/>
                </label>
                
                <label>
                    	<span>Name:</span> 
                    	<input name='name' type='text' id='name'/>
                </label>
                
                    <label>
                      <span>Description:</span>
                      <input name='description' type='text' id='description'/>
                </label>
                
				  <input type='hidden' name='token' value='{$token}'/>
                
                  <input name='Submit' type='submit' id='submit_b' value='Submit' /> 
              </form>
            </div>";
}

function download_add_game_category($errors,$error,$token,$lang) 
{
	if (isset($_POST['Submit']))
	{
		$errors = array(); // set the errors array to empty, by default
		$fields = array(); // stores the field values
		$success_message = "Paldies J�su Inform�cija Nos�t�ta";
		// import the form_validation library
		require ("include/library/form_validation.php");
		$rules = array(); // stores the form_validation rules
	
		// standard form fields
		$rules[] = "required,hide,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
		$rules[] = "required,name,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
	
		$errors = validateFields($_POST, $rules);
	
		// if there were errors, re-populate the form fields
		if (!empty($errors))
		{
			$fields = $_POST;
		}	// no errors! redirect the user to the thankyou page (or whatever)
		else
		{
			if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
			{
				$download_group_hide = mysql_real_escape_string($_POST['hide']);
				$download_group_hide = htmlentities($_POST['hide']);
				$download_group_hide = trim($_POST['hide']);
				$download_group_hide = stripslashes($_POST['hide']);
				$download_group_hide = addslashes($_POST['hide']);
	
				$download_group_name = mysql_real_escape_string($_POST['name']);
				$download_group_name = htmlentities($_POST['name']);
				$download_group_name = trim($_POST['name']);
				$download_group_name = stripslashes($_POST['name']);
				$download_group_name = addslashes($_POST['name']);
				
				#Laiks Stundas,minutes,sekundes
				$time = date("H:i:s");
				#Datums datums,menesis,gads
				$date = date("d/m/Y");
					
				// process input
				$download_game_id = (int)$_GET['id'];
				unset($_POST['token']);
				unset($_POST['hide']);
				unset($_POST['name']);
	
				if (mysql_query("INSERT INTO download_category (hide,name,time,date,author,download_game_id) VALUES ('".$download_group_hide."','".$download_group_name."','".$time."','".$date."','".$_SESSION['nick']."','".$download_game_id."')"))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadmore&id={$download_game_id}'>";
				}
				else
				{
					echo "<div class='pagination'>Having Issue</div>";
				}
			}
		}
	}
	
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
							
		if (!empty($errors))
		{
			{
				echo "<div class='pagination'><div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
				foreach ($errors as $error)
				echo "<span style='color:darkred'>$error</span><br>";		
				echo "</ul></div></div>";
			}
						
			if (!empty($message))
			{
				echo "<div class='notify'>$success_message</div>";
			}
		}
				
		echo "<div class='subholder'>
            

           	  <form action='' method='post' name='form1' id='form1'>
               	<h1 class='post_title'>Download Add Game Group</h1>
                <label>
                  <span>Hide</span><select name='hide' id='hide'>
                    <option selected='selected'>no</option>
                    <option>yes</option>
                  </select>
                </label>
               	<label>
                    	<span>Name:</span> 
                    	<input name='name' type='text' id='name'/>
                </label>
               	<input type='hidden' name='token' value='{$token}'/>
                
                  <input name='Submit' type='submit' id='submit_b' value='Submit' /> 
              </form>
            </div>";
}

function download_add($errors,$error,$token,$lang) 
{
	if (isset($_POST['Submit']))
	{
		$errors = array(); // set the errors array to empty, by default
		$fields = array(); // stores the field values
		$success_message = "Paldies J�su Inform�cija Nos�t�ta";
		// import the form_validation library
		require ("include/library/form_validation.php");
		$rules = array(); // stores the form_validation rules
	
		// standard form fields
		$rules[] = "required,hide,{hide}";
		$rules[] = "required,name,{name}";
		$rules[] = "required,size,{size}";
		$rules[] = "required,version,{version}";
		$rules[] = "required,short_version,{short_version}";
		$rules[] = "required,build,{build}";
		$rules[] = "required,type,{type}";
		$rules[] = "required,description,{description}";
		$rules[] = "required,link,{link}";
		$rules[] = "required,link_mirror,{link_mirror}";
		$rules[] = "required,link_mirror2,{link_mirror2}";
		$rules[] = "required,link_torrent,{link_torrent}";
		$rules[] = "required,link_wuala,{link_wuala}";
		$rules[] = "required,link_dropbox,{link_dropbox}";
		$rules[] = "required,link_skydrive,{link_skydrive}";
		$rules[] = "required,link_mega,{link_mega}";
		
		$errors = validateFields($_POST, $rules);
	
		// if there were errors, re-populate the form fields
		if (!empty($errors))
		{
			$fields = $_POST;
		}	// no errors! redirect the user to the thankyou page (or whatever)
		else
		{
			if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
			{
				$download_group_topic_hide = mysql_real_escape_string($_POST['hide']);
				$download_group_topic_hide = htmlentities($_POST['hide']);
				$download_group_topic_hide = trim($_POST['hide']);
				$download_group_topic_hide = stripslashes($_POST['hide']);
				$download_group_topic_hide = addslashes($_POST['hide']);
	
				$download_group_topic_name = mysql_real_escape_string($_POST['name']);
				$download_group_topic_name = htmlentities($_POST['name']);
				$download_group_topic_name = trim($_POST['name']);
				$download_group_topic_name = stripslashes($_POST['name']);
				$download_group_topic_name = addslashes($_POST['name']);
				
				$download_group_topic_name = mysql_real_escape_string($_POST['name']);
				$download_group_topic_name = htmlentities($_POST['name']);
				$download_group_topic_name = trim($_POST['name']);
				$download_group_topic_name = stripslashes($_POST['name']);
				$download_group_topic_name = addslashes($_POST['name']);
				
				$download_group_topic_size = mysql_real_escape_string($_POST['size']);
				$download_group_topic_size = htmlentities($_POST['size']);
				$download_group_topic_size = trim($_POST['size']);
				$download_group_topic_size = stripslashes($_POST['size']);
				$download_group_topic_size = addslashes($_POST['size']);
				
				$download_group_topic_version = mysql_real_escape_string($_POST['version']);
				$download_group_topic_version = htmlentities($_POST['version']);
				$download_group_topic_version = trim($_POST['version']);
				$download_group_topic_version = stripslashes($_POST['version']);
				$download_group_topic_version = addslashes($_POST['version']);
				
				$download_group_topic_short_version = mysql_real_escape_string($_POST['short_version']);
				$download_group_topic_short_version = htmlentities($_POST['short_version']);
				$download_group_topic_short_version = trim($_POST['short_version']);
				$download_group_topic_short_version = stripslashes($_POST['short_version']);
				$download_group_topic_short_version = addslashes($_POST['short_version']);
				
				$download_group_topic_build = mysql_real_escape_string($_POST['build']);
				$download_group_topic_build = htmlentities($_POST['build']);
				$download_group_topic_build = trim($_POST['build']);
				$download_group_topic_build = stripslashes($_POST['build']);
				$download_group_topic_build = addslashes($_POST['build']);
				
				$download_group_topic_type = mysql_real_escape_string($_POST['type']);
				$download_group_topic_type = htmlentities($_POST['type']);
				$download_group_topic_type = trim($_POST['type']);
				$download_group_topic_type = stripslashes($_POST['type']);
				$download_group_topic_type = addslashes($_POST['type']);
				
				$download_group_topic_description = mysql_real_escape_string($_POST['description']);
				$download_group_topic_description = htmlentities($_POST['description']);
				$download_group_topic_description = trim($_POST['description']);
				$download_group_topic_description = stripslashes($_POST['description']);
				$download_group_topic_description = addslashes($_POST['description']);
				
				$download_group_topic_link = mysql_real_escape_string($_POST['link']);
				$download_group_topic_link = htmlentities($_POST['link']);
				$download_group_topic_link = trim($_POST['link']);
				$download_group_topic_link = stripslashes($_POST['link']);
				$download_group_topic_link = addslashes($_POST['link']);
				
				$download_group_topic_link_mirror = mysql_real_escape_string($_POST['link_mirror']);
				$download_group_topic_link_mirror = htmlentities($_POST['link_mirror']);
				$download_group_topic_link_mirror = trim($_POST['link_mirror']);
				$download_group_topic_link_mirror = stripslashes($_POST['link_mirror']);
				$download_group_topic_link_mirror = addslashes($_POST['link_mirror']);
				
				$download_group_topic_link_mirror2 = mysql_real_escape_string($_POST['link_mirror2']);
				$download_group_topic_link_mirror2 = htmlentities($_POST['link_mirror2']);
				$download_group_topic_link_mirror2 = trim($_POST['link_mirror2']);
				$download_group_topic_link_mirror2 = stripslashes($_POST['link_mirror2']);
				$download_group_topic_link_mirror2 = addslashes($_POST['link_mirror2']);
				
				$download_group_topic_link_torrent = mysql_real_escape_string($_POST['link_torrent']);
				$download_group_topic_link_torrent = htmlentities($_POST['link_torrent']);
				$download_group_topic_link_torrent = trim($_POST['link_torrent']);
				$download_group_topic_link_torrent = stripslashes($_POST['link_torrent']);
				$download_group_topic_link_torrent = addslashes($_POST['link_torrent']);
				
				$download_group_topic_link_wuala = mysql_real_escape_string($_POST['link_wuala']);
				$download_group_topic_link_wuala = htmlentities($_POST['link_wuala']);
				$download_group_topic_link_wuala = trim($_POST['link_wuala']);
				$download_group_topic_link_wuala = stripslashes($_POST['link_wuala']);
				$download_group_topic_link_wuala = addslashes($_POST['link_wuala']);
				
				$download_group_topic_link_dropbox = mysql_real_escape_string($_POST['link_dropbox']);
				$download_group_topic_link_dropbox = htmlentities($_POST['link_dropbox']);
				$download_group_topic_link_dropbox = trim($_POST['link_dropbox']);
				$download_group_topic_link_dropbox = stripslashes($_POST['link_dropbox']);
				$download_group_topic_link_dropbox = addslashes($_POST['link_dropbox']);
				
				$download_group_topic_link_skydrive = mysql_real_escape_string($_POST['link_skydrive']);
				$download_group_topic_link_skydrive = htmlentities($_POST['link_skydrive']);
				$download_group_topic_link_skydrive = trim($_POST['link_skydrive']);
				$download_group_topic_link_skydrive = stripslashes($_POST['link_skydrive']);
				$download_group_topic_link_skydrive = addslashes($_POST['link_skydrive']);
				
				$download_group_topic_link_mega = mysql_real_escape_string($_POST['link_mega']);
				$download_group_topic_link_mega = htmlentities($_POST['link_mega']);
				$download_group_topic_link_mega = trim($_POST['link_mega']);
				$download_group_topic_link_mega = stripslashes($_POST['link_mega']);
				$download_group_topic_link_mega = addslashes($_POST['link_mega']);
				
				#Laiks Stundas,minutes,sekundes
				$time = date("H:i:s");
				#Datums datums,menesis,gads
				$date = date("d/m/Y");
					
				// process input
				$download_category_id = (int)$_GET['id'];
				unset($_POST['token']);
				unset($_POST['hide']);
				unset($_POST['name']);
				
				$select_download_category = mysql_query("SELECT id,download_game_id FROM download_category WHERE id = '{$download_category_id}' ");
				$download_category = mysql_fetch_array($select_download_category);
	
				if (mysql_query("INSERT INTO download_topic (author,date,time,hide,name,size,version,short_version,build,type,description,link,link_mirror,link_mirror2,link_torrent,link_wuala,link_dropbox,link_skydrive,link_mega,download_category_id,download_game_id) VALUES ('".$_SESSION['nick']."','".$date."','".$time."','".$download_group_topic_hide."','".$download_group_topic_name."','".$download_group_topic_size."','".$download_group_topic_version."','".$download_group_topic_short_version."','".$download_group_topic_build."','".$download_group_topic_type."','".$download_group_topic_description."','".$download_group_topic_link."','".$download_group_topic_link_mirror."','".$download_group_topic_link_mirror2."','".$download_group_topic_link_torrent."','".$download_group_topic_link_wuala."','".$download_group_topic_link_dropbox."','".$download_group_topic_link_skydrive."','".$download_group_topic_link_mega."','".$download_category_id."','".$download_category['download_game_id']."' )") or die(mysql_error()))
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadgroup&id={$download_category_id}'>";
				}
				#else
				#{
			#	mysql_error();
				#	echo "<div class='pagination'>Having Issue</div>";
				#}
			}
		}
	}
	
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
							
		if (!empty($errors))
		{
			{
				echo "<div class='pagination'><div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
				foreach ($errors as $error)
				echo "<span style='color:darkred'>$error</span><br>";		
				echo "</ul></div></div>";
			}
						
			if (!empty($message))
			{
				echo "<div class='notify'>$success_message</div>";
			}
		}
				
		echo "<div class='subholder'> 
           	  <form action='' method='post' name='form1' id='form1'>
               	<h1 class='post_title'>Download Add Game Topic</h1>

                <label>
                  <span>Hide:</span>
                  <select name='hide' id='hide'>
                    <option>no</option>
                    <option>yes</option>
                  </select>
                </label>
               	<label><span>Name:</span><input name='name' type='text' id='name'/>
                </label>
                
                <label><span>Size:</span><input name='size' type='text' /></label>
                
                
                <label><span>Version:</span><input name='version' type='text' /></label>

                 <label><span>Short Verison:</span><input name='short_version' type='text' /></label>

                <label><span>Build:</span><input name='build' type='text' /></label>
                
				<label>
				<span>Type:</span>
				  <select name='type' id='type'>
				    <option>Client</option>
				    <option>Patch</option>
				    <option>Maps</option>
				  </select>
				</label>
           <label><span>Description:</span><textarea name='description' cols='' rows=''></textarea></label>  
           
           <label><span>Direct:</span><input name='link' type='text' /></label>   
            
           <label><span>Mirror I:</span><input name='link_mirror' type='text' /></label>   
             
           <label><span>Mirror II:</span><input name='link_mirror2' type='text' /></label>   
              
           <label><span>Torrent:</span><input name='link_torrent' type='text' /></label>   
           
           <label><span>Wuala:</span><input name='link_wuala' type='text' /></label>   

           <label><span>Dropbox:</span><input name='link_dropbox' type='text' /></label> 

           <label><span>Skydrive:</span><input name='link_skydrive' type='text' /></label> 
           
           <label><span>Mega:</span><input name='link_mega' type='text' /></label> 
                
             <input type='hidden' name='token' value='{$token}'/>
                
             <input name='Submit' type='submit' id='submit_b' value='Submit' /> 
              </form>
			</div>";
}
?>