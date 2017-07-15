<?php
if ($_GET['lang'] == '')
{
echo $_GET['lang'] == 'eng';
}

//English Language Locale
elseif ($_GET['lang'] == 'eng')
{
//Menu Panel
$menu_news = "News";	
$menu_blog = "Blog";	
$menu_hosting =  "Hosting";
$menu_forum = "Forum";
$menu_progress = "Our Progress";
$menu_donate   = "Donate";
$menu_contact = "Contact";
	
}

//Latvieso Valodas Tulkojums
elseif($_GET['lang'] == 'lv')
{
//Menu Panelis
$menu_news = "Jaunumi";	
$menu_blog = "Blogs";	
$menu_hosting = "Hostings";
$menu_forum = "Forums";
$menu_progress = "Mūsu Progress";
$menu_donate   = "Ziedot";
$menu_contact = "Sazināties Ar Mums";	
}

elseif ($_GET['lang'] == 'ru')
{
$menu_news = "Новости";	
$menu_blog = "Блог";	
$menu_hosting = "Хостинг";
$menu_forum = "Форум";
$menu_progress = "Наш Прогресс";
$menu_donate   = "Позертоват";
$menu_contact = "Свизастса С Нами";
}

?>