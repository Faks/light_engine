<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))

		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
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
  $rules[] = "required,contact_resason,{$lang['BODY_CONTACT_VALIDATION_FILL_REASON']}";
  $rules[] = "required,contact_title,{$lang['BODY_CONTACT_VALIDATION_FILL_TITLE']}";
  $rules[] = "required,contact_text,{$lang['BODY_CONTACT_VALIDATION_FILL_TEXT']}";
  
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
  		$contact_title = $_POST['contact_title'];
		$contact_title = mysql_real_escape_string($_POST['contact_title']);	
		$contact_title = htmlentities($_POST['contact_title']);
		$contact_title = trim($_POST['contact_title']);
		$contact_title = stripslashes($_POST['contact_title']);
		$contact_title = strip_script($_POST['contact_title']);
		$contact_title = bbcode_parser($_POST['contact_title']);
		
		$contact_resason = $_POST['contact_resason'];
		$contact_resason = mysql_real_escape_string($_POST['contact_resason']);
		$contact_resason = htmlentities($_POST['contact_resason']);
		$contact_resason = trim($_POST['contact_resason']);
		$contact_resason = stripslashes($_POST['contact_resason']);
		$contact_resason = strip_script($_POST['contact_resason']);
		$contact_resason = bbcode_parser($_POST['contact_resason']);
		
		$contact_text = $_POST['contact_text'];
		$contact_text = mysql_real_escape_string($_POST['contact_text']);
		$contact_text = htmlentities($_POST['contact_text']);
		$contact_text = trim($_POST['contact_text']);
		$contact_text = stripslashes($_POST['contact_text']);
		$contact_text = strip_script($_POST['contact_text']);
		$contact_text = bbcode_parser($_POST['contact_text']);
		unset($_POST['token']);
		 	
		$contact_insert = "INSERT INTO hosting_contact_us (contact_title,contact_name,contact_email,contact_time,contact_resason,contact_text) VALUES ('".$contact_title."','".$_SESSION['nick']."','".$_SESSION['email']."','".$last_time_seen."','".$contact_resason."','".$contact_text."') ";
		mysql_query($contact_insert);
			
	  	{
	    	echo "<meta http-equiv='REFRESH' content='0'/>"; 
   		}
   }
 }		
}
	    	  	
$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

  	echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <th scope='col'>
        <div align='left'>";
if (!empty($errors))
{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_CONTACT_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
}
	echo "<form name='contact' method='post' >
   ".$lang['BODY_CONTACT_REASON']."
  <br />
  <select name='contact_resason' id='select'>
  <option></option>
  <option>{$lang['BODY_CONTACT_REASON_1']}</option>
  <option>{$lang['BODY_CONTACT_REASON_2']}</option>
  <option>{$lang['BODY_CONTACT_REASON_3']}</option>
  <option>{$lang['BODY_CONTACT_REASON_4']}</option>
  <option>{$lang['BODY_CONTACT_REASON_5']}</option>
  </select>
  <br />
 ".$lang['BODY_CONTACT_TITLE']."
 <br />
  <input name='contact_title' type='text' value='{$fields['contact_title']}' />
  <br />
  ".$lang['BODY_CONTACT_TEXT']."
  <br />
  <textarea name='contact_text' cols='75' rows='15'value='{$fields['contact_text']}'></textarea>
  <br>
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_CONTACT_BUTTON_SUBMIT']}' />
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_CONTACT_BUTTON_RESET']}' />

