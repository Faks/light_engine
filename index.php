<?php 
require ("include/config_inc.php");
$bbcode = new BBCode;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gamer Ludus Community</title>
<link rel="shortcut icon" href="/images/favicon_ludus.ico" />

<meta name="Description" content="Gamer Ludus Community is with many servers,Counter-Strike Source,Counter-Strike Global Offensive,Left 4 Dead,Left 4 Dead 2,Team Fortress 2,Killing Floor,It's Coming">
<meta name="Keywords" content="gamerludus,Gamer Ludus,css,csgo,tf2,kl,l4,l4d2,Gameplay By Faks,hakerx1">
 <meta name="wot-verification" content="0d2aadc0413c1f342a4a"/> 
<link type="text/css" rel="stylesheet" href="style.css"  />
<link rel="stylesheet" type="text/css" href="include/modules/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="include/modules/markitup/sets/bbcode/style.css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="css/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
if( (self.parent && !(self.parent===self))
    &&(self.parent.frames.length!=0)){
    self.parent.location=document.location
}
</script>

<script type="text/javascript">
    window._idl = {};
    _idl.variant = "banner";
    (function() {
        var idl = document.createElement('script');
        idl.type = 'text/javascript';
        idl.async = true;
        idl.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'members.internetdefenseleague.org/include/?url=' + (_idl.url || '') + '&campaign=' + (_idl.campaign || '') + '&variant=' + (_idl.variant || 'banner');
        document.getElementsByTagName('#defence')[0].appendChild(idl);
    })();
</script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.22.min.js" type="text/javascript"></script>
<script type="text/javascript" src="include/modules/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="include/modules/markitup/sets/bbcode/set.js"></script>

<script language="javascript">
$(document).ready(function()	{
    $('.bbcode').markItUp(myBbcodeSettings);
    $('.bbcode2').markItUp(myBbcodeSettings);

    $('#emoticons a').click(function() {
        emoticon = $(this).attr("title");
        $.markItUp( { replaceWith:emoticon } );
    });
});
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.spoiler-body').hide()
        jQuery('.spoiler-head').click(function(){
            jQuery(this).toggleClass("folded").toggleClass("unfolded").next().toggle()
        })
    })
</script>
</head>

<body>
<script src="js/messi.js" type="text/javascript"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113600445354739";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div class="wrap">
<div class="header">
        <div class="menu">
        	<ul>
        		<li><a href="/?section=news">News</a></li>
        		<li><a href="/?section=blog">Blog</a></li>
                <li><a href="/?section=download">Download</a></li>
                <li><a href="/?section=forum">Forum</a></li>
                <li><a href="/?section=liberalvellegis">The Book of the Law</a></li>
                <li><a href="/?section=adjudicium">The Court</a></li>
                <li><a href="/?section=tips">Tips Jar</a></li>
        		<li><a href="/?section=contact">Contact</a></li>
        		<li><a href="/?section=about">About</a></li>
        	</ul>
        </div>
                 
       <div class="logo"></div>
	</div>
	
    
  <div class="body_wrap clearfix">
    	<!-- Body -->
   	<div class="body"><?php
   	$config = array('comment'=>0, 'cdata'=>1);
   	$spec = 'i=-*; td, tr=style, id, -*; a=id(match="/[a-z][a-z\d.:\-`"]*/i"/minval=2), href(maxlen=100/minlen=34); img=-width,-alt';
   	#Filtring Sections from all know attack with basic filter
   	#$sanize_section = escapeshellcmd($_GET['section']);
   	$sanize_section = htmlentities($_GET['section']);
   	$sanize_section = mysql_real_escape_string($_GET['section']);
   	$sanize_section = stripslashes($_GET['section']);
   	$sanize_section = trim($_GET['section']);
   	$sanize_section = urlencode($_GET['section']);
   	$sanize_section = rawurlencode($_GET['section']);
   	#Filtering Section from all known attacks advanced
   	$myFilter_sanize_section = $myFilter->process($sanize_section);
   	$processed = htmLawed($myFilter_sanize_section, $config, $spec);

