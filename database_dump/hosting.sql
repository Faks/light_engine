-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2017 at 12:00 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hosting`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `text`, `created_at`, `updated_at`) VALUES
(1, '<h1>My Title</h1>', 'dasdasdasda', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` enum('Devlopment','Updates','News','Bugs','Game Server','Game Servers','Security','Network','Hardware','Downloads','Members','Server Issues') NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(400) NOT NULL,
  `text_short` text NOT NULL,
  `text_long` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `date`, `author`, `category`, `title`, `image`, `text_short`, `text_long`) VALUES
(1, '04/07/2012', 'Faks', 'Bugs', 'Ar Šodienu Blogs Uzsāk Savu Darbību', '[img]http://gaming.flushsolutions.info/images/soldier.jpg[/img]', 'Šodien blogs ir atvēries un tagad varam aktīvi runāt un spriest par gudrām lietāms kas notiek un kā.', 'Šodien blogs ir atvēries un tagad varam aktīvi runāt un spriest par gudrām lietāms kas notiek un kā.'),
(2, '16/07/2012', 'Faks', 'Bugs', 'Vienreiz Drošības Problēmas Salāpītas', '[img]http://www.tutorialspoint.com/images/bug_free.jpg[/img]', 'Nu tātād sāksim ar toka drošības caurumi ir aiztaisīti un tiek aktīvi pastiprināti lai drošībās līmenis būtu atbilstoš vajadzībām.', 'Nu tātād sāksim ar toka drošības caurumi ir aiztaisīti un tiek aktīvi pastiprināti lai drošībās līmenis būtu atbilstoš vajadzībām.'),
(3, '16/07/2012', 'Faks', 'News', 'Cik tāls ceļs noiets un cik jaiet', '[img]http://images.devshed.com/da/stories/Coding_Standards/Coding_Standard%5B1%5D_html_m2deb69c.png[/img]', '[b]Cik tāls ceļs  ir noiets nu ta pa punktam cik daudz vel ir jātaisa vai ir jau pabeigts.[/b]\n\n[b]Papildināts 01/08/2012[/b]\n\n[*]Ziņas             : Gatavs  uz 99%\n[*]Blogs             : Gatavs  uz 99%\n[*]Download          : Gatavs  uz 0%\n[*]Bans              : Gatavs  uz 0%\n[*]Donate            : Gatavs  uz 0%\n[*]Contact           : Gatavs  uz 0%\n[*]About             : Gatvas  uz 0%\n[*]Forums            : Gatavs  uz 80%\n[*]Reģistrācija      : Gatavs  uz 90%\n[*]Noteikumi         : Gatavs  uz 0%\n[*]BBCode            : Gatavs  uz 95%\n[*]Drošiba           : Gatavs  uz 99%\n[*]Serveru Monitori  : Gatavs  uz 50%\n[*]Lietotaju Profili : Gatavs uz 0%\n[br]\n[b]Jaunais saraksts iznāks citā formātā un daudz labāk organizēts jaunā tēmā turpmāk forumā.[/b]', '[b]Cik tāls ceļs  ir noiets nu ta pa punktam cik daudz vel ir jātaisa vai ir jau pabeigts.[/b]\n\n[b]Papildināts 01/08/2012[/b]\n\n[*]Ziņas             : Gatavs  uz 99%\n[*]Blogs             : Gatavs  uz 99%\n[*]Download          : Gatavs  uz 0%\n[*]Bans              : Gatavs  uz 0%\n[*]Donate            : Gatavs  uz 0%\n[*]Contact           : Gatavs  uz 0%\n[*]About             : Gatvas  uz 0%\n[*]Forums            : Gatavs  uz 80%\n[*]Reģistrācija      : Gatavs  uz 90%\n[*]Noteikumi         : Gatavs  uz 0%\n[*]BBCode            : Gatavs  uz 95%\n[*]Drošiba           : Gatavs  uz 99%\n[*]Serveru Monitori  : Gatavs  uz 50%\n[*]Lietotaju Profili : Gatavs uz 0%\n[br]\n[b]Jaunais saraksts iznāks citā formātā un daudz labāk organizēts jaunā tēmā turpmāk forumā.[/b]'),
(4, '29/07/2012', 'Faks', 'Bugs', 'Terraria Servera Crash', '[img]/images/server_crashed.png[/img]', 'Šodien ap pukstens 23:00+/- notieka servera brukšana (crash) manis nebija uzvietas un serveris pīlnīgi nobruka diemžel ap pulstens 00:00 konstatēju faktu un sāku aktīvi meklēt vainīgo problēmu bet izrādās crash notika pavisam vienkāršu kļūdu dēl tāpēc ātri salaboju izveidoju jaunu fail safe šellkodu kurš atdzīvinās serveri vienā momenta un vis būs labi turpmāk :smile:', 'Šodien ap pukstens 23:00+/- notieka servera brukšana (crash) manis nebija uzvietas un serveris pīlnīgi nobruka diemžel ap pulstens 00:00 konstatēju faktu un sāku aktīvi meklēt vainīgo problēmu bet izrādās crash notika pavisam vienkāršu kļūdu dēl tāpēc ātri salaboju izveidoju jaunu fail safe šellkodu kurš atdzīvinās serveri vienā momenta un vis būs labi turpmāk :smile:'),
(5, '27/08/2012', 'Faks', 'Game Server', 'Left 4 Dead 2 Servera Crash', '[img]/images/server_crashed.png[/img]', 'Labdien visiem lasītājiem rakstu ar sliktu ziņu pēdējā laikā novērota problēma ar Left 4 Dead 2 serveri kurš mīl nokārties bez iemesla tieši tāpēc serveris vari arī nebūt pieejams,cenšos novērst šo problēmu un cerams ka pēdējie labojumi līdzēs ja nē iespējams nāksies pieņemt stingrakus mērus katrā ziņa cerība mirst pēdējā :worry:', 'Labdien visiem lasītājiem rakstu ar sliktu ziņu pēdējā laikā novērota problēma ar Left 4 Dead 2 serveri kurš mīl nokārties bez iemesla tieši tāpēc serveris vari arī nebūt pieejams,cenšos novērst šo problēmu un cerams ka pēdējie labojumi līdzēs ja nē iespējams nāksies pieņemt stingrakus mērus katrā ziņa cerība mirst pēdējā :worry:'),
(6, '07/11/2012', 'Faks', 'Game Servers', 'hlxce nedienas .', '[img]http://www.hlxce.com/sites/default/files/amadou_logo.png[/img]', 'Labdien lassītāj kartējo reizi notika maza bēda nedarbojas statiska kā paredzēts dēļ pārvākšanas pēc kartīgām zvēru keršanas stundām atradās un jau vis darbojas atvainojiet lūdzu cienijamie spēlētaji.', 'Labdien lassītāj kartējo reizi notika maza bēda nedarbojas statiska kā paredzēts dēļ pārvākšanas pēc kartīgām zvēru keršanas stundām atradās un jau vis darbojas atvainojiet lūdzu cienijamie spēlētaji.'),
(7, '10/11/2012', 'Faks', 'News', 'Download Sadaļa !', '[img]/images/downloading.jpg[/img]', 'Labs vakars tavās mājās lasītāj šodien tiks pabeigta pirmā ejošā lejuplādes sadaļa kura uzsāks savu darībū tuvākajā laikā [br]kamēr tapa šis unikālais brīnums bija arī citi sarežģijumi tāpēc vis ari kavējās tanī skaita ari bija neliela pauze no visa bet tas netraucēja izplānot un izveidot sadaļas .', 'Labs vakars tavās mājās lasītāj šodien tiks pabeigta pirmā ejošā lejuplādes sadaļa kura uzsāks savu darībū tuvākajā laikā [br]kamēr tapa šis unikālais brīnums bija arī citi sarežģijumi tāpēc vis ari kavējās tanī skaita ari bija neliela pauze no visa bet tas netraucēja izplānot un izveidot sadaļas .'),
(8, '21/02/2013', 'Faks', 'Devlopment', 'Mājas lapas attīstība', '[img]http://images.devshed.com/da/stories/Coding_Standards/Coding_Standard%5B1%5D_html_m2deb69c.png[/img]', 'Labvakar lasītāj šodien rakstu blogā jo laiks aprakstīt kas ir pa šo laiku noticis pamatā vis mans brīvais laiks bija iegūldīts spēļu serveru pulēšanā un uzlabošanā un netika atvēlēts laiks priekš mājas lapas kodēšanas ļoti žēl protams bet neskatoties uz visu situāciju tiks pakāpeniski jautājums kustināts no vietas šodien tiek modernizēta download sistēma smalkāk būs zemāk aprakstīts.[br]\n\n[b]Download Izmaiņas[/b]\nPievienoti jauni dažadi linki vienkārš links,links spogulis,links spogulis 2,links mega,link torrent.\nizņemta arā neejoša komentāru sadaļa.\nnepieejami lejuplādes linki vairs neuzrādisies .[br]\n\n[b]Mājas lapas izmaiņas[/b]\nZiņām un blogam tagad ir izviedotas kārtīgas kategorijas kuras ir ērtas un praktiskas.', 'Labvakar lasītāj šodien rakstu blogā jo laiks aprakstīt kas ir pa šo laiku noticis pamatā vis mans brīvais laiks bija iegūldīts spēļu serveru pulēšanā un uzlabošanā un netika atvēlēts laiks priekš mājas lapas kodēšanas ļoti žēl protams bet neskatoties uz visu situāciju tiks pakāpeniski jautājums kustināts no vietas šodien tiek modernizēta download sistēma smalkāk būs zemāk aprakstīts.[br]\n\n[b]Download Izmaiņas[/b]\nPievienoti jauni dažadi linki vienkārš links,links spogulis,links spogulis 2,links mega,link torrent.\nizņemta arā neejoša komentāru sadaļa.\nnepieejami lejuplādes linki vairs neuzrādisies .[br]\n\n[b]Mājas lapas izmaiņas[/b]\nZiņām un blogam tagad ir izviedotas kārtīgas kategorijas kuras ir ērtas un praktiskas.'),
(9, '10/08/2014', 'Faks', 'Devlopment', 'Mājas lapas attīstība II', '[img]http://images.devshed.com/da/stories/Coding_Standards/Coding_Standard%5B1%5D_html_m2deb69c.png[/img]', '\r\nIr pagājis liels laika periods kopš pēdējās atskaites jo ļoti daudz kas bijis noticis un ir bijuši smagi ļoti laika periodi un neskatoties uz to tika kaut kas lēnām darīts pa brīvo laiku nu tad pie tās atskaites.\r\n[br]\r\n\r\n[b]Profilu Sistēma[/b]\r\npre-alpha bija uzrākstīta diezgan sen tagad ir strādojoša beta versija kurai dažas sadaļas vel nau sarakstītas bet pavisam drīz tiks pabeigtas.\r\n\r\n[b]Reģistrācija[/b]\r\nReģistrācija saņēma modernizāciju un arī optimizāciju jo laiks tāka to bija izdarīt jo bija nopietnas problēmas ar veco sistēmu un iskātijas nepārāk labi jaunā versija noformējums daudz patīkamāks :smile:.\r\n\r\n[b]Citas sadaļas[/b]\r\nPavisam nesen tika izveidota sadaļa tips jar:šinī sadaļa varam brīvprātigi atbalstīt ar kādu drusku naudiņas ja ir iemētājusi kāda lieka monētam un protāms vēlam palīdzēt administrācijai projekta attīstībā,about:sadaļa ir diezgan agrīnā stadijā bet pastāsta kas ir bijis pagātne projektam un ir tagad ar laiku tiks izveidots ļoti garš un detalizēts aprakts kas bijis un protams kas ir,un modernizēta un novesta lidz saprātām sadaļa noteikumi (Rules) sen gribējas to izdarīt :).\r\n', '\r\nIr pagājis liels laika periods kopš pēdējās atskaites jo ļoti daudz kas bijis noticis un ir bijuši smagi ļoti laika periodi un neskatoties uz to tika kaut kas lēnām darīts pa brīvo laiku nu tad pie tās atskaites.\r\n[br]\r\n\r\n[b]Profilu Sistēma[/b]\r\npre-alpha bija uzrākstīta diezgan sen tagad ir strādojoša beta versija kurai dažas sadaļas vel nau sarakstītas bet pavisam drīz tiks pabeigtas.\r\n\r\n[b]Reģistrācija[/b]\r\nReģistrācija saņēma modernizāciju un arī optimizāciju jo laiks tāka to bija izdarīt jo bija nopietnas problēmas ar veco sistēmu un iskātijas nepārāk labi jaunā versija noformējums daudz patīkamāks :smile:.\r\n\r\n[b]Citas sadaļas[/b]\r\nPavisam nesen tika izveidota sadaļa tips jar:šinī sadaļa varam brīvprātigi atbalstīt ar kādu drusku naudiņas ja ir iemētājusi kāda lieka monētam un protāms vēlam palīdzēt administrācijai projekta attīstībā,about:sadaļa ir diezgan agrīnā stadijā bet pastāsta kas ir bijis pagātne projektam un ir tagad ar laiku tiks izveidots ļoti garš un detalizēts aprakts kas bijis un protams kas ir,un modernizēta un novesta lidz saprātām sadaļa noteikumi (Rules) sen gribējas to izdarīt :).\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) NOT NULL,
  `id_news` varchar(255) NOT NULL,
  `id_forum_topic` varchar(255) NOT NULL,
  `id_blog` varchar(255) NOT NULL,
  `id_download` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_news`, `id_forum_topic`, `id_blog`, `id_download`, `date`, `time`, `author`, `text`) VALUES
(287, '', '1', '', '', '19/07/2012', '23:14:35', 'Faks', 'test edit update by Faks'),
(288, '', '1', '', '', '19/07/2012', '23:29:14', 'Faks', '[color=red]test[/color]'),
(290, '', '1', '', '', '19/07/2012', '23:36:42', 'Faks', 'asdas'),
(293, '', '1', '', '', '19/07/2012', '23:49:36', 'test', 'asd'),
(292, '', '1', '', '', '19/07/2012', '23:39:38', 'Faks', 'xxxxxx2'),
(301, '', '1', '', '', '10/04/2015', '13:25:07', 'Faks', 'adasdadas');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `download_category`
--

CREATE TABLE `download_category` (
  `id` bigint(20) NOT NULL,
  `hide` enum('yes','no') NOT NULL DEFAULT 'no',
  `name` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `download_game_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `download_category`
--

INSERT INTO `download_category` (`id`, `hide`, `name`, `time`, `date`, `author`, `download_game_id`) VALUES
(1, 'no', 'Client', '14:08:08', '2012-11-09', 'Faks', 1),
(2, 'no', 'Patch', '14:08:16', '2012-11-09', 'Faks', 1),
(3, 'no', 'Maps', '14:00:06', '2012-11-09', 'Faks', 1),
(4, 'no', 'Client', '15:04:15', '2012-11-09', 'Faks', 3),
(5, 'no', 'Client', '15:04:38', '09/11/2012', 'Faks', 2),
(6, 'no', 'Client', '15:04:56', '09/11/2012', 'Faks', 4),
(7, 'no', 'Client', '15:05:05', '09/11/2012', 'Faks', 5),
(8, 'no', 'Client', '15:05:21', '09/11/2012', 'Faks', 6),
(9, 'no', 'Client', '15:05:32', '09/11/2012', 'Faks', 7),
(10, 'no', 'Patch', '15:06:13', '09/11/2012', 'Faks', 6),
(11, 'no', 'Patch', '15:06:22', '09/11/2012', 'Faks', 5),
(12, 'no', 'Patch', '15:06:33', '09/11/2012', 'Faks', 4),
(13, 'no', 'Client', '23:51:22', '14/02/2013', 'Faks', 8);

-- --------------------------------------------------------

--
-- Table structure for table `download_game`
--

CREATE TABLE `download_game` (
  `id` bigint(20) NOT NULL,
  `hide` enum('yes','no') NOT NULL DEFAULT 'no',
  `name` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `download_game`
--

INSERT INTO `download_game` (`id`, `hide`, `name`, `description`, `icon`) VALUES
(1, 'no', 'Counter-Strike: Source', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/css.png'),
(2, 'no', 'Counter-Strike: Condition Zero', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/cscz.png'),
(3, 'no', 'Counter-Strike: 1.6', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/cs1.6.png'),
(4, 'no', 'Day of Defeat: Source', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/dods.png'),
(5, 'no', 'Left 4 Dead', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/l4d.png'),
(6, 'no', 'Left 4 Dead 2', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/l4d2.png'),
(7, 'no', 'Terraria', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/terraria.png'),
(8, 'no', 'Counter-Strike: Global Offensive', 'Šinī sadaļa atrodas (Game Client,Patch,Maps)', 'images/games/csgo.png');

-- --------------------------------------------------------

--
-- Table structure for table `download_topic`
--

CREATE TABLE `download_topic` (
  `id` bigint(20) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL,
  `hide` enum('no','yes') NOT NULL,
  `name` tinytext NOT NULL,
  `size` varchar(20) NOT NULL,
  `version` varchar(20) NOT NULL,
  `short_version` varchar(10) NOT NULL,
  `build` varchar(10) NOT NULL,
  `type` enum('Client','Patch','Maps') NOT NULL,
  `description` longtext NOT NULL,
  `link` varchar(500) NOT NULL,
  `link_mirror` varchar(500) NOT NULL,
  `link_mirror2` varchar(500) NOT NULL,
  `link_torrent` varchar(500) NOT NULL,
  `link_wuala` varchar(500) NOT NULL,
  `link_dropbox` varchar(500) NOT NULL,
  `link_skydrive` varchar(500) NOT NULL,
  `link_mega` varchar(500) NOT NULL,
  `download_category_id` bigint(20) NOT NULL,
  `download_game_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `download_topic`
--

INSERT INTO `download_topic` (`id`, `author`, `date`, `time`, `hide`, `name`, `size`, `version`, `short_version`, `build`, `type`, `description`, `link`, `link_mirror`, `link_mirror2`, `link_torrent`, `link_wuala`, `link_dropbox`, `link_skydrive`, `link_mega`, `download_category_id`, `download_game_id`) VALUES
(1, 'Faks', '10/11/2012', '16:05:16', 'no', 'Counter-Strike: Source v73', '1.5GB', '1.0.0.73', 'v73', '5028', 'Client', 'Counter-Strike: Source uses the highly-anticipated Source Engine to remake the original Counter-Strike.', '#', '#', '#', '#', 'http://www.wuala.com/Jonh/Gamer%20Ludus/Game%20Client/Counter-Strike%20Source%20New/Gamer%20Ludus%20Game%20Client%20CSS%20v73.exe/?id=1,217776,11-7,1951277,18', '#', '#', '#', 1, 1),
(2, 'Faks', '10/11/2012', '16:17:37', 'no', 'Counter-Strike 1.6 Protocol 47/48', '406MB', '1.1.2.6', 'v26', '4554', 'Client', 'Play the world\'s number 1 online action game.[br] Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. [br] Ally with teammates to complete strategic missions. [br] Take out enemy sites.[br] Rescue hostages.[br] Your role affects your team\'s success.[br] Your team\'s success affects your role. \n\nAlso Includes Counter-Strike Condition Zero.', '#', '#', '#', '#', 'http://www.wuala.com/Jonh/Gamer%20Ludus/Game%20Client/Counter-Strike%201.6%20%26%20Counter-Strike%20Condition%20Zero/Gamer%20Ludus%20Game%20Client%20CS%201.6%20%26%20CZ.exe/?id=1,217776,11-2,1951277,18', 'https://dl.dropbox.com/sh/6gltbxfft24nufl/ssFKCrU8kq/Gamer Ludus/Gamer Ludus Game Client CS 1.6 & CZ.exe?dl=1', '#', '#', 4, 3),
(3, 'Faks', '10/11/2012', '16:15:47', 'no', 'Counter-Strike: Source v34', '1.9GB', '1.0.0.43', 'v34', '4044', 'Client', 'Counter-Strike: Source uses the highly-anticipated Source Engine to remake the original Counter-Strike.', '#', '#', '#', '#', 'http://www.wuala.com/Jonh/Gamer%20Ludus/Game%20Client/Counter-Strike%20Source%20v34/Gamer%20Ludus%20Game%20Client%20CSS%20v34.exe/?id=1,217776,11-6,1951277,18', '#', '#', '#', 1, 1),
(7, 'Faks', '27/12/2012', '18:53:16', 'no', 'Left 4 Dead', '3.06GB', '1.0.2.7', 'v27', '4716', 'Client', ' From Valve (the creators of Counter-Strike, Half-Life and more) comes Left 4 Dead, a co-op action horror game for the PC and Xbox 360 that casts up to four players in an epic struggle for survival against swarming zombie hordes and terrifying mutant monsters. ', '#', '#', '#', '#', '#', '#', 'https://skydrive.live.com/?cid=97347903a5d5bd50&id=97347903A5D5BD50%21212', '#', 7, 5),
(4, 'Faks', '10/11/2012', '16:22:48', 'no', 'Counter-Strike: Condition Zero Protocol 47/48', '406MB', '1.0.0.3', 'v3', '4554', 'Client', 'With its extensive Tour of Duty campaign, a near-limitless number of skirmish modes, updates and new content for Counter-Strike\'s award-winning multiplayer game play, plus over 12 bonus single player missions, Counter-Strike: Condition Zero is a tremendous offering of single and multiplayer content.\n\nAlso Includes Counter-Strike 1.6', '#', '#', '#', '#', 'http://www.wuala.com/Jonh/Gamer%20Ludus/Game%20Client/Counter-Strike%201.6%20%26%20Counter-Strike%20Condition%20Zero/Gamer%20Ludus%20Game%20Client%20CS%201.6%20%26%20CZ.exe/?id=1,217776,11-2,1951277,18', 'https://dl.dropbox.com/sh/6gltbxfft24nufl/ssFKCrU8kq/Gamer Ludus/Gamer Ludus Game Client CS 1.6 & CZ.exe?dl=1', '#', '#', 5, 2),
(5, 'Faks', '11/11/2012', '10:05:08', 'no', 'Day of Defeat Source v43', '1.66GB', '1.0.0.43', 'v43', '5051', 'Client', 'Day of Defeat offers intense online action gameplay set in Europe during WWII. Assume the role of infantry, sniper or machine-gunner classes, and more. DoD:S features enhanced graphics and sounds design to leverage the power of Source, Valve\'s new engine technology. ', '#', '#', '#', '#', '#', '#', 'https://skydrive.live.com/?cid=97347903A5D5BD50&id=97347903A5D5BD50!202#cid=97347903A5D5BD50&id=97347903A5D5BD50!207', '#', 6, 4),
(6, 'Faks', '11/11/2012', '12:14:30', 'no', 'Terraria  v12', '22MB', '1.1.2', 'v12', 'Unkown', 'Client', 'Dig, fight, explore, build! Nothing is impossible in this action-packed adventure game. The world is your canvas and the ground itself is your paint. Grab your tools and go! Make weapons to fight off a variety of enemies in numerous biomes. Dig deep underground to find accessories, money, and other useful things. ', '#', '#', '#', '#', '#', '#', 'https://skydrive.live.com/?cid=97347903A5D5BD50&id=97347903A5D5BD50!202#cid=97347903A5D5BD50&id=97347903A5D5BD50!206', '#', 9, 7),
(8, 'Faks', '22/02/2013', '02:12:16', 'no', 'Counter-Strike: Global Offensive', '2.36GB', '1.22.2.2', '', 'Unkown', 'Client', 'Counter-Strike: Global Offensive (CS: GO) will expand upon the team-based action gameplay that it pioneered when it was launched 12 years ago. CS: GO features new maps, characters, and weapons and delivers updated versions of the classic CS content (de_dust, etc.). ', '#', '#', '#', 'http://sun-torrents.name/viewtopic.php?t=1858', '#', '#', '#', '#', 13, 8),
(9, 'Faks', '22/02/2013', '02:43:02', 'no', 'Counter-Strike: Source v73-76 Patch', '74MB', '1.0.0.76', '', '5198', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!fZ9H2D4a!eVGM_mg3y_lEQLyUtra3ExtGcec31AZrNKRSRKN6RGc', 2, 1),
(10, 'Faks', '22/02/2013', '22:36:10', 'no', 'Day of Defeat: Source v43-49 Patch', '64.1MB', '1.0.0.49', '', '5191', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.\r\n', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!aMcwQJIB!L5AA6kCt6gx7ShRc6mWSXCOd4tx5OXp8dH2cPZvnZ2A', 12, 4),
(11, 'Faks', '22/02/2013', '03:13:12', 'no', 'Left 4 Dead v2.7-2.8 Patch', '10.4MB', '1.0.2.8', '', '5134', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!TNkjFYRS!HOA-sSwMjyvxMWrG6gG5MhScTep8bBTs57q3KvLc-NA', 11, 5),
(12, 'Faks', '22/02/2013', '22:31:23', 'no', 'Left 4 Dead 2 v1.9-2.0', '30.4MB', '2.1.2.0', '', '5177', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.\r\n', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!fIFQ2IhS!GAmsnU3w1noRbuhK2shydmuMIGxVU3q2cnyIpqvn2WA', 10, 6),
(13, 'Faks', '22/02/2013', '22:33:16', 'no', 'Left 4 Dead 2 v2.0-2.1', '4.6MB', '2.1.2.1', 'v21', '5177', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!KcVBGb6a!UI6NDAY8oHNNEGZtljmxjS6Xajxwst9KYYgWpPj5LKs', 10, 6),
(14, 'Faks', '23/02/2013', '17:27:48', 'no', 'Day of Defeat: Source v49-51 Patch', '25.9MB', '1.0.0.51', 'v51', '5220 ', 'Patch', 'Dažadi labojumi steam mājas lapā vairāk.', '#', '#', '#', '#', '#', '#', '#', 'https://mega.co.nz/#!qQswRBAA!RWfiaXECJA9evmTIw5509kxwX0Vdq8fBdJKDLawX-JU', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fortumo`
--

CREATE TABLE `fortumo` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `scrolls` varchar(500) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` varchar(25) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `billing_type` varchar(100) NOT NULL,
  `service_id` varchar(200) NOT NULL,
  `message_id` varchar(200) NOT NULL,
  `shortcode` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` bigint(20) NOT NULL,
  `title` varchar(400) NOT NULL,
  `description` varchar(500) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `group_id` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `title`, `description`, `icon`, `group_id`) VALUES
(1, 'Zinas', 'Seit atrodas visas zinas par serveri', '<img src=\'http://gaming.flushsolutions.info/images/f_icon_read.png\'>', '1'),
(2, 'Zinas', 'Seit atrodas visas zinas par serveri', '<img src=\'http://gaming.flushsolutions.info/images/f_icon_read.png\'>', '2'),
(4, 'Zinas', 'Seit atrodas visas zinas par serveri', '<img src=\'http://gaming.flushsolutions.info/images/f_icon_read.png\'>', '3'),
(3, 'Zinas', 'Seit atrodas visas zinas par serveri', '<img src=\'http://gaming.flushsolutions.info/images/f_icon_read.png\'>', '4');

-- --------------------------------------------------------

--
-- Table structure for table `forum_group`
--

CREATE TABLE `forum_group` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `group_name` varchar(400) NOT NULL,
  `group_show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `group_created` varchar(100) NOT NULL,
  `group_create_date` date NOT NULL,
  `group_create_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_group`
--

INSERT INTO `forum_group` (`id`, `group_id`, `group_name`, `group_show`, `group_created`, `group_create_date`, `group_create_time`) VALUES
(1, 1, 'Terraria', 'yes', 'Faks', '2013-12-20', '20:49:01'),
(2, 2, 'Counter-Strike Source', 'yes', 'Faks', '0000-00-00', '20:49:01'),
(3, 3, 'Counter-Strike 1.6', 'yes', 'Faks', '0000-00-00', '20:49:01'),
(4, 4, 'Counter-Strike Condition Zero', 'yes', 'Faks', '2013-12-20', '20:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `forum_group_sub`
--

CREATE TABLE `forum_group_sub` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `group_sub_title` varchar(255) NOT NULL,
  `group_sub_show` enum('yes','no') NOT NULL,
  `group_sub_created` varchar(150) NOT NULL,
  `group_sub_create_date` date NOT NULL,
  `group_sub_create_time` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum_thread`
--

CREATE TABLE `forum_thread` (
  `id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `text` longtext NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `forum_id` varchar(255) NOT NULL,
  `forum_sub_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_thread`
--

INSERT INTO `forum_thread` (`id`, `title`, `text`, `author`, `date`, `show`, `forum_id`, `forum_sub_id`) VALUES
(1, 'Atkal Gluki', 'testa teksts', 'Faks', '18/07/2012/15:00', 'yes', '1', ''),
(2, 'test 2', ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s...  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s... ', 'test', '19/07/2012', 'yes', '1', ''),
(3, 'tes2', 'test a', 'Faks', '27/07/2012/22:57', 'yes', '2', ''),
(4, 'Test Sub Forum Topic', 'Test Sub Forum Text', 'Faks', '2013-09-10', 'yes', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_about`
--

CREATE TABLE `hosting_about` (
  `hosting_about_id` int(11) NOT NULL,
  `hosting_about_title` varchar(255) NOT NULL,
  `hosting_about_author` varchar(255) NOT NULL,
  `hosting_about_stamp` datetime NOT NULL,
  `hosting_about_text` text NOT NULL,
  `hosting_about_severity` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_about`
--

INSERT INTO `hosting_about` (`hosting_about_id`, `hosting_about_title`, `hosting_about_author`, `hosting_about_stamp`, `hosting_about_text`, `hosting_about_severity`) VALUES
(1, 'What is goal of the project ?', 'Faks', '2010-12-26 21:12:15', 'I will offer cheap Website hosting without taking any responsibility what our clients we will do while they use our services witch we provide .', 'High'),
(2, ' Why we don\'t take any responsibility ?', 'Faks', '2010-12-26 21:12:50', 'Because it\'s impossible in these days to track all clients if only don\'t have huge company behind you,we are example we are small and we simply can\'t track them all .\r\n', 'High'),
(3, 'Why We Started our project ?', 'Faks', '2010-12-26 21:14:52', 'because we couldn\'t leave behind all this mess in our country most of web hosting\'s companys provides very expensive for these days,also they host too many Website and in same time they are glad to make servers slower but charge for double like saying take our free cheese but if you choke we don\'t wanna hear anything . ', 'High'),
(4, 'What do we want to achieve ?', 'Faks', '2010-12-26 21:14:46', 'Mutual business where client is on top priority list not because they only paying but because they deserve it like any other citizen living in any country !', 'High');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_blog`
--

CREATE TABLE `hosting_blog` (
  `hosting_blog_id` int(11) NOT NULL,
  `hosting_blog_title` varchar(255) NOT NULL,
  `hosting_blog_nick` varchar(255) NOT NULL,
  `hosting_blog_text` text NOT NULL,
  `hosting_blog_group` int(11) NOT NULL,
  `hosting_blog_publish_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_blog`
--

INSERT INTO `hosting_blog` (`hosting_blog_id`, `hosting_blog_title`, `hosting_blog_nick`, `hosting_blog_text`, `hosting_blog_group`, `hosting_blog_publish_date`) VALUES
(1, 'New Desing & Blog Is Here !', 'Faks', 'Hi Everybody i am working on website and right now i have almost finished new design for website  and by the way it looks Hilarius and yes almost forgot blog is now finished and is up and running sow we can now track all latest news here :) .\r\n<br>', 1, '2011-01-05 23:51:38'),
(2, 'Server Offline Time ?', 'Faks', 'Well server was offline due problems with setups for services witch were needed for hosting and server were restarted many times that\'s is the reason of downtime but i hope near future it won\'t be any more needed at all at least do hope .', 1, '2011-01-10 22:28:15'),
(3, 'About updates', 'Faks', 'I was working website quite long time all is coming to end and all features will be finished in most nearest time i still encounter few difficulty due problems with core of code engine but i think i have overcome most important exploits and bugs witch i have fixed and secured them for any further damage witch they could lead or cause !', 0, '2011-03-12 01:05:29'),
(4, 'Desing Updates', 'Faks', 'I Am working on design updates right we see a skeleton of them what i am planning but still it looks kinda sweet i think keep waiting for any further updates by the way i planning opening registration on April Fools\' Day i hope see you here in nearest future :)', 1, '2011-03-12 01:15:07'),
(5, 'Optimize & Speed Up & Secure ', 'Faks', 'Hi everybody today website was offline & online & had errors some while due improving optimization & speeding up website with great features also made more secure to avoid any issues in nearest future and at-lest for some time :)', 1, '2011-03-18 01:53:14'),
(6, 'utf-8 problems !', 'Faks', 'having problems with Russian & Latvian Comment Text bugs is related to utf 8 issue :( i hope to resolve it as fast is possible !', 1, '2011-04-01 20:38:40'),
(7, 'Updates & Changes Is Coming Version 1.00 Beta Coming Soon !', 'Faks', 'Well it was a long time to make a proper cms system light engine would work in real-time with ftp & domain system but it seems i am closing in to <b>1.00 beta</b>\r\nthere are much work to do,i have chore list right now they are over <b>62</b> most of them are finished but every day is more and more of them and i am marking them as proof what i have finished and done it\'s nearly like change log track it helps me to finish much but any way wish you luck visiting us again and joining us and by the way you can wait for hosting to open soon too,Because <b>Registration</b> right now is <b>open</b> you can be a simple member and can be a part of us and keep us helping & improve &\r\ngrow stronger everyday  to achieve our goal :) !\r\n', 1, '2011-04-04 22:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_comment`
--

CREATE TABLE `hosting_comment` (
  `hosting_comment_id` int(11) NOT NULL,
  `hosting_comment_news_id` varchar(320) NOT NULL,
  `hosting_comment_blog_id` varchar(320) NOT NULL,
  `hosting_comment_forum_thread_id` varchar(320) NOT NULL,
  `hosting_comment_ticket_id` varchar(320) NOT NULL,
  `hosting_comment_text` text NOT NULL,
  `hosting_comment_nick` varchar(320) NOT NULL,
  `hosting_comment_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_comment`
--

INSERT INTO `hosting_comment` (`hosting_comment_id`, `hosting_comment_news_id`, `hosting_comment_blog_id`, `hosting_comment_forum_thread_id`, `hosting_comment_ticket_id`, `hosting_comment_text`, `hosting_comment_nick`, `hosting_comment_date`) VALUES
(620, '7', '', '', '', 'xss', 'demo', '2011-09-25 21:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_contact_us`
--

CREATE TABLE `hosting_contact_us` (
  `contact_id` int(11) NOT NULL,
  `contact_title` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_time` varchar(255) NOT NULL,
  `contact_resason` varchar(255) NOT NULL,
  `contact_text` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_contact_us`
--

INSERT INTO `hosting_contact_us` (`contact_id`, `contact_title`, `contact_name`, `contact_email`, `contact_time`, `contact_resason`, `contact_text`) VALUES
(39, 'The Nexus', 'Lee Watson', 'synsytershadows403@googlemail.com', '2011.06.05 01:50:13', 'Help', 'Please add me as a friend on The Nexus Forums. I want to help you take down the site. My username is: TheReverendTholomewPlague<br data-mce-bogus=\"1\" />'),
(40, 'erqnxu@byzcvt.com', 'erqnxu@byzcvt.com', 'erqnxu@byzcvt.com', '2011.06.30 06:41:24', 'Advice', 'gMqODi  <a href=\"http://dopjoxgmcody.com/\">dopjoxgmcody</a>, [url=http://pvvhszurlcql.com/]pvvhszurlcql[/url], [link=http://oguljqzdqlep.com/]oguljqzdqlep[/link], http://aoddscwhjejs.com/'),
(41, 'uZdoxPmCKGlkBMtrhS', 'ktswhc@ufsdef.com', 'ktswhc@ufsdef.com', '2012.03.06 03:39:41', 'Спорный вопрос', 'B0XXFn  <a href=\"http://pvjgsdufbisp.com/\">pvjgsdufbisp</a>, <a href=\"http://kzblinxtantq.com/\">kzblinxtantq</a>, [link=http://ccotpfigujsc.com/]ccotpfigujsc[/link], http://uqnjelmbjolk.com/'),
(42, 'bwlfyb@vnipin.com', 'bwlfyb@vnipin.com', 'bwlfyb@vnipin.com', '2012.05.22 18:29:50', 'Совет', 'i91JME  <a href=\"http://qftcvihsdgbw.com/\">qftcvihsdgbw</a>, <a href=\"http://aigrymrjcqpm.com/\">aigrymrjcqpm</a>, [link=http://zpxbtamhukmz.com/]zpxbtamhukmz[/link], http://nmglrntjiamt.com/'),
(43, 'cJiwUMEetdPkJURTFw', 'ctsikluml', 'xdycsq@ycdprq.com', '2012.06.10 01:35:31', 'ÐÐ¾Ð¼Ð¾ÑÑ', 'AeVwXs  <a href=\"http://mdwifttskant.com/\">mdwifttskant</a>, <a href=\"http://epkwlknllqfd.com/\">epkwlknllqfd</a>, [link=http://aduweevnilzv.com/]aduweevnilzv[/link], http://qgpbrtxxkwrt.com/'),
(44, 'lyoTkoxsPmkBfAd', 'Dfliqwd', 'szazmdru@gmail.com', '2012.07.02 16:43:57', 'ÐÐ°Ð¿ÑÐ¾Ñ', 'G4ls8L <a href=\"http://healthserviceu.net/\">http://healthserviceu.net/</a> <a href=http://healthserviceu.net/>http://healthserviceu.net/</a> http://healthserviceu.net/'),
(45, 'xWkKLyLhzlA', 'pleddiw', 'uyuymi@yyywwd.com', '2013.03.25 13:18:08', 'ÐÐ°Ð¿ÑÐ¾Ñ', 'ZybjYO  <a href=\"http://mxjlfhnijhqb.com/\">mxjlfhnijhqb</a>, <a href=\"http://xbmxkokigmct.com/\">xbmxkokigmct</a>, [link=http://keitmehlibiz.com/]keitmehlibiz[/link], http://ftzjvueqpwes.com/');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_domain`
--

CREATE TABLE `hosting_domain` (
  `hosting_domain_id` int(11) NOT NULL,
  `hosting_domain_domain` varchar(255) NOT NULL,
  `hosting_domain_docroot` varchar(255) NOT NULL,
  `hosting_domain_owner` varchar(255) NOT NULL,
  `hosting_domain_status` enum('0','1','2') NOT NULL DEFAULT '1',
  `hosting_domain_license` varchar(255) NOT NULL,
  `hosting_domain_paypal_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_domain`
--

INSERT INTO `hosting_domain` (`hosting_domain_id`, `hosting_domain_domain`, `hosting_domain_docroot`, `hosting_domain_owner`, `hosting_domain_status`, `hosting_domain_license`, `hosting_domain_paypal_id`) VALUES
(6, 'hlxce.gamerludus.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/hlxce.gamerludus.info', 'Faks', '2', '', ''),
(5, 'www.placis.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/www.placis.info', 'Faks', '2', '', ''),
(4, 'download.gamerludus.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/download.gamerludus.info', 'Faks', '2', '', ''),
(3, 'gamerludus.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/gamerludus.info', 'Faks', '2', '', ''),
(7, 'beta.flushsolutions.info', '/usr/local/etc/www/webroot/var/htdocs_public/99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8/root/public_html/beta.flushsolutions.info', 'root', '2', '', ''),
(1, 'faks.sytes.net', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/faks.sytes.net', 'Faks', '2', '', ''),
(2, 'gaming.flushsolutions.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/gaming.flushsolutions.info', 'Faks', '2', '', ''),
(116, 'phpmyadmin.flushsolutions.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/phpmyadmin.flushsolutions.info', 'Faks', '2', '', ''),
(117, 'sourcebans.gamerludus.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/sourcebans.gamerludus.info', 'Faks', '2', '', ''),
(118, 'flushsolutions.info', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/flushsolutions.info', 'Faks', '2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_forum`
--

CREATE TABLE `hosting_forum` (
  `hosting_forum_id` int(255) NOT NULL,
  `hosting_forum_title` varchar(320) NOT NULL,
  `hosting_forum_description` text NOT NULL,
  `hosting_forum_icon` varchar(255) NOT NULL,
  `hosting_forum_group_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_forum`
--

INSERT INTO `hosting_forum` (`hosting_forum_id`, `hosting_forum_title`, `hosting_forum_description`, `hosting_forum_icon`, `hosting_forum_group_id`) VALUES
(8, 'News & System Announcements', 'In This Forum We Will Describe Latest News & System Announcements ', '<img src=\"http://www.cornholeshop.com/images/icon_protection_30x30.gif\" />', '1'),
(14, 'Report Bug\'s & Issues', 'Post any bugs you see to help improve light engine system !', '<img src=\"http://www.cornholeshop.com/images/icon_protection_30x30.gif\" />', '2'),
(15, 'Introduce Your Self To Community', 'Here we introduce each other to community :)', '<img src=\"http://www.cornholeshop.com/images/icon_protection_30x30.gif\" />', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_forum_group`
--

CREATE TABLE `hosting_forum_group` (
  `hosting_forum_group_id` varchar(255) NOT NULL,
  `hosting_forum_group_name` varchar(320) NOT NULL,
  `hosting_forum_group_show` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_forum_group`
--

INSERT INTO `hosting_forum_group` (`hosting_forum_group_id`, `hosting_forum_group_name`, `hosting_forum_group_show`) VALUES
('1', 'General Forum', '1'),
('2', 'Bug Report', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_forum_thread`
--

CREATE TABLE `hosting_forum_thread` (
  `hosting_forum_thread_id` int(11) NOT NULL,
  `hosting_forum_thread_title` varchar(255) NOT NULL,
  `hosting_forum_thread_text` longtext NOT NULL,
  `hosting_forum_thread_author` varchar(255) NOT NULL,
  `hosting_forum_thread_date` varchar(255) NOT NULL,
  `hosting_forum_thread_status` varchar(30) NOT NULL DEFAULT 'Open',
  `hosting_forum_thread_icon` varchar(255) NOT NULL,
  `hosting_forum_id` varchar(320) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_forum_thread`
--

INSERT INTO `hosting_forum_thread` (`hosting_forum_thread_id`, `hosting_forum_thread_title`, `hosting_forum_thread_text`, `hosting_forum_thread_author`, `hosting_forum_thread_date`, `hosting_forum_thread_status`, `hosting_forum_thread_icon`, `hosting_forum_id`) VALUES
(27, 'News', '<ol style=\"padding-left: 20px;\">\r\n<li>We Had Offline Days Because internet provider had issues with line</li>\r\n<li>We had again offline time because of power line outtage at power grid line !</li>\r\n</ol>', 'Faks', '2011-02-28 17:19:41', 'Open', '<img src=\"http://hostings.flush.ws/img/forum/icons/Open.png\" />', '8'),
(33, 'Report Bugs !', 'Report Bugs to help us solve them and to improve quality of website', 'Faks', '2011.03.16 21:23:23', 'Open', '', '14');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_ftpd`
--

CREATE TABLE `hosting_ftpd` (
  `ftpd_id` int(11) NOT NULL,
  `User` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `Password` varchar(255) NOT NULL,
  `Uid` varchar(500) NOT NULL,
  `Gid` varchar(500) NOT NULL,
  `Dir` varchar(255) NOT NULL,
  `ULBandwidth` smallint(6) NOT NULL DEFAULT '0',
  `DLBandwidth` smallint(6) NOT NULL DEFAULT '0',
  `comment` tinytext NOT NULL,
  `ipaccess` varchar(15) NOT NULL DEFAULT '*',
  `QuotaSize` smallint(5) NOT NULL DEFAULT '0',
  `QuotaFiles` int(11) NOT NULL DEFAULT '0',
  `ftpd_owner` varchar(255) NOT NULL,
  `ftpd_license` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_ftpd`
--

INSERT INTO `hosting_ftpd` (`ftpd_id`, `User`, `status`, `Password`, `Uid`, `Gid`, `Dir`, `ULBandwidth`, `DLBandwidth`, `comment`, `ipaccess`, `QuotaSize`, `QuotaFiles`, `ftpd_owner`, `ftpd_license`) VALUES
(1, 'flush', '1', '409f25ac60a8cc794787dd30b744fd37', '2001', '2001', '/usr/local/etc/www/webroot/var/www', 0, 0, '', '80.232.240.26', 0, 0, 'root', '100'),
(2, 'flush_virtual', '1', '409f25ac60a8cc794787dd30b744fd37', '2001', '2001', '/usr/local/etc/www/webroot/var/htdocs/', 0, 0, '', '80.232.240.26', 0, 0, 'root', '100'),
(3, 'flush_phpmyadmin', '1', '409f25ac60a8cc794787dd30b744fd37', '2001', '2001', '/usr/local/etc/www/webroot/var/phpMyAdmin', 0, 0, '', '80.232.240.26', 0, 0, 'root', '100'),
(4, 'flush_net2ftp', '1', '409f25ac60a8cc794787dd30b744fd37', '2001', '2001', '/usr/local/etc/www/webroot/var/net2ftp', 0, 0, '', '80.232.240.26', 0, 0, 'root', '100'),
(5, 'flush_sqlbuddy', '1', '409f25ac60a8cc794787dd30b744fd37', '2001', '2001', '/usr/local/etc/www/webroot/var/sqlbuddy', 0, 0, '', '80.232.240.26', 0, 0, 'root', '100'),
(50, 'faks_virtual', '1', '6dc5292aaa06b028a68b998594943e4a', '101', '101', '/usr/local/etc/www/webroot/var/htdocs_public/345639030d7123d830f7e60b0ce3cd530fb586b2819f8988e01313ed79fcc9b95becbb3d9f7c89164863df34dbb7ee106b9baf0ccc37cf1ce75b624d3fa95f98/Faks/public_html/', 0, 0, '', '*', 0, 0, 'Faks', ''),
(49, 'root', '1', '58013529b3976d32d9b0cc646654864b', '106', '106', '/usr/local/etc/www/webroot/var/htdocs_public/99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8/root/public_html/', 0, 0, '', '*', 0, 0, 'root', '');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_guests`
--

CREATE TABLE `hosting_guests` (
  `hosting_guests_ip` varchar(255) NOT NULL,
  `hosting_guests_browser` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hosting_maintenance`
--

CREATE TABLE `hosting_maintenance` (
  `hosting_id_maintenance` int(11) NOT NULL,
  `hosting_maintenance_status` enum('0','1') NOT NULL DEFAULT '0',
  `hosting_maintenance_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_maintenance`
--

INSERT INTO `hosting_maintenance` (`hosting_id_maintenance`, `hosting_maintenance_status`, `hosting_maintenance_text`) VALUES
(1, '0', '<b>\nLabvakar lasītāj rakstu šo zinu jo mājas lapa migrē uz jauno serveri un varbūt dažādas problēmas sākot ar lēnu ielādi lidz citām problēmam tāpec ļoti ceru uz jūsu iecietību visi kaitīgie zvēri tiks nogālīnati un atrisināti</b>\n<br>\n<b>');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_most_online`
--

CREATE TABLE `hosting_most_online` (
  `id` int(11) NOT NULL,
  `hosting_most_online_record` varchar(100) NOT NULL,
  `hosting_most_online_stamp` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_most_online`
--

INSERT INTO `hosting_most_online` (`id`, `hosting_most_online_record`, `hosting_most_online_stamp`) VALUES
(1, '1', '2014-08-09'),
(2, '2', '2014-08-10'),
(3, '2', '2014-08-11'),
(4, '2', '2014-08-12'),
(5, '2', '2014-08-13'),
(6, '2', '2014-08-14'),
(7, '2', '2014-08-15'),
(8, '2', '2014-08-16'),
(9, '2', '2014-08-17'),
(10, '2', '2014-08-18'),
(11, '2', '2014-08-19'),
(12, '2', '2014-08-20'),
(13, '2', '2014-08-21'),
(14, '2', '2014-08-22'),
(15, '2', '2014-08-23'),
(16, '2', '2014-08-24'),
(17, '2', '2014-08-25'),
(18, '2', '2014-08-26'),
(19, '2', '2014-08-27'),
(20, '2', '2014-08-28'),
(21, '2', '2014-08-29'),
(22, '2', '2014-08-30'),
(23, '2', '2014-08-31'),
(24, '2', '2014-09-01'),
(25, '2', '2014-09-02'),
(26, '2', '2014-09-03'),
(27, '2', '2014-09-04'),
(28, '2', '2014-09-05'),
(29, '2', '2014-09-06'),
(30, '2', '2014-09-07'),
(31, '2', '2014-09-08'),
(32, '2', '2014-09-09'),
(33, '2', '2014-09-10'),
(34, '2', '2014-09-11'),
(35, '2', '2014-09-12'),
(36, '2', '2014-09-13'),
(37, '2', '2014-09-14'),
(38, '2', '2014-09-15'),
(39, '2', '2014-09-16'),
(40, '2', '2014-09-17'),
(41, '2', '2014-09-18'),
(42, '2', '2014-09-19'),
(43, '2', '2014-09-20'),
(44, '2', '2014-09-21'),
(45, '2', '2014-09-22'),
(46, '2', '2014-09-23'),
(47, '2', '2014-09-24'),
(48, '2', '2014-09-25'),
(49, '2', '2014-09-26'),
(50, '2', '2014-09-27'),
(51, '2', '2014-09-28'),
(52, '2', '2014-09-29'),
(53, '2', '2014-09-30'),
(54, '2', '2014-10-01'),
(55, '2', '2014-10-02'),
(56, '2', '2014-10-03'),
(57, '2', '2014-10-04'),
(58, '2', '2014-10-05'),
(59, '1', '2014-10-06'),
(60, '1', '2014-10-07'),
(61, '1', '2014-10-08'),
(62, '1', '2014-10-09'),
(63, '1', '2014-10-10'),
(64, '1', '2014-10-11'),
(65, '1', '2014-10-12'),
(66, '1', '2014-10-13'),
(67, '1', '2014-10-14'),
(68, '1', '2014-10-15'),
(69, '1', '2014-10-16'),
(70, '1', '2014-10-17'),
(71, '1', '2014-10-18'),
(72, '1', '2014-10-19'),
(73, '1', '2014-10-20'),
(74, '1', '2014-10-21'),
(75, '1', '2014-10-22'),
(76, '1', '2014-10-23'),
(77, '1', '2014-10-24'),
(78, '1', '2014-10-25'),
(79, '1', '2014-10-26'),
(80, '1', '2014-10-27'),
(81, '1', '2014-10-28'),
(82, '1', '2014-10-29'),
(83, '1', '2014-10-30'),
(84, '1', '2014-10-31'),
(85, '1', '2014-11-01'),
(86, '1', '2014-11-02'),
(87, '1', '2014-11-03'),
(88, '1', '2014-11-04'),
(89, '1', '2014-11-05'),
(90, '1', '2014-11-06'),
(91, '1', '2014-11-07'),
(92, '1', '2014-11-08'),
(93, '1', '2014-11-09'),
(94, '1', '2014-11-10'),
(95, '1', '2014-11-11'),
(96, '1', '2014-11-12'),
(97, '1', '2014-11-15'),
(98, '1', '2014-11-16'),
(99, '1', '2014-11-17'),
(100, '1', '2014-11-18'),
(101, '1', '2014-11-19'),
(102, '1', '2014-11-20'),
(103, '1', '2014-11-21'),
(104, '1', '2014-11-22'),
(105, '1', '2014-11-23'),
(106, '1', '2014-11-24'),
(107, '1', '2014-11-25'),
(108, '1', '2014-11-26'),
(109, '1', '2014-11-27'),
(110, '1', '2014-11-28'),
(111, '1', '2014-11-29'),
(112, '1', '2014-11-30'),
(113, '1', '2014-12-01'),
(114, '1', '2014-12-02'),
(115, '1', '2014-12-03'),
(116, '1', '2014-12-04'),
(117, '1', '2014-12-05'),
(118, '1', '2014-12-07'),
(119, '1', '2014-12-08'),
(120, '1', '2014-12-09'),
(121, '1', '2014-12-10'),
(122, '1', '2014-12-11'),
(123, '1', '2014-12-12'),
(124, '1', '2014-12-13'),
(125, '1', '2014-12-14'),
(126, '1', '2014-12-16'),
(127, '1', '2014-12-17'),
(128, '1', '2014-12-18'),
(129, '1', '2014-12-20'),
(130, '1', '2014-12-21'),
(131, '1', '2014-12-22'),
(132, '1', '2014-12-23'),
(133, '1', '2014-12-24'),
(134, '1', '2014-12-25'),
(135, '1', '2014-12-26'),
(136, '1', '2014-12-27'),
(137, '1', '2014-12-28'),
(138, '1', '2014-12-29'),
(139, '1', '2014-12-30'),
(140, '1', '2014-12-31'),
(141, '1', '2015-01-01'),
(142, '1', '2015-01-02'),
(143, '1', '2015-01-03'),
(144, '1', '2015-01-04'),
(145, '1', '2015-01-05'),
(146, '1', '2015-01-06'),
(147, '1', '2015-01-07'),
(148, '1', '2015-01-08'),
(149, '1', '2015-01-09'),
(150, '1', '2015-01-10'),
(151, '1', '2015-01-11'),
(152, '1', '2015-01-12'),
(153, '1', '2015-01-13'),
(154, '1', '2015-01-14'),
(155, '1', '2015-01-15'),
(156, '1', '2015-01-16'),
(157, '1', '2015-01-17'),
(158, '1', '2015-01-18'),
(159, '1', '2015-01-19'),
(160, '1', '2015-01-20'),
(161, '1', '2015-01-21'),
(162, '1', '2015-01-22'),
(163, '1', '2015-01-23'),
(164, '1', '2015-01-24'),
(165, '1', '2015-01-25'),
(166, '1', '2015-01-26'),
(167, '1', '2015-01-27'),
(168, '1', '2015-01-29'),
(169, '1', '2015-01-30'),
(170, '1', '2015-01-31'),
(171, '1', '2015-02-02'),
(172, '1', '2015-02-04'),
(173, '1', '2015-02-05'),
(174, '1', '2015-02-06'),
(175, '1', '2015-02-07'),
(176, '1', '2015-02-08'),
(177, '1', '2015-02-10'),
(178, '1', '2015-02-11'),
(179, '1', '2015-02-13'),
(180, '1', '2015-02-14'),
(181, '1', '2015-02-17'),
(182, '1', '2015-02-18'),
(183, '1', '2015-02-19'),
(184, '1', '2015-02-20'),
(185, '1', '2015-02-21'),
(186, '1', '2015-02-22'),
(187, '1', '2015-02-25'),
(188, '1', '2015-02-26'),
(189, '1', '2015-02-27'),
(190, '1', '2015-02-28'),
(191, '1', '2015-03-01'),
(192, '1', '2015-03-03'),
(193, '1', '2015-03-04'),
(194, '1', '2015-03-05'),
(195, '1', '2015-03-06'),
(196, '1', '2015-03-07'),
(197, '1', '2015-03-08'),
(198, '1', '2015-03-09'),
(199, '1', '2015-03-12'),
(200, '1', '2015-03-13'),
(201, '1', '2015-03-16'),
(202, '1', '2015-03-17'),
(203, '1', '2015-03-18'),
(204, '1', '2015-03-19'),
(205, '1', '2015-03-20'),
(206, '1', '2015-03-21'),
(207, '1', '2015-03-23'),
(208, '1', '2015-03-24'),
(209, '1', '2015-03-25'),
(210, '1', '2015-03-27'),
(211, '1', '2015-03-28'),
(212, '1', '2015-03-29'),
(213, '1', '2015-03-30'),
(214, '1', '2015-03-31'),
(215, '1', '2015-04-01'),
(216, '1', '2015-04-02'),
(217, '1', '2015-04-03'),
(218, '1', '2015-04-06'),
(219, '1', '2015-04-08'),
(220, '1', '2015-04-09'),
(221, '1', '2015-04-10'),
(222, '1', '2015-04-11'),
(223, '1', '2015-04-14'),
(224, '1', '2015-04-15'),
(225, '1', '2015-04-16'),
(226, '1', '2015-04-17'),
(227, '1', '2015-04-18'),
(228, '1', '2015-04-19'),
(229, '1', '2015-04-20'),
(230, '1', '2015-04-21'),
(231, '1', '2015-04-22'),
(232, '1', '2015-04-23'),
(233, '1', '2015-04-24'),
(234, '1', '2015-04-25'),
(235, '1', '2015-04-26'),
(236, '1', '2015-04-29'),
(237, '1', '2015-04-30'),
(238, '1', '2015-05-01'),
(239, '1', '2015-05-02'),
(240, '1', '2015-05-03'),
(241, '1', '2015-05-04'),
(242, '1', '2015-05-05'),
(243, '1', '2015-05-06'),
(244, '1', '2015-05-07'),
(245, '1', '2015-05-08'),
(246, '1', '2015-05-09'),
(247, '1', '2015-05-10'),
(248, '1', '2015-05-11'),
(249, '1', '2015-05-12'),
(250, '1', '2015-05-13'),
(251, '1', '2015-05-16'),
(252, '1', '2015-05-19'),
(253, '1', '2015-05-20'),
(254, '1', '2015-05-21'),
(255, '1', '2015-05-22'),
(256, '1', '2015-05-23'),
(257, '1', '2015-05-24'),
(258, '1', '2015-05-25'),
(259, '1', '2015-05-26'),
(260, '1', '2015-05-27'),
(261, '1', '2015-05-28'),
(262, '1', '2015-05-29'),
(263, '1', '2015-05-30'),
(264, '1', '2015-05-31'),
(265, '1', '2015-06-01'),
(266, '1', '2015-06-02'),
(267, '1', '2015-06-03'),
(268, '1', '2015-06-04'),
(269, '1', '2015-06-05'),
(270, '1', '2015-06-06'),
(271, '1', '2015-06-07'),
(272, '1', '2015-06-08'),
(273, '1', '2015-06-09'),
(274, '1', '2015-06-10'),
(275, '1', '2015-06-11'),
(276, '1', '2015-06-12'),
(277, '1', '2015-06-13'),
(278, '1', '2015-06-14'),
(279, '1', '2015-06-15'),
(280, '1', '2015-06-16'),
(281, '1', '2015-06-17'),
(282, '1', '2015-06-18'),
(283, '1', '2015-06-19'),
(284, '1', '2015-06-20'),
(285, '1', '2015-06-21'),
(286, '1', '2015-06-22'),
(287, '1', '2015-06-23'),
(288, '1', '2015-06-24'),
(289, '1', '2015-06-25'),
(290, '1', '2015-06-26'),
(291, '1', '2015-06-27'),
(292, '1', '2015-06-28'),
(293, '1', '2015-06-29'),
(294, '1', '2015-06-30'),
(295, '1', '2015-07-01'),
(296, '1', '2015-07-02'),
(297, '1', '2015-07-03'),
(298, '1', '2015-07-04'),
(299, '1', '2015-07-06'),
(300, '1', '2015-07-07'),
(301, '1', '2015-07-08'),
(302, '1', '2015-07-09'),
(303, '1', '2015-07-10'),
(304, '1', '2015-07-11'),
(305, '1', '2015-07-12'),
(306, '1', '2015-07-13'),
(307, '1', '2015-07-14'),
(308, '1', '2015-07-15'),
(309, '1', '2015-07-16'),
(310, '1', '2015-07-17'),
(311, '1', '2015-07-18'),
(312, '1', '2015-07-20'),
(313, '1', '2015-07-21'),
(314, '1', '2015-07-22'),
(315, '1', '2015-07-23'),
(316, '1', '2015-07-24'),
(317, '1', '2015-07-25'),
(318, '1', '2015-07-26'),
(319, '1', '2015-07-27'),
(320, '1', '2015-07-28'),
(321, '1', '2015-07-29'),
(322, '1', '2015-07-30'),
(323, '1', '2015-07-31'),
(324, '1', '2015-08-01'),
(325, '1', '2015-08-02'),
(326, '1', '2015-08-03'),
(327, '1', '2015-08-04'),
(328, '1', '2015-08-05'),
(329, '1', '2015-08-07'),
(330, '1', '2015-08-08'),
(331, '1', '2015-08-09'),
(332, '1', '2015-08-10'),
(333, '1', '2015-08-12'),
(334, '1', '2015-08-13'),
(335, '1', '2015-08-14'),
(336, '1', '2015-08-15'),
(337, '1', '2015-08-16'),
(338, '1', '2015-08-17'),
(339, '1', '2015-08-19'),
(340, '1', '2015-08-20'),
(341, '1', '2015-08-22'),
(342, '1', '2015-08-23'),
(343, '1', '2015-08-24'),
(344, '1', '2015-08-25'),
(345, '1', '2015-08-26'),
(346, '1', '2015-08-27'),
(347, '1', '2015-08-28'),
(348, '1', '2015-08-29'),
(349, '1', '2017-05-03'),
(350, '1', '2017-05-04'),
(351, '1', '2017-05-05'),
(352, '1', '2017-05-06'),
(353, '1', '2017-05-09'),
(354, '1', '2017-05-10'),
(355, '1', '2017-05-12'),
(356, '1', '2017-05-14'),
(357, '1', '2017-05-15'),
(358, '1', '2017-05-16'),
(359, '1', '2017-05-23'),
(360, '1', '2017-05-26'),
(361, '1', '2017-05-28'),
(362, '1', '2017-05-29'),
(363, '1', '2017-06-02'),
(364, '1', '2017-06-04'),
(365, '1', '2017-06-11'),
(366, '1', '2017-06-13'),
(367, '1', '2017-06-19'),
(368, '1', '2017-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_news`
--

CREATE TABLE `hosting_news` (
  `hosting_id_news` int(11) NOT NULL,
  `hosting_author_news` varchar(320) NOT NULL,
  `hosting_time_news` datetime NOT NULL,
  `hosting_short_news` text NOT NULL,
  `hosting_full_news` longtext NOT NULL,
  `hosting_title_news` varchar(320) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_news`
--

INSERT INTO `hosting_news` (`hosting_id_news`, `hosting_author_news`, `hosting_time_news`, `hosting_short_news`, `hosting_full_news`, `hosting_title_news`) VALUES
(1, 'Faks', '2010-12-26 20:44:04', 'Hi Everybody yesterday i started working on hosting web page right i have quite much work left but i hope resolve all problems as soon is possible sow please be patience .', '', 'Hosting Flush About Hosting !'),
(2, 'Faks', '2010-12-27 16:28:36', '<b>Hi everybody my name Faks and i am founder of project Hosting Flush right now we are working on Website and all hosting stuff to get hosting up and running but meanwhile track us for any further news but all goes like in this video but i do hope it will be better :) thanks for your attention .</b>\r\n\r\nhttp://www.youtube.com/watch?v=cDtgpM6f7KE&feature=player_embedded', '', 'Welcome To Our Project & Keep Tracking For News !'),
(5, 'Faks', '2010-12-31 18:07:27', '<a href=\"http://3.bp.blogspot.com/_--YjWiyF8eE/Sz0kj8YYysI/AAAAAAAAGDE/OsBMMWRE5ko/s400/happy-new-year.jpg\" title=\"Happy New Year\" class=\"thickbox\"><img src=\"http://3.bp.blogspot.com/_--YjWiyF8eE/Sz0kj8YYysI/AAAAAAAAGDE/OsBMMWRE5ko/s400/happy-new-year.jpg\"/></a>', '', 'Happy New Year 2011'),
(3, 'Faks', '2010-12-31 18:02:56', '<a href=\"http://hlcdn.datasphere.com/sites/kboi2.com/files/imagecache/resize_story_image/Power_Outage2_1.jpg\" title=\"Power Problems\" class=\"thickbox\"><img src=\"http://hlcdn.datasphere.com/sites/kboi2.com/files/imagecache/resize_story_image/Power_Outage2_1.jpg\"/></a><br>\r\n<a href=\"http://twitter.com/#!/Faksx/status/20870991248891905\">explained at twitter</a>', '', 'Power Outage Problem located'),
(6, 'Faks', '2011-03-11 23:57:03', 'Hi everybody lately we had many issues<br> \r\nPower Line Blackout<br>\r\nInternet Line offline time<br>\r\nServer Offline times because of ddos testing<br>\r\nServer slowdowns because of improvements & tweaks<br>\r\n', 'Hi everybody lately we had many issues <br>\r\nPower Line Blackout<br>\r\nInternet Line offline time<br>\r\nServer Offline times because of ddos testing<br>\r\nServer slowdowns because of improvements & tweaks<br>\r\ni hope all problems will be resolved in most nearest future also soon launching change log panel and bug tracker :)', '<b>Problems & In Short</b>'),
(7, 'Faks', '2011-08-21 23:57:59', 'Hi everybody since been very long time gap i will cut to the chase !<br>\r\n\r\nFirst of all right now i am working on<br> \r\n<pre>\r\n1.Registration :: Done<br>\r\n2.Translations<br>\r\n3.Terms Of Agreement :: Done<br>\r\n4.Security Leaks<br>\r\n5.BBcode Integration :: Ready<br>\r\n6.Missing Features<br>\r\n</pre>\r\n\r\n<br>\r\nFirst working Beta Version Soon ! \r\n<br>\r\nMore updates as soon i will find enough free time .', 'Hi everybody since been very long time gap i will cut to the chase !<br>\r\n\r\nFirst of all right now i am working on<br> \r\n<pre>\r\n1.Registration<br>\r\n2.Translations<br>\r\n3.Terms Of Agreement<br>\r\n4.Security Leaks<br>\r\n5.BBcode Integration<br>\r\n6.Missing Features<br>\r\n</pre>\r\n\r\n<br>\r\nFirst working Beta Version Soon ! \r\n<br>\r\nMore updates as soon i will find enough free time .', 'Things To Do'),
(9, 'Faks', '2011-09-25 22:04:15', 'Hi everybody well i glad to say were are in beta stage there is still much work to do but we are ready to start hosting your website we will be glad to welcome new members in our community or as customers :)\r\n<br>\r\nThings To Do\r\nMultilingual system spell check mistakes or misspells to fix or to translate them :)', 'Hi everybody well i glad to say were are in beta stage there is still much work to do but we are ready to start hosting your website we will be glad to welcome new members in our community or as customers :)\r\n<br>\r\nThings To Do\r\nMultilingual system spell check mistakes or misspells to fix or to translate them :)', 'This Is It Beta Is Here !');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_new_member`
--

CREATE TABLE `hosting_new_member` (
  `id` int(11) NOT NULL,
  `hosting_new_member_name` varchar(150) NOT NULL,
  `hosting_new_member_date` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_new_member`
--

INSERT INTO `hosting_new_member` (`id`, `hosting_new_member_name`, `hosting_new_member_date`) VALUES
(1, 'Arphen', '2014-08-03'),
(2, 'test', '2014-08-10'),
(3, 'bugatti', '2015-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_order_plan`
--

CREATE TABLE `hosting_order_plan` (
  `hosting_order_plan_id` bigint(100) NOT NULL,
  `hosting_order_plan` varchar(255) NOT NULL,
  `hosting_order_plan_name` varchar(255) NOT NULL,
  `hosting_order_plan_price` varchar(50) NOT NULL,
  `hosting_order_plan_php_version` varchar(15) NOT NULL DEFAULT '5',
  `hosting_order_plan_MySQL_version` varchar(5) NOT NULL DEFAULT '5',
  `hosting_order_plan_MySQL_total_db` varchar(11) NOT NULL,
  `hosting_order_plan_total_domains` varchar(11) NOT NULL,
  `hosting_order_plan_user_nick` varchar(255) NOT NULL,
  `hosting_order_plan_order_datetime` datetime NOT NULL,
  `hosting_order_plan_confirmed` enum('no','yes') NOT NULL DEFAULT 'no',
  `hosting_order_plan_paid` enum('no','yes') NOT NULL DEFAULT 'no',
  `hosting_order_plan_expired` enum('no','yes') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_order_plan`
--

INSERT INTO `hosting_order_plan` (`hosting_order_plan_id`, `hosting_order_plan`, `hosting_order_plan_name`, `hosting_order_plan_price`, `hosting_order_plan_php_version`, `hosting_order_plan_MySQL_version`, `hosting_order_plan_MySQL_total_db`, `hosting_order_plan_total_domains`, `hosting_order_plan_user_nick`, `hosting_order_plan_order_datetime`, `hosting_order_plan_confirmed`, `hosting_order_plan_paid`, `hosting_order_plan_expired`) VALUES
(86, 'Hosting Plan 1', '2 Months', '2.80', '5', '5', '1', '2', 'test', '2012-07-07 17:06:11', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_permission`
--

CREATE TABLE `hosting_permission` (
  `hosting_permission_id` int(11) NOT NULL,
  `hosting_permission_page_name` varchar(255) NOT NULL,
  `hosting_permission_rights` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_permission`
--

INSERT INTO `hosting_permission` (`hosting_permission_id`, `hosting_permission_page_name`, `hosting_permission_rights`) VALUES
(1, 'News', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hosting_pm`
--

CREATE TABLE `hosting_pm` (
  `hosting_pm_id` int(25) NOT NULL,
  `hosting_pm_author` varchar(320) NOT NULL,
  `hosting_pm_title` varchar(320) NOT NULL,
  `hosting_pm_receiver` varchar(320) NOT NULL,
  `hosting_pm_text` mediumtext NOT NULL,
  `hosting_pm_read` enum('no','yes') NOT NULL DEFAULT 'no',
  `hosting_pm_date` date NOT NULL,
  `hosting_pm_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_pm`
--

INSERT INTO `hosting_pm` (`hosting_pm_id`, `hosting_pm_author`, `hosting_pm_title`, `hosting_pm_receiver`, `hosting_pm_text`, `hosting_pm_read`, `hosting_pm_date`, `hosting_pm_time`) VALUES
(39, 'Faks', 'Labdien Laipni Lūdzam testā režīmā !', 'demo', 'Esam ļoti iepriecināti ka jūs esat ar mums un vēlaties aplūkot mūsu progressu !', 'yes', '2011-08-22', '22:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_pm_outbox`
--

CREATE TABLE `hosting_pm_outbox` (
  `hosting_pm_outbox_id` int(25) NOT NULL,
  `hosting_pm_outbox_author` varchar(320) NOT NULL,
  `hosting_pm_outbox_title` varchar(320) NOT NULL,
  `hosting_pm_outbox_receiver` varchar(320) NOT NULL,
  `hosting_pm_outbox_text` mediumtext NOT NULL,
  `hosting_pm_outbox_read` enum('no','yes') NOT NULL DEFAULT 'no',
  `hosting_pm_outbox_date` date NOT NULL,
  `hosting_pm_outbox_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_pm_outbox`
--

INSERT INTO `hosting_pm_outbox` (`hosting_pm_outbox_id`, `hosting_pm_outbox_author`, `hosting_pm_outbox_title`, `hosting_pm_outbox_receiver`, `hosting_pm_outbox_text`, `hosting_pm_outbox_read`, `hosting_pm_outbox_date`, `hosting_pm_outbox_time`) VALUES
(31, 'Faks', 'Labdien Laipni Lūdzam testā režīmā !', 'demo', 'Esam ļoti iepriecināti ka jūs esat ar mums un vēlaties aplūkot mūsu progressu !', 'no', '2011-08-22', '22:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_support`
--

CREATE TABLE `hosting_support` (
  `ticket_id` int(11) NOT NULL,
  `ticket_nick` varchar(255) NOT NULL,
  `ticket_title` varchar(255) NOT NULL,
  `ticket_domain_name` varchar(320) NOT NULL,
  `ticket_status` varchar(5) NOT NULL,
  `ticket_text` mediumtext NOT NULL,
  `ticket_issue_type` varchar(255) NOT NULL,
  `ticket_date` date NOT NULL,
  `ticket_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_support`
--

INSERT INTO `hosting_support` (`ticket_id`, `ticket_nick`, `ticket_title`, `ticket_domain_name`, `ticket_status`, `ticket_text`, `ticket_issue_type`, `ticket_date`, `ticket_time`) VALUES
(76, 'Faks', 'test', 'asdasd', '1', 'asdads', 'Light Support Panel', '2011-09-15', '21:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_user`
--

CREATE TABLE `hosting_user` (
  `hosting_user_id` bigint(20) NOT NULL,
  `hosting_user_name` varchar(320) NOT NULL,
  `hosting_user_password` text NOT NULL,
  `hosting_user_avatar` varchar(255) NOT NULL,
  `hosting_user_email` varchar(320) NOT NULL,
  `hosting_user_gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `hosting_user_rights` int(1) NOT NULL DEFAULT '2',
  `hosting_user_title` enum('SysAdmin','Admin','Moderator','VIP','User') NOT NULL DEFAULT 'User',
  `hosting_user_sysop_rights` enum('yes','no') NOT NULL DEFAULT 'no',
  `hosting_user_administrator_rights` enum('yes','no') NOT NULL DEFAULT 'no',
  `hosting_user_admin_rights` enum('1','0') NOT NULL DEFAULT '0',
  `hosting_user_moderator_rights` enum('yes','no') NOT NULL DEFAULT 'no',
  `hosting_user_vip_rights` enum('yes','no') NOT NULL DEFAULT 'no',
  `hosting_user_default_rights` enum('yes','no') NOT NULL DEFAULT 'yes',
  `hosting_user_online_status` enum('no','yes') NOT NULL DEFAULT 'no',
  `hosting_user_total_news_comments` bigint(20) NOT NULL DEFAULT '0',
  `hosting_user_total_blog_comments` bigint(20) NOT NULL DEFAULT '0',
  `hosting_user_total_forum_comments` bigint(20) NOT NULL DEFAULT '0',
  `hosting_user_total_download_comments` bigint(20) NOT NULL DEFAULT '0',
  `hosting_user_forum_visited_today` varchar(255) NOT NULL,
  `hosting_user_homepage` varchar(320) NOT NULL,
  `hosting_user_signature` text NOT NULL,
  `hosting_user_bonus` varchar(320) NOT NULL DEFAULT '0',
  `hosting_user_violation` tinytext NOT NULL,
  `hosting_user_warnings` tinytext NOT NULL,
  `hosting_user_join` datetime NOT NULL,
  `hosting_user_hosting_plan_start` varchar(320) NOT NULL DEFAULT '0',
  `hosting_user_hosting_plan_end` varchar(320) NOT NULL DEFAULT '0',
  `hosting_user_fee_transfer` enum('0','1') NOT NULL DEFAULT '0',
  `hosting_permission_for_status` enum('0','1') NOT NULL DEFAULT '0',
  `hosting_user_hosting_plan` enum('1','2','3','4','5','6') NOT NULL,
  `hosting_user_last_time_seen` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosting_user`
--

INSERT INTO `hosting_user` (`hosting_user_id`, `hosting_user_name`, `hosting_user_password`, `hosting_user_avatar`, `hosting_user_email`, `hosting_user_gender`, `hosting_user_rights`, `hosting_user_title`, `hosting_user_sysop_rights`, `hosting_user_administrator_rights`, `hosting_user_admin_rights`, `hosting_user_moderator_rights`, `hosting_user_vip_rights`, `hosting_user_default_rights`, `hosting_user_online_status`, `hosting_user_total_news_comments`, `hosting_user_total_blog_comments`, `hosting_user_total_forum_comments`, `hosting_user_total_download_comments`, `hosting_user_forum_visited_today`, `hosting_user_homepage`, `hosting_user_signature`, `hosting_user_bonus`, `hosting_user_violation`, `hosting_user_warnings`, `hosting_user_join`, `hosting_user_hosting_plan_start`, `hosting_user_hosting_plan_end`, `hosting_user_fee_transfer`, `hosting_permission_for_status`, `hosting_user_hosting_plan`, `hosting_user_last_time_seen`) VALUES
(1, 'Faks', 'protected', 'http://img197.imageshack.us/img197/511/82790110.jpg', 'sia_dev@inbox.lv', 'Male', 6, 'SysAdmin', 'yes', 'no', '1', 'no', 'no', 'no', 'no', 1, 0, 5, 0, '', 'faks.sytes.net', 'If You Are Smart Proove It <a href=\"http://faks.sytes.net/\"><img src=\"http://img219.imageshack.us/img219/1695/buttonlogo.gif\" alt=\"http://img219.imageshack.us/img219/1695/buttonlogo.gif\" /></a>', '30 days', 'Test violation !!!', 'Tried Hack Website', '2011-01-05 19:49:13', '2013-08-09', '2012-08-11', '1', '1', '6', '2011-01-05 20:35:00'),
-- --------------------------------------------------------

--
-- Table structure for table `lgsl`
--

CREATE TABLE `lgsl` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `c_port` varchar(5) NOT NULL DEFAULT '0',
  `q_port` varchar(5) NOT NULL DEFAULT '0',
  `s_port` varchar(5) NOT NULL DEFAULT '0',
  `zone` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cache` text NOT NULL,
  `cache_time` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lgsl`
--

INSERT INTO `lgsl` (`id`, `type`, `ip`, `c_port`, `q_port`, `s_port`, `zone`, `disabled`, `comment`, `status`, `cache`, `cache_time`) VALUES
(1, 'halflife', '169.254.148.47', '27015', '27015', '27015', 1, 1, 'Gamer Ludus', 0, '', ''),
(2, 'source', '83.99.233.96', '27016', '27016', '27016', 1, 0, 'Gamer Ludus', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjY6InNvdXJjZSI7czoyOiJpcCI7czoxMjoiODMuOTkuMjMzLjk2IjtzOjY6ImNfcG9ydCI7czo1OiIyNzAxNiI7czo2OiJxX3BvcnQiO3M6NToiMjcwMTYiO3M6Njoic19wb3J0IjtzOjU6IjI3MDE2IjtzOjY6InN0YXR1cyI7czoxOiIwIjt9czoxOiJvIjthOjQ6e3M6NzoicmVxdWVzdCI7czoyOiJzcCI7czoyOiJpZCI7czoxOiIyIjtzOjQ6InpvbmUiO3M6MToiMSI7czo3OiJjb21tZW50IjtzOjExOiJHYW1lciBMdWR1cyI7fXM6MToicyI7YTo2OntzOjQ6ImdhbWUiO3M6NDoiY3NnbyI7czozOiJtYXAiO3M6NzoiZGVfZHVzdCI7czo4OiJwYXNzd29yZCI7czoxOiIwIjtzOjc6InBsYXllcnMiO2k6MDtzOjEwOiJwbGF5ZXJzbWF4IjtzOjI6IjI0IjtzOjQ6Im5hbWUiO3M6MjE6IkdhbWVyIEx1ZHVzIENTOkdPIFBVQiI7fXM6MToiZSI7YTowOnt9czoxOiJwIjthOjA6e319', '1493891643_1493891643_1493891643'),
(3, 'source', '83.99.233.96', '27017', '27017', '27017', 1, 1, 'Gamer Ludus', 0, '', ''),
(4, 'source', '83.99.233.96', '27018', '27018', '27018', 1, 0, 'Gamer Ludus', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjY6InNvdXJjZSI7czoyOiJpcCI7czoxMjoiODMuOTkuMjMzLjk2IjtzOjY6ImNfcG9ydCI7czo1OiIyNzAxOCI7czo2OiJxX3BvcnQiO3M6NToiMjcwMTgiO3M6Njoic19wb3J0IjtzOjU6IjI3MDE4IjtzOjY6InN0YXR1cyI7czoxOiIwIjt9czoxOiJvIjthOjQ6e3M6NzoicmVxdWVzdCI7czoyOiJzcCI7czoyOiJpZCI7czoxOiI0IjtzOjQ6InpvbmUiO3M6MToiMSI7czo3OiJjb21tZW50IjtzOjExOiJHYW1lciBMdWR1cyI7fXM6MToicyI7YTo2OntzOjQ6ImdhbWUiO3M6NzoiY3N0cmlrZSI7czozOiJtYXAiO3M6NzoiZGVfcG9ydCI7czo4OiJwYXNzd29yZCI7czoxOiIwIjtzOjc6InBsYXllcnMiO2k6MDtzOjEwOiJwbGF5ZXJzbWF4IjtzOjI6IjI0IjtzOjQ6Im5hbWUiO3M6MjA6IkdhbWVyIEx1ZHVzIENTOlMgUFVCIjt9czoxOiJlIjthOjA6e31zOjE6InAiO2E6MDp7fX0=', '1493891617_1493891617_1493891617'),
(5, 'source', '83.99.233.96', '27019', '27019', '27019', 1, 1, 'Gamer Ludus', 0, '', ''),
(6, 'source', '83.99.233.96', '27020', '27020', '27020', 1, 1, 'Gamer Ludus', 0, '', ''),
(7, 'source', '83.99.233.96', '27021', '27021', '27021', 1, 0, 'Gamer Ludus', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjY6InNvdXJjZSI7czoyOiJpcCI7czoxMjoiODMuOTkuMjMzLjk2IjtzOjY6ImNfcG9ydCI7czo1OiIyNzAyMSI7czo2OiJxX3BvcnQiO3M6NToiMjcwMjEiO3M6Njoic19wb3J0IjtzOjU6IjI3MDIxIjtzOjY6InN0YXR1cyI7czoxOiIwIjt9czoxOiJvIjthOjQ6e3M6NzoicmVxdWVzdCI7czoyOiJzcCI7czoyOiJpZCI7czoxOiI3IjtzOjQ6InpvbmUiO3M6MToiMSI7czo3OiJjb21tZW50IjtzOjExOiJHYW1lciBMdWR1cyI7fXM6MToicyI7YTo2OntzOjQ6ImdhbWUiO3M6OToibGVmdDRkZWFkIjtzOjM6Im1hcCI7czoxOToibDRkX2dhcmFnZTAxX2FsbGV5cyI7czo4OiJwYXNzd29yZCI7czoxOiIwIjtzOjc6InBsYXllcnMiO2k6MDtzOjEwOiJwbGF5ZXJzbWF4IjtzOjE6IjQiO3M6NDoibmFtZSI7czoyMToiR2FtZXIgTHVkdXMgTDREIENPLU9QIjt9czoxOiJlIjthOjA6e31zOjE6InAiO2E6MDp7fX0=', '1493891527_1493891527_1493891527'),
(8, 'source', '83.99.233.96', '27022', '27022', '27022', 1, 0, 'Gamer Ludus', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjY6InNvdXJjZSI7czoyOiJpcCI7czoxMjoiODMuOTkuMjMzLjk2IjtzOjY6ImNfcG9ydCI7czo1OiIyNzAyMiI7czo2OiJxX3BvcnQiO3M6NToiMjcwMjIiO3M6Njoic19wb3J0IjtzOjU6IjI3MDIyIjtzOjY6InN0YXR1cyI7czoxOiIwIjt9czoxOiJvIjthOjQ6e3M6NzoicmVxdWVzdCI7czoyOiJzcCI7czoyOiJpZCI7czoxOiI4IjtzOjQ6InpvbmUiO3M6MToiMSI7czo3OiJjb21tZW50IjtzOjExOiJHYW1lciBMdWR1cyI7fXM6MToicyI7YTo2OntzOjQ6ImdhbWUiO3M6MTA6ImxlZnQ0ZGVhZDIiO3M6MzoibWFwIjtzOjE0OiJjOG0xX2FwYXJ0bWVudCI7czo4OiJwYXNzd29yZCI7czoxOiIwIjtzOjc6InBsYXllcnMiO2k6MDtzOjEwOiJwbGF5ZXJzbWF4IjtzOjE6IjQiO3M6NDoibmFtZSI7czoyMjoiR2FtZXIgTHVkdXMgTDREMiBDTy1PUCI7fXM6MToiZSI7YTowOnt9czoxOiJwIjthOjA6e319', '1493891641_1493891641_1493891641'),
(9, 'source', '83.99.233.96', '27023', '27023', '27023', 1, 1, 'Gamer Ludus', 0, '', ''),
(10, 'source', '83.99.233.96', '27024', '27024', '27024', 1, 0, 'Gamer Ludus', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjY6InNvdXJjZSI7czoyOiJpcCI7czoxMjoiODMuOTkuMjMzLjk2IjtzOjY6ImNfcG9ydCI7czo1OiIyNzAyNCI7czo2OiJxX3BvcnQiO3M6NToiMjcwMjQiO3M6Njoic19wb3J0IjtzOjU6IjI3MDI0IjtzOjY6InN0YXR1cyI7czoxOiIwIjt9czoxOiJvIjthOjQ6e3M6NzoicmVxdWVzdCI7czoyOiJzcCI7czoyOiJpZCI7czoyOiIxMCI7czo0OiJ6b25lIjtzOjE6IjEiO3M6NzoiY29tbWVudCI7czoxMToiR2FtZXIgTHVkdXMiO31zOjE6InMiO2E6Njp7czo0OiJnYW1lIjtzOjI6InRmIjtzOjM6Im1hcCI7czo5OiJwbF91cHdhcmQiO3M6ODoicGFzc3dvcmQiO3M6MToiMCI7czo3OiJwbGF5ZXJzIjtpOjA7czoxMDoicGxheWVyc21heCI7czoyOiIyNCI7czo0OiJuYW1lIjtzOjE5OiJHYW1lciBMdWR1cyBURjIgUFVCIjt9czoxOiJlIjthOjA6e31zOjE6InAiO2E6MDp7fX0=', '1493891615_1493891615_1493891615'),
(11, 'source', '83.99.233.96', '27025', '27025', '27025', 1, 1, 'Gamer Ludus', 0, '', ''),
(12, 'killingfloor', '83.99.233.96', '7707', '7708', '0', 1, 1, '', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjEyOiJraWxsaW5nZmxvb3IiO3M6MjoiaXAiO3M6MTI6IjgzLjk5LjIzMy45NiI7czo2OiJjX3BvcnQiO3M6NDoiNzcwNyI7czo2OiJxX3BvcnQiO3M6NDoiNzcwOCI7czo2OiJzX3BvcnQiO3M6MToiMCI7czo2OiJzdGF0dXMiO3M6MToiMCI7fXM6MToibyI7YTo0OntzOjc6InJlcXVlc3QiO3M6MToicyI7czoyOiJpZCI7czoyOiIxMiI7czo0OiJ6b25lIjtzOjE6IjEiO3M6NzoiY29tbWVudCI7czowOiIiO31zOjE6InMiO2E6Njp7czo0OiJnYW1lIjtzOjEyOiJraWxsaW5nZmxvb3IiO3M6MzoibWFwIjtzOjI6Ii0tIjtzOjg6InBhc3N3b3JkIjtpOjA7czo3OiJwbGF5ZXJzIjtpOjA7czoxMDoicGxheWVyc21heCI7aTowO3M6NDoibmFtZSI7czoyOiItLSI7fXM6MToiZSI7YTowOnt9czoxOiJwIjthOjA6e319', '1432682955_1432682955_1432682955'),
(13, 'source', '83.99.233.96', '7800', '7900', '0', 1, 1, '', 0, '', ''),
(14, 'halflife', '83.99.233.96', '7777', '7777', '7777', 1, 1, '', 0, 'YTo1OntzOjE6ImIiO2E6Njp7czo0OiJ0eXBlIjtzOjg6ImhhbGZsaWZlIjtzOjI6ImlwIjtzOjEyOiI4My45OS4yMzMuOTYiO3M6NjoiY19wb3J0IjtzOjQ6Ijc3NzciO3M6NjoicV9wb3J0IjtzOjQ6Ijc3NzciO3M6Njoic19wb3J0IjtzOjQ6Ijc3NzciO3M6Njoic3RhdHVzIjtzOjE6IjAiO31zOjE6Im8iO2E6NDp7czo3OiJyZXF1ZXN0IjtzOjM6InNlcCI7czoyOiJpZCI7czoyOiIxNCI7czo0OiJ6b25lIjtzOjE6IjEiO3M6NzoiY29tbWVudCI7czowOiIiO31zOjE6InMiO2E6Njp7czo0OiJnYW1lIjtzOjg6ImhhbGZsaWZlIjtzOjM6Im1hcCI7czoyOiItLSI7czo4OiJwYXNzd29yZCI7aTowO3M6NzoicGxheWVycyI7aTowO3M6MTA6InBsYXllcnNtYXgiO2k6MDtzOjQ6Im5hbWUiO3M6MjoiLS0iO31zOjE6ImUiO2E6MDp7fXM6MToicCI7YTowOnt9fQ==', '1435209078_1435209078_1435209078');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(50) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` enum('Devlopment','Updates','News','Bugs','Game Server','Game Servers','Security','Network','Hardware','Downloads','Members','Server Issues') NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(400) NOT NULL,
  `text_short` text NOT NULL,
  `text_long` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `time`, `author`, `category`, `title`, `image`, `text_short`, `text_long`) VALUES
(1, '25/06/2012', '00:00:00', 'Faks', 'News', 'Laipni Lūdzam Gaming Ludus Mājas Lapā', '[img]http://gaming.flushsolutions.info/images/soldier.jpg[/img]', 'Sākot ar šodienu mājas lapa sāk darboties  un attīstīties un projekts drīz uzsāks pilnīgu darbību tai skaitā ari serveri bet pacik viņi ari tiek veidoti patstavigi ar maniem spēkiem tas var aizņemt kādu drusku laika ceru ka jūs visi negaidat pasaules brīnumus.', 'Sākot ar šodienu mājas lapa sāk darboties  un attīstīties un projekts drīz uzsāks pilnīgu darbību tai skaitā ari serveri bet pacik viņi ari tiek veidoti patstavigi ar maniem spēkiem tas var aizņemt kādu drusku laika ceru ka jūs visi negaidat pasaules brīnumus.'),
(3, '11/07/2012', '00:00:00', 'Faks', 'News', 'Test Launch Nedēļas Beigas', '[img]http://1.bp.blogspot.com/_7Sp4ExCqOsk/TOqNkwJtbEI/AAAAAAAAB1U/d0JR3p4foMo/s1600/endOfLine.jpg[/img]', 'Nu tad tā diena ir situsi test launch nedēļa beidzās un serveri vakar tika islēgti pl 00:00.', 'Nu tad tā diena ir situsi test launch nedēļa beidzās un serveri vakar tika islēgti pl 00:00.'),
(2, '04/07/2012', '00:00:00', 'Faks', 'News', 'Test Launch Nedēļa Mūsu Gladiatori uzsāka cīņu', '[img]http://toursblogqa.com/etus/wp-content/uploads/2011/11/Roman-Gladiators.jpg[/img]', 'Nu tad tā diena ir situsi visi ir laipni gaidīti mūsu serveros !', 'Nu tad tā diena ir situsi visi ir laipni gaidīti mūsu serveros !'),
(4, '20/07/2012', '00:00:00', 'Faks', 'News', 'Šodien Officiāli atvērta mājas lapa.', '[img]http://troyohcoc.weblinkconnect.com/external/wcpages/wcmedia/images/ribbon-cutting.jpg[/img]', 'Nu tātad ir notikusi ši svarīgā diena un officiāli mājas lapa ir atvērta tā ir laba ziņa visiem kas vēlas pievienoties mūsu komūnai.\r\nNu tad īsumā kas būs un kas kā ir tātad mums ir Terraria,CS:1.6,CS:S,CS:CZ\r\nServeri tiek ari piedomāti ari citi bet tas citam rakstam turpinot tēmu \r\nnaksies visus sarūktināt mājas lapā vel nau pabeigtas visas funkcijas šis cms motors ir rakstits no 0 lidz esošajam līmenim Persongī ar manām zināšanām tai skaitā ari serveri un vis parējais ir veidots ar manām rokām neskatoties uz visām problēmām Projekts tika palaists un tagad tikai plauks visā savā skaistumā .\r\n', 'Nu tātad ir notikusi ši svarīgā diena un officiāli mājas lapa ir atvērta tā ir laba ziņa visiem kas vēlas pievienoties mūsu komūnai.\r\nNu tad īsumā kas būs un kas kā ir tātad mums ir Terraria,CS:1.6,CS:S,CS:CZ\r\nServeri tiek ari piedomāti ari citi bet tas citam rakstam turpinot tēmu \r\nnaksies visus sarūktināt mājas lapā vel nau pabeigtas visas funkcijas šis cms motors ir rakstits no 0 lidz esošajam līmenim Persongī ar manām zināšanām tai skaitā ari serveri un vis parējais ir veidots ar manām rokām neskatoties uz visām problēmām Projekts tika palaists un tagad tikai plauks visā savā skaistumā .\r\n'),
(5, '25/07/2012', '00:00:00', 'Faks', 'News', 'Šodien notiek tehniskie darbi !', '[img]/images/working_in_Progress_bar.png[/img]', 'Šodien notiek aktivi tehniskie darbi mājas lapai tiek pievienotas jaunas funkcijas un tiek salabotas esošas un nestrādajošas bet jau intigrētās ja ieraugat kļudu nebrīnaties .', 'Šodien notiek aktivi tehniskie darbi mājas lapai tiek pievienotas jaunas funkcijas un tiek salabotas esošas un nestrādajošas bet jau intigrētās ja ieraugat kļudu nebrīnaties .'),
(6, '23/08/2012', '17:16:27', 'Faks', 'Server Issues', 'Tehniskas Problēmas', '[img]http://www.smalshop.lv/img/p/819-955-large.jpg[/img]', 'Labdien rakstu ar sliktu un labu ziņu šonakt serveri nobruka ... tiešak cietais\nbet nu tas ir dēļ manu darbību bija nopietnas problēmas bija ar arejo cieto disku kurš nobruka un rezultāta nedarbojas kamer vinš tika labots serveri sabruka pie viena dēļ tehniskas kļudas rezultātā visi servera faili tika noformatēti :smile: tas nekas to visu esu atguvis ar speciāliem rīkiem un visi faili ir jau uz master datora .\n[br]\n[b]Fakti par visu kas notiek[/b] \nProtams mājas lapas darbības bija tieši traucēta dēļ cietā diska arējā kurs sabruka tāpec ari backup serveris bija atslēgts patlaban stradaju lai atgriezt server 1 darbībā bet pašlaik visi spēļu serveri ir atslēgti bet serveri tiks atgriezti atrī uz main backup kurš aizvietos server 2 uz doto brīdi .\n[br]\n[b]Papildināts 19:37[/b]\nKādu bridi atpakaļ serveri tikai atjauni vienīgi dod:s serveris vel nau bet ļoti drīz tiks taiskāitā tiks atjaunos css:72 uz 73 versiju .\n[br]\n[b]Papildināts 22:36[/b]\nBeidzot visi spēļu serveri ir atjaunoti un darbojas labi,Lai veiksmīgi spēlējas visiem, vienīgi terraria serveris bus izslēgts lidz vis tiks atgriezts.\n[br]\n[b]Kas tagad notiek ?[/b]\nServeris 1 tiek apstrādāts un atjaunots atpakaļ patlaban ir tehniski jāregulet un jauzstāda vajadzīgie parameteri.\nServeris 2 Nobrucis bet faili atgūti pec 48h aptuveni pieļauju iespēju visi serveri bus atpakaļ uz servera 2 un griezīsies bez problēmam.\n[b]Ir Ieslēgts Master Backup Dotaja brīdi kurš uzturs mājas lapas un serverus kuri griežas bez problēmam tikai pagaidu varijantā vis tiks atgriezts tiko vis tiks sakartots un vis ies.[/b]', 'Labdien rakstu ar sliktu un labu ziņu šonakt serveri nobruka ... tiešak cietais\nbet nu tas ir dēļ manu darbību bija nopietnas problēmas bija ar arejo cieto disku kurš nobruka un rezultāta nedarbojas kamer vinš tika labots serveri sabruka pie viena dēļ tehniskas kļudas rezultātā visi servera faili tika noformatēti :smile: tas nekas to visu esu atguvis ar speciāliem rīkiem un visi faili ir jau uz master datora .\n[br]\n[b]Fakti par visu kas notiek[/b] \nProtams mājas lapas darbības bija tieši traucēta dēļ cietā diska arējā kurs sabruka tāpec ari backup serveris bija atslēgts patlaban stradaju lai atgriezt server 1 darbībā bet pašlaik visi spēļu serveri ir atslēgti bet serveri tiks atgriezti atrī uz main backup kurš aizvietos server 2 uz doto brīdi .\n[br]\n[b]Papildināts 19:37[/b]\nKādu bridi atpakaļ serveri tikai atjauni vienīgi dod:s serveris vel nau bet ļoti drīz tiks taiskāitā tiks atjaunos css:72 uz 73 versiju .\n[br]\n[b]Papildināts 22:36[/b]\nBeidzot visi spēļu serveri ir atjaunoti un darbojas labi,Lai veiksmīgi spēlējas visiem, vienīgi terraria serveris bus izslēgts lidz vis tiks atgriezts.\n[br]\n[b]Kas tagad notiek ?[/b]\nServeris 1 tiek apstrādāts un atjaunots atpakaļ patlaban ir tehniski jāregulet un jauzstāda vajadzīgie parameteri.\nServeris 2 Nobrucis bet faili atgūti pec 48h aptuveni pieļauju iespēju visi serveri bus atpakaļ uz servera 2 un griezīsies bez problēmam.\n[b]Ir Ieslēgts Master Backup Dotaja brīdi kurš uzturs mājas lapas un serverus kuri griežas bez problēmam tikai pagaidu varijantā vis tiks atgriezts tiko vis tiks sakartots un vis ies.[/b]'),
(7, '25/08/2012', '00:07:16', 'Faks', 'News', 'Kartējā pasaka ....', '[img]http://img4.imageshack.us/img4/9483/itsalive.png[/img]', 'Labvakar cienijamie lasītāji izklausīsies smieklīgi bet nu sabojājās kontatks uz sadalītāju un visi serveri izslēdzas uz daudzām stundām es diemžel nebiju uz vietas un nevarēju konstatēt faktu bet kad konstatēju bija krieni vēls,pēc kāda laika atbrīvojos un sāku meklēt vainīgo rezultāta atradās augstāk minētais kontatks kurš nedarbojas vairs protāms tai skaitā uzsāku aktīvu profilaksi visiem sadalītājiem un tika konstatēti pārits defekti kuri tika noversti ar veco labo tehniku smilšpapīrs un skrūve :smile: rezultāta tika iztīrīti vadu savienoju uz kontaktdakšas platformu un arī apstrādāta kontaktdakša kura bija par retu brīnumu bet apsubējusi ... tas būtu sīkums bet laiks lidoja ar vēja spārniem tāpec arī aizgāja milzīgs laika apjoms.\n[br]\n[b]Kas tagad notiek ar serveriem ?[/b]\nServeris 2 drīz atsāks savu darbību:jau ir atjaunota partīcija un faili aktīvi tiek kopēti uz savā vietā :smile:.\nServeris 1 patlaban gaida savu kārtu pirms tiks kārtigi atregulēts un vis nepieciešamais uzstādīts.', 'Labvakar cienijamie lasītāji izklausīsies smieklīgi bet nu sabojājās kontatks uz sadalītāju un visi serveri izslēdzas uz daudzām stundām es diemžel nebiju uz vietas un nevarēju konstatēt faktu bet kad konstatēju bija krieni vēls,pēc kāda laika atbrīvojos un sāku meklēt vainīgo rezultāta atradās augstāk minētais kontatks kurš nedarbojas vairs protāms tai skaitā uzsāku aktīvu profilaksi visiem sadalītājiem un tika konstatēti pārits defekti kuri tika noversti ar veco labo tehniku smilšpapīrs un skrūve :smile: rezultāta tika iztīrīti vadu savienoju uz kontaktdakšas platformu un arī apstrādāta kontaktdakša kura bija par retu brīnumu bet apsubējusi ... tas būtu sīkums bet laiks lidoja ar vēja spārniem tāpec arī aizgāja milzīgs laika apjoms.\n[br]\n[b]Kas tagad notiek ar serveriem ?[/b]\nServeris 2 drīz atsāks savu darbību:jau ir atjaunota partīcija un faili aktīvi tiek kopēti uz savā vietā :smile:.\nServeris 1 patlaban gaida savu kārtu pirms tiks kārtigi atregulēts un vis nepieciešamais uzstādīts.'),
(8, '26/08/2012', '05:35:08', 'Faks', 'News', 'Progress liek par sevi zināt', '[img]http://powerofmoms.com/wp-content/uploads/2012/06/progress.jpg[/img]', 'Labrīt visiem agrajiem putniem nu tad ņemam vērsi aiz ragiem un liekam faktus pa plauktiņam ir veikta serveru atjaunošana \r\nLeft 4 Dead : 1.0.2.6 > 1.0.2.7\r\nLeft 4 Dead 2 : 2.1.0.7 > 2.1.0.8\r\nCounter-Strike Source 1.0.0.72 > 1.0.0.73\r\n[br]\r\nJa ieraugat nedarbojošos serveri nedomājiet ka viņs ir izslēgts bez iemesla bieži vien ir tīri tehniski momenti kurus nākas regulēt un labot tādā veida izveidojot stabilus serverus jebkurā gadījumā atvainojiet par sagādātajam neērtībām.', 'Labrīt visiem agrajiem putniem nu tad ņemam vērsi aiz ragiem un liekam faktus pa plauktiņam ir veikta serveru atjaunošana \r\nLeft 4 Dead : 1.0.2.6 > 1.0.2.7\r\nLeft 4 Dead 2 : 2.1.0.7 > 2.1.0.8\r\nCounter-Strike Source 1.0.0.72 > 1.0.0.73\r\n[br]\r\nJa ieraugat nedarbojošos serveri nedomājiet ka viņs ir izslēgts bez iemesla bieži vien ir tīri tehniski momenti kurus nākas regulēt un labot tādā veida izveidojot stabilus serverus jebkurā gadījumā atvainojiet par sagādātajam neērtībām.'),
(9, '01/09/2012', '10:04:30', 'Faks', 'News', 'Drusciņa Faktu Kas Notiek !', '[img]http://liliendahl.files.wordpress.com/2010/10/checklist.jpg[/img]', 'Labdien Visiem lasītājiem drošvien daudzi domā nekas nenotiek ?\nAtbilde ir negatīva jo kā sekojoš piemērs ir Left 4 Dead 2 Serveris kurš ir jau salabots un iet stabili bet tas nau īstāis iemesls kāpēc rakstu jo patiesībā man te ļoti daudz darba varam aptuveni izveidot šadu sarakstu .\n[br]\n[list=1]\n[*]Mājas lapas kodēšana.\n[*]Dizaina plānošana sadaļam,pilveindošana un protams labošana un lāpīšana :).\n[*]Spēļu Client drošvien vis populārākais jautājums jā patiešam top šadi bet lai viņus izveidot aiziet diezgan daudz laika lidz kamēr noslīpē un izveido installāciju un uzliek uz tuvākā failu izvietošanas lapas paiet laiks tāka vien gaidam.\n[*]Top arī Intro Gamer Ludus dēļ arējā cieta nobrukšanas viņs tika pazaudēts bet visi faili man vel ir tāka sāksim no gala :) .\n[/list]\n[br]\n[b]Serveris 1 atgriežas mājas lapas ir savās vietās.[/b]', 'Labdien Visiem lasītājiem drošvien daudzi domā nekas nenotiek ?\nAtbilde ir negatīva jo kā sekojoš piemērs ir Left 4 Dead 2 Serveris kurš ir jau salabots un iet stabili bet tas nau īstāis iemesls kāpēc rakstu jo patiesībā man te ļoti daudz darba varam aptuveni izveidot šadu sarakstu .\n[br]\n[list=1]\n[*]Mājas lapas kodēšana.\n[*]Dizaina plānošana sadaļam,pilveindošana un protams labošana un lāpīšana :).\n[*]Spēļu Client drošvien vis populārākais jautājums jā patiešam top šadi bet lai viņus izveidot aiziet diezgan daudz laika lidz kamēr noslīpē un izveido installāciju un uzliek uz tuvākā failu izvietošanas lapas paiet laiks tāka vien gaidam.\n[*]Top arī Intro Gamer Ludus dēļ arējā cieta nobrukšanas viņs tika pazaudēts bet visi faili man vel ir tāka sāksim no gala :) .\n[/list]\n[br]\n[b]Serveris 1 atgriežas mājas lapas ir savās vietās.[/b]'),
(10, '08/09/2012', '17:15:45', 'Faks', 'Updates', 'Serveri Atjauninati', '[img]http://powerofmoms.com/wp-content/uploads/2012/06/progress.jpg[/img]', 'Ar šodienu \nLeft 4 Dead 2 serveris darbojas ar v2.1.1.0,\nDay of Defeat Source  serveris darbojas ar v1.0.0.43 .', 'Ar šodienu \nLeft 4 Dead 2 serveris darbojas ar v2.1.1.0,\nDay of Defeat Source  serveris darbojas ar v1.0.0.43 .'),
(11, '10/09/2012', '21:53:01', 'Faks', 'News', 'Kaut kas jau notiek ...', '[img]/images/updates.png[/img]', 'Labvakar lasītāji šodien rakstu daudzu iemeslu dēļ drošvien daudzi pamanija ka serveri bija izslēgti tad atkal ieslēgti un tādā paša garā iemesls tam visam bija viens iemesls visi serveri saņēma dozu ar dažadiem labumiem :evil:\n\n[b]Lietas kas mainijās visos serveros[/b] :smile:\n[*] visi serveri saņema anti crash shell kura tika uzlabota un modificēta priekš katra servera \n[*] visi serveri saņema dāžadus moduļus un labojumus ja tiešāk afk kick,high ping kick un daudz kas cits\n[*] visi serveri saņema auto start kad serveris pārstartē tāka turpmāk nebūs ar šo jautāju nopietnas problēmas \n[*] visi serveri saņema vienreiz ilgi gaidīto statisku \n[*] visi serveri kuriem vajadzēja sourcemod saņema viņu un tai skaitā augstāk minētos labumus.\n\nP.s\nKas notiek aiz scēnas patlaban top spēļu client kuri faktiski jau ir gatavi,ari download saļa darbojas zem betas publiski vel nau pieejama bet ļoti drīz uzsāks savu darbību,neskatoties uz visu lielo darba apjomu jau ir diezgan daudz kas uztaisīts salabots un ļoti daudz kas vel būs :smile:', 'Labvakar lasītāji šodien rakstu daudzu iemeslu dēļ drošvien daudzi pamanija ka serveri bija izslēgti tad atkal ieslēgti un tādā paša garā iemesls tam visam bija viens iemesls visi serveri saņēma dozu ar dažadiem labumiem :evil:\n\n[b]Lietas kas mainijās visos serveros[/b] :smile:\n[*] visi serveri saņema anti crash shell kura tika uzlabota un modificēta priekš katra servera \n[*] visi serveri saņema dāžadus moduļus un labojumus ja tiešāk afk kick,high ping kick un daudz kas cits\n[*] visi serveri saņema auto start kad serveris pārstartē tāka turpmāk nebūs ar šo jautāju nopietnas problēmas \n[*] visi serveri saņema vienreiz ilgi gaidīto statisku \n[*] visi serveri kuriem vajadzēja sourcemod saņema viņu un tai skaitā augstāk minētos labumus.\n\nP.s\nKas notiek aiz scēnas patlaban top spēļu client kuri faktiski jau ir gatavi,ari download saļa darbojas zem betas publiski vel nau pieejama bet ļoti drīz uzsāks savu darbību,neskatoties uz visu lielo darba apjomu jau ir diezgan daudz kas uztaisīts salabots un ļoti daudz kas vel būs :smile:'),
(12, '04/11/2012', '10:48:43', 'Faks', 'News', 'Jautājumi Un Atbildes !', '[img]http://www.magnaflowreview.com/wp-content/uploads/2011/01/horsepower-exhausts.gif[/img]', 'Labrīt cienījamais lasītāj pa šim pāris dienām ir šis un tas mainijies uz labo pusi server1 un server2 tiek pārdoti tiks izveidota papild sadaļa kurā tas arī šeit uzradīsies,bet atgriežoties pie parastam mirstīgam problēmam turpmāk visi serveri dzivos uz main datora [server0] orģināli nebija paredzēts ka šadi tas vis notiks bet šim faktam ir viens labums visi serveri strādās 99% bez aizkeršanās bet tas nau vis arī mājas lapu serveris pārvācas tiešak jau lasot šo tēmu viņs jau darbosies bet tas vel nau nekas tiks labi optimizēts mysql serveris un visas citas konfigurācijas lai mājas lapa skrietu ātrāk un vairāk nebūtu nepatīkamu aizkeršanos kā līdz šim bija .\r\n[br]\r\n[b]Ja nu kādam interesē[/b] \r\nTad tagad visi serveri griezīsies uz\r\n8 kodola procesora ar\r\n16gb rama (tiek planots likt 32gb).\r\n ', 'Labrīt cienījamais lasītāj pa šim pāris dienām ir šis un tas mainijies uz labo pusi server1 un server2 tiek pārdoti tiks izveidota papild sadaļa kurā tas arī šeit uzradīsies,bet atgriežoties pie parastam mirstīgam problēmam turpmāk visi serveri dzivos uz main datora [server0] orģināli nebija paredzēts ka šadi tas vis notiks bet šim faktam ir viens labums visi serveri strādās 99% bez aizkeršanās bet tas nau vis arī mājas lapu serveris pārvācas tiešak jau lasot šo tēmu viņs jau darbosies bet tas vel nau nekas tiks labi optimizēts mysql serveris un visas citas konfigurācijas lai mājas lapa skrietu ātrāk un vairāk nebūtu nepatīkamu aizkeršanos kā līdz šim bija .\r\n[br]\r\n[b]Ja nu kādam interesē[/b] \r\nTad tagad visi serveri griezīsies uz\r\n8 kodola procesora ar\r\n16gb rama (tiek planots likt 32gb).\r\n '),
(13, '13/11/2012', '23:17:15', 'Faks', 'News', 'Šodien Download Sadaļa uzsāk savu darbību !', '[img]/images/downloading.jpg[/img]', 'Labvakar lasītāj šodien sadaļa download uzsāk savu darbību tagad var lejuplādēt sekojošus spēles klientus.[br]\nCounter-Strike: 1.6 & Condition Zero,[br]\nCounter-Strike: Source v34,[br]\nCounter-Strike Source: v73,[br]\nDay of Defeat: Source v43,[br]\nTerraria v12[br]\nPatlaban nau pieejami Left 4 Dead Un Left 4 Dead 2 spēles klienti bet tuvākajā laika jau būs pieejami kaut arī viņi ir gatavi ir grūtibas viņus izvietot lejuplādes spoguļos patlaban tiek pieņemti mēri kuri palīdzēs visu novērst neskatoties uz to visu vis iet savā gaitā .', 'Labvakar lasītāj šodien sadaļa download uzsāk savu darbību tagad var lejuplādēt sekojošus spēles klientus.[br]\nCounter-Strike: 1.6 & Condition Zero,[br]\nCounter-Strike: Source v34,[br]\nCounter-Strike Source: v73,[br]\nDay of Defeat: Source v43,[br]\nTerraria v12[br]\nPatlaban nau pieejami Left 4 Dead Un Left 4 Dead 2 spēles klienti bet tuvākajā laika jau būs pieejami kaut arī viņi ir gatavi ir grūtibas viņus izvietot lejuplādes spoguļos patlaban tiek pieņemti mēri kuri palīdzēs visu novērst neskatoties uz to visu vis iet savā gaitā .'),
(14, '18/11/2012', '05:36:37', 'Faks', 'Hardware', 'Nu kā sakās gādās ari tā', '[img]http://i.chzbgr.com/completestore/2009/1/4/128755624744926649.jpg[/img]', 'Labrīt drošvien vakar ņemos ar routeri un protams uzliku DD-WRT sākuma aizgāja tīri kārtīgi pēc ilgām mocibām viņs vienalga atteicas man stumt portus uz priekšu rezultātā uztaisiju nezināmu skaitu resetu un pārkoncofigurāciju bet tas ari nelīdzēja atteicās klausīties mani nolēmu uzlikt pēdējo build rezultātā nosprāga routeris :evilgrin: bet nu tā nau pasaules bēda protams routeris ir atdzīvināms ar pareiziem vadiem un rīkiem ja nē paņemšu jaunu isāk sakot patlaban regulēju un ņemos ar serveriem tuvākajā laika vis bus [b]ONLINE[/b]', 'Labrīt drošvien vakar ņemos ar routeri un protams uzliku DD-WRT sākuma aizgāja tīri kārtīgi pēc ilgām mocibām viņs vienalga atteicas man stumt portus uz priekšu rezultātā uztaisiju nezināmu skaitu resetu un pārkoncofigurāciju bet tas ari nelīdzēja atteicās klausīties mani nolēmu uzlikt pēdējo build rezultātā nosprāga routeris :evilgrin: bet nu tā nau pasaules bēda protams routeris ir atdzīvināms ar pareiziem vadiem un rīkiem ja nē paņemšu jaunu isāk sakot patlaban regulēju un ņemos ar serveriem tuvākajā laika vis bus [b]ONLINE[/b]'),
(15, '07/12/2012', '03:20:16', 'Faks', 'News', 'Putekļi ...', '[img]http://theittools.net/uploads/posts/2012-06/1339929550_computer.jpg[/img]', 'Sveiks lasītāj drošvien pamaniji ka mājas lapa un spēļu serveri nedarbojās iemesls ir sekojoš notika generālā putekļu tīrīšana kura nemaz nau viegla ja ņemt vērā ka datora case ir HAF X jauka kaste tikpat liela cik galds un tikpat daudz putekļu ^^ bet tas tā ar dažādām grūtībām beigās sastapos gpu un ventilators 200mm abiem iepatikās zāģēt vienam izrādijās vads ķeras a outram vienkārši vajadzēja rūpīgām iztīrit putekļu un vīs sāka darboties kā nākas tākas tehniskā apkope izzieta ^^ .', 'Sveiks lasītāj drošvien pamaniji ka mājas lapa un spēļu serveri nedarbojās iemesls ir sekojoš notika generālā putekļu tīrīšana kura nemaz nau viegla ja ņemt vērā ka datora case ir HAF X jauka kaste tikpat liela cik galds un tikpat daudz putekļu ^^ bet tas tā ar dažādām grūtībām beigās sastapos gpu un ventilators 200mm abiem iepatikās zāģēt vienam izrādijās vads ķeras a outram vienkārši vajadzēja rūpīgām iztīrit putekļu un vīs sāka darboties kā nākas tākas tehniskā apkope izzieta ^^ .'),
(16, '17/01/2013', '01:05:24', 'Faks', 'News', 'Welcome to the future son \"welcome to the war\"', '[img]http://mario.tomsk.fm/thumbs/h/130862693054549.jpg[/img]', 'Labdien visiem un jebkuram [br]apsveicu ar aizgājušiem ziemas svētkiem un jauno 2013 gadu ir daudzi sekojoši iemesli kāpēc es neesu bijis uz vietas kā tautā sakās biju aizņemts ar lielo burtu nu tad ķeramies vērsim aiz ragiem pa šo laiku visi serveri migrē uz linux pēc neliela laika uz unix lai varētu vieglāk apkalpot visus serverus tas būtu puse no stāsta beidzot ir atgriezies routeris atdzīvināts (gods be praised) tāka visi serveri pēc kāda laika atkal migrēs bet uz sava iemīļotā server 2 kurš aizvietos server 1 tai skaitā vai arī ja nē tad vietā ies VM patlaban tiek plānots ielikt drusku klāt rama patlaban uz kastes ir 4096(4gb) bet tiek planots 6144(6gb) pēctam vel 2048(2gb) kopā lai būtu vainu 6gb vai 8gb arī procesora atjauninājums tiek domats no x2 uz x4 procesoru vēlak tiek domāts ņemt 8 kodolu kasti ar 32gb vai arī ar 64gb jautājums vel nau izlemts bet tiek lemts izdevumi ir lieli bet kā jau pašam sevi cienošam projektam ceru ar visu tikt galā[br]Jo ja godīgi man jau sen ir apnikuši visi klonu projekti neskatoties uz to visu tiek plānots atvērt daudzus citus serverus tālāka nākotne vai tuvākā to laiks rādīs bet ja tā dziļāk padomāt tiek domāts būvēt Cluser serverus vai arī Grid Serverus tiekas ir apdāvinātāki māte googlē jums visu pastāstīs kas tas ir un kā tas darbojas.', 'Labdien visiem un jebkuram [br]apsveicu ar aizgājušiem ziemas svētkiem un jauno 2013 gadu ir daudzi sekojoši iemesli kāpēc es neesu bijis uz vietas kā tautā sakās biju aizņemts ar lielo burtu nu tad ķeramies vērsim aiz ragiem pa šo laiku visi serveri migrē uz linux pēc neliela laika uz unix lai varētu vieglāk apkalpot visus serverus tas būtu puse no stāsta beidzot ir atgriezies routeris atdzīvināts (gods be praised) tāka visi serveri pēc kāda laika atkal migrēs bet uz sava iemīļotā server 2 kurš aizvietos server 1 tai skaitā vai arī ja nē tad vietā ies VM patlaban tiek plānots ielikt drusku klāt rama patlaban uz kastes ir 4096(4gb) bet tiek planots 6144(6gb) pēctam vel 2048(2gb) kopā lai būtu vainu 6gb vai 8gb arī procesora atjauninājums tiek domats no x2 uz x4 procesoru vēlak tiek domāts ņemt 8 kodolu kasti ar 32gb vai arī ar 64gb jautājums vel nau izlemts bet tiek lemts izdevumi ir lieli bet kā jau pašam sevi cienošam projektam ceru ar visu tikt galā[br]Jo ja godīgi man jau sen ir apnikuši visi klonu projekti neskatoties uz to visu tiek plānots atvērt daudzus citus serverus tālāka nākotne vai tuvākā to laiks rādīs bet ja tā dziļāk padomāt tiek domāts būvēt Cluser serverus vai arī Grid Serverus tiekas ir apdāvinātāki māte googlē jums visu pastāstīs kas tas ir un kā tas darbojas.'),
(17, '22/01/2013', '20:37:22', 'Faks', 'News', 'Where Is The Love ?', '[img]/images/whereislove.jpg[/img]', 'Labvakar Cienijamais lasītāj nu tā atkal kas notiek un cik ir padarīts .[br]\nUz Linux Serveri ir noportēti gandrīz visi serveri palika vel L4D,L4D2 un tad jau visi serveri būs gatavi,patlaban statistika ir [b]atslēgta[/b] bet tiks drīz atgriezta fakts kā tāds serveri darbojas stabilāk uz linux vides kā bija paredzēts un efektīvāk izmanto resursus,par unix portēšanu var tikta pārskatīta nepieciešamība bet protams ja vis aizies būs daudz labāk un arī resursi tiks izmanto daudz optimālāk bet pacik linux ir tikai kernelis cits tāka pēc būtības vis nau tik traki kā domāju protams pārīts testus man vajadzēs lai pārliecināties kas būs labāks :smile: .[br]\n[b]Sekojoši Serveri Atjaunoti.[/b][br]\nCounter-Strike Source v73>>v75\nDay of Defeat Source v43>>v48', 'Labvakar Cienijamais lasītāj nu tā atkal kas notiek un cik ir padarīts .[br]\r\nUz Linux Serveri ir noportēti gandrīz visi serveri palika vel L4D,L4D2 un tad jau visi serveri būs gatavi,patlaban statistika ir [b]atslēgta[/b] bet tiks drīz atgriezta fakts kā tāds serveri darbojas stabilāk uz linux vides kā bija paredzēts un efektīvāk izmanto resursus,par unix portēšanu var tikta pārskatīta nepieciešamība bet protams ja vis aizies būs daudz labāk un arī resursi tiks izmanto daudz optimālāk bet pacik linux ir tikai kernelis cits tāka pēc būtības vis nau tik traki kā domāju protams pārīts testus man vajadzēs lai pārliecināties kas būs labāks :smile: .[br]\r\n[b]Sekojoši Serveri Atjaunoti.[/b][br]\r\nCounter-Strike Source v73>>v75[br]\r\nDay of Defeat Source v43>>v48[br]\r\n\r\n[img]http://4.bp.blogspot.com/_J2OJel1YhX0/TCjW6ntnKLI/AAAAAAAAAYE/X2mihAnkWjg/s1600/end.bmp[/img]'),
(18, '27/01/2013', '14:40:03', 'Faks', 'News', 'Kas ir mērķis bez iemesla ?', '[img]http://cdn.sourcefednews.com/wp-content/uploads/2012/10/I_want_to_believe_wallpaper_by_Pencilshade2-400x300.png[/img]', 'Labdien Cienījamais lasītāj rakstu sekojošu iemeslu dēļ,aiz slegtām durvīm lēnam visi serveri atrod ceļu uz jaunajām mājam [b]Game Server 1[/b] (aka ex Server2).[br]\r\nKā jau tika domāts tomer tika izvēlēts,(OS)linux,serverim dēļ dažādu priekšrocību un labā atbalsta un daudz citu labu rīku praktiskumā.[br]\r\nKā jau labā pasakā vienmēr būs kaut kas radīs problēmas dotajā brīdi saskāros ar nelielu problēmu bet ja tiešak lielu serverim ir vajadzīgs jaudīgāks procesors un tai skaitā psu,ram agrāk jau minēju bet ja precizēt visu tad tiešak [b]AMD Phenom X4 9950(socket am2+)[/b],DDR2 667 vai 800mhz(lieliski ja 800mhz) 4x2gb var arī 3x2gb vai kaut vai 2x2gb,psu 600-650w (24-pin ATX Power connector) ja ir kādām kas var uzdāvināt vai izpalīdzēt iegūt šos zvērus manās rokās būšu īpāši pateicīgs uz ilgu laiku bet vis vairāk problēmu sagadādā processors (raksta uz sia_dev@inbox.lv ar tēmu Gamer Ludus Servers 1 - Palīdzība).[br]\r\n[b]Neskatoties uz visām problēmam patlaan aptuvēnā tāme uz izdevumiem ir sekojoša cpu - 20ls,ram aptuveni 15-20ls,psu - 10ls(lietots ja jauns max 20ls)\r\nkopā iznāk dotajā brīdi līdzīgi 60ls pavisam protams tas ir rupjākais aprēķins protams var arī būt lētāk vai dārģak.[/b][br]\r\nAtgriežoties pie tēmas patlaban ir uzradušies jauni servri kuri tiek aktīvi baudīti un protams veidoti spēļu client bet ja neskatīties uz to visu darba apjomu kas darāms tad ka tuvākajā laikā tiks vis publiski pieejams līdz ar to tiek veidoti jauni drošibās mēri kuri palīdzēs serverim darboties stabili sākot ar network traffic shaping beidzot ar filtriem un daudzām citām gudrām lietām nu tad tas arī vis šodienai.\r\n\r\nP.S\r\nAr Cieņu Jūsu Sisadministrātors Faks.', 'Labdien Cienījamais lasītāj rakstu sekojošu iemeslu dēļ,aiz slegtām durvīm lēnam visi serveri atrod ceļu uz jaunajām mājam [b]Game Server 1[/b] (aka ex Server2).[br]\r\nKā jau tika domāts tomer tika izvēlēts,(OS)linux,serverim dēļ dažādu priekšrocību un labā atbalsta un daudz citu labu rīku praktiskumā.[br]\r\nKā jau labā pasakā vienmēr būs kaut kas radīs problēmas dotajā brīdi saskāros ar nelielu problēmu bet ja tiešak lielu serverim ir vajadzīgs jaudīgāks procesors un tai skaitā psu,ram agrāk jau minēju bet ja precizēt visu tad tiešak [b]AMD Phenom X4 9950(socket am2+)[/b],DDR2 667 vai 800mhz(lieliski ja 800mhz) 4x2gb var arī 3x2gb vai kaut vai 2x2gb,psu 600-650w (24-pin ATX Power connector) ja ir kādām kas var uzdāvināt vai izpalīdzēt iegūt šos zvērus manās rokās būšu īpāši pateicīgs uz ilgu laiku bet vis vairāk problēmu sagadādā processors (raksta uz sia_dev@inbox.lv ar tēmu Gamer Ludus Servers 1 - Palīdzība).[br]\r\n[b]Neskatoties uz visām problēmam patlaan aptuvēnā tāme uz izdevumiem ir sekojoša cpu - 20ls,ram aptuveni 15-20ls,psu - 10ls(lietots ja jauns max 20ls)\r\nkopā iznāk dotajā brīdi līdzīgi 60ls pavisam protams tas ir rupjākais aprēķins protams var arī būt lētāk vai dārģak.[/b][br]\r\nAtgriežoties pie tēmas patlaban ir uzradušies jauni servri kuri tiek aktīvi baudīti un protams veidoti spēļu client bet ja neskatīties uz to visu darba apjomu kas darāms tad ka tuvākajā laikā tiks vis publiski pieejams līdz ar to tiek veidoti jauni drošibās mēri kuri palīdzēs serverim darboties stabili sākot ar network traffic shaping beidzot ar filtriem un daudzām citām gudrām lietām nu tad tas arī vis šodienai.\r\n\r\nP.S\r\nAr Cieņu Jūsu Sisadministrātors Faks.'),
(19, '30/01/2013', '16:35:57', 'Faks', 'News', 'Carry on My Wayward Son', '[img]/images/chevy_impala.jpg[/img]', 'Labvakar lasītāj rakstu ar labām ziņam drīz visi serveri uzsāks savu darbību pilnvērtīgi.[br]\r\nSakot šo frāzi varu aprakstīt kas notiek kamēr jūs visu šo lasat tiek veidoti \r\nĀtru failu lejuplādes spoguļi[br]\r\nDrošibas mēri dažadi[br]\r\nSodu sistēma[br]\r\nStatistikas sistēma[br]\r\nja palūkoties uz ši saraksta var saprast ka vis top veiklā tempā protams tas nau vis bet jebkurā varijantā rada priekštatu kāds darba apjoms ir tiek plānots līdz nedēļas beigām pīlnīgi iekurbulēt visu lai darbotos bet to redzēs pēc situācijas jo dotajā brīdi.\r\n\r\n\r\n', 'Labvakar lasītāj rakstu ar labām ziņam drīz visi serveri uzsāks savu darbību pilnvērtīgi.[br]\r\nSakot šo frāzi varu aprakstīt kas notiek kamēr jūs visu šo lasat tiek veidoti \r\nĀtru failu lejuplādes spoguļi[br]\r\nDrošibas mēri dažadi[br]\r\nSodu sistēma[br]\r\nStatistikas sistēma[br]\r\nja palūkoties uz ši saraksta var saprast ka vis top veiklā tempā protams tas nau vis bet jebkurā varijantā rada priekštatu kāds darba apjoms ir tiek plānots līdz nedēļas beigām pīlnīgi iekurbulēt visu lai darbotos bet to redzēs pēc situācijas jo dotajā brīdi.\r\n\r\n\r\n'),
(20, '05/02/2013', '18:53:55', 'Faks', 'News', 'Apkopes Darbi !!!', '[img]/images/maintenance.jpg[/img]', '[b]Labdien cienijamais lasītāj šodien notiek ieplānoti apkopes darbi ši iemesla dēļ spēļu serveri būs izslēgti uz nonenoteiktu laiku.[/b]', '[b]Labdien cienijamais lasītāj šodien notiek ieplānoti apkopes darbi ši iemesla dēļ spēļu serveri būs izslēgti uz nonenoteiktu laiku.[/b]'),
(21, '08/02/2013', '23:04:56', 'Faks', 'News', 'Birds flyin\' high you know how I feel', '[img]/images/free.jpg[/img]', 'Labdien cienijamais lasītāj beidzās serveru aprūpes dienas patiesība vis bija plānots nemanāmi izdarīt bet tā neiznāca dēļ dāžādu atjaunijājumu un citu problēmu radīto skādi bet neskatoties uz to visu vis ir izdevies un darbojas labi.[br]\r\nPatlaban serveru statusi ir bojāti dēļ steam update jo notika source engine protocol maiņa no 22 uz 23 tāpec daži serveri rādas kā islēgti bet tādi viņi nau fakts kā tāds būs salabots.\r\n\r\n[b]Sekojoši Serveri Tiek Šodien Atvērti.[/b]\r\nInsurgency :: 1.0.0.0 :: gamerludus.info:27025\r\nZombie Panic! Source :: 2.4.1.0 :: gamerludus.info:27023\r\nTeam Fotress 2 :: 1.2.5.1 :: gamerludus.info:27024\r\nCounter-Strike Global Offensive :: 1.22.0.3 :: gamerludus.info:27019\r\n\r\n[b]Sekojoši Serveri Atjaunoti.[/b]\r\nCounter-Strike Source no 1.0.0.75 uz 1.0.0.76\r\nDay of Defeat Source  no 1.0.0.48 uz 1.0.0.49\r\nLeft 4 Dead  no 1.0.2.7 uz 1.0.2.8\r\nLeft 4 Dead 2  no 2.1.1.0 uz 2.1.2.0\r\n\r\nServeri Tika palaisti ar http://www.youtube.com/watch?v=oXiJh-x8DI4 :smile: pavadību .\r\n\r\nP.s\r\nJūsu Mīlošais administrators Faks', 'Labdien cienijamais lasītāj beidzās serveru aprūpes dienas patiesība vis bija plānots nemanāmi izdarīt bet tā neiznāca dēļ dāžādu atjaunijājumu un citu problēmu radīto skādi bet neskatoties uz to visu vis ir izdevies un darbojas labi.[br]\r\nPatlaban serveru statusi ir bojāti dēļ steam update jo notika source engine protocol maiņa no 22 uz 23 tāpec daži serveri rādas kā islēgti bet tādi viņi nau fakts kā tāds būs salabots.\r\n\r\n[b]Sekojoši Serveri Tiek Šodien Atvērti.[/b]\r\nInsurgency :: 1.0.0.0 :: gamerludus.info:27025\r\nZombie Panic! Source :: 2.4.1.0 :: gamerludus.info:27023\r\nTeam Fotress 2 :: 1.2.5.1 :: gamerludus.info:27024\r\nCounter-Strike Global Offensive :: 1.22.0.3 :: gamerludus.info:27019\r\n\r\n[b]Sekojoši Serveri Atjaunoti.[/b]\r\nCounter-Strike Source no 1.0.0.75 uz 1.0.0.76\r\nDay of Defeat Source  no 1.0.0.48 uz 1.0.0.49\r\nLeft 4 Dead  no 1.0.2.7 uz 1.0.2.8\r\nLeft 4 Dead 2  no 2.1.1.0 uz 2.1.2.0\r\n\r\nServeri Tika palaisti ar http://www.youtube.com/watch?v=oXiJh-x8DI4 :smile: pavadību .\r\n\r\nP.s\r\nJūsu Mīlošais administrators Faks'),
(22, '12/02/2013', '22:16:41', 'Faks', 'News', 'Zirgaspēki', '[img]/images/horsepower_bike.gif[/img]', 'Labvakar Lasītāji šodien rakstu labām ziņam ir notikušas sekojošas izmaiņas daži serveri pārdzina portus drusku savādākā kārtība tie kuri izmanto mūsu client iesaku  drusku uzgaidīt drīz tiks izlaists ielāps un vis būs kārtībā.[br]\nPar Spēļu klientiem priekš Insrugency,Team Fortress 2,Counter-Strike Global Offensive šie klienti drīz tiks izveidoti un publiskoti pēc iespējas drīzāk.[br]\nPar Zirgaspēkiem šodien bija laba diena iegādājos 4gb rama šodien tiks ielikts serveri būs offline uz kādām 10 minūtem plus mīnus tāka laiks dzīvot bet problēmam.\n[br]\n[b]Nakts Papildināts[/b]\nLabvakar visiem rakstu jo strādāju ar rama uzstādīšanu tieši tāpēc serveri nedarbojas jau labu laiku ļoti atvainojos ka tik ilgi bet tikai pēc bios update aizgāja vis rams kuram bija jāiet tiek dzīts memtest tiko vis tiks pabeigts vis atsāks savu darbību.\n[br]\n[b]Papildināts šodien[/b]\nStāsts smalkāk ieliekot jaunos ramus serveris bija reti kaščīgs vietā 6gb atpazina 5gb nācās ņemties ar ramiem izmēģināju krustām škērām nekādīgi negāja nu tad vēlāk nolēmu jātaisa bios update pēc neilga brīžā ieguvu pēdējo stabilo versiju un stūmu virsū cerībā nenobeigt mātes plati :evil: vis izgāja tīri mierīgi tad taisīju rr(restartēju) un vis šancēja tīri normāli līdz kamēr sistēmai nesākās pilnīga nokāršanas katru reizi protams baudiju bios ram ātrūmus un voltāžu itka vis kārtība pēc neilgām pardomām un mātes google aprakstiem nonācu pie secinājuma ka taisnība vajaga Clear CMOS (mātes plates batereja) un no mest bios uz standarta pēc jaunā biosa tika skaisti izdarīts visu saliku un sapraudu vietās un kurbulēju iekša vīs tīri skaisti aizgāja un visas problēmas bija garām :love: un rezultāta aizgāja 10x ilgāks laiks par tām 10 minutēm līdzīgi kādas 3 stundas bet tas nekas toties vis darbojas kā nākas :smile:.', 'Labvakar Lasītāji šodien rakstu labām ziņam ir notikušas sekojošas izmaiņas daži serveri pārdzina portus drusku savādākā kārtība tie kuri izmanto mūsu client iesaku  drusku uzgaidīt drīz tiks izlaists ielāps un vis būs kārtībā.[br]\nPar Spēļu klientiem priekš Insrugency,Team Fortress 2,Counter-Strike Global Offensive šie klienti drīz tiks izveidoti un publiskoti pēc iespējas drīzāk.[br]\nPar Zirgaspēkiem šodien bija laba diena iegādājos 4gb rama šodien tiks ielikts serveri būs offline uz kādām 10 minūtem plus mīnus tāka laiks dzīvot bet problēmam.\n[br]\n[b]Nakts Papildināts[/b]\nLabvakar visiem rakstu jo strādāju ar rama uzstādīšanu tieši tāpēc serveri nedarbojas jau labu laiku ļoti atvainojos ka tik ilgi bet tikai pēc bios update aizgāja vis rams kuram bija jāiet tiek dzīts memtest tiko vis tiks pabeigts vis atsāks savu darbību.\n[br]\n[b]Papildināts šodien[/b]\nStāsts smalkāk ieliekot jaunos ramus serveris bija reti kaščīgs vietā 6gb atpazina 5gb nācās ņemties ar ramiem izmēģināju krustām škērām nekādīgi negāja nu tad vēlāk nolēmu jātaisa bios update pēc neilga brīžā ieguvu pēdējo stabilo versiju un stūmu virsū cerībā nenobeigt mātes plati :evil: vis izgāja tīri mierīgi tad taisīju rr(restartēju) un vis šancēja tīri normāli līdz kamēr sistēmai nesākās pilnīga nokāršanas katru reizi protams baudiju bios ram ātrūmus un voltāžu itka vis kārtība pēc neilgām pardomām un mātes google aprakstiem nonācu pie secinājuma ka taisnība vajaga Clear CMOS (mātes plates batereja) un no mest bios uz standarta pēc jaunā biosa tika skaisti izdarīts visu saliku un sapraudu vietās un kurbulēju iekša vīs tīri skaisti aizgāja un visas problēmas bija garām :love: un rezultāta aizgāja 10x ilgāks laiks par tām 10 minutēm līdzīgi kādas 3 stundas bet tas nekas toties vis darbojas kā nākas :smile:.'),
(23, '16/02/2013', '19:55:40', 'Faks', 'Game Servers', ' Just one of those days, I guess ...', '[img]/images/BMS_ANOMALIES.jpg[/img]', 'Labvakar lasītāj rakstu par jautro dienu šodien cs 1.6 serveris bija nobrucis pilnīgī nekas neņema nācas radikāli iznīdēt problēmu un ar lielām piepūlem vis ir kārtībā :smile:.[br]\r\nSekojoši Serveri tiek atjaunoti\r\nTeam Fortress 2 no 1.2.5.1 uz 1.2.5.3\r\nCounter-Strike Global Offensive no 1.22.0.3 uz v1.22.2.2.\r\n\r\n\r\n', 'Labvakar lasītāj rakstu par jautro dienu šodien cs 1.6 serveris bija nobrucis pilnīgī nekas neņema nācas radikāli iznīdēt problēmu un ar lielām piepūlem vis ir kārtībā :smile:.[br]\r\nSekojoši Serveri tiek atjaunoti\r\nTeam Fortress 2 no 1.2.5.1 uz 1.2.5.3\r\nCounter-Strike Global Offensive no 1.22.0.3 uz v1.22.2.2.\r\n\r\n\r\n'),
(25, '20/02/2013', '03:49:56', 'Faks', 'News', 'Tuk Tuk Tuk ?', '[img]/images/fobthatsall.jpg[/img]', 'Labvakar visiem cienijamiem lasītājiem rakstot šinī vēlajā stundā aprakstīšu ko esu šodien apdarijis.[br]\r\nTerraria Serveris ir officiali uzstādīts uz Game-Server 1.[br]\r\nTiek vel aizvien labots TF2 Servera ghost players esošās metodes nelīdz nāksies meklēt biezāku ķerzaku :smile: gan jau tikšu galā.[br]\r\nTiek ari strādāt ar spēļu klientiem CS:GO,Insurgency drīzuma būs pieejami.', 'Labvakar visiem cienijamiem lasītājiem rakstot šinī vēlajā stundā aprakstīšu ko esu šodien apdarijis.[br]\r\nTerraria Serveris ir officiali uzstādīts uz Game-Server 1.[br]\r\nTiek vel aizvien labots TF2 Servera ghost players esošās metodes nelīdz nāksies meklēt biezāku ķerzaku :smile: gan jau tikšu galā.[br]\r\nTiek ari strādāt ar spēļu klientiem CS:GO,Insurgency drīzuma būs pieejami.'),
(24, '19/02/2013', '02:44:16', 'Faks', 'Game Servers', 'Kaut kur tepat ...', '[img]/images/updates.png[/img]', 'Labvakar cienijamais lasītāt šajā vēlajā stunda rakstu ar labām ziņam tf2 serveris saņema kārtējo dozu atjauninājuma tai skaitā tiek meklēts risinājums uz tf2 servera ghost players :evil: cerams drīz vis tiks salabots.\n[br]\n[b]Sekojoši Servers tiek atjaunots[/b]\nTeam Fortress 2 no 1.2.5.3 uz 1.2.5.4\n\n', 'Labvakar cienijamais lasītāt šajā vēlajā stunda rakstu ar labām ziņam tf2 serveris saņema kārtējo dozu atjauninājuma tai skaitā tiek meklēts risinājums uz tf2 servera ghost players :evil: cerams drīz vis tiks salabots.\n[br]\n[b]Sekojoši Servers tiek atjaunots[/b]\nTeam Fortress 2 no 1.2.5.3 uz 1.2.5.4\n\n'),
(26, '23/02/2013', '01:21:41', 'Faks', 'Game Servers', 'Kas pie joda notiek ?', '[img]/images/updates.png[/img]', 'Labvakar lasītāj šodien bija veikti dažadi darbi optimizācija mājas lapas serverim gāja labi lidz kamēr vis nobruka pēc kārtīgām nopūlem līdzigi 1h serveris atjaunoja savu darbību neskatoties uz to visu šodien notiek serveru atjaunošanas diena zemāk būs vis smalkāk aprakstīts.[br]\r\n\r\n[b]Sekojoši Serveri Atjaunoti[/b]\r\n[spoiler]\r\n[b]Papildināts 23/02/2013[/b]\r\nDay of Defeat Source no 1.0.0.49 uz 1.0.0.51\r\nLeft 4 Dead 2 no 2.1.2.0 uz 2.1.2.1\r\nCounter-Strike Global Offensive 1.22.2.2 uz 1.22.2.3\r\nTeam Fortress 2 no 1.2.5.4 uz 1.2.5.6\r\n[br]\r\n[b]Papildināts - 02/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.6 uz 1.2.5.7\r\n[br]\r\n[b]Papildināts - 06/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.7 uz 1.2.5.8\r\n[br]\r\n[b]Papildināts - 09/03/2013 - Labots 11/03/2013[/b]\r\nCounter-Strike Global Offensive no 1.22.2.3 uz [s]1.22.2.6[/s] 1.22.2.7.\r\n[br]\r\n[b]Papildināts - 15/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.8 uz 1.2.5.9\r\n[br]\r\n[b]Papildināts - 24/03/2013[/b]\r\nCounter-Strike Source no 1.0.0.76 uz 1.0.0.77\r\nTeam Fortress 2 no 1.2.5.9 uz 1.2.6.0\r\nDay of Defeat Source no 1.0.0.51 uz 1.0.0.52\r\nCounter-Strike Global Offensive no 1.22.2.7 uz 1.22.3.0\r\n[br]\r\n[b]Papildināts - 28/03/2013[/b]\r\nLeft 4 Dead 2 no 2.1.2.1 uz 2.1.2.2\r\n[br]\r\n[b]Papild Ziņas - 28/03/2013[/b]\r\nCounter-Strike Source v34 Servera darbība atjaunota (dažadu tehnisku iemeslu dēļ.\r\n[br]\r\n[b]Papildināts - 30/03/2013[/b]\r\nCounter-Strike Global Offensive no 1.22.3.0 uz 1.22.3.1\r\n[br]\r\n[b]Papildināts - 04/04/2013[/b]\r\nTeam Fortress 2 no 1.2.6.0 uz 1.2.6.3\r\nDay of Defeat Source no 1.0.0.52 uz 1.0.0.52 (build update)\r\n[br]\r\n[b]Papildināts - 21/04/2013[/b]\r\nTeam Fortress 2 no 1.2.6.3 uz 1.2.6.4\r\n\r\n[/spoiler]', 'Labvakar lasītāj šodien bija veikti dažadi darbi optimizācija mājas lapas serverim gāja labi lidz kamēr vis nobruka pēc kārtīgām nopūlem līdzigi 1h serveris atjaunoja savu darbību neskatoties uz to visu šodien notiek serveru atjaunošanas diena zemāk būs vis smalkāk aprakstīts.[br]\r\n\r\n[b]Sekojoši Serveri Atjaunoti[/b]\r\n[spoiler]\r\n[b]Papildināts 23/02/2013[/b]\r\nDay of Defeat Source no 1.0.0.49 uz 1.0.0.51\r\nLeft 4 Dead 2 no 2.1.2.0 uz 2.1.2.1\r\nCounter-Strike Global Offensive 1.22.2.2 uz 1.22.2.3\r\nTeam Fortress 2 no 1.2.5.4 uz 1.2.5.6\r\n[br]\r\n[b]Papildināts - 02/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.6 uz 1.2.5.7\r\n[br]\r\n[b]Papildināts - 06/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.7 uz 1.2.5.8\r\n[br]\r\n[b]Papildināts - 09/03/2013 - Labots 11/03/2013[/b]\r\nCounter-Strike Global Offensive no 1.22.2.3 uz [s]1.22.2.6[/s] 1.22.2.7\r\n[br]\r\n[b]Papildināts - 15/03/2013[/b]\r\nTeam Fortress 2 no 1.2.5.8 uz 1.2.5.9\r\n[br]\r\n[b]Papildināts - 24/03/2013[/b]\r\nCounter-Strike Source no 1.0.0.76 uz 1.0.0.77\r\nTeam Fortress 2 no 1.2.5.9 uz 1.2.6.0\r\nDay of Defeat Source no 1.0.0.51 uz 1.0.0.52\r\nCounter-Strike Global Offensive no 1.22.2.7 uz 1.22.3.0\r\n[br]\r\n[b]Papildināts - 28/03/2013[/b]\r\nLeft 4 Dead 2 no 2.1.2.1 uz 2.1.2.2\r\n[br]\r\n[b]Papild Ziņas - 28/03/2013[/b]\r\nCounter-Strike Source v34 Servera darbība atjaunota (dažadu tehnisku iemeslu dēļ.\r\n[br]\r\n[b]Papildināts - 30/03/2013[/b]\r\nCounter-Strike Global Offensive no 1.22.3.0 uz 1.22.3.1\r\n[br]\r\n[b]Papildināts - 04/04/2013[/b]\r\nTeam Fortress 2 no 1.2.6.0 uz 1.2.6.3\r\nDay of Defeat Source no 1.0.0.52 uz 1.0.0.52 (build update)\r\n[br]\r\n[b]Papildināts - 21/04/2013[/b]\r\nTeam Fortress 2 no 1.2.6.3 uz 1.2.6.4\r\n[/spoiler]'),
(27, '27/05/2013', '16:18:22', 'Faks', 'News', 'Kas ar projektu notiek ?', '[img]http://www.punjabigraphics.com/images/1/rest-in-peace-poem.jpg[/img]', 'Labdien visiem rakstu kas ir noticis pa šo garo laika periodu dotajā laika esu ļoti aizņems to ir ļoti smagi paskaidrot jo mans stasts ir sarežģīts bet sāksim ar to kāpēc vis ir apstājies jau tuvōjas outrais mēnesis kā esu apbērējis savu māti (Requiescat in pace) ar šo atgadijumu esu apstājies visos projektos kamēr nespēšu saņemties un doties tālāk bet dotajā brīdī es vienkārši nevaru neko darit kamēr mani sēras nau pilnīgi pametušas es ļoti atvainojos visiem par sagādātājam neērtībam un radīto vilšanos.\n\nP.s\nAtvainojos spēlētajiem un visiem citiem kās ienāk jo nedarbojas no 26 datuma 00:00 līdz šodienas trījiem dienā ar kāpeikām dēļ atrāka interneta parslēgšanas. \n', 'Labdien visiem rakstu kas ir noticis pa šo garo laika periodu dotajā laika esu ļoti aizņems to ir ļoti smagi paskaidrot jo mans stasts ir sarežģīts bet sāksim ar to kāpēc vis ir apstājies jau tuvōjas outrais mēnesis kā esu apbērējis savu māti (Requiescat in pace) ar šo atgadijumu esu apstājies visos projektos kamēr nespēšu saņemties un doties tālāk bet dotajā brīdī es vienkārši nevaru neko darit kamēr mani sēras nau pilnīgi pametušas es ļoti atvainojos visiem par sagādātājam neērtībam un radīto vilšanos.\n\nP.s\nAtvainojos spēlētajiem un visiem citiem kās ienāk jo nedarbojas no 26 datuma 00:00 līdz šodienas trījiem dienā ar kāpeikām dēļ atrāka interneta parslēgšanas. \n'),
(28, '01/07/2013', '06:31:46', 'Faks', 'News', 'Lai varētu saprast ..', '[img]http://cdn.idlehearts.com/wp-content/uploads/2012/05/Hopes-and-Dreams-are-like-teardrops.jpg[/img]', 'Labdien šeit jums raksta jūsu sērojošais admins visiem kas ir noskumuši un domājuši ka esu pazudis tā nu diemžel ir taisnība bet pēc ļoti ilgām pardomām esu spējis sevi pielikt pie darba un atjaunot serverus.', 'Labdien šeit jums raksta jūsu sērojošais admins visiem kas ir noskumuši un domājuši ka esu pazudis tā nu diemžel ir taisnība bet pēc ļoti ilgām pardomām esu spējis sevi pielikt pie darba un atjaunot serverus.'),
(29, '11/08/2013', '00:10:52', 'Faks', 'News', 'Restrukturizācija - Fāze 1', '[img]/images/updates.png[/img]', 'Labdien visiem lasītājiem rakstu par projektu kas tad ir tagad noticis patlaban ir aizvērti ciet sekojoši serveri.\r\nCounter-Strike 1.6\r\nCounter-Strike Condintion Zero\r\nLeft 4 Dead\r\nLeft 4 Dead 2\r\nInsurgency\r\nZombie Panic Source\r\nTerraria\r\n[br]\r\n[b]P.S[/b]\r\nNoslēguma vārda varu minēt sekojošus faktus projekts tiek restruktirizēts lai varētu darboties optimāli tiek iskatītās radikālas metodes lai samazināt neērtības.', 'Labdien visiem lasītājiem rakstu par projektu kas tad ir tagad noticis patlaban ir aizvērti ciet sekojoši serveri.\r\nCounter-Strike 1.6\r\nCounter-Strike Condintion Zero\r\nLeft 4 Dead\r\nLeft 4 Dead 2\r\nInsurgency\r\nZombie Panic Source\r\nTerraria\r\n[br]\r\n[b]P.S[/b]\r\nNoslēguma vārda varu minēt sekojošus faktus projekts tiek restruktirizēts lai varētu darboties optimāli tiek iskatītās radikālas metodes lai samazināt neērtības.'),
(30, '18/12/2013', '', 'Faks', 'News', 'Kas bija un nebija Pirmais Sējums', '[img]/images/south_park_we_can.jpg[/img]', 'Labvakar lasītāj kā jau redzi mājas lapa atkal darbojas bez problēmam nu tad es pastāstīšu kas notika 13/12/2013 bija patīkama diena pēc darba (naktī) pūtos zaļi un patīkami baudot anime :smile:.', 'Labvakar lasītāj kā jau redzi mājas lapa atkal darbojas bez problēmam nu tad es pastāstīšu kas notika 13/12/2013 bija patīkama diena pēc darba (naktī) pūtos zaļi un patīkami baudot anime :smile:. fakts kā tāds aizgāju uz virtuvi un te pēkšņi korķi(drošinātāji) tiek izsisti kā par retu brīnumu nekā nesaprotu kāpēc,kādēļ un kas ir pie vainas nu tad devos baudīt visur tehniku un nonācu pie datora tiko sledz iekša PSU(barokli) tiek korķi izsisti kā tautā sakas Sayonara (Japāniski atvadas) un 1000w bija pagalam nācās pasūtiju jaunu psu vairākas dienas gaidiju bet pēc aptuveni 72h gaidīšanas ir atnācis baroklis uzmodināja telefona zvans kuru nepaspēju pacelt devos pa bodēm un pēc psu  Enermax Lega G 750-MAS 80  Gold (Alus 4 paka veikalam) bija priecīgi mazai dāvanai par labu darbu nu tad es devos mājas sākas dissamble(izjaukšana) un putekļu tīrīšana aizņema diezgan laika tomēr kaste galīgi nau maza HAF X :smile: kad tas tika padarīt sāku kārtot vadus pa vietam un novācu liekos lai netraucē atbrīvoju nedaudz vietas un tad jau lēnām gatavojos Moment of The Truth Fucking Truth (iespraudu kontaktā) un vis skaisti šancēja nu tad sākās bios regulējumi uz overlock bija problēmas ar XMP profilu līdz kamēr atregulēju visu un cpu oveclock uztaisiju aizņema savu laiku kopa aizgāja pāris stundas uz visām darbībām. '),
(31, '20/12/2013', '21:52:59', 'Faks', 'News', 'Kas bija un nebija Otrais Sējums', '[img]/images/south_park_we_can.jpg[/img]', 'Labdien mans miļais lasītāj rakstu kas bijis noticis kā jau labā pasakā nemēdz būt problēmas vēlak tā ari sākas šis stāsts pēc visām problēmam mājas lapa startēja velreiz bet nu tei bija prieks sabruka mysql serveris un sabojāja db(datubāzi) nācas labot aizņema diezgan laika bet lai tas neatkārtotos tagad mysql serveris strāda uz atsevisķas vm unix sistēmas tāka tas būtū risināts šodien bija salabots vis un atregulēts bet pa ceļam bija maziņas problēmas kuras es novērsu ar lielu centību pēc noskatītas anime kā ari biju solijis tomer s2 ka beidzas nevar nenoskatīties labs rom/com bija bet tas tā atgriežoties pie tēmas vakar nakti bija serveru update visi serveri bija atjaunināti uz pēdējo versiju.\n[br]\nPēc Vārds.\nPa šo laiku projekts kārājas bet dzivs viņs ir gluži ar roku neatmetu bet dēļ darba maz laika tāka prioriātes liek par sevi zināt.\n', 'Labdien mans miļais lasītāj rakstu kas bijis noticis kā jau labā pasakā nemēdz būt problēmas vēlak tā ari sākas šis stāsts pēc visām problēmam mājas lapa startēja velreiz bet nu tei bija prieks sabruka mysql serveris un sabojāja db(datubāzi) nācas labot aizņema diezgan laika bet lai tas neatkārtotos tagad mysql serveris strāda uz atsevisķas vm unix sistēmas tāka tas būtū risināts šodien bija salabots vis un atregulēts bet pa ceļam bija maziņas problēmas kuras es novērsu ar lielu centību pēc noskatītas anime kā ari biju solijis tomer s2 ka beidzas nevar nenoskatīties labs rom/com bija bet tas tā atgriežoties pie tēmas vakar nakti bija serveru update visi serveri bija atjaunināti uz pēdējo versiju.\n[br]\nPēc Vārds.\nPa šo laiku projekts kārājas bet dzivs viņs ir gluži ar roku neatmetu bet dēļ darba maz laika tāka prioriātes liek par sevi zināt.\n');
INSERT INTO `news` (`id`, `date`, `time`, `author`, `category`, `title`, `image`, `text_short`, `text_long`) VALUES
(32, '19/02/2014', '16:26:13', 'Faks', 'Devlopment', 'Jauna Dzīve I', '[img]/images/Welcome-to-New-Life.jpg[/img]', 'Labvakar jūsu mājas lasītāj vakar 18.02.2014 bija laba diena pēc ilgiem meklējumiem es atradu labu un derīgu vps priekš serveriem un vienreiz viņu nopirku!\n[br]\nNulltais solis bija atregulet serveri un uzstātīt visu vajadzīgo programmatūru.\n[br]\nPirmais solijs bija pārvest mājas lapu un tas ari tika izdarīts kaut ari bija dažādas problemas un ķibeles lai mājas lapa darbotos kā pienākas bet tika visas problēmas atrisinātas :).\n[br]\nOtrais solis bija un tiešak ir pašu spēļu serveru pārvietošana dotaja brīdi visi serveri jau ir uzstādīti (izņemot v34) palika viņus atslīpēt un noregulēt lai darbotos stabili un bez problēmām.\n[b]Serveru Jaunā ip ir 151.236.11.15 (vecā bija 80.232.240.26)porti visi tie paši.[/b]\n[br]\nTrešais solis ir un būs mājas lapas pilnīga uzkodēšana līdz beigām to es darīšu brīva laika un kad to varēšu bet svarīgākas funkcijas tiks izveidotas un atslīpētas kā pienākas.', 'Labvakar jūsu mājas lasītāj vakar 18.02.2014 bija laba diena pēc ilgiem meklējumiem es atradu labu un derīgu vps priekš serveriem un vienreiz viņu nopirku!\n[br]\nNulltais solis bija atregulet serveri un uzstātīt visu vajadzīgo programmatūru.\n[br]\nPirmais solijs bija pārvest mājas lapu un tas ari tika izdarīts kaut ari bija dažādas problemas un ķibeles lai mājas lapa darbotos kā pienākas bet tika visas problēmas atrisinātas :).\n[br]\nOtrais solis bija un tiešak ir pašu spēļu serveru pārvietošana dotaja brīdi visi serveri jau ir uzstādīti (izņemot v34) palika viņus atslīpēt un noregulēt lai darbotos stabili un bez problēmām.\n[b]Serveru Jaunā ip ir 151.236.11.15 (vecā bija 80.232.240.26)porti visi tie paši.[/b]\n[br]\nTrešais solis ir un būs mājas lapas pilnīga uzkodēšana līdz beigām to es darīšu brīva laika un kad to varēšu bet svarīgākas funkcijas tiks izveidotas un atslīpētas kā pienākas.'),
(33, '22/02/2014', '13:03:04', 'Faks', 'Devlopment', 'Jauna Dzīve II', '[img]/images/Welcome-to-New-Life.jpg[/img]', 'Labvakar lasītāj rakstot šo zinu varu droši teikt ka galu galā ir serveri atregulēti un palaisti kaut gan v34 ļoti niķojās un negribēja iet nepakam taka paliec gudrs bet nu to pēc sirsnīgāk piepūlēm atrisinājām un vis darbojas kā pienākas :).\n\n\n[b]Kas ir un nau ...[/b]\nDotajā brīdi statistika atslēgta!\n\n\n[b]P.S[/b]\nDomāju tas ari vis pamatā faktiski gandriz vis esu izdarijis kad būs vel brīvs laiks domāju paniekoties ar pārējo visu bet kopēja bildē droši ejat splēlējāt un priecājaties :) ar cieņu Jūsu Faks.', 'Labvakar lasītāj rakstot šo zinu varu droši teikt ka galu galā ir serveri atregulēti un palaisti kaut gan v34 ļoti niķojās un negribēja iet nepakam taka paliec gudrs bet nu to pēc sirsnīgāk piepūlēm atrisinājām un vis darbojas kā pienākas :).\n\n\n[b]Kas ir un nau ...[/b]\nDotajā brīdi statistika atslēgta!\n\n\n[b]P.S[/b]\nDomāju tas ari vis pamatā faktiski gandriz vis esu izdarijis kad būs vel brīvs laiks domāju paniekoties ar pārējo visu bet kopēja bildē droši ejat splēlējāt un priecājaties :) ar cieņu Jūsu Faks.'),
(34, '08/06/2014', '10:39:20', 'Faks', 'News', 'Jauna Dzīve III Noslēgums', '[img]/images/news/deathcards.jpg[/img]', 'Labdien mans iecietīgais lasītāj rakstu šo ziņu jo biju pazudis uz vairākiem mēnešiem,pa šo laika periodu man bija daudz problemu no finansiālām lidz tehniskām problēmam un citām bet tālāk rakstot es pastāstīšu kas notika un kāpēc visas labās izmaiņas izjuka kā kāršu namiņs.\r\n[br]\r\n[b]Kas Notika ?[/b]\r\nNotika nepatīkama situācija mans pirktais (hostings) nolēma pieprasīt papild samaksas kuras mūsu kontraktā nebija atrunātas un kā saprātīgs cilvēks būdams Es uzteicu ka atsakos no viņu sniegtajiem pakalpojumiem ar to ari sākas meklēju citu vietu kur visu bāzt bet rezultātā paliku ar neko un protams mājas lapas serveris migrēja uz manu (gaming build) kurš pēc parametriem ir serveris :smile: pēc ilgām mocības bija izveidoti jauni VM kuri darbojās kadu laiku bet sākās problēmas ar processora temperatūru un nācas ar laiku atteikties  \r\nno labās domas rezultātā nācas parplānot un atkal pārmigrēt mājas lapu uz citu vietu to es protams atrisināju ar labu stabilu risinājumu un tānu esam nonākuši lidz stāsta beigām un protams gribētos teikt jā ta ir bet nē ir velviens moments serveri ari bija uzreiz aizklapēti ciet rezultāta strādāja tikai mājas ar tehniskām problēmam bet strādāja vot tādi man tie pīragi te ir.\r\n[br]\r\n[b]P.S[/b]\r\nDotaja brīdi esu ļoti aizdomīgs ka drīz izpildīsīes mums viens gadiņs un es pārdzīvoju šitādas problēmas un beigas viņam neredz beigu kaut gan tomer arī kuģis pa retam nomet enkuru tā laikam ari mans teiktais izklausās ceru ka tuvākajā laikā tiks atrisinātas visas vai vis maz daļa problēmu.\r\n[br]\r\nAr Cieņu Jūsu Administrators Faks.', 'Labdien mans iecietīgais lasītāj rakstu šo ziņu jo biju pazudis uz vairākiem mēnešiem,pa šo laika periodu man bija daudz problemu no finansiālām lidz tehniskām problēmam un citām bet tālāk rakstot es pastāstīšu kas notika un kāpēc visas labās izmaiņas izjuka kā kāršu namiņs.\r\n[br]\r\n[b]Kas Notika ?[/b]\r\nNotika nepatīkama situācija mans pirktais (hostings) nolēma pieprasīt papild samaksas kuras mūsu kontraktā nebija atrunātas un kā saprātīgs cilvēks būdams Es uzteicu ka atsakos no viņu sniegtajiem pakalpojumiem ar to ari sākas meklēju citu vietu kur visu bāzt bet rezultātā paliku ar neko un protams mājas lapas serveris migrēja uz manu (gaming build) kurš pēc parametriem ir serveris :smile: pēc ilgām mocības bija izveidoti jauni VM kuri darbojās kadu laiku bet sākās problēmas ar processora temperatūru un nācas ar laiku atteikties  \r\nno labās domas rezultātā nācas parplānot un atkal pārmigrēt mājas lapu uz citu vietu to es protams atrisināju ar labu stabilu risinājumu un tānu esam nonākuši lidz stāsta beigām un protams gribētos teikt jā ta ir bet nē ir velviens moments serveri ari bija uzreiz aizklapēti ciet rezultāta strādāja tikai mājas ar tehniskām problēmam bet strādāja vot tādi man tie pīragi te ir.\r\n[br]\r\n[b]P.S[/b]\r\nDotaja brīdi esu ļoti aizdomīgs ka drīz izpildīsīes mums viens gadiņs un es pārdzīvoju šitādas problēmas un beigas viņam neredz beigu kaut gan tomer arī kuģis pa retam nomet enkuru tā laikam ari mans teiktais izklausās ceru ka tuvākajā laikā tiks atrisinātas visas vai vis maz daļa problēmu.\r\n[br]\r\nAr Cieņu Jūsu Administrators Faks.'),
(35, '21/08/2014', '13:29:16', 'Faks', 'News', 'Vienreiz kaut kas iet uz priekšu....', '[img]/images/news/moving-on.png[/img]', 'Labdien mani mīļie lasītāji rakstu šo rakstu jo tiešam daudz kas ir noticis un esu nolēmis padalīties kas man ir uz sirds galvenais ir tas ka vienreiz esu ticis pie [b]100/100[/b](prieks izmaksāja 40 euro + hz kā ar ltc bus 50 vai 70 euro ^^ isāk sakot saldi man ari nau) līnijas un tas nozīme serveri agriežas bet te ir izmaiņas turpmāk visi serveri būs [b]Steam Legit[/b] izņemums būs v34 serveris uz kuru tas neatiecas tāka ja vēlamies spēlēt pērkam officiālo versiju un baudam spēles caur steam platformu\r\n[br]\r\n[b]Pēc Vārds[/b]\r\nDotajā brīdi esu iegūldijis diezgan prāvu naudas summu ka daudzi teiktu bet ceru ka tas attaisno visas problēmas kuras ir bijušam projektam pa šiem 2 gadiem un protams ceru ka vienreiz visi varēs izlaidēties un labi atpūsties :smile:.\r\n[br] \r\n[b]P.S[/b]\r\nAr Cieņu Jūsu Faks.\r\n', 'Labdien mani mīļie lasītāji rakstu šo rakstu jo tiešam daudz kas ir noticis un esu nolēmis padalīties kas man ir uz sirds galvenais ir tas ka vienreiz esu ticis pie [b]100/100[/b](prieks izmaksāja 40 euro + hz kā ar ltc bus 50 vai 70 euro ^^ isāk sakot saldi man ari nau) līnijas un tas nozīme serveri agriežas bet te ir izmaiņas turpmāk visi serveri būs [b]Steam Legit[/b] izņemums būs v34 serveris uz kuru tas neatiecas tāka ja vēlamies spēlēt pērkam officiālo versiju un baudam spēles caur steam platformu\r\n[br]\r\n[b]Pēc Vārds[/b]\r\nDotajā brīdi esu iegūldijis diezgan prāvu naudas summu ka daudzi teiktu bet ceru ka tas attaisno visas problēmas kuras ir bijušam projektam pa šiem 2 gadiem un protams ceru ka vienreiz visi varēs izlaidēties un labi atpūsties :smile:.\r\n[br] \r\n[b]P.S[/b]\r\nAr Cieņu Jūsu Faks.\r\n'),
(36, '07/09/2014', '10:25:41', 'Faks', 'Updates', 'Genjutsu Part I', '[img]http://33.media.tumblr.com/tumblr_mbhidtry831rb345qo1_500.gif[/img]', 'Labdien mani mīļie lasītāji kā jau jūs ievērojāt vakar visi serveri bija atslēgti bet jautājums kapēc ?\r\nAtbilde ir sekojoša Notika Tehniskā apkope,Serveriem un Serverim tika atjaunināti dāži serveri un protams arī serveris ja iedziļināties kas vel bija padarīts tad tagad visi serveri ir saņēmuši uzlabojumus un izlabotas kļūdas kas bija radītas steigā kad es viņus ieslēdzu vairāk par nedēļu atpakaļ tagad visi serveri ir atregulēti un ir izlēmts izbeigt ideju uz atbalstu v34 serveri tāka mājam ar roku un sakam Sayonara,kā konpensācija bija izviedoti divi citi serveri Counter-Strike Global Offensive un Killing Floor.\r\nTagad vēlos parunat par Killing Floor serveri ar viņu es jau karoju ap jau 2 nedēļu un domāju noregulēt nebūs iespējams bet tagad ir tomer izdevies serveri palaist stabili bez crash un vote gļukiem kuri noveda pie crash,runājot par crash ši problēma apciemoja Left 4 Dead Serveri bruka(crash) bez iemesla bet beigās spēju konstatēt kas bija pie vainas izrādijas administrācijas modļuļi pie vainas kas mani diezgan stipri sarūgtināja pēc ilgām mocībām es atradu varijantu kā visu salabot un appiet problēmas,šadi lūk man te ir gājis.\r\n[br]\r\nSvarīgas izmaiņas Servera IP Tagad ir 83.99.233.96 <<<< 80.232.240.26 vairāk nepieder serverim bye bye bija lojāla ip viegli atcereties bet visam labajam kādreiz pienāk beigas ;).\r\n\r\nPēc Vārds\r\nVakar izsita korķus kas lai to zin kapēc bet serveri bija offline ap 5 minūtēm ātri un operatīvi visu atrisināju atvainojos kuriem nobruka spēles sessija.\r\n\r\nP.S\r\nJūsu Administrātors Faks Ar Cieņu.', 'Labdien mani mīļie lasītāji kā jau jūs ievērojāt vakar visi serveri bija atslēgti bet jautājums kapēc ?\r\nAtbilde ir sekojoša Notika Tehniskā apkope,Serveriem un Serverim tika atjaunināti dāži serveri un protams arī serveris ja iedziļināties kas vel bija padarīts tad tagad visi serveri ir saņēmuši uzlabojumus un izlabotas kļūdas kas bija radītas steigā kad es viņus ieslēdzu vairāk par nedēļu atpakaļ tagad visi serveri ir atregulēti un ir izlēmts izbeigt ideju uz atbalstu v34 serveri tāka mājam ar roku un sakam Sayonara,kā konpensācija bija izviedoti divi citi serveri Counter-Strike Global Offensive un Killing Floor.\r\nTagad vēlos parunat par Killing Floor serveri ar viņu es jau karoju ap jau 2 nedēļu un domāju noregulēt nebūs iespējams bet tagad ir tomer izdevies serveri palaist stabili bez crash un vote gļukiem kuri noveda pie crash,runājot par crash ši problēma apciemoja Left 4 Dead Serveri bruka(crash) bez iemesla bet beigās spēju konstatēt kas bija pie vainas izrādijas administrācijas modļuļi pie vainas kas mani diezgan stipri sarūgtināja pēc ilgām mocībām es atradu varijantu kā visu salabot un appiet problēmas,šadi lūk man te ir gājis.\r\n[br]\r\nSvarīgas izmaiņas Servera IP Tagad ir 83.99.233.96 <<<< 80.232.240.26 vairāk nepieder serverim bye bye bija lojāla ip viegli atcereties bet visam labajam kādreiz pienāk beigas ;).\r\n\r\nPēc Vārds\r\nVakar izsita korķus kas lai to zin kapēc bet serveri bija offline ap 5 minūtēm ātri un operatīvi visu atrisināju atvainojos kuriem nobruka spēles sessija.\r\n\r\nP.S\r\nJūsu Administrātors Faks Ar Cieņu.'),
(37, '24/09/14', '18:01:20', 'Faks', 'News', 'No pain,No Game - Truth Reveal', '[img]http://2.bp.blogspot.com/-oezxqMqZ3yI/U31UFKe402I/AAAAAAAAEX8/bZHKQ3YbqVs/s1600/Log-Horizon-Anime-Review-Feature-Shiroe.png[/img]', '[B]19/09/14[/b]\nLabdien mani mīļie lasītāji vis notika 19/09/2014 vis sākas ar toka cietais disks sāka mirt nost ...\nvis izpaudās nepatīkami neko nevarēja atvērt neko nevarējai aizvert respetīvi os strāda bet fiziski vis nokaras un \nnekas nedarbojas tai paša laika vis darbojas pašos serveris isākot paradox otra problēma bija temperatūras \nprocessoram ar kurām es karoju risināju es piedzini downclock un undervolt darbojas stabili un bez īpašas starpības varbūt atrūma zudums ir ap 5% bet tas ir tā verts,atgriežoties pie tā kas notikas pēc tā visa nu tad sākas jautrā reinstall procesija kura protams nenogāja kā vajaga un vis gāja škērsām jo uz 3TB cietā uzlikt win mēdz būt nopietna problea ja vins nau MBR bet GPT rezultātā nacās izmainīt partīciju izmērus kuri aizņēma daudz laika un protams ari to darot vis nogāja dēli tad protams meklēju sava disku kolekcija veco lavo linux live cd jo biju pazaudējis savu Hiren BootCD :D un beigas atradu vienu vecu ubuntu disku kurš par retu brīnumu darbojas stabili kaut ari sākuma spurojas darboties ar nelielām piepūlēm tiku cietajiem klāt un vilku failus ārā no viena 3TB uz otru 3TB cieto :) un \nveco 1TB pārvertu par support cieto kurš vienkārši glabā kaut kādu nebūtiskus failus tieksim anime,download un etc ko var pāris minutēs sabāzt atpakaļ :),atgriežamies pie tāka failus pārmeta servera faili ari izdzīvoja bet lai dabūt darboties tā bija galvas sāpe jo izrādās jaunākais VirtualBox ir sabojāts labi ka mētājās vecais labais stable build bez gļukiem jo kad taisiju import serveru vm viņs banāli meta erroru nācas ka sakās hard way ^^ taisiju import un kopēju ārā cieto rezultātā ap 30min laikā abi vm tika atjauno ejoša stadija kaut ari web serveris drusciņ nobruka jo stavēja vecs linux kuram patīk sabrucināt interneta konfigurācija tāka tur bija jāņemas bet pats game serveris aizgāja uzreiz bez problēmam rezultātā sanāca ka 20/09/14 vakārā vis iestartēja kā es rakstiju mājas lapa jo viņa darbojas no mana telefona (Sony Xperia Z Ultra) jauka rotaļieta :) bija gļukaina dēļ screen time out bet neskatoties uz to visu kaut kādīgi tikām galā bet ar CMW vis bija no nulles jo faili bija 1TB cieta un lai izkopēt rāda ap 2-4h tas ir smieklīgi ja novilkt un atregulēt aizņema kopa ap 30min :) īsāk sakot bija jautri un nebija viegli bet kā parasti tiku galā.\n[br]\n[b]P.S[/b]\n25/09/14\nVakarā serveri bus kādu laiku offline (aptuveni no 17-19) lidz notiks neliels upgrade kad tiks pabeigts vis aizies live atkal tas ir maziņs pārsteigums visiem no manis :).\n[br]\n[b]Pēc Vārds[/b]\nRakstot šo rakstu atcērjos ka uz darbu devos neizgulējies un bija smagi bet kaut kādigi spēju izkarot visu bet es tomēr turos starpcitu skatos daudziem patīk serveri driz domāju maziņus labumus uzkrūvēt klāt vai vis būtu smukāk un ertāk starp mums visiem.', '[B]19/09/14[/b]\nLabdien mani mīļie lasītāji vis notika 19/09/2014 vis sākas ar toka cietais disks sāka mirt nost ...\nvis izpaudās nepatīkami neko nevarēja atvērt neko nevarējai aizvert respetīvi os strāda bet fiziski vis nokaras un \nnekas nedarbojas tai paša laika vis darbojas pašos serveris isākot paradox otra problēma bija temperatūras \nprocessoram ar kurām es karoju risināju es piedzini downclock un undervolt darbojas stabili un bez īpašas starpības varbūt atrūma zudums ir ap 5% bet tas ir tā verts,atgriežoties pie tā kas notikas pēc tā visa nu tad sākas jautrā reinstall procesija kura protams nenogāja kā vajaga un vis gāja škērsām jo uz 3TB cietā uzlikt win mēdz būt nopietna problea ja vins nau MBR bet GPT rezultātā nacās izmainīt partīciju izmērus kuri aizņēma daudz laika un protams ari to darot vis nogāja dēli tad protams meklēju sava disku kolekcija veco lavo linux live cd jo biju pazaudējis savu Hiren BootCD :D un beigas atradu vienu vecu ubuntu disku kurš par retu brīnumu darbojas stabili kaut ari sākuma spurojas darboties ar nelielām piepūlēm tiku cietajiem klāt un vilku failus ārā no viena 3TB uz otru 3TB cieto :) un \nveco 1TB pārvertu par support cieto kurš vienkārši glabā kaut kādu nebūtiskus failus tieksim anime,download un etc ko var pāris minutēs sabāzt atpakaļ :),atgriežamies pie tāka failus pārmeta servera faili ari izdzīvoja bet lai dabūt darboties tā bija galvas sāpe jo izrādās jaunākais VirtualBox ir sabojāts labi ka mētājās vecais labais stable build bez gļukiem jo kad taisiju import serveru vm viņs banāli meta erroru nācas ka sakās hard way ^^ taisiju import un kopēju ārā cieto rezultātā ap 30min laikā abi vm tika atjauno ejoša stadija kaut ari web serveris drusciņ nobruka jo stavēja vecs linux kuram patīk sabrucināt interneta konfigurācija tāka tur bija jāņemas bet pats game serveris aizgāja uzreiz bez problēmam rezultātā sanāca ka 20/09/14 vakārā vis iestartēja kā es rakstiju mājas lapa jo viņa darbojas no mana telefona (Sony Xperia Z Ultra) jauka rotaļieta :) bija gļukaina dēļ screen time out bet neskatoties uz to visu kaut kādīgi tikām galā bet ar CMW vis bija no nulles jo faili bija 1TB cieta un lai izkopēt rāda ap 2-4h tas ir smieklīgi ja novilkt un atregulēt aizņema kopa ap 30min :) īsāk sakot bija jautri un nebija viegli bet kā parasti tiku galā.\n[br]\n[b]P.S[/b]\n25/09/14\nVakarā serveri bus kādu laiku offline (aptuveni no 17-19) lidz notiks neliels upgrade kad tiks pabeigts vis aizies live atkal tas ir maziņs pārsteigums visiem no manis :).\n[br]\n[b]Pēc Vārds[/b]\nRakstot šo rakstu atcērjos ka uz darbu devos neizgulējies un bija smagi bet kaut kādigi spēju izkarot visu bet es tomēr turos starpcitu skatos daudziem patīk serveri driz domāju maziņus labumus uzkrūvēt klāt vai vis būtu smukāk un ertāk starp mums visiem.'),
(38, '25/09/14', '19:52:17', 'Faks', 'Network', 'After Party - I', '[img]http://www.bildites.lv/images/n9l4mtevrj23mnbcjzb0.jpg[/img]', 'Labdien mani lasītāji kā ari biju domajis notika neizbēgamais nobira intreneta settings kopš šodien neplānoti no rīta ievilku 1 Gigabita internetu problēma pirmā sayonara miļais custom made routerim ar openwrt virsū jaunais routers kavēsies līdz rītdiani kamēr veikals neatvēdits no noliktavas uz veikalu viņu grr isākot sakot ja nedarbojas serveris vai nobrūk visu ko es varu pateikt serveri darbojas rupji sakot debug režīmā jo cs:go un l4d2 vispar gandrīz negrib strādat l4d2 tiešak vispār atsakās strādāt kaut ari ir ieslēgts go figure par cs:go labāk nerunāšu bez iemesla ir crash vis drizāk nepatīk jaunie nic regulējumi bet neko darīt ciešam šis 24 stundas ar lieku un tad ceram ka vis būs aidā !!!\r\n[B]Update 26/09/14[/B]\r\nRouteri dabusu tik otradiena taka neko darit dzivojam ar glukiem...\r\n[B]Update 01/10/14[/B]\r\nRouteris vakar atbrauca,bet dēļ laika trūkuma vis jedzigi nebija noregulets bet vis sāka darboties,tāpec šodien visi serveri saņema update poti un tika vis sakārtots līdz galam tāka dodamies spēlejam pūšamies :) baudam Gigabita internetu serveros :).\r\n[B]UPDATE 04/10/14[/B]\r\nRouterim ir diemžel ar defektiem un nespēj pilnā mērā izspiest ātrumu un atvērt portus tādēļ serveros nevarēja tikt iekša šodien esu noņemis visu un atregulejis lai darbojas un ļoti atvainojos visiem kas gaidija tik ilgi lai uzspēlēt un neiznāca (dēļ darba agrāk nevarēju to izdarīt).', 'Labdien mani lasītāji kā ari biju domajis notika neizbēgamais nobira intreneta settings kopš šodien neplānoti no rīta ievilku 1 Gigabita internetu problēma pirmā sayonara miļais custom made routerim ar openwrt virsū jaunais routers kavēsies līdz rītdiani kamēr veikals neatvēdits no noliktavas uz veikalu viņu grr isākot sakot ja nedarbojas serveris vai nobrūk visu ko es varu pateikt serveri darbojas rupji sakot debug režīmā jo cs:go un l4d2 vispar gandrīz negrib strādat l4d2 tiešak vispār atsakās strādāt kaut ari ir ieslēgts go figure par cs:go labāk nerunāšu bez iemesla ir crash vis drizāk nepatīk jaunie nic regulējumi bet neko darīt ciešam šis 24 stundas ar lieku un tad ceram ka vis būs aidā !!!\r\n[B]Update 26/09/14[/B]\r\nRouteri dabusu tik otradiena taka neko darit dzivojam ar glukiem...\r\n[B]Update 01/10/14[/B]\r\nRouteris vakar atbrauca,bet dēļ laika trūkuma vis jedzigi nebija noregulets bet vis sāka darboties,tāpec šodien visi serveri saņema update poti un tika vis sakārtots līdz galam tāka dodamies spēlejam pūšamies :) baudam Gigabita internetu serveros :).\r\n[B]UPDATE 04/10/14[/B]\r\nRouterim ir diemžel ar defektiem un nespēj pilnā mērā izspiest ātrumu un atvērt portus tādēļ serveros nevarēja tikt iekša šodien esu noņemis visu un atregulejis lai darbojas un ļoti atvainojos visiem kas gaidija tik ilgi lai uzspēlēt un neiznāca (dēļ darba agrāk nevarēju to izdarīt).'),
(39, '30/12/14', '00:44:47', 'Faks', 'News', 'After Party - No Game No Life', '[img]http://img3.wikia.nocookie.net/__cb20140523121457/powerlisting/images/e/ef/Sora_No_Game_No_Life.jpg[/img]', 'Labdien miļie lasītāji šodien mēs tikamies gada beigās bieži bija piedzīvotas dažadas problēmas pēdējos mēnešos gāja smagāk bet ka sakās dzīve ne vienmer var iet perfekti bet tieši tāpec (Combate) Jācīnas un jadodas tālak mana dzīve ir daudz dažādu izmaiņu un tieši tāpec ari projekts sāks mainīties tieši tāpec Es esu sācis ar to ka serveri tiek atkal parnesti uz main pc vieta vm jo ar vm bija piedzīvoti nepatīkami piedzīvojumi otrs smagi maintain taisit tieši tāpec centīšos šo dienu laika visu serverus atdzīvinat uz main lai darbotos stabili un normali un vienreiz saņemtu (auto update visi serveri) nakošais moments ir veikt mājas lapas kodēšanu lidz galam un vienreiz lai varētu visi baudīt un priecāties jo dotajā brīdi bija izlemtas veikt izmaiņas un ari citas bija notikušas tieši tāpec šis bardaks ari notika.\r\n\r\nP.S\r\nAr Cieņu Jūsu Administrators Faks.', 'Labdien miļie lasītāji šodien mēs tikamies gada beigās bieži bija piedzīvotas dažadas problēmas pēdējos mēnešos gāja smagāk bet ka sakās dzīve ne vienmer var iet perfekti bet tieši tāpec (Combate) Jācīnas un jadodas tālak mana dzīve ir daudz dažādu izmaiņu un tieši tāpec ari projekts sāks mainīties tieši tāpec Es esu sācis ar to ka serveri tiek atkal parnesti uz main pc vieta vm jo ar vm bija piedzīvoti nepatīkami piedzīvojumi otrs smagi maintain taisit tieši tāpec centīšos šo dienu laika visu serverus atdzīvinat uz main lai darbotos stabili un normali un vienreiz saņemtu (auto update visi serveri) nakošais moments ir veikt mājas lapas kodēšanu lidz galam un vienreiz lai varētu visi baudīt un priecāties jo dotajā brīdi bija izlemtas veikt izmaiņas un ari citas bija notikušas tieši tāpec šis bardaks ari notika.\r\n\r\nP.S\r\nAr Cieņu Jūsu Administrators Faks.'),
(40, '09/07/15', '2015-07-09 11:15:50', 'Faks', 'Network', 'Par Mājas lapu.', '[img]http://sd.keepcalm-o-matic.co.uk/i/keep-calm-because-this-is-the-new-shit-2.png[/img]', 'Labdien mani mīļie lasītāji kā jau pamanijāt mums ir jauns domens vairs nelietoajs .info bet .com tuvākajā laika .info domēns pārstās darboties un turpmāk dzīvosim tikai ar,\n[b]http://gamerludus.tk[/b]\n[s]http://gamerludus.com  - Tika atņemts pēc tiesas lēmuma.[/s]\n[br]\n[b]P.S[/b]\nAtvaijojos visiem kas ilgi gaida jaunumus bet nekas netiek darīts patiesībā ļoti daudz kas notiek paralēli ēnā top v2 projektam un drīz bus daudz daudz jaunu labumu,paralēli tam ļoti aktīvi uzpasēju serverus kuri darbojas stabili bez man zināmam problēmam tiek vienmēr atjaunoti,uptime tagad ir ap 99% tāpec ļoti ceru ka visiem ir labi lai visiem veicas jūsu Administrators Ar cieņu Faks. \n[b]Update 2017[/b]', 'Labdien mani mīļie lasītāji kā jau pamanijāt mums ir jauns domens vairs nelietoajs .info bet .com tuvākajā laika .info domēns pārstās darboties un turpmāk dzīvosim tikai ar,\n[b]http://gamerludus.tk[/b]\n[s]http://gamerludus.com  - Tika atņemts pēc tiesas lēmuma.[/s]\n[br]\n[b]P.S[/b]\nAtvaijojos visiem kas ilgi gaida jaunumus bet nekas netiek darīts patiesībā ļoti daudz kas notiek paralēli ēnā top v2 projektam un drīz bus daudz daudz jaunu labumu,paralēli tam ļoti aktīvi uzpasēju serverus kuri darbojas stabili bez man zināmam problēmam tiek vienmēr atjaunoti,uptime tagad ir ap 99% tāpec ļoti ceru ka visiem ir labi lai visiem veicas jūsu Administrators Ar cieņu Faks. \n[b]Update 2017[/b]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `download_category`
--
ALTER TABLE `download_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_game`
--
ALTER TABLE `download_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_topic`
--
ALTER TABLE `download_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fortumo`
--
ALTER TABLE `fortumo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_group`
--
ALTER TABLE `forum_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_group_sub`
--
ALTER TABLE `forum_group_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_thread`
--
ALTER TABLE `forum_thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosting_about`
--
ALTER TABLE `hosting_about`
  ADD PRIMARY KEY (`hosting_about_id`);

--
-- Indexes for table `hosting_blog`
--
ALTER TABLE `hosting_blog`
  ADD PRIMARY KEY (`hosting_blog_id`);

--
-- Indexes for table `hosting_comment`
--
ALTER TABLE `hosting_comment`
  ADD PRIMARY KEY (`hosting_comment_id`);

--
-- Indexes for table `hosting_contact_us`
--
ALTER TABLE `hosting_contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `hosting_domain`
--
ALTER TABLE `hosting_domain`
  ADD PRIMARY KEY (`hosting_domain_id`);

--
-- Indexes for table `hosting_forum`
--
ALTER TABLE `hosting_forum`
  ADD PRIMARY KEY (`hosting_forum_id`);

--
-- Indexes for table `hosting_forum_group`
--
ALTER TABLE `hosting_forum_group`
  ADD PRIMARY KEY (`hosting_forum_group_id`);

--
-- Indexes for table `hosting_forum_thread`
--
ALTER TABLE `hosting_forum_thread`
  ADD PRIMARY KEY (`hosting_forum_thread_id`);

--
-- Indexes for table `hosting_ftpd`
--
ALTER TABLE `hosting_ftpd`
  ADD PRIMARY KEY (`ftpd_id`),
  ADD UNIQUE KEY `User` (`User`);

--
-- Indexes for table `hosting_maintenance`
--
ALTER TABLE `hosting_maintenance`
  ADD PRIMARY KEY (`hosting_id_maintenance`);

--
-- Indexes for table `hosting_most_online`
--
ALTER TABLE `hosting_most_online`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `hosting_news`
--
ALTER TABLE `hosting_news`
  ADD PRIMARY KEY (`hosting_id_news`);

--
-- Indexes for table `hosting_new_member`
--
ALTER TABLE `hosting_new_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosting_order_plan`
--
ALTER TABLE `hosting_order_plan`
  ADD PRIMARY KEY (`hosting_order_plan_id`);

--
-- Indexes for table `hosting_permission`
--
ALTER TABLE `hosting_permission`
  ADD PRIMARY KEY (`hosting_permission_id`);

--
-- Indexes for table `hosting_pm`
--
ALTER TABLE `hosting_pm`
  ADD PRIMARY KEY (`hosting_pm_id`);

--
-- Indexes for table `hosting_pm_outbox`
--
ALTER TABLE `hosting_pm_outbox`
  ADD PRIMARY KEY (`hosting_pm_outbox_id`);

--
-- Indexes for table `hosting_support`
--
ALTER TABLE `hosting_support`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `hosting_user`
--
ALTER TABLE `hosting_user`
  ADD PRIMARY KEY (`hosting_user_id`),
  ADD UNIQUE KEY `hosting_user_id` (`hosting_user_id`);

--
-- Indexes for table `lgsl`
--
ALTER TABLE `lgsl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT for table `download_category`
--
ALTER TABLE `download_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `download_game`
--
ALTER TABLE `download_game`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `download_topic`
--
ALTER TABLE `download_topic`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fortumo`
--
ALTER TABLE `fortumo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forum_group`
--
ALTER TABLE `forum_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forum_group_sub`
--
ALTER TABLE `forum_group_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_thread`
--
ALTER TABLE `forum_thread`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hosting_about`
--
ALTER TABLE `hosting_about`
  MODIFY `hosting_about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hosting_blog`
--
ALTER TABLE `hosting_blog`
  MODIFY `hosting_blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hosting_comment`
--
ALTER TABLE `hosting_comment`
  MODIFY `hosting_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646;
--
-- AUTO_INCREMENT for table `hosting_contact_us`
--
ALTER TABLE `hosting_contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `hosting_domain`
--
ALTER TABLE `hosting_domain`
  MODIFY `hosting_domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `hosting_forum`
--
ALTER TABLE `hosting_forum`
  MODIFY `hosting_forum_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `hosting_forum_thread`
--
ALTER TABLE `hosting_forum_thread`
  MODIFY `hosting_forum_thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `hosting_ftpd`
--
ALTER TABLE `hosting_ftpd`
  MODIFY `ftpd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `hosting_maintenance`
--
ALTER TABLE `hosting_maintenance`
  MODIFY `hosting_id_maintenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hosting_most_online`
--
ALTER TABLE `hosting_most_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;
--
-- AUTO_INCREMENT for table `hosting_news`
--
ALTER TABLE `hosting_news`
  MODIFY `hosting_id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hosting_new_member`
--
ALTER TABLE `hosting_new_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hosting_order_plan`
--
ALTER TABLE `hosting_order_plan`
  MODIFY `hosting_order_plan_id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `hosting_permission`
--
ALTER TABLE `hosting_permission`
  MODIFY `hosting_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hosting_pm`
--
ALTER TABLE `hosting_pm`
  MODIFY `hosting_pm_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `hosting_pm_outbox`
--
ALTER TABLE `hosting_pm_outbox`
  MODIFY `hosting_pm_outbox_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `hosting_support`
--
ALTER TABLE `hosting_support`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `hosting_user`
--
ALTER TABLE `hosting_user`
  MODIFY `hosting_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lgsl`
--
ALTER TABLE `lgsl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