</form>
</div>
</th>
  </tr>
    </table>";
			
		}
	}
}
else 
{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))

		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
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
  $rules[] = "required,contact_name,{$lang['BODY_CONTACT_VALIDATION_FILL_NAME']}";
  $rules[] = "required,contact_email,{$lang['BODY_CONTACT_VALIDATION_FILL_EMAIL']}";
  $rules[] = "valid_email,contact_email,{$lang['BODY_CONTACT_VALIDATION_FILL_VALID_EMAIL']}";
  $rules[] = "required,contact_resason,{$lang['BODY_CONTACT_VALIDATION_FILL_REASON']}";
  $rules[] = "required,contact_title,{$lang['BODY_CONTACT_VALIDATION_FILL_TITLE']}";
  $rules[] = "required,contact_text,{$lang['BODY_CONTACT_VALIDATION_FILL_TEXT']}";
  
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
  		$contact_title = $_POST['contact_title'];	
		$contact_title = mysql_real_escape_string($_POST['contact_title']);	
		$contact_title = htmlentities($_POST['contact_title']);
		$contact_title = trim($_POST['contact_title']);
		$contact_title = stripslashes($_POST['contact_title']);
		
		$contact_name = $_POST['contact_name'];
		$contact_name = mysql_real_escape_string($_POST['contact_name']);
		$contact_name = htmlentities($_POST['contact_name']);
		$contact_name = trim($_POST['contact_name']);
		$contact_name = stripslashes($_POST['contact_name']);
		
		$contact_email = $_POST['contact_email'];
		$contact_email = mysql_real_escape_string($_POST['contact_email']);
		$contact_email = htmlentities($_POST['contact_email']);
		$contact_email = trim($_POST['contact_email']);
		$contact_email = stripslashes($_POST['contact_email']);
		
		$contact_resason = $_POST['contact_resason'];
		$contact_resason = mysql_real_escape_string($_POST['contact_resason']);
		$contact_resason = htmlentities($_POST['contact_resason']);
		$contact_resason = trim($_POST['contact_resason']);
		$contact_resason = stripslashes($_POST['contact_resason']);
		
		$contact_text = $_POST['contact_text'];
		$contact_text = mysql_real_escape_string($_POST['contact_text']);
		$contact_text = htmlentities($_POST['contact_text']);
		$contact_text = trim($_POST['contact_text']);
		$contact_text = stripslashes($_POST['contact_text']);
		$contact_text = bbcode_parser($_POST['contact_text']);
		unset($_POST['token']);
		 	
		$contact_insert = "INSERT INTO hosting_contact_us (contact_title,contact_name,contact_email,contact_time,contact_resason,contact_text) VALUES ('".$contact_title."','".$contact_name."','".$contact_email."','".$last_time_seen."','".$contact_resason."','".$contact_text."') ";
		mysql_query($contact_insert);
			
	  	{
	    	echo "<meta http-equiv='REFRESH' content='0'/>"; 
   		}
   } 
 }		
}
	    	  	
$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;
	
  	echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <th scope='col'><div align='left'>"; 
  	if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_CONTACT_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
	echo "
       <form name='contact' method='post' >
  ".$lang['BODY_CONTACT_NAME']."
  <br />
    <input name='contact_name' type='text' value='{$fields['contact_name']}' />
  <br />
  ".$lang['BODY_CONTACT_EMAIL']."
  <br />
  <input name='contact_email' type='text' value='{$fields['contact_email']}' />
 <br />
  ".$lang['BODY_CONTACT_REASON']."
  <br />
  <select name='contact_resason' id='select'>
  <option></option>
  <option>{$lang['BODY_CONTACT_REASON_1']}</option>
  <option>{$lang['BODY_CONTACT_REASON_2']}</option>
  <option>{$lang['BODY_CONTACT_REASON_3']}</option>
  <option>{$lang['BODY_CONTACT_REASON_4']}</option>
  <option>{$lang['BODY_CONTACT_REASON_5']}</option>
  </select>
  <br />
 ".$lang['BODY_CONTACT_TITLE']."
 <br />
  <input name='contact_title' type='text' value='{$fields['contact_title']}' />
  <br />
 ".$lang['BODY_CONTACT_TEXT']."
  <br />
  <textarea name='contact_text' cols='75' rows='15'value='{$fields['contact_text']}'></textarea>
  <br>
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_CONTACT_BUTTON_SUBMIT']}' />
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_CONTACT_BUTTON_RESET']}' />

</form></div></th>
  </tr>
    </table>";
		}
}

																			
?>