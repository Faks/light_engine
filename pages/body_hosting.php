<?php
#require_once 'pages/body_order_add.php';

if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		$select = mysql_query("select * from hosting_maintenance");
		while ($row = mysql_fetch_array($select))

		if ($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
		{
			if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
			{
				$hosting_order_plan = $_POST['plan'];
				$hosting_order_plan = mysql_real_escape_string($_POST['plan']);	
				$hosting_order_plan = htmlentities($_POST['plan']);
				$hosting_order_plan = trim($_POST['plan']);
				$hosting_order_plan = stripslashes($_POST['plan']);
				$hosting_order_plan = addslashes($_POST['plan']);
				$hosting_order_plan = strip_script($_POST['plan']);
					
				$hosting_order_plan_name = $_POST['months'];
				$hosting_order_plan_name = mysql_real_escape_string($_POST['months']);	
				$hosting_order_plan_name = htmlentities($_POST['months']);
				$hosting_order_plan_name = trim($_POST['months']);
				$hosting_order_plan_name = stripslashes($_POST['months']);
				$hosting_order_plan_name = addslashes($_POST['months']);
				$hosting_order_plan_name = strip_script($_POST['months']);
					
				$hosting_order_plan_price = $_POST['price'];
				$hosting_order_plan_price = mysql_real_escape_string($_POST['price']);	
				$hosting_order_plan_price = htmlentities($_POST['price']);
				$hosting_order_plan_price = trim($_POST['price']);
				$hosting_order_plan_price = stripslashes($_POST['price']);
				$hosting_order_plan_price = addslashes($_POST['price']);
				$hosting_order_plan_price = strip_script($_POST['price']);
				
				$hosting_order_plan_total_mysql_db = $_POST['totalmysqldb'];
				$hosting_order_plan_total_mysql_db = mysql_real_escape_string($_POST['totalmysqldb']);	
				$hosting_order_plan_total_mysql_db = htmlentities($_POST['totalmysqldb']);
				$hosting_order_plan_total_mysql_db = trim($_POST['totalmysqldb']);
				$hosting_order_plan_total_mysql_db = stripslashes($_POST['totalmysqldb']);
				$hosting_order_plan_total_mysql_db = addslashes($_POST['totalmysqldb']);
				$hosting_order_plan_total_mysql_db = strip_script($_POST['totalmysqldb']);
					
				$hosting_order_plan_total_domains = $_POST['totaldomains'];
				$hosting_order_plan_total_domains = mysql_real_escape_string($_POST['totaldomains']);	
				$hosting_order_plan_total_domains = htmlentities($_POST['totaldomains']);
				$hosting_order_plan_total_domains = trim($_POST['totaldomains']);
				$hosting_order_plan_total_domains = stripslashes($_POST['totaldomains']);
				$hosting_order_plan_total_domains = addslashes($_POST['totaldomains']);
				$hosting_order_plan_total_domains = strip_script($_POST['totaldomains']);
							
				$hosting_order_plan_user_nick = $_POST['os1'];
				$hosting_order_plan_user_nick = mysql_real_escape_string($_POST['os1']);	
				$hosting_order_plan_user_nick = htmlentities($_POST['os1']);
				$hosting_order_plan_user_nick = trim($_POST['os1']);
				$hosting_order_plan_user_nick = stripslashes($_POST['os1']);
				$hosting_order_plan_user_nick = addslashes($_POST['os1']);
				$hosting_order_plan_user_nick = strip_script($_POST['os1']);
				unset($_POST['token']);
					 	
				$order_insert = "INSERT INTO hosting_order_plan (hosting_order_plan,hosting_order_plan_name,hosting_order_plan_price,hosting_order_plan_MySQL_total_db,hosting_order_plan_total_domains,hosting_order_plan_user_nick,hosting_order_plan_order_datetime) VALUES ('".$hosting_order_plan."','".$hosting_order_plan_name."','".$hosting_order_plan_price."','".$hosting_order_plan_total_mysql_db."','".$hosting_order_plan_total_domains."','".$hosting_order_plan_user_nick."','".$last_time_seen."') ";
				if (mysql_query($order_insert) or die(mysql_error()))
				{
					#Dear Customer Our Team Will Process Your Order In Nearest Time,Estimated Time Is From 24-48 Hours
					echo "<meta http-equiv='REFRESH' content='0'/>";
				}
			}	
			  $token = sha1(uniqid(rand(), true));
			  $_SESSION['token'] = $token;	
			  
			$hosting_order_check_select = mysql_query("SELECT * FROM hosting_order_plan WHERE hosting_order_plan_user_nick = '".$_SESSION['nick']."' ");
			if (mysql_num_rows($hosting_order_check_select) == 0) 
			{
				echo "<table  border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
  <tr>
    <td width='157'>
        <form  method='post' name='order' class='border' id='order'>
  		<input name='plan' type='hidden' value='Hosting Plan 1' />
  		<input name='totalmysqldb' type='hidden' value='1'/>
  		<input name='totaldomains' type='hidden' value='2' />
  
          <center class='header' id='MyOrderTable'>
    	<strong>{$lang['BODY_HOSTING_HOSTING_PLAN_1']}</strong>
       
            <hr align='center' width='100%' size='1' />
          &euro;2.80 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_2']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_1_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         </div>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
          {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_2']} <img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}<img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='2.80' />
  <input type='hidden' name='months' value='2 Months' />
          <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
          <input type='hidden' name='token' value='{$token}'/>
          <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
         </center>
    
   <br />
   
        </form>
 </td>
    <td width='157'><form  method='post' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 2' />
    <input name='totalmysqldb' type='hidden' value='2'/>
    <input name='totaldomains' type='hidden' value='5' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_2']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;5.60 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_4']}
          </center>
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_2_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
          {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_5']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='5.60' />
  <input type='hidden' name='months' value='4 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
        </form></td>
    <td width='157'><form  method='post' name='order' class='border' id='order'>
      <input name='plan' type='hidden' value='Hosting Plan 3' />
      <input name='totalmysqldb' type='hidden' value='5'/>
  	  <input name='totaldomains' type='hidden' value='10' />
  
<center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_3']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;8.40 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_6']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_5_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_10']} <img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='8.40' />
  <input type='hidden' name='months' value='6 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='157'><form  method='post' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 4' />
    <input name='totalmysqldb' type='hidden' value='8'/>
    <input name='totaldomains' type='hidden' value='15' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_4']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;11.20 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_8']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_8_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']}<img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_15']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='11.20' />
  <input type='hidden' name='months' value='8 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='157'><form  method='post' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 5' />
    <input name='totalmysqldb' type='hidden' value='10'/>
  	<input name='totaldomains' type='hidden' value='20' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_5']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;14.00 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_10']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_10_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_20']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='14.00' />
  <input type='hidden' name='months' value='10 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='158'><form  method='post' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 6' />
    <input name='totalmysqldb' type='hidden' value='~'/>
    <input name='totaldomains' type='hidden' value='~' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_6']}</strong>
            <hr align='center' width='100%' size='1' />
          &#x20AC;16.80 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_12']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_~_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_~']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='16.80' />
  <input type='hidden' name='months' value='12 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
   <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
  </tr>
