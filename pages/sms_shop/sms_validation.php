<?php
    // check that the request comes from Fortumo server
    if (! in_array ( $_SERVER ['REMOTE_ADDR'], array ('81.20.151.38', '81.20.148.122', '79.125.125.1', '209.20.83.207' ) ))
    {
            header ( "HTTP/1.0 403 Forbidden" );
            die ( "Error: Unknown IP" );
    }
     
    $message 		= $_GET['message']; //
    $sender         = $_GET ['sender']; // phone num.
    $country 		= $_GET['country'];
    $price          = $_GET ['price']; //pacik pirka
    $currency		= $_GET['currency'];
    $keyword 		= $_GET['keyword'];
    $operator 		= $_GET['operator'];
    $billing_type 	= $_GET['billing_type'];
    
    //Unikala Informacija lietotjam
    $service_id     = $_GET['service_id']; //Unikalais pakalpojuma kods
    $message_id  	= $_GET['message_id'];
    $shortcode 		= $_GET['shortcode'];
                                       
    // hint: find or create payment by payment_id
    // additional parameters: operator, price,
     // user_share, country
     
    if (preg_match ( "/failed/i", $_GET ['status'] ))
    {
            echo "Please Contact Customer Support To Resolve Problem 26893153";
    }
    else
    {      
    	$mysql = mysql_connect('127.0.0.1','Faks','hakerx37');
    	$database_select = mysql_select_db('hosting');

    	
    	#Datums datums,menesis,gads
    	$date = date("Y-m-d");
    	
    	//Laiks Stundas,minutes,sekundes
    	$time = date("H:i:s");
    	
            if ($service_id == "c977884124f99d6663fa5aee2807af9f")
            {
            	$Scrolls = "200";
             	$fortumo_pay_Scrolls1 = mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$Scrolls."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
	                if (!$fortumo_pay_Scrolls1 && !$database_select or !$mysql) 
	                {
	                	$sqlite3_fortumo_pay_Scrolls1 = new SQLite3("hosting.db");
	                	$sqlite3_fortumo_pay_Scrolls1->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
	                	$sqlite3_fortumo_pay_Scrolls1->close();
	                }
            }
            elseif ($service_id == "48a0cf5b1891a69fa9bae88504358563")
            {
            	$Scrolls2 = "452";
             	$fortumo_pay_Scrolls2 =  mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$Scrolls2."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
	             	if (!$fortumo_pay_Scrolls2 && !$database_select or !$mysql)
	             	{
	             		$sqlite3_fortumo_pay_Scrolls2 = new SQLite3("hosting.db");
	             		$sqlite3_fortumo_pay_Scrolls2->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
	             		$sqlite3_fortumo_pay_Scrolls2->close();
	             	}
            }
            elseif ($service_id == "34bcf22eef28c1a6f970a174353b2c00")
            {
            	$Scrolls3 = "573";
             	$fortumo_pay_Scrolls3 =  mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$Scrolls3."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
	             	if (!$fortumo_pay_Scrolls3 && !$database_select or !$mysql)
	             	{
	             		$sqlite3_fortumo_pay_Scrolls3 = new SQLite3("hosting.db");
	             		$sqlite3_fortumo_pay_Scrolls3->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
	             		$sqlite3_fortumo_pay_Scrolls3->close();
	             	}
            }
            elseif ($service_id == "18b6b1fe50fb43393a899a3bb4bb3f6b")
            {
            	$Scrolls4 = "883";
             	$fortumo_pay_Scrolls4 =  mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$Scrolls4."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
	             	if (!$fortumo_pay_Scrolls4 && !$database_select or !$mysql)
	             	{
	             		$sqlite3_fortumo_pay_Scrolls4 = new SQLite3("hosting.db");
	             		$sqlite3_fortumo_pay_Scrolls4->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
	             		$sqlite3_fortumo_pay_Scrolls4->close();
	             	}
            }
            elseif ($service_id == "f3052aa2c4ec7d12ebbecbf8b58c37c4")
            {
            	$Scrolls5 = "1515";
             	$fortumo_pay_Scrolls5 =  mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$Scrolls5."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
	             	if (!$fortumo_pay_Scrolls5 && !$database_select or !$mysql)
	             	{
	             		$sqlite3_fortumo_pay_Scrolls5 = new SQLite3("hosting.db");
	             		$sqlite3_fortumo_pay_Scrolls5->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
	             		$sqlite3_fortumo_pay_Scrolls5->close();
	             	}
            }
            elseif ($service_id == "0bd74711da98cad60ed2980b8a169ec8")
            {
            	$tips = "tips";
            	$fortumo_pay_Scrolls5 =  mysql_query("INSERT INTO fortumo (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ('".$message."','".$date."','".$time."','".$tips."','".$sender."','".$country."','".$currency."','".$price."','".$keyword."','".$operator."','".$billing_type."','".$service_id."','".$message_id."','".$shortcode."') ");
            	if (!$fortumo_pay_Scrolls5 && !$database_select or !$mysql)
            	{
            		$sqlite3_fortumo_pay_Scrolls5 = new SQLite3("hosting.db");
            		$sqlite3_fortumo_pay_Scrolls5->query('INSERT INTO `fortumo` (username,date,time,scrolls,sender,country,currency,price,keyword,operator,billing_type,service_id,message_id,shortcode) VALUES ("'.$message.'","'.$date.'","'.$time.'","'.$Scrolls.'","'.$sender.'","'.$country.'","'.$currency.'","'.$price.'","'.$keyword.'","'.$operator.'","'.$billing_type.'","'.$service_id.'","'.$message_id.'","'.$shortcode.'") ');
            		$sqlite3_fortumo_pay_Scrolls5->close();
            	}
            }
    }
     
    // print out the reply
    echo  "Paldies Ka Iegâdâjaties "; 
    if ($service_id == "c977884124f99d6663fa5aee2807af9f") 
    {
    	echo $Scrolls;
    }
    elseif ($service_id == "48a0cf5b1891a69fa9bae88504358563")
    {
    	echo $Scrolls2;
    }
    elseif ($service_id == "34bcf22eef28c1a6f970a174353b2c00")
    {
    	echo $Scrolls3;
    }
    elseif ($service_id == "18b6b1fe50fb43393a899a3bb4bb3f6b")
    {
    	echo $Scrolls4;
    }
    elseif ($service_id == "f3052aa2c4ec7d12ebbecbf8b58c37c4")
    {
    	echo $Scrolls5;
    }
     echo " Scrolls ".$message." Par ".$price."Ls";
?>