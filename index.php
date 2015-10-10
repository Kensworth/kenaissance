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
    margin:0;
    padding:0;
  }

  a {
    text-decoration: none;
  }

  .title {
    text-align: center;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    color: Black;
    font-size: 3em; /*fallback*/
    font-size: 6vmin;
  }

  .About {
    text-align: center;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    color: #001F67;
    text-decoration: none;
    font-size: 2em;/*fallback*/
    font-size: 4vmin;
    /* MIN VIEWPORT SIZE IS TAKING THE TOP DOWN AT THE BEGINNING */
  }

  .parallax {
    height: 500px; 
    height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-perspective: 300px;
    perspective: 300px;
  }

  .parallax__group {
    position: relative;
    height: 500px; 
    height: 100vh;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
  }

  .parallax__layer {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .parallax__layer--fore {
    -webkit-transform: translateZ(90px) scale(.7);
    transform: translateZ(90px) scale(.7);
    z-index: 1;
  }

  .parallax__layer--base {
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    z-index: 4;
  }

  .parallax__layer--back {
    -webkit-transform: translateZ(-300px) scale(2);
    transform: translateZ(-550px) scale(3);
    z-index: 3;
  }

  .parallax__group {
    -webkit-transition: -webkit-transform 0.5s;
    transition: transform 0.5s;
  }

  body, html {
    overflow: hidden;
  }

  body {
    font: 100% / 1.5 Arvo;
  }

  #group2 {
    z-index: 3;
  }

  #group3 {
    z-index: 4;
  }

  #yahoo {
    color:#7B0099;
    border-bottom: .25rem solid #7B0099;
  }
  #spark {
    color:#008cba;
    border-bottom: .25rem solid #008cba;
  }
  #trmg {
    color:#FF6600;
    border-bottom: .25rem solid #FF6600;
  }
  #nyu {
    color:#57068c;
    border-bottom: .25rem solid #57068c;
  }
  #github {
    color:green;
    border-bottom: .25rem solid green;
  }
  #linkedin {
    color:#007bb5;
    border-bottom: .25rem solid #007bb5;
  }
  #instagram {
    color:#125688;
    border-bottom: .25rem solid #125688;
  }
  #facebook {
    color:#3b5998;
    border-bottom: .25rem solid #3b5998;
  }
  #securityoverride {
    color:black;
    border-bottom: .25rem solid black;
  }
  .email a {
    color: #001F67;
    text-decoration: none;
    border-bottom: .25rem solid #001F67;
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
  <div class="parallax">
    <div id="group2" class="parallax__group">
      <div class="parallax__layer parallax__layer--base">
      </div>
      <div class="parallax__layer parallax__layer--back">
        <div class="title"><strong>Kenneth Zhang</strong></div>
      </div>
    </div>
    <div id="group3" class="parallax__group">
      <div class="parallax__layer parallax__layer--fore">
        <div class="About">
          <!-- design inspired by graham hicks -->
            <p>
            Developer with experience at <a href = "https://www.yahoo.com"><span id = "yahoo">Yahoo</span></a>, <a href = "http://www.thesparkapp.com/"><span id = "spark">Spark</span></a>, and <a href = "http://www.therealmacgenius.com/"><span id = "trmg">TRMG</span></a>. Pursuing a dual degree in Computer Science and Economics from <a href = "https://www.nyu.edu"><span id = "nyu">New York University.</span></a>
            </p><br />
            <p>
            Networks: <a href = "https://github.com/Kensworth"><span id = "github">GitHub</span>, </a><a href = "https://www.linkedin.com/in/kennethzhang1"><span id = "linkedin">LinkedIn</span>, </a><a href = "https://instagram.com/kennaisance/"><span id = "instagram">Instagram</span>, </a><a href = "https://www.facebook.com/KennethZhang95"><span id = "facebook">Facebook</span>, </a><a href = "http://securityoverride.org/profile.php?lookup=19693"><span id = "securityoverride">SecurityOverride</span></a> </p><br />
          <div class = "email">
            Contact: <a href="mailto:kennethzhang@yahoo.com"> kenneth.zhang@nyu.edu</a> 
          </div>
        </div>
      </div>
      <div class="parallax__layer parallax__layer--base">
        <!--<img src = "http://i.imgur.com/Burv9vn.gif" height = "100%" width = "100%" id = "forest"/> -->
      </div>
    </div>
  </div>
</body>
</html>