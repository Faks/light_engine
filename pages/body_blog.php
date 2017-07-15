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
			$sql = "SELECT COUNT(*) FROM hosting_blog";
			$result = mysql_query($sql);
			$r = mysql_fetch_row($result);
			$numrows = $r[0];
		
			// find out total pages
			$totalpages = ceil($numrows / $news_limit);
		
			if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))		
			{
				$page = (int)$_GET['page'];
			}
			else 
			{
				$page = 1;
			}
			// if current page is greater than total pages...
			if ($page > $totalpages) {
			   // set current page to last page
			   $page = $totalpages;
			} // end if
			// if current page is less than first page...
			if ($page < 1) {
			   // set current page to first page
			   $page = 1;
			} // end if
			
			// the offset of the list, based on current page 
			$offset = ($page - 1) * $news_limit;					
			
		$select = mysql_query("SELECT * FROM hosting_blog ORDER BY hosting_blog_publish_date desc "."limit $offset, $news_limit");
		if (mysql_num_rows($select) != 0)
		while ($row_blog = mysql_fetch_array($select))
		{
			echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <th scope='col'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <th scope='col'><a href='/?section=bgcomment&id=".$row_blog['hosting_blog_id']."'>{$lang['BODY_BLOG_COMMENT_NAME']}</a></th>
            <th scope='col'><a href='/?section=viewprofile&name={$row_blog['hosting_blog_nick']}'>{$row_blog['hosting_blog_nick']}</a> ".$row_blog['hosting_blog_publish_date']."</th>
            <th scope='col'>".$row_blog['hosting_blog_title']."</th>
          </tr>
        </table></th>
  </tr>
      <tr>
        <th scope='col'>".$row_blog['hosting_blog_text']."</th>
      </tr>
    </table><br>";
		}
		else 
		{
			echo $lang['BODY_BLOG_NOT_YET_PUBLISHED'];
		}
								/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) {
					  // if we're on current page...
					  if ($x == $page) {
						 // 'highlight' it but don't make a link
						 echo "$x ";
					  // if not current page...
					  } else {
						 // make it a link
						 echo "<a href='/?section=blog&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center>"; 
				/****** end build pagination links ******/		
		
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
			$sql = "SELECT COUNT(*) FROM hosting_blog";
			$result = mysql_query($sql);
			$r = mysql_fetch_row($result);
			$numrows = $r[0];
		
			// find out total pages
			$totalpages = ceil($numrows / $news_limit);
		
			if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))		
			{
				$page = (int)$_GET['page'];
			}
			else 
			{
				$page = 1;
			}
			// if current page is greater than total pages...
			if ($page > $totalpages) {
			   // set current page to last page
			   $page = $totalpages;
			} // end if
			// if current page is less than first page...
			if ($page < 1) {
			   // set current page to first page
			   $page = 1;
			} // end if
			
			// the offset of the list, based on current page 
			$offset = ($page - 1) * $news_limit;					
			
		$select = mysql_query("SELECT * FROM hosting_blog ORDER BY hosting_blog_publish_date desc "."limit $offset, $news_limit");
		if (mysql_num_rows($select) != 0)
		while ($row_blog = mysql_fetch_array($select))
		{
				echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>
			      <tr>
			        <th scope='col'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
			          <tr>
			            <th scope='col'><a href='/?section=bgcomment&id=".$row_blog['hosting_blog_id']."'>${lang['BODY_BLOG_COMMENT_NAME']}</a></th>
			            <th scope='col'><a href='/?section=viewprofile&name={$row_blog['hosting_blog_nick']}'>{$row_blog['hosting_blog_nick']}</a> ".$row_blog['hosting_blog_publish_date']."</th>
			            <th scope='col'>".$row_blog['hosting_blog_title']."</th>
			          </tr>
			        </table></th>
			  </tr>
			      <tr>
			        <th scope='col'>".$row_blog['hosting_blog_text']."</th>
			      </tr>
			    </table><br>";		
		}
		else 
		{
			echo $lang['BODY_BLOG_NOT_YET_PUBLISHED'];
		}
								/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) {
					  // if we're on current page...
					  if ($x == $page) {
						 // 'highlight' it but don't make a link
						 echo "$x ";
					  // if not current page...
					  } else {
						 // make it a link
						 echo "<a href='/?section=blog&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center>"; 
				/****** end build pagination links ******/		
		
	}
}

?>