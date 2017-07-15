<?php 
require ("include/config_inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="PRAGMA" content="NO-CACHE" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<title>Welcome To Our Project</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href=css/thickbox.css rel="stylesheet" type="text/css" />
<link href="SpryAssets/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11153852-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="include/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	 
    mode : "textareas",
    theme : "advanced",
    plugins : "bbcode,emotions, fullscreen,autoresize,preview",
    cleanup : "true",
	forced_root_block : false,
    force_br_newlines : false,
    force_p_newlines : false,
    theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,bullist,numlist,justifyleft, justifycenter, justifyright,undo,redo,link,unlink,image,emotions, forecolor,link,unlink,cleanup,autoresize,fullscreen,preview",
    theme_advanced_buttons2 : "",
    theme_advanced_toolbar_location : "top"
});	
</script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$(".btn-slide").click(function(){
$("#slide-panel").slideToggle("fast");
});
		 
});
</script>
<script src="SpryAssets/validation.js" type="text/javascript"></script>
<script type="text/javascript">
/*
 * Thickbox 3.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2007 cody lindley
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/
      
var tb_pathToImage = "img/loadingAnimation.gif";
/*!!!!!!!!!!!!!!!!! edit below this line at your own risk !!!!!!!!!!!!!!!!!!!!!!!*/
//on page load call tb_init
$(document).ready(function(){   
  tb_init('a.thickbox, area.thickbox, input.thickbox');//pass where to apply thickbox
  imgLoader = new Image();// preload image
  imgLoader.src = tb_pathToImage;
});
//add thickbox to href & area elements that have a class of .thickbox
function tb_init(domChunk){
  $(domChunk).click(function(){
  var t = this.title || this.name || null;
  var a = this.href || this.alt;
  var g = this.rel || false;
  tb_show(t,a,g);
  this.blur();
  return false;
  });
}
function tb_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link
  try {
    if (typeof document.body.style.maxHeight === "undefined") {//if IE 6
      $("body","html").css({height: "100%", width: "100%"});
      $("html").css("overflow","hidden");
      if (document.getElementById("TB_HideSelect") === null) {//iframe to hide select elements in ie6
        $("body").append("<iframe id='TB_HideSelect'></iframe><div id='TB_overlay'></div><div id='TB_window'></div>");
        $("#TB_overlay").click(tb_remove);
      }
    }else{//all others
      if(document.getElementById("TB_overlay") === null){
        $("body").append("<div id='TB_overlay'></div><div id='TB_window'></div>");
        $("#TB_overlay").click(tb_remove);
      }
    }
    
    if(tb_detectMacXFF()){
      $("#TB_overlay").addClass("TB_overlayMacFFBGHack");//use png overlay so hide flash
    }else{
      $("#TB_overlay").addClass("TB_overlayBG");//use background and opacity
    }
    
    if(caption===null){caption="";}
    $("body").append("<div id='TB_load'><img src='"+imgLoader.src+"' /></div>");//add loader to the page
    $('#TB_load').show();//show loader
    
    var baseURL;
     if(url.indexOf("?")!==-1){ //ff there is a query string involved
      baseURL = url.substr(0, url.indexOf("?"));
     }else{ 
         baseURL = url;
     }
     
     var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$/;
     var urlType = baseURL.toLowerCase().match(urlString);
    if(urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp'){//code to show images
        
      TB_PrevCaption = "";
      TB_PrevURL = "";
      TB_PrevHTML = "";
      TB_NextCaption = "";
      TB_NextURL = "";
      TB_NextHTML = "";
      TB_imageCount = "";
      TB_FoundURL = false;
      if(imageGroup){
        TB_TempArray = $("a[@rel="+imageGroup+"]").get();
        for (TB_Counter = 0; ((TB_Counter < TB_TempArray.length) && (TB_NextHTML === "")); TB_Counter++) {
          var urlTypeTemp = TB_TempArray[TB_Counter].href.toLowerCase().match(urlString);
            if (!(TB_TempArray[TB_Counter].href == url)) {            
              if (TB_FoundURL) {
                TB_NextCaption = TB_TempArray[TB_Counter].title;
                TB_NextURL = TB_TempArray[TB_Counter].href;
                TB_NextHTML = "<span id='TB_next'>&nbsp;&nbsp;<a href='#'>Next &gt;</a></span>";
              } else {
                TB_PrevCaption = TB_TempArray[TB_Counter].title;
                TB_PrevURL = TB_TempArray[TB_Counter].href;
                TB_PrevHTML = "<span id='TB_prev'>&nbsp;&nbsp;<a href='#'>&lt; Prev</a></span>";
              }
            } else {
              TB_FoundURL = true;
              TB_imageCount = "Image " + (TB_Counter + 1) +" of "+ (TB_TempArray.length);                      
            }
        }
      }
      imgPreloader = new Image();
      imgPreloader.onload = function(){    
      imgPreloader.onload = null;
        
      // Resizing large images - orginal by Christian Montoya edited by me.
      var pagesize = tb_getPageSize();
      var x = pagesize[0] - 150;
      var y = pagesize[1] - 150;
      var imageWidth = imgPreloader.width;
      var imageHeight = imgPreloader.height;
      if (imageWidth > x) {
        imageHeight = imageHeight * (x / imageWidth); 
        imageWidth = x; 
        if (imageHeight > y) { 
          imageWidth = imageWidth * (y / imageHeight); 
          imageHeight = y; 
        }
      } else if (imageHeight > y) { 
        imageWidth = imageWidth * (y / imageHeight); 
        imageHeight = y; 
        if (imageWidth > x) { 
          imageHeight = imageHeight * (x / imageWidth); 
          imageWidth = x;
        }
      }
      // End Resizing
      
      TB_WIDTH = imageWidth + 30;
      TB_HEIGHT = imageHeight + 60;
      $("#TB_window").append("<a href='' id='TB_ImageOff' title='Close'><img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='Close'>close</a> or Esc Key</div>");     
      
      $("#TB_closeWindowButton").click(tb_remove);
      
      if (!(TB_PrevHTML === "")) {
        function goPrev(){
          if($(document).unbind("click",goPrev)){$(document).unbind("click",goPrev);}
          $("#TB_window").remove();
          $("body").append("<div id='TB_window'></div>");
          tb_show(TB_PrevCaption, TB_PrevURL, imageGroup);
          return false;  
        }
        $("#TB_prev").click(goPrev);
      }
      
      if (!(TB_NextHTML === "")) {    
        function goNext(){
          $("#TB_window").remove();
          $("body").append("<div id='TB_window'></div>");
          tb_show(TB_NextCaption, TB_NextURL, imageGroup);        
          return false;  
        }
        $("#TB_next").click(goNext);
        
      }
      document.onkeydown = function(e){   
        if (e == null) { // ie
          keycode = event.keyCode;
        } else { // mozilla
          keycode = e.which;
        }
        if(keycode == 27){ // close
          tb_remove();
        } else if(keycode == 190){ // display previous image
          if(!(TB_NextHTML == "")){
            document.onkeydown = "";
            goNext();
          }
        } else if(keycode == 188){ // display next image
          if(!(TB_PrevHTML == "")){
            document.onkeydown = "";
            goPrev();
          }
        }  
      };
      
      tb_position();
      $("#TB_load").remove();
      $("#TB_ImageOff").click(tb_remove);
      $("#TB_window").css({display:"block"}); //for safari using css instead of show
      };
      
      imgPreloader.src = url;
    }else{//code to show html
      
      var queryString = url.replace(/^[^\?]+\??/,'');
      var params = tb_parseQuery( queryString );
      TB_WIDTH = (params['width']*1) + 30 || 630; //defaults to 630 if no paramaters were added to URL
      TB_HEIGHT = (params['height']*1) + 40 || 440; //defaults to 440 if no paramaters were added to URL
      ajaxContentW = TB_WIDTH - 30;
      ajaxContentH = TB_HEIGHT - 45;
      
      if(url.indexOf('TB_iframe') != -1){// either iframe or ajax window    
          urlNoQuery = url.split('TB_');
          $("#TB_iframeContent").remove();
          if(params['modal'] != "true"){//iframe no modal
            $("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton' title='Close'>close</a> or Esc Key</div></div><iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' > </iframe>");
          }else{//iframe modal
          $("#TB_overlay").unbind();
            $("#TB_window").append("<iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;'> </iframe>");
          }
      }else{// not an iframe, ajax
          if($("#TB_window").css("display") != "block"){
            if(params['modal'] != "true"){//ajax no modal
            $("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton'>close</a> or Esc Key</div></div><div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px'></div>");
            }else{//ajax modal
            $("#TB_overlay").unbind();
            $("#TB_window").append("<div id='TB_ajaxContent' class='TB_modal' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>");  
            }
          }else{//this means the window is already up, we are just loading new content via ajax
            $("#TB_ajaxContent")[0].style.width = ajaxContentW +"px";
            $("#TB_ajaxContent")[0].style.height = ajaxContentH +"px";
            $("#TB_ajaxContent")[0].scrollTop = 0;
            $("#TB_ajaxWindowTitle").html(caption);
          }
      }
          
      $("#TB_closeWindowButton").click(tb_remove);
      
        if(url.indexOf('TB_inline') != -1){  
          $("#TB_ajaxContent").append($('#' + params['inlineId']).children());
          $("#TB_window").unload(function () {
            $('#' + params['inlineId']).append( $("#TB_ajaxContent").children() ); // move elements back when you're finished
          });
          tb_position();
          $("#TB_load").remove();
          $("#TB_window").css({display:"block"}); 
        }else if(url.indexOf('TB_iframe') != -1){
          tb_position();
          if($.browser.safari){//safari needs help because it will not fire iframe onload
            $("#TB_load").remove();
            $("#TB_window").css({display:"block"});
          }
        }else{
          $("#TB_ajaxContent").load(url += "&random=" + (new Date().getTime()),function(){//to do a post change this load method
            tb_position();
            $("#TB_load").remove();
            tb_init("#TB_ajaxContent a.thickbox");
            $("#TB_window").css({display:"block"});
          });
        }
      
    }
    if(!params['modal']){
      document.onkeyup = function(e){   
        if (e == null) { // ie
          keycode = event.keyCode;
        } else { // mozilla
          keycode = e.which;
        }
        if(keycode == 27){ // close
          tb_remove();
        }  
      };
    }
    
  } catch(e) {
    //nothing here
  }
}
//helper functions below
function tb_showIframe(){
  $("#TB_load").remove();
  $("#TB_window").css({display:"block"});
}
function tb_remove() {
   $("#TB_imageOff").unbind("click");
  $("#TB_closeWindowButton").unbind("click");
  $("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();});
  $("#TB_load").remove();
  if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
    $("body","html").css({height: "auto", width: "auto"});
    $("html").css("overflow","");
  }
  document.onkeydown = "";
  document.onkeyup = "";
  return false;
}
function tb_position() {
$("#TB_window").css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
  if ( !(jQuery.browser.msie && jQuery.browser.version < 7)) { // take away IE6
    $("#TB_window").css({marginTop: '-' + parseInt((TB_HEIGHT / 2),10) + 'px'});
  }
}
function tb_parseQuery ( query ) {
   var Params = {};
   if ( ! query ) {return Params;}// return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) {continue;}
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}
function tb_getPageSize(){
  var de = document.documentElement;
  var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
  var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
  arrayPageSize = [w,h];
  return arrayPageSize;
}
function tb_detectMacXFF() {
  var userAgent = navigator.userAgent.toLowerCase();
  if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) {
    return true;
  }
}
</script>
<?php 
/*
if($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 0 && $_SESSION['admin'] == 0) 
	{
		echo  ("<script type='text/javascript'>
		$(document).ready(function() {
			var	number = 240;
			var url = '/?logout=yes';
	
			function countdown() {
				setTimeout(countdown, 1000);
				$('#box').html('Session Edning In ' + number + ' seconds.');
				number --;
	
				if(number<0) {
					window.location = url;
					number = 0;
				}
			}
	
			countdown();
			
		}); </script>");
	}
	elseif ($_SESSION['permission'] == 6 && $_SESSION['admin'] == 1)
	{
		echo  ("<script type='text/javascript'>
		$(document).ready(function() {
			var	number = 99999;
			var url = '/?logout=yes';
	
			function countdown() {
				setTimeout(countdown, 1000);
				$('#box').html('Session Edning In ' + number + ' seconds.');
				number --;
	
				if(number<0) {
					window.location = url;
					number = 0;
				}
			}
	
			countdown();
			
		}); </script>");
	}
}
*/
?>
</head>