</table>";
			}
			else
			{
				$hosting_plan_my_select = mysql_query("SELECT * FROM hosting_order_plan WHERE hosting_order_plan_user_nick = '".$_SESSION['nick']."' ");
				if (mysql_num_rows($hosting_plan_my_select) == 1) 
				{
					while ($hosting_plan_my_show = mysql_fetch_array($hosting_plan_my_select))
					if ($hosting_plan_my_show['hosting_order_plan_expired'] == 'yes')
					{
						if (mysql_query("DELETE FROM hosting_order_plan WHERE hosting_order_plan_user_nick = '".$_SESSION['nick']."' AND hosting_order_plan_expired = 'yes' ")) 
						{
							echo "<meta http-equiv='REFRESH' content='0'/>"; 
						}
					}
					elseif ($hosting_plan_my_show['hosting_order_plan_expired'] == 'no') 
					{
						echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
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
    <td width='665' valign='top'><table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
        <tr>
          <td width='200' ><strong>{$lang['BODY_HOSTING_HOSTING_MY_ORDER']}</strong>            <hr align='center' width='100%' noshade='noshade' /></td>
        </tr>
        <tr>
          <td><table width='220' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
  <tr>
    <td>
        <form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='order' id='order'>
  <input type='hidden' name='cmd' value='_s-xclick' />
  <input type='hidden' name='hosted_button_id' value='56C8UKZDXP3ZS' />
  <input type='hidden' name='on0' value='Hosting Plan Choise' />
  <input name='os0' type='hidden' value='{$hosting_plan_my_show['hosting_order_plan']} :: {$hosting_plan_my_show['hosting_order_plan_name']}' />
  
          <center class='header' id='MyOrderTable'>
            <strong>";
						if ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 1") 
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_1'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 2")
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_2'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 3")
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_3'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 4")
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_4'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 5")
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_5'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan'] == "Hosting Plan 6")
						{
							echo $lang['BODY_HOSTING_HOSTING_PLAN_6'];	
						}
						echo "</strong>
            <hr align='center' width='100%' size='1' />
           &euro;{$hosting_plan_my_show['hosting_order_plan_price']} :: ";
						if ($hosting_plan_my_show['hosting_order_plan_name'] == "2 Months") 
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_2'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan_name'] == "4 Months")
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_4'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan_name'] == "6 Months")
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_6'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan_name'] == "8 Months")
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_8'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan_name'] == "10 Months")
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_10'];
						}
						elseif ($hosting_plan_my_show['hosting_order_plan_name'] == "12 Months")
						{
							echo $lang['BODY_HOSTING_HOSTING_MONTHS_12'];
						}
						echo "
          </center>
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_MY_ORDER_PHP_VERSION']} {$hosting_plan_my_show['hosting_order_plan_php_version']} <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
      {$lang['BODY_HOSTING_HOSTING_MY_ORDER_MYSQL_VERSION']} {$hosting_plan_my_show['hosting_order_plan_MySQL_version']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MY_ORDER_MYSQL_TOTAL']} {$hosting_plan_my_show['hosting_order_plan_MySQL_total_db']} {$lang['BODY_HOSTING_HOSTING_MY_ORDER_MYSQL_TOTAL_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
      {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']}<img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
          {$lang['BODY_HOSTING_HOSTING_MY_ORDER_TOTAL_DOMAINS']} {$hosting_plan_my_show['hosting_order_plan_total_domains']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}<img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='€{$hosting_plan_my_show['hosting_order_plan_price']}' />
  <input type='hidden' name='months' value='{$hosting_plan_my_show['hosting_order_plan_name']}' />
          <input type='hidden' name='on1' value='Please Enter Your Username' />
          <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
          <input type='hidden' name='currency_code' value='EUR' />
          <input type='submit' name='Confirm' id='Confirm' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_CONFIRM']}' />
          <a href='/?section=delete&action=cancelorder&id=".$hosting_plan_my_show['hosting_order_plan_id']."'><input type='button' name='Cancel' id='Cancel' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_CANCEL']}' /></a>
         </center>
    
   <br />
   
        </form>
 </td>
  </tr>
</table>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>";
					}
				}
				elseif (mysql_num_rows($hosting_plan_my_select) >= 2)
				{
					echo "We Are Encountering Issue With Your Hosting Plan Order,Please Contant Administrator As Soon It Is Possible";
				}
			}
		}
	}
	
	if ($_SESSION['permission'] < 2) 
	{
		echo $redirect;
	}
}
else 
{
	$select = mysql_query("select * from hosting_maintenance");
	while($row =mysql_fetch_array($select))

	if ($row[hosting_maintenance_status ] == "1" )
	{
		echo $row[hosting_maintenance_text];
	}
	else 
	{
		echo "<table  border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
  <tr>
    <td width='157'>
        <form  method='post' action='/?section=register' name='order' class='border' id='order'>
  		<input name='plan' type='hidden' value='Hosting Plan 1' />
  		<input name='totalmysqldb' type='hidden' value='1'/>
  		<input name='totaldomains' type='hidden' value='2' />
  
          <center class='header' id='MyOrderTable'>
    	<strong>{$lang['BODY_HOSTING_HOSTING_PLAN_1']}</strong>
       
            <hr align='center' width='100%' size='1' />
          &euro;2.80 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_2']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_1_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         </div>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
          {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_2']} <img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}<img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='2.80' />
  <input type='hidden' name='months' value='2 Months' />
          <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
          <input type='hidden' name='token' value='{$token}'/>
          <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
         </center>
    
   <br />
   
        </form>
 </td>
    <td width='157'><form  method='post' action='/?section=register' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 2' />
    <input name='totalmysqldb' type='hidden' value='2'/>
    <input name='totaldomains' type='hidden' value='5' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_2']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;5.60 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_4']}
          </center>
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_2_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
          {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_5']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='5.60' />
  <input type='hidden' name='months' value='4 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
        </form></td>
    <td width='157'><form  method='post' action='/?section=register' name='order' class='border' id='order'>
      <input name='plan' type='hidden' value='Hosting Plan 3' />
      <input name='totalmysqldb' type='hidden' value='5'/>
  	  <input name='totaldomains' type='hidden' value='10' />
  
<center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_3']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;8.40 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_6']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_5_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_10']} <img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='8.40' />
  <input type='hidden' name='months' value='6 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='157'><form  method='post' action='/?section=register' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 4' />
    <input name='totalmysqldb' type='hidden' value='8'/>
    <input name='totaldomains' type='hidden' value='15' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_4']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;11.20 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_8']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_8_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']}<img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_15']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='11.20' />
  <input type='hidden' name='months' value='8 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='157'><form  method='post' action='/?section=register' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 5' />
    <input name='totalmysqldb' type='hidden' value='10'/>
  	<input name='totaldomains' type='hidden' value='20' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_5']}</strong>
            <hr align='center' width='100%' size='1' />
          &euro;14.00 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_10']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_10_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_20']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='14.00' />
  <input type='hidden' name='months' value='10 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
  <input type='hidden' name='token' value='{$token}'/>
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
    <td width='158'><form  method='post' action='/?section=register' name='order' class='border' id='order'>
    <input name='plan' type='hidden' value='Hosting Plan 6' />
    <input name='totalmysqldb' type='hidden' value='~'/>
    <input name='totaldomains' type='hidden' value='~' />
  
          <center class='header' id='MyOrderTable'>
            <strong>{$lang['BODY_HOSTING_HOSTING_PLAN_6']}</strong>
            <hr align='center' width='100%' size='1' />
          &#x20AC;16.80 :: {$lang['BODY_HOSTING_HOSTING_MONTHS_12']}</center>
          
 <hr align='center' width='100%' size='1' noshade='noshade' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_PHP_VERSION']}  <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
    <hr align='center' width='100%' size='1' />
    
         <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_MYSQL_VERSION']}<img src='img/hosting/ok.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
{$lang['BODY_HOSTING_HOSTING_MYSQL_TOTAL_~_DB']}<img src='img/hosting/ok.png' width='15' height='15' />
         </center>
         
    <hr align='center' width='100%' size='1' />
    
     <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_DOMAIN_REGISTER']} <img src='img/hosting/error.png' width='15' height='15' />
