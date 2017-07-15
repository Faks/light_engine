<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1) 
	{
		$check_limit = mysql_query("SELECT COUNT(ticket_nick) FROM hosting_support WHERE ticket_nick = '{$_SESSION['nick']}' AND ticket_date = CURDATE()");
		while ($support_check = mysql_fetch_array($check_limit))
		
		if ($support_check['COUNT(ticket_nick)'] != "10")
		{
		
		if (isset($_POST['Submit']))
		{
			$errors = array(); // set the errors array to empty, by default
		 	$fields = array(); // stores the field values
		 	$success_message = "Paldies Jûsu Informâcija Nosûtîta";	
		 	// import the validation library
		 	#require("include/validation.php");
		 	require ("include/validation.php");
		 	$rules = array(); // stores the validation rules
		
		 	// standard form fields
		 	$rules[] = "required,support_title,{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_FILL_SUBJECT']}";
		 	$rules[] = "required,support_type,{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_FILL_ISSUE_TYPE']}";
		 	$rules[] = "required,support_domain,{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_FILL_DOMAIN']}";
		 	$rules[] = "required,support_text,{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_FILL_TEXT']}";
		  
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
	 			$support_title = $_POST['support_title'];
				$support_title = mysql_real_escape_string($_POST['support_title']);
				$support_title = htmlentities($_POST['support_title']);
				$support_title = trim($_POST['support_title']);
				$support_title = stripslashes($_POST['support_title']);
				
				$support_domain = $_POST['support_domain'];
				$support_domain = mysql_real_escape_string($_POST['support_domain']);
				$support_domain = htmlentities($_POST['support_domain']);
				$support_domain = trim($_POST['support_domain']);
				$support_domain = stripslashes($_POST['support_domain']);
				
				$support_text = $_POST['support_text'];
				$support_text = mysql_real_escape_string($_POST['support_text']);
				$support_text = htmlentities($_POST['support_text']);
				$support_text = trim($_POST['support_text']);
				$support_text = stripslashes($_POST['support_text']);
				$support_text = strip_script($_POST['support_text']);
				$support_text = bbcode_parser($_POST['support_text']);
				
				$support_type = $_POST['support_type'];
				$support_type = mysql_real_escape_string($_POST['support_type']);
				$support_type = htmlentities($_POST['support_type']);
				$support_type = trim($_POST['support_type']);
				$support_type = stripslashes($_POST['support_type']);
				unset($_POST['token']);
		
				$status = 1;
				$insert = "INSERT INTO hosting_support (ticket_nick,ticket_title,ticket_domain_name,ticket_status,ticket_text,ticket_issue_type,ticket_date,ticket_time) VALUES ('".$_SESSION['nick']."','".$support_title."','".$support_domain."','".$status."','".$support_text."','".$support_type."','".$date."','".$time."')";
    			mysql_query($insert);
    		{
				echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightusersupportpanel'>"; 
	 		}
	 	}	
	}
}	
	 	$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
	 
		echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_NAME']}</strong> </h3>
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_DAILY_TICKETS_LIMIT']} </strong><br />".
        $support_check['COUNT(ticket_nick)']." | "; 
			echo "".check_ticket_limit()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL']} </strong><br />
        {$lang['BODY_LIGHT_SUPPORT_PANEL_NAME_VERSION']} <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <td width='665' valign='top'><table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='ticket'>
        <tr>
          <td>";
	if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
          echo "<form id='form1' name='form1' method='post'>
          <p>
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_SUBJECT']}</strong><br />
        <input name='support_title' type='text' id='support_title' />
        <p>
         <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_ISSUE']}</strong><br />
                <select name='support_type' >
                  <option></option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_1']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_2']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_3']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_4']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_5']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_6']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_7']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_8']}</option>
                  <option>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_REASON_9']}</option>
                </select>
        <p>
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_DOMAIN']}</strong><br />
        <input name='support_domain' type='text' id='support_domain' />
	  	<p>
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_FORM_PROBLEM']}</strong><br />
	    <textarea name='support_text' cols='70' rows='15' id='textarea'>	</textarea>
	  	<input type='hidden' name='token' value='{$token}'/> 
	  	<p>
	  	<input type='submit' name='Submit' id='button' value='{$lang['BODY_LIGHT_SUPPORT_PANEL_BUTTON_SUBMIT']}' />
	  	  <input type='reset' name='reset' id='reset' value='{$lang['BODY_LIGHT_SUPPORT_PANEL_BUTTON_RESET']}' />
	  	
	  	</p>
</form></td>
        </tr>
      </table></td>
  </tr>
</table>";
		}
		else
		{
			echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
    <h3><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_NAME']}</strong>
    </h3><hr align='center' noshade='noshade' />
    <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_DAILY_TICKETS_LIMIT']} </strong><br />".
        $support_check['COUNT(ticket_nick)']." | "; 
			echo "".check_ticket_limit()."
    <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL']}
        </strong><br />
        {$lang['BODY_LIGHT_SUPPORT_PANEL_NAME_VERSION']}
      <strong>
      <hr align='center' noshade='noshade' /></div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
  <tr>
    <td><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_LIMIT_REACH']}</strong></td>
  </tr>
  </table></td>
  </tr>
</table>";
		}
	}
	
	if ($_SESSION['permission'] <= 2 AND $_SESSION['hosting'] == 0) 
	{
		echo $redirect;
	}

}
else 
{
	echo $redirect;
}
?>