<body>
<div id="slide-panel">
   <h3>&nbsp;</h3>
  <div class="loginform">
<?php 
if($_SESSION['logged_in'])
{
  echo "<span style='font-size: 10px;color:red' id='box'></span>";
}
?>
<div class="formdetails">
<?php
if ($login_failed)
{
	
	echo "<span style='color:#F63'>{$lang['LOGIN_FAILED']}</span>";
}

if(!$_SESSION['logged_in'])
{ 
	echo "<form id='form1' name='login' method='post'>
  <span id='username'>".$lang['LOGIN_USERNAME']."
  <input name='name' type='text' id='name'/>
  <span class='textfieldRequiredMsg'>".$lang['LOGIN_USERNAME_REQUIRED']."</span><span class='textfieldMinCharsMsg'>".$lang['LOGIN_USERNAME_LENGTH_REQUIRED']."</span></span>
  &nbsp;&nbsp;".$lang['LOGIN_USERPASSWORD']."
  <span id='userpassword'>
  <input name='pass' type='password' id='pass'/>
  <span class='passwordRequiredMsg'>".$lang['LOGIN_PASSWORD_REQUIRED']."</span><span class='passwordMinCharsMsg'>".$lang['LOGIN_PASSWORD_LENGTH_REQUIRED']."</span></span>
  
  <input type='submit' name='login' id='login' value='{$lang['LOGIN_BUTTON_LOGIN']}' spry:hover='confirmRequiredMsg'/>
  <input type='reset' name='Reset' id='Reset' value='{$lang['LOGIN_BUTTON_RESET']}' />
</form>";
}
else 
{
	//Ieliek Flagu vai lietotajs ir online
	echo online_status_set_on();
	
	if ($_SESSION['permission'] >= 0)
	{
		echo "Welcome User {$_SESSION['nick']} <a href='/?logout=yes'> {$lang['LOGIN_LOGOUT']} </a> <a href='/?section=myprofile'>{$lang['LOGIN_MY_PROFILE']}</a> <a href='/?section=pm&action=inbox'>{$lang['LOGIN_INBOX']}</a> <a href='/?section=pm&action=outbox'>{$lang['LOGIN_OUTBOX']}</a>";
	}
	
	if ($_SESSION['permission'] >= 2 and $_SESSION['hosting'] == 1)
	{
		echo "&nbsp;<a href='/?section=lightuserpanel'>{$lang['LOGIN_HOSTING_PANEL']}</a>&nbsp;"."<a href='/?section=lightusersupportpanel'>{$lang['LOGIN_HOSTING_SUPPORT_PANEL']}</a>";
	}
}
?>
    </div>
    <div class="loginregister">
