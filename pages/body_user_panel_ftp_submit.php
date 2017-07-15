<link href="SpryAssets/style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/validation.js" type="text/javascript"></script>
<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1)
	{
		$count_ftp = mysql_query("SELECT COUNT(ftpd_owner) FROM hosting_ftpd WHERE ftpd_owner = '{$_SESSION['nick']}' ");
		while($ftp_user_checker = mysql_fetch_array($count_ftp))

	if ($ftp_user_checker['COUNT(ftpd_owner)'] != "1")
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
  $rules[] = "required,ftpname,{$lang['BODY_LIGHT_USER_PANEL_FTP_VALIDATION_FILL_USERNAME']}";
  $rules[] = "required,ftppass,{$lang['BODY_LIGHT_USER_PANEL_FTP_VALIDATION_FILL_PASSWORD']}";
  
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
  		$ftpname = $_POST['ftpname'];		
		$ftpname = mysql_real_escape_string($_POST['ftpname']);
		$ftpname = htmlentities($_POST['ftpname']);
		$ftpname = trim($_POST['ftpname']);
		$ftpname = stripslashes($_POST['ftpname']);
		$ftpname = addslashes($_POST['ftpname']);
		#$dir_ftpname_salt = sha1($_POST['ftpname']);
		
		$ftppass = $_POST['ftppass'];
		$ftppass = mysql_real_escape_string($_POST['ftppass']);
		$ftppass = htmlentities($_POST['ftppass']);
		$ftppass = trim($_POST['ftppass']);
		$ftppass = stripslashes($_POST['ftppass']);
		$ftppass = addslashes($_POST['ftppass']);
		$ftppass = md5($_POST['ftppass']);
		#$dir_ftp_pass_salt = sha1($_SESSION['nick']);
		$dir_ftp_salt_by_name = hash(crc32b, $_SESSION['nick']); #update no sha512 jo parak lens 05.04.14
		
		// '".'/var/htdocs/'.$_SESSION['nick'].'/'."'
		#Linux /webroot/var/htdocs/'.$_SESSION['nick'].'/'."','".$_SESSION['nick']."' changed to Unix
		#Unix /usr/local/etc/www/webroot/var/htdocs_public/'.$dir_ftp_salt_by_name.'/'.$_SESSION['nick'].'/public_html/
		
		$ftp_user_insert = "INSERT INTO hosting_ftpd (User,status,Password,Uid,Gid,Dir,ftpd_owner) VALUES ('".$ftpname."','".'1'."','".$ftppass."','10{$_SESSION['id']}','10{$_SESSION['id']}','".'/home/faks/webroot/htdocs_public/'.$dir_ftp_salt_by_name.'/'.$_SESSION['nick'].'/public_html/'."','".$_SESSION['nick']."')";
		mysql_query($ftp_user_insert) or die (mysql_error());
		
  	    {
	    	echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>"; 
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
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_FTP_VALIDATION_TEXT']}</b><br>";
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
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td>
        </tr>
      <tr>
        <td><form id='form1' name='form1' method='post'>

  <span id='ftpname'>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_USERNAME']}<br />
  <input name='ftpname' type='text' id='text1' size='30' value='{$fields['ftpname']}' />
  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_FTP_USERNAME_REQUIRED']}</span><span class='textfieldMinCharsMsg'>{$lang['BODY_LIGHT_USER_PANEL_FTP_USERNAME_LENGTH_REQUIRED']}</span></span><br />
  
  <span id='ftppass'>{$lang['BODY_LIGHT_USER_PANEL_FTP_FROM_PASSWORD']}<br />
  <input name='ftppass' type='password' id='password1' size='30' value='{$fields['ftppass']}' />
  <span class='passwordRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_FTP_PASSWORD_REQUIRED']}</span><span class='passwordMinCharsMsg'>{$lang['BODY_LIGHT_USER_PANEL_FTP_PASSWORD_LENGTH_REQUIRED']}</span></span><br />
  
   <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_FTP_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_FTP_BUTTON_RESET']}' />
</form></td>
        </tr>
    </table></td>
  </tr>
</table>");
}
else 
{
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
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong><meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT_REACH']}</strong></td>
      </tr>
    </table></td>
  </tr>
</table>");
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("ftpname", "none", {hint:"<?php echo $lang['BODY_LIGHT_USER_PANEL_FTP_HINT_USERNAME']; ?>", validateOn:["blur"], minChars:4});
var sprypassword1 = new Spry.Widget.ValidationPassword("ftppass", {validateOn:["blur"], minChars:6});
</script>