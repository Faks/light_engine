<?php 
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] >= '4') 
	{
		
		echo "<table width='400' border='0' align='left' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='50'><img src='bc.png '  alt='bc' name='bc'width='50' height='50' id='bc' title='Bitcoin'></td>
    <td width='550'>1PiWJtBQ7PnCVH2xHjxKQEFZrGDxGV1nvx</td>
  </tr>
  <tr>
    <td><img src='ltc.png' alt='ltc' name='ltc' width='50' height='50' id='ltc' title='Litecoin'></td>
    <td>LZd9igM7ELRR7yrVP37vZEJW98LrdMVKFX</td>
  </tr>
  <tr>
    <td><img src='dogec.png' alt='dogec' name='dogec' width='50' height='50' id='dogec' title='Dogecoin'></td>
    <td>DNAwti5EAH6xu4wmkSCVfYf53s23CnSLoS</td>
  </tr>
  <tr>
    <td><img src='megac.png' alt='megac' name='megac' width='50' height='50' id='megac' title='Megacoin'></td>
    <td>MQ94W3M3Lmnh6Ymqv6gjcgLxNzPMSZ2Rck</td>
  </tr>
  <tr>
    <td><img src='paypal.png' alt='paypal' name='paypal' width='50' height='50' id='paypal' title='Paypal'></td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
  <input type='hidden' name='cmd' value='_s-xclick'>
  <input type='hidden' name='hosted_button_id' value='485K8LT74TBRQ'>
  <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
  <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
  </form></td>
  </tr>
  <tr>
    <td><img src='fortumo-mobile-payments-logo.png' alt='fortumo' name='fortumo' width='50' height='25' id='fortumo' title='Fortumo'></td>
    <td><a id='fmp-button' href='#' rel='0bd74711da98cad60ed2980b8a169ec8'><img src='http://fortumo.com/images/fmp/fortumopay_96x47.png' width='96' height='47' alt='Mobile Payments by Fortumo' border='0' /></a></td>
  </tr>
</table>";
	}
}
else
{
	echo $redirect;
}
?>