<?php                    
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] == 6 )
	{
		echo "<a href='/?section=lightadminpanel'>{$lang['LOGIN_ADMIN_PANEL']}</a>";
	}
}
else 
{
	echo "<a href='/?section=register'>{$lang['LOGIN_REGISTER']}</a> | <a href='#'>{$lang['LOGIN_RECOVER']}</a>";
}	
?>
    </div>
  </div>
</div>
<div><a href="#" class="btn-slide">
<?php if(!$_SESSION['logged_in'])
{ 
	echo "{$lang['LOGIN_PANEL_LINK_LOGIN']} &darr;";
}

else
{
	echo "{$lang['LOGIN_PANEL_LINK_PANEL']} &darr;";
}
?>
  </a></div>
</div>
<div class="container">
  <div class="header">
    <table width="960"  height="300" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="bottom" background="img/logo_next2.gif"><?php echo online_users(); ?><div align="center"><a href="/?lang=eng"><img src="img/lang/eng.gif" alt="eng" width="47" height="30" /></a><a href="/?lang=lv"><img src="img/lang/lv.gif" alt="lv" width="47" height="30" /></a><a href="/?lang=ru"><img src="img/lang/ru.gif" alt="ru" width="47" height="30" /></a> </div>
          <ul class="nav" id="menu">
            <li><a href="/?section=news" target="_self"><?php echo $lang['MENU_NEWS'] ?></a></li>
            <li><a href="/?section=blog" target="_self"><?php echo $lang['MENU_BLOG'] ?></a></li>
            <li><a href="/?section=hosting" target="_self"><?php echo $lang['MENU_HOSTING'] ?></a></li>
            <li><a href="/?section=forum" target="_self"><?php echo $lang['MENU_FORUM']  ?></a></li>
            <li><a href="/?section=progress" target="_self"><?php echo $lang['MENU_PROGRESS'] ?></a></li>
            <li><a href="/?section=donate" target="_self"><?php echo $lang['MENU_DONATE'] ?></a></li>
            <li><a href="/?section=contact" target="_self"><?php echo $lang['MENU_CONTACT'] ?></a></li>
          </ul></td>
      </tr>
    </table>
  </div>
  <div class="content">
