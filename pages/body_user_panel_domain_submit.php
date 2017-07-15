<link href="SpryAssets/style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/validation.js" type="text/javascript"></script>
<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1) 
	{
		$select_dir_name = mysql_query("SELECT ftpd_owner,status,Dir from hosting_ftpd WHERE ftpd_owner = '".$_SESSION['nick']."' AND status = '1' ");
		$dir_name = mysql_fetch_array($select_dir_name);
			
		$count_domain_limits = mysql_query("SELECT COUNT(hosting_domain_owner) FROM hosting_domain WHERE hosting_domain_owner = '{$_SESSION['nick']}' ");
		while ($domain_count_limits = mysql_fetch_array($count_domain_limits))
		
		if ($_SESSION['hostingplan'] == 1 && $domain_count_limits['COUNT(hosting_domain_owner)'] != 2)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 1 && $domain_count_limits['COUNT(hosting_domain_owner)'] == 2) 
{
	echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>Hosting Information</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>Domain Limit</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
		echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT_REACH'] }</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 2 && $domain_count_limits['COUNT(hosting_domain_owner)'] != 5)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 2 && $domain_count_limits['COUNT(hosting_domain_owner)'] == 5) 
{
	echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>Hosting Information</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>Domain Limit</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
		echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT_REACH'] }</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");	
}
	elseif ($_SESSION['hostingplan'] == 3 && $domain_count_limits['COUNT(hosting_domain_owner)'] != 10)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 3 && $domain_count_limits['COUNT(hosting_domain_owner)'] == 10)
{	
echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>Hosting Information</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>Domain Limit</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
		echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT_REACH'] }</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");	
	
}
elseif ($_SESSION['hostingplan'] == 4 && $domain_count_limits['COUNT(hosting_domain_owner)'] != 15)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 4 && $domain_count_limits['COUNT(hosting_domain_owner)'] == 15)
{

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>Hosting Information</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>Domain Limit</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
		echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT_REACH'] }</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");	
	
}
elseif ($_SESSION['hostingplan'] == 5 && $domain_count_limits['COUNT(hosting_domain_owner)'] != 20)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == 5 && $domain_count_limits['COUNT(hosting_domain_owner)'] == 20) 
{
	echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>Hosting Information</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>Domain Limit</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
		echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT_REACH'] }</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");	
}
elseif ($_SESSION['hostingplan'] == 6)
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
	  $rules[] = "required,domain_name,{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_FILL_DOMAIN']}";
	  
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
  		$domain_name = $_POST['domain_name'];	
		$domain_name = mysql_real_escape_string($_POST['domain_name']);
		$domain_name = htmlentities($_POST['domain_name']);
		$domain_name = trim($_POST['domain_name']);
		$domain_name = stripslashes($_POST['domain_name']);
		$domain_name = addslashes($_POST['domain_name']);
		
		$domain_insert = "INSERT INTO hosting_domain (hosting_domain_domain,hosting_domain_docroot,hosting_domain_owner,hosting_domain_status) VALUES ('".$domain_name."','".$dir_name['Dir'].$domain_name."','".$_SESSION['nick']."','".'2'."')";
		mysql_query($domain_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
   		}
   } 
 }		
}

$token = sha1(uniqid(rand(), true));
$_SESSION['token'] = $token;

echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
       ");
		echo ("".check_domain_limit()."|");
		echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
		echo ("".check_mysqldb_limit()."|");
		echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
		echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
		echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
		
		echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
        echo ("".check_ftp_user_limit()."|");
        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
        <hr align='center' noshade='noshade' />
          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
        echo ("".check_hosting_plan_dates()."
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
    </div></td>
    <td width='665' valign='top'>");
	      if (!empty($errors))
	{
    	{
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
    
 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post' action=''>
  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
  <input name='domain_name' type='text' id='text1' size='50' value='{$fields['domain_name']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
  
  <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
elseif ($_SESSION['hostingplan'] == "")
{
	$select_hosting_information = mysql_query("SELECT * FROM hosting_order_plan WHERE hosting_order_plan_user_nick = '".$_SESSION['nick']."' ");
	while($hosting_information = mysql_fetch_array($select_hosting_information))
	
	if ($hosting_information['hosting_order_plan_total_domains'] == "2") 
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 1 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
	elseif ($hosting_information['hosting_order_plan_total_domains'] == "5")
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 2 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
	elseif ($hosting_information['hosting_order_plan_total_domains'] == "10") 
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 3 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
	elseif ($hosting_information['hosting_order_plan_total_domains'] == "15")
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 4 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
	elseif ($hosting_information['hosting_order_plan_total_domains'] == "20") 
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 5 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
	elseif ($hosting_information['hosting_order_plan_total_domains'] == "~") 
	{
		mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 6 WHERE hosting_user_name = '{$_SESSION['nick']}' ");
		echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>"; 
	}
}
	}
	elseif($_SESSION['permission'] <= 2 && $_SESSION['hosting'] == 0)
	{
		echo $redirect;
	}

}
else
{
	echo $redirect;
}


?>
<script type="text/javascript">
var domain = new Spry.Widget.ValidationTextField("domain", "none", {validateOn:["blur"], hint:"<?php echo $lang['BODY_LIGHT_USER_PANEL_DOMAIN_HINT_DOMAIN']; ?>"});
</script>