<hr align='center' width='100%' size='1' />
         {$lang['BODY_HOSTING_HOSTING_TOTAL_DOMAINS_~']}<img src='img/hosting/ok.png' width='15' height='15' />
     </center>
          
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_FTP_1_USER']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    <hr align='center' width='100%' size='1' />
    <p id='MyOrderTable'>{$lang['BODY_HOSTING_HOSTING_DAILY_BACKUP']}    <img src='img/hosting/ok.png' width='15' height='15' /></p>
    
  <hr align='center' width='100%' size='1' />
  
        <center class='header' id='MyOrderTable'>
       {$lang['BODY_HOSTING_HOSTING_HDD_SPACE']}  <img src='img/hosting/ok.png' width='15' height='15' />
       <hr align='center' width='100%' size='1' />
                   <input type='hidden' name='price' value='16.80' />
  <input type='hidden' name='months' value='12 Months' />
  <input name='os1' type='hidden' value='{$_SESSION['nick']}' />
   <input type='hidden' name='token' value='{$token}'/> 
  <input type='submit' name='Order' id='Order' value='{$lang['BODY_HOSTING_HOSTING_BUTTON_ORDER_NOW']}' />
        </center>
    
   <br />
   
    </form></td>
  </tr>
</table>";
	}	
}
?>