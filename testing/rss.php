<?php
	session_start();
	require('modules/connection.php');
	require('modules/errors.php');
	//username and password authentication
	require('password.php');
	$query = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";

	if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
		if($result = mysqli_query($connection, $query)) {
			//successful query
			if($row = mysqli_fetch_assoc($result)) {
				if($_SESSION['username'] === $row['username'] && $_SESSION['password'] === $row['password']) {
		        	//welcome, admin. 
		        	if($_SESSION['rememberme'] === "set") {
		        		//cookie set
						setcookie('username', $_SESSION['username'], time() + (60*60*24*7), "/");
				   		setcookie('password', $_SESSION['password'], time() + (60*60*24*7), "/");
					}
					else {
						//no cookie set
						setcookie('username', false, false, "/");
					    setcookie('password', false, false, "/");
					}
		    	}
		    	else {
		    		//wrong sessions
		    		session_destroy();
					echo "<script>location.href='login.php';</script>";
				}
			}
			else {
				session_destroy();
				echo "<script>location.href='login.php';</script>";
			}
		}
		else {
			session_destroy();
			echo "<script>location.href='login.php';</script>";
		}
    }
	else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		if($result = mysqli_query($connection, $query)) {
			//successful query
			if($row = mysqli_fetch_assoc($result)) {
				if($_COOKIE['username'] === $row['username'] && $_COOKIE['password'] === $row['password']) {
		        	//welcome, admin. 
		    	}
		    	else {
		    		//wrong sessions
		    		session_destroy();
					echo "<script>location.href='login.php';</script>";
				}
			}
			else {
				session_destroy();
				echo "<script>location.href='login.php';</script>";
			}
		}
		else {
			session_destroy();
			echo "<script>location.href='login.php';</script>";
		}
	} 
	else {
		//cookies partially or not set
		session_destroy();
		echo "<script>location.href='login.php';</script>";
	}
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 2015 kenneth zhang -->
<html>
<head>
<title>PHP/MySQL/Apache Testing</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<style>	
	* {
		font-family: 'Open Sans', sans-serif;
		margin: 0;
		text-decoration: none;
	}
	#cubicSpace {
		position: absolute;
		z-index: 0;
		min-height: 100%;
		min-width: 1024px;
			
		/* set up proportionate scaling */
		width: 100%;
		height: auto;
			
		/* set up positioning */
		position: fixed;
		top: 0;
		left: 0;
	}
	.links {
		color: white;
		z-index: 100;
		font-size: 10px;
		position: absolute;
		text-align: left;
    	top: 0%;
    	left:0%;
    	background-color: black;
    	opacity: 0.8;
    	border-radius: 3px;
    	padding: 9px;
    	display:inline-block;
	}
	a:link    {color:white;}  
	a:visited {color:white;}  
	a:hover   {color:gray;} 
	a:active  {color:#000;}
	.forms {
		position:absolute;
		top: 9%;
		left: 50%;
		margin-left: -110px;
		color: white;
		z-index: 100;
		font-size: 20px;
    	background-color: black;
    	opacity: 0.8;
    	border-radius: 5px;
    	padding: 10px;
    	display:inline-block;
	}
	#updateClock {
		position:absolute;
		top: 16.5%;
		left: 50%;
		margin-left: -150px;
		z-index: 100;
	}
	#rss {
		z-index: 100;
		position: absolute;
		left: 50%;
    	top: 20%;
    	margin-left: -550px;
	}
</style>
</head>
<body>
	<img src = "../images/cubicSpace.jpg"  id = "cubicSpace" />
	<div class = "links">
		<a href = "http://www.lichess.org">Chess&nbsp</a>|
		<a href = "http://www.youtube.com">YouTube&nbsp</a>|
		<a href = "http://www.facebook.com">Facebook&nbsp</a>|
		<a href = "http://www.reddit.com">Reddit&nbsp</a>|
		<a href = "http://www.reddit.com/r/weightlifting">/r/WL</a>
	</div>
	<div class = "forms">
		Welcome.
	</div>
	<div id = "updateClock">
		<script>
		//clock
		var mydate = new Date();
		var hours = mydate.getHours();
		var minutes = mydate.getMinutes();

		var year = mydate.getYear()
		if (year < 1000)
		year += 1900
		var day = mydate.getDay()
		var month = mydate.getMonth()
		var daym = mydate.getDate()
		if (daym < 10)
		daym = "0" + daym
		var dayarray = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
		var montharray = new Array("January","February","March","April","May","June","July","August","September","October","November","December")
		if(hours > 12) {
			if(minutes >= 10) {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +(hours - 12)+":"+minutes+"pm "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
			else {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +(hours - 12)+":0"+minutes+"pm "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
		}
		else if(hours == 12) {
			if(minutes >= 10) {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +hours+":"+minutes+"pm "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
			else {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +hours+":0"+minutes+"pm "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
		}
		else if(hours == 0) {
			if(minutes >= 10) {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +(hours+12)+":"+minutes+"am "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
			else {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +(hours+12)+":0"+minutes+"am "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
		}
		else {
			if(minutes >= 10) {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +hours+":"+minutes+"am "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
			else {
			document.write("<small><font color='000000' face='Arial'><b>"+"Last Updated " +hours+":0"+minutes+"am "+ dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>");
			}
		}
		
		</script>
	</div>
	<div id = "rss">
		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://feeds.feedburner.com/TechCrunch/",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://www.businessinsider.com/category/rss-feed",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://codinghorror.com",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://feeds.feedburner.com/allthingsgym",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://www.chess.com/rss/news",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

		<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://xkcd.com/rss.xml",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "'Trebuchet MS', Verdana, Arial",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>
	</div>
</body>
</html>