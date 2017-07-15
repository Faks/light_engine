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
			echo "{$lang['BODY_DONATE_TEXT']}<br><br>"."<center><form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='K8QXPBG98YDMJ'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form></center>";
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
			echo "{$lang['BODY_DONATE_TEXT']}<br><br>"."<center><form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='K8QXPBG98YDMJ'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form></center>";
		}
}















?>