<?php
$section = htmlentities(mysql_real_escape_string(stripslashes(trim($_GET[section]))));
switch ($section)
{
case 'news';
require ("pages/body_news.php");
break;

case 'forum';
require ('pages/body_forum.php');
break;

case 'myprofile';
require ('pages/body_profile.php');
break;

case 'viewprofile';
require ('pages/body_profile_view.php');
break;

case 'pm';
require ('pages/body_pm.php');
break;

case 'forumview';
require ('pages/body_forum_view.php');
break;

case 'forumthreadview';
require ('pages/body_forum_thread_view.php');
break;

case 'forumthreadsubmit';
require ('pages/body_forum_thread_submit.php');
break;

case 'hosting';
require ("pages/body_hosting.php");
break;

case 'contact';
require ('pages/body_contact.php');
break;

case 'progress';
require ('pages/body_progress.php');
break;

case 'blog';
require ('pages/body_blog.php');
break;

case 'donate';
require ('pages/body_donate.php');
break;

case 'tos';
require 'pages/body_tos.php';
break;

case 'register';
require ('pages/body_register.php');
break;

case 'recover';
require ('pages/body_recover.php');
break;

case 'nwcomment';
require ('pages/body_news_comment.php');
break;

case 'bgcomment';
require ('pages/body_blog_comment.php');
break;

case 'edit';
require ('pages/body_process_edit.php');
break;

case 'delete';
require ('pages/body_process_delete.php');
break;

//Hosting Panels

case 'lightuserpanel';
require ('pages/body_user_panel.php');
break;

case 'lightuserpaneldomainmanage';
require 'pages/body_user_panel_domain_manage.php';
break;

case 'lightuserpaneldomainsubmit';
require ('pages/body_user_panel_domain_submit.php');
break;

case ('lightuserpanelftpmanage');
require ('pages/body_user_panel_ftp_manage.php');
break;

case 'lightuserpanelftpsubmit';
require ('pages/body_user_panel_ftp_submit.php');
break;

case 'lightuserpanelmysqlmanage';
require ('pages/body_user_panel_mysql_manage.php');
break;

case 'lightuserpanelmysqlcreatedb';
require ('pages/body_user_panel_mysql_create_db.php');
break;

case 'lightuserpanelmysqlcreateuser';
require ('pages/body_user_panel_mysql_create_user.php');
break;

case 'lightusersupportpanel';
require ('pages/body_support_panel.php');
break;

case 'lightusersupportpanelview';
require ('pages/body_support_panel_view.php');
break;

case 'lightusersupportpanelsubmit';
require ('pages/body_support_panel_submit.php');
break;

//END Hosting Panel

//Admin Panel
case 'lightadminpanel';
require 'pages/body_cp_panel.php';
break;

default; //Obligati jabut savadak index fails tiek izmantots.
require('pages/body_news.php');
}
?>
  </div>
  <div class="footer"><a href="http://faks.sytes.net/"><?php echo $lang['FOOTER_CREATOR_CREATED']?></a> <?php echo $lang['FOOTER_CREATOR_BY']?> <a href="mailto:sia_dev@inbox.lv" id="author"><?php echo $lang['FOOTER_CREATOR_AUTHOR']?></a> <?php echo $lang['FOOTER_POWERED']?> <span id="engine"><?php echo $lang['FOOTER_ENGINE'] ?></span> <span id="revision"><?php echo $lang['FOOTER_VERSION']?></span> <?php echo $lang['FOOTER_COPYRIGHT'] ?><span id="year"><?php echo $lang['FOOTER_COPYRIGHT_YEAR'] ?></span> <?php echo $lang['FOOTER_RENDER_TIME'] .pagetimingcalculator().$lang['FOOTER_RENDER_SECONDS']?>&nbsp;&nbsp;&nbsp;<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" width="88" height="31" />&nbsp;<a href="http://www.siteguard.ru/" target="_blank"><img src="http://www.siteguard.ru/img/knopka.gif" width="88" height="31" border="0" alt="Š­Ń‚Š¾Ń‚ Ń�Š°Š¹Ń‚ Š·Š°Ń‰ŠøŃ‰ŠµŠ½ &laquo;Site Guard&raquo;"></a>

    </p>
  </div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("username", "none", {validateOn:["blur"], hint:"<?php echo $lang['LOGIN_USERNAME_HINT']; ?>", minChars:4});
var sprypassword1 = new Spry.Widget.ValidationPassword("userpassword", {minChars:6, validateOn:["blur"]});
</script>
</body>
</html>
