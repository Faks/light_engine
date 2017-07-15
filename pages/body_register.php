<link href="SpryAssets/style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/validation.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 0)
	{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))

		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
		{
			echo $redirect;	

		}
	}
}
else 
{
	$select = mysql_query("select * from hosting_maintenance");
	while($row = mysql_fetch_array($select))

	if($row[hosting_maintenance_status ] == "1" )
	{
		echo $row[hosting_maintenance_text];
	}
	else 
	{
			$status = "2011-05-31";
		if ($status == "2011-05-31")
		{
			if (isset($_POST['submit']))
			{
			   $errors = array(); // set the errors array to empty, by default
			   $fields = array(); // stores the field values
			   $success_message = "Paldies Jûsu Informâcija Nosûtîta";	
				// import the validation library
			  require ("include/validation.php");
			  $rules = array(); // stores the validation rules
			
			  // standard form fields
			  $rules[] = "required,user_name,{$lang['BODY_REGISTER_VALIDATION_FILL_USERNAME']}";
			  $rules[] = "is_alpha,user_name,{$lang['BODY_REGISTER_VALIDATION_INVALID_FORMAT_USERNAME']}";
			  $rules[] = "required,user_email,{$lang['BODY_REGISTER_VALIDATION_FILL_EMAIL']}";
			  $rules[] = "valid_email,user_email,{$lang['BODY_REGISTER_VALIDATION_FILL_VALID_EMAIL']}";
			  $rules[] = "required,user_password,{$lang['BODY_REGISTER_VALIDATION_FILL_PASSWORD']}";
			  $rules[] = "required,user_password2,{$lang['BODY_REGISTER_VALIDATION_FILL_CONFIRM_PASSWORD']}";
			  $rules[] =  "same_as,user_password,user_password2,{$lang['BODY_REGISTER_VALIDATION_SAME_AS_CONFIRM_PASSWORD']}";
			  $rules[] = "required,captcha,{$lang['BODY_REGISTER_VALIDATION_FILL_CAPTCHA']}";
			  $rules[] = "required,tos,{$lang['BODY_REGISTER_VALIDATION_CONFIRM_TOS']}";
			  
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
			  		$user_name = htmlentities($_POST['user_name']);
			  		$user_name = mysql_real_escape_string($_POST['user_name']);
					$user_name = trim($_POST['user_name']);
					$user_name = stripslashes($_POST['user_name']);
					$user_name = addslashes($_POST['user_name']);
								
					$user_password = htmlentities($_POST['user_password']);	
					$user_password = mysql_real_escape_string($_POST['user_password']);
					$user_password = trim($_POST['user_password']);	
					$user_password = stripslashes($_POST['user_password']);
					$user_password = addslashes($_POST['user_password']);
					#$user_password = hash('sha512',$salt.$_POST['user_password']); 
					#$user_password = crypt($_POST['user_password'], $salt); 
					$salt = generateSalt($_POST['user_name']);
					$user_password = generateHash($salt, $_POST['user_password']);
								
					$user_email = htmlentities($_POST['user_email']);	
					$user_email = mysql_real_escape_string($_POST['user_email']);
					$user_email = trim($_POST['user_email']);
					$user_email = stripslashes($_POST['user_email']);
					$user_email = addslashes($_POST['user_email']);
					
					$user_check_available = sprintf('SELECT hosting_user_name,hosting_user_email,COUNT(hosting_user_name),COUNT(hosting_user_email) FROM hosting_user WHERE hosting_user_name = "%s" OR hosting_user_email = "%s" ',$user_name,$user_email);
					$user_check_query = mysql_query($user_check_available) or die (mysql_error());
					$user_check = mysql_fetch_array($user_check_query);
					
					if ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 1) 
					{
						echo $lang['BODY_REGISTER_CHEKER_USER_NAME_IN_USE'];
					}
					elseif ($_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 1)
					{
						echo $lang['BODY_REGISTER_CHEKER_EMAIL_IN_USE'];
					}
					elseif ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 2 && $_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 2)
					{
						echo $lang['BODY_REGISTER_CHEKER_USER_NAME_AND_EMAIL_IN_USE'];
					}
					elseif ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 1 && $_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 1)
					{
						echo $lang['BODY_REGISTER_CHEKER_USER_NAME_AND_EMAIL_IN_USE'];
					}
					elseif ($_POST['user_name'] != $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 0 && $_POST['user_email'] != $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 0)
					{
						if ($_POST['user_password'] == $_POST['user_password2']) 
						{
							include("include/securimage/securimage.php");
							$img = new Securimage();
							$valid = $img->check($_POST['captcha']);
							
							if ($valid == true) 
							{
								if (mysql_query("INSERT INTO hosting_user (hosting_user_name,hosting_user_password,hosting_user_email,hosting_user_join,hosting_user_last_time_seen) VALUES ('".$user_name."','".$user_password."','".$user_email."','".$last_time_seen."','".$last_time_seen."') ") )	
								{
									echo "<center><b>{$lang['BODY_REGISTER_SUCCESS']}</b></center><br><meta http-equiv='REFRESH' content='5;url=/?section=news'>";
								}
							}
							elseif ($valid == false)
							{
								echo $lang['BODY_REGISTER_CHEKER_CAPTCHA_INVALID'];
							}	
						}
						else 
						{
							echo "<center>{$lang['BODY_REGISTER_CHEKER_PASS_NOT_SAME_INVALID']}</center>";
						}
					}
			  	} 
			  }		
			}

		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;

    if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_REGISTER_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}

	echo "<center><form method='post' target='_self' >
  <span id='sprytextfield1'>".$lang['BODY_REGISTER_USERNAME']."<br />
  <input name='user_name' type='text' id='text1' size='25' value='{$fields['user_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_REGISTER_USERNAME_REQUIRED']}</span><span class='textfieldMinCharsMsg'>{$lang['BODY_REGISTER_USERNAME_LENGTH_REQUIRED']}</span></span> <br />
  
    </p>
  
  <span id='sprytextfield2'>".$lang['BODY_REGISTER_EMAIL']."<br />
  <input name='user_email' type='text' id='text2' size='25' value='{$fields['user_email']}' />
  <span class='textfieldInvalidFormatMsg'>{$lang['BODY_REGISTER_INVALID_EMAIL']}</span><span class='textfieldRequiredMsg'>{$lang['BODY_REGISTER_EMAIL_REQUIRED']}</span></span><br />
  
    </p>
  
  <span id='sprypassword1'>".$lang['BODY_REGISTER_PASSWORD']." <br />
  <input name='user_password' type='password' id='password1' size='25' value='{$fields['user_password']}' />
  <span class='passwordRequiredMsg'>{$lang['BODY_REGISTER_PASSWORD_REQUIRED']}</span><span class='passwordMinCharsMsg'>{$lang['BODY_REGISTER_PASSWORD_LENGTH_REQUIRED']}</span></span> <br />

    </p>
    
    <span id='password2'>
  <label for='password2'>".$lang['BODY_REGISTER_PASSWORD_CONFIRM']."</label><br>
  <input type='password' name='user_password2' id='password2' size='25' value='{$fields['user_password']}' />
  <span class='confirmRequiredMsg'>".$lang['BODY_REGISTER_PASSWORD_CONFIRM_REQUIRED']."</span><span class='confirmInvalidMsg'>{$lang['BODY_REGISTER_INVALID_DONT_MATCH']}</span></span><br />
    
  </p>
    
   <img id='captcha' src='include/securimage/securimage_show.php' alt='CAPTCHA Image' />
   <br>
   <span id='sprycaptcha'>
    <label for='captcha'>".$lang['BODY_REGISTER_CAPTCHA']."</label>
    <br>
    <input type='text' name='captcha' size='25' maxlength='6' />
    <span class='textfieldRequiredMsg'>".$lang['BODY_REGISTER_CAPTCHA_REQUIRED']."</span></span><br />
    
	</p>
	
	  <span id='tos'>
  <input type='checkbox' name='tos' id='tos' />
  <label for='tos'>".$lang['BODY_REGISTER_TOS']."</label>
  <span class='checkboxRequiredMsg'><b>".$lang['BODY_REGISTER_TOS_REQUIRED']."</b></span></span>
  
  </p>
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_REGISTER_BUTTON_SUBMIT']}'  spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_REGISTER_BUTTON_RESET']}' />
</form></center>";
			}
			else 
			{
				echo $lang['BODY_REGISTER_CLOSED']."<img src='/img/joker.jpg' />";
			}
	}
}
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], minChars:4,hint:"<?php echo $lang['BODY_REGISTER_HINT_USERNAME']; ?>"});
var sprycaptcha = new Spry.Widget.ValidationTextField("sprycaptcha", "none", {validateOn:["blur"], minChars:6,hint:"<?php echo $lang['BODY_REGISTER_HINT_CAPTCHA']; ?>"});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"], minChars:6});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"], hint:"<?php echo $lang['BODY_REGISTER_HINT_EMAIL']; ?>"});
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("tos");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("password2", "password1", {validateOn:["blur", "change"]});
</script>