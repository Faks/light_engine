<?php
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
if ($_SESSION['logged_in']) 
{
	echo $redirect;
}
else 
{
	if (isset($_POST['submit']))
	{
		$errors = array(); // set the errors array to empty, by default
		$fields = array(); // stores the field values
		$success_message = "Paldies Jûsu Informâcija Nosûtîta";
		// import the form_validation library
		require 'include/library/form_validation.php';
		$rules = array(); // stores the form_validation rules
			
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
				$user_name = $myFilter->process($_POST["user_name"]);
	
				$user_password = htmlentities($_POST['user_password']);
				$user_password = mysql_real_escape_string($_POST['user_password']);
				$user_password = trim($_POST['user_password']);
				$user_password = stripslashes($_POST['user_password']);
				$user_password = addslashes($_POST['user_password']);
				$salt = generateSalt($_POST['user_name']);
				$user_password = generateHash($salt, $_POST['user_password']);
				#$user_password = $myFilter->process($_POST["user_password"]);
	
				$user_email = htmlentities($_POST['user_email']);
				$user_email = mysql_real_escape_string($_POST['user_email']);
				$user_email = trim($_POST['user_email']);
				$user_email = stripslashes($_POST['user_email']);
				$user_email = addslashes($_POST['user_email']);
				$user_email = $myFilter->process($_POST["user_email"]);
					
				$user_check_available = sprintf('SELECT hosting_user_name,hosting_user_email,COUNT(hosting_user_name),COUNT(hosting_user_email) FROM hosting_user WHERE hosting_user_name = "%s" OR hosting_user_email = "%s" ',$user_name,$user_email);
				$user_check_query = mysql_query($user_check_available) or die (mysql_error());
				$user_check = mysql_fetch_array($user_check_query);
					
				if ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 1)
				{
					echo "<div class='pagination'>".$lang['BODY_REGISTER_CHEKER_USER_NAME_IN_USE']."</div>";
				}
				elseif ($_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 1)
				{
					echo "<div class='pagination'>".$lang['BODY_REGISTER_CHEKER_EMAIL_IN_USE']."</div>";
				}
				elseif ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 2 && $_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 2)
				{
					echo "<div class='pagination'>".$lang['BODY_REGISTER_CHEKER_USER_NAME_AND_EMAIL_IN_USE']."</div>";
				}
				elseif ($_POST['user_name'] == $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 1 && $_POST['user_email'] == $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 1)
				{
					echo "<div class='pagination'>".$lang['BODY_REGISTER_CHEKER_USER_NAME_AND_EMAIL_IN_USE']."</div>";
				}
				elseif ($_POST['user_name'] != $user_check['hosting_user_name'] && $user_check['COUNT(hosting_user_name)'] == 0 && $_POST['user_email'] != $user_check['hosting_user_email'] && $user_check['COUNT(hosting_user_email)'] == 0)
				{
					if ($_POST['user_password'] == $_POST['user_password2'])
					{
						include("/include/modules/securimage/securimage.php");
						$img = new Securimage();
						$valid = $img->check($_POST['captcha']);
							
						if ($valid == true)
						{
							if (mysql_query("INSERT INTO hosting_user (hosting_user_name,hosting_user_password,hosting_user_email,hosting_user_join,hosting_user_last_time_seen) VALUES ('".$user_name."','".$user_password."','".$user_email."','".$last_time_seen."','".$last_time_seen."') ")  or die (mysql_error()) )
							{
								mysql_query("INSERT INTO hosting_new_member (hosting_new_member_date,hosting_new_member_name) VALUES ('{$date}','{$user_name}') ") or die(mysql_error());
	
								echo "<script language='javascript' type='text/javascript'>
										new Messi('You Have Complete Registration Successfully.', {title: 'Welcome To Gamer Ludus Community', titleClass: 'success', buttons: [{id: 0, label: 'Close', val: 'X'}]});
										</script>
								<meta http-equiv='REFRESH' content='5;url=/?section=news'>";
							}
						}
						elseif ($valid == false)
						{
							echo "<div class='pagination'>".$lang['BODY_REGISTER_CHEKER_CAPTCHA_INVALID']."</div>";
						}
					}
					else
					{
						echo "<center><div class='pagination'>{$lang['BODY_REGISTER_CHEKER_PASS_NOT_SAME_INVALID']}</div></center>";
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
		echo "<div class='pagination'><b>{$lang['BODY_REGISTER_VALIDATION_TEXT']}</b><br>";
		foreach ($errors as $error)
		echo "<span style='color:darkred'>$error</span><br>";
	
		echo "</ul></div>";
		}
	
			if (!empty($message))
		{
		echo "<div class='notify'>{$success_message}</div></div>";
		}
		}
	
		echo $redirect;

	/*
		echo "<div class='subholder'>
	
		<form method='post' target='_self' >
	
            <h1 class='post_title'>Registration to our gaming community !!!</h1>
	
				 <label>
				 <span>".$lang['BODY_REGISTER_USERNAME']."</span> <input name='user_name' type='text' id='text1' size='25' value='{$fields['user_name']}' />
					 </label>
	
					 <label>
					 <span>".$lang['BODY_REGISTER_EMAIL']."</span> <input name='user_email' type='text' id='text2' size='25' value='{$fields['user_email']}' />
					 </label>
	
	
					 <label>
					 <span>".$lang['BODY_REGISTER_PASSWORD']."</span> <input name='user_password' type='password' id='password1' size='25' value='{$fields['user_password']}' />
					 </label>
	
	
	
					 <label>
					 <span>".$lang['BODY_REGISTER_PASSWORD_CONFIRM']."</span>
				<input type='password' name='user_password2' id='password2' size='25' value='{$fields['user_password']}' />
				</label>
	
	
	
					<div align='center'><img id='captcha' src='include/modules/securimage/securimage_show.php' alt='CAPTCHA Image' /></div>
					<label>
					<span>".$lang['BODY_REGISTER_CAPTCHA']."</span> <input type='text' name='captcha' size='25' maxlength='6' />
					</label>
	
	
					<div align='center'><input type='checkbox' name='tos' id='tos' /><span>".$lang['BODY_REGISTER_TOS']."<span> </div><br>
	      
	
		  <input type='hidden' name='token' value='{$token}'/>
		  <input type='submit' name='submit' id='submit_b' value='{$lang['BODY_REGISTER_BUTTON_SUBMIT']}' />
	
			  		</form>
			  		</div>";
					*/
}
?>