if ($processed && ctype_lower($processed) && ctype_alnum($processed)) 
{
	switch ($processed)
	{
		case 'news';
		require ('pages/news.php');
		break;
		
		case 'newsmore';
		require ('pages/read_more/news_read_more.php');
		break;
		
		case 'blog';
		require ('pages/blog.php');
		break;
		
		case 'blogmore';
		require ('pages/read_more/blog_read_more.php');
		break;
		
		case 'tips';
		require ('pages/tips.php');
		break;
		
		case 'download';
		require ('pages/download.php');
		break;
		
		case 'contact';
		require ('pages/contact.php');
		break;
		
		case 'downloadmore';
		require ('pages/read_more/download_group_read_more.php');
		break;
		
		case 'downloadgroup';
		require ('pages/read_more/download_group_view_read_more.php');
		break;
		
		case 'downloadtopic';
		require ('pages/read_more/download_group_view_topic_read_more.php');
		break;
		
		case 'downloadaddgame';
		require ('process/pages/download_add_game.php');
		break;
		
		case 'downloadaddgroup';
		require ('process/pages/download_add_category.php');
		break;
		
		case 'downloadaddtopic';
		require ('process/pages/download_add.php');
		break;
		
		case 'forum';
		require ('pages/forum.php');
		break;
		
		case 'forummore';
		require ('pages/read_more/forum_read_more.php');
		break;
		
		case 'forumtopic';
		require ('pages/read_more/forum_topic_read_more.php');
		break;
		
		case 'forumsubmore';
		require ('pages/read_more/forum_sub_forum_read_more.php');
		break;
		
		case 'forumsubtopic';
		require ('pages/read_more/forum_sub_topic_read_more.php');
		break;
		
		case 'liberalvellegis';
		require 'pages/thebookoflaw.php';
		break;
		
		#case 'adjudicium';
		#require 'pages/court.php';
		#break;
		
		case 'about';
		require ('pages/about.php');
		break;
		
		case 'join';
		require ('pages/register.php');
		break;
		
		case 'profile';
		require ('pages/profile.php');
		break;
		
		case 'pm';
		require ('pages/pm.php');
		break;
		
		case 'delete';
		require ('process/delete.php');
		break;
		
		case 'edit';
		require ('process/edit_rendition.php');
		break;
		
		case 'sandbox';
		require ('pages/sandox.php');
		break;
	
		default; //Obligati jabut savadak index fails tiek izmantots.
		require('pages/news.php');
	}
}
else
{
	echo $redirect;
}
?></div>
    	<!-- Body End-->
		<!-- Sidebar -->
    	<div class="sidebar">

			<!-- First Side-Bar Starts -->
			<!-- First Side-Bar Ends -->
		<div class="box">
			<div class="b_title">
					<p>Vieta Jūsu Reklāmai</p>
			</div>
            	<div class="b_content">
			
				Mana Bilde [Reklāmai]
					<p></p>
					
					<small>
					Ja ir jautājumi lūdzu rakstat uz:
				sia_dev@inbox.lv
				</small>
            	</div>
			
          </div>

			 			<div class="box" style="visibility: hidden;">
				<div class="b_title">
                	<p>Servers Status</p>
				</div>
            	<div class="b_content">
				   <!--
						# error_reporting( E_ALL ^ E_NOTICE );
						 global $lgsl_zone_number, $output;
						 $lgsl_zone_number = 1;
						 $output = "";
						 require "include/modules/lgsl/lgsl_files/lgsl_zone.php";
						 echo $output;
						 
						# $bbcode = new BBCode;
						# echo $bbcode->Parse("[url=http://terraria-server-list.com/server/433/][img]http://terraria-server-list.com/server/logo/433.png[/img][/url]");
					
					-->
				 
            	</div>
          </div>
            
 			<div class="box" style="visibility: hidden;">
				<div class="b_title">
                	<p>Servers Status</p>
				</div>
            	<div class="b_content">
				   <!--
						# error_reporting( E_ALL ^ E_NOTICE );
						 global $lgsl_zone_number, $output;
						 $lgsl_zone_number = 1;
						 $output = "";
						 require "include/modules/lgsl/lgsl_files/lgsl_zone.php";
						 echo $output;
						 
						# $bbcode = new BBCode;
						# echo $bbcode->Parse("[url=http://terraria-server-list.com/server/433/][img]http://terraria-server-list.com/server/logo/433.png[/img][/url]");
					
					-->
				 
            	</div>
          </div>
            
 			
 			<div class="box" style="visibility: hidden;">
				<div class="b_title">
                	<p>
                	<?php 
                	
                	if (!(isset($_SESSION['logged_in']))) 
                	{
                		echo "Login";
                	}
                	else
                	{
                		echo "My Cabinet";
                	}
                	
                	?></p>
				</div>
            	<div class="b_content">
                	<p>
                	
					<?php 
					if(isset($login_failed))
					{
						echo "<span style='color:#F63' class='errornp'>{$lang['LOGIN_FAILED']}</span>";
					}
					
					if(!(isset($_SESSION['logged_in'])))
					{
						echo "<form id='form1' name='login' method='post'>
						
						  <span id='username'>{$lang['LOGIN_USERNAME']}
						  <input name='name' type='text' id='name'/>
						  
							<br>
							
								<div class='validation'>
							 		<span class='textfieldRequiredMsg'>{$lang['LOGIN_USERNAME_REQUIRED']}</span>
							  		<span class='textfieldMinCharsMsg'>{$lang['LOGIN_USERNAME_LENGTH_REQUIRED']}</span>
							  </div>
						  </span>
						  
							</br>			
						
						  <span id='userpassword'>{$lang['LOGIN_USERPASSWORD']}
						  <input name='pass' type='password' id='pass'/>
						
						  <br>
						  
							  <div class='validation'>
							 		<span class='passwordRequiredMsg'>{$lang['LOGIN_PASSWORD_REQUIRED']}</span>
							 		<span class='passwordMinCharsMsg'>{$lang['LOGIN_PASSWORD_LENGTH_REQUIRED']}</span>
							  </div>
						  </span>
						  
						  </br>
						  
					  <input type='submit' name='login' id='login' value='{$lang['LOGIN_BUTTON_LOGIN']}' spry:hover='confirmRequiredMsg'/>
					  <input type='reset' name='Reset' id='Reset' value='{$lang['LOGIN_BUTTON_RESET']}' />
					</form>
					
					<br><a href='/?section=join' class='errornp'>Join Community</a></br>";
						
						
						
					}
					elseif($_SESSION['logged_in'])
					{
						echo "Welcome User {$_SESSION['nick']} <br> <a href='/?logout=yes'> {$lang['LOGIN_LOGOUT']}</a> <br> <a href='/?section=profile&name={$_SESSION['nick']}'>{$lang['LOGIN_MY_PROFILE']}</a> <br> <a href='/?section=pm&action=inbox'>{$lang['LOGIN_INBOX']}</a> <br> <a href='/?section=pm&action=outbox'>{$lang['LOGIN_OUTBOX']}</a>";
					}
					?>
                    </p>
					
				</div>
            </div>
            
                        			<!-- Second Side-Bar Starts -->
 			<div class="box" style="visibility: hidden;">
				<div class="b_title">
                	<p>Social </p>
				</div>
            	<div class="b_content">
            	   
					    <div class="fb-like" data-href="http://gamerludus.info/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					           
                    	<div class="g-plusone" data-href="http://www.facebook.com/GamerLudus"></div>
                    
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.facebook.com/GamerLudus" data-via="Faksx" data-related="Faksx">Tweet</a>
								<p></p>	
						<div class="fb-like-box" data-href="http://www.facebook.com/GamerLudus" data-width="180" data-show-faces="true" data-stream="false" data-header="true"></div>

				</div>
            </div>
            
 			<div class="box" style="visibility: hidden;">
					<div class="b_title">
						<p>We Support</p>
					</div>
					<div class="b_content">
						<ul class="sidemenu">
							<li><a href="http://internetdefenseleague.org"><img src="images/shield_badge.png" alt="Member of The Internet Defense League"  class="defence"/></a></li>
						<li><!--BEGIN NAMECHEAP LINK --><a href="Http://www.namecheap.com?aff=35948"><img src="http://files.namecheap.com/graphics/linkus/180x150-12.gif" height="150" width="180" border="0" alt="Domain Registrations starting at $9.98*"></a><!--END NAMECHEAP LINK --></li>
						</ul>
					</div>
				</div>
 			<!-- Second Side-Bar Ends-->
    </div>
		<!-- Sidebar End -->
<!-- begin of www.top.lv code //-->
<!-- end of www.top.lv code //-->
<br />


<!-- end of Statistika.lv code //-->

<!-- begin of counter.hackers.lv code //-->
<!-- end of counter.hackers.lv code //-->

<!-- Invisible Counters -->
 
  </div>		

	<!--Footer-->
	<footer>
		<p>Copyright 2012-2016&copy Gaming Ludus Design by NomaD &amp; Faks Powered By Light Engine v0.99 <b>Beta</b> Build RMT</p>
	</footer>
	<!--Footer End-->

</div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("username", "none", {validateOn:["blur"], minChars:4});
var sprypassword1 = new Spry.Widget.ValidationPassword("userpassword", {minChars:6, validateOn:["blur"]});
</script>
</body>
</html>
