<!DOCTYPE html>
<!-- 2015 kenneth zhang -->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
  * {
    font-family: 'Arvo', sans-serif;
    margin: 0;
    text-decoration: none;
  }
  a:link    {color:white;}  
  a:visited {color:white;}  
  a:hover   {color:gray;} 
  a:active  {color:#000;}
  #updateClock {
    top: 9%;
    left: 50%;
    font-size: 20px;
    margin-left:-120px;
    text-align: center;
    position: absolute;
  }
  #rss {
    z-index: 100;
    position: absolute;
    left: 50%;
    top: 12%;
    margin-left: -550px;
  }
</style>
<script>
$(document).ready(function() {
  $(".parallax").animate({
      scrollTop: $(document).height()
    }, 1000);
  return false;
});
</script>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-61805851-1', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
</head>
<body>
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
    var dayarray = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    var montharray = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
    
    //Ugliest code block ever, will clean up later.
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
    <script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "https://news.ycombinator.com/rss",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "Verdana, Arial",rssmikle_font_size: "14",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>
    
    <script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://feeds.feedburner.com/TechCrunch/",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "Verdana, Arial",rssmikle_font_size: "14",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

    <script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://codinghorror.com",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "Verdana, Arial",rssmikle_font_size: "14",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>

    <script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://xkcd.com/rss.xml",rssmikle_frame_width: "110%",rssmikle_frame_height: "500",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "Verdana, Arial",rssmikle_font_size: "14",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "off",scrolldirection: "up",scrollstep: "3",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#000000",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "150",rssmikle_item_title_color: "#000000",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "750",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:1000px;"></div><br/>
  </div>
</body>
</html>