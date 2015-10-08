<!DOCTYPE html>
<!-- 2015 kenneth zhang -->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<style>
  .email a {
    color: #001F66;
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
    font-size: 6vmin;
    text-shadow: -.5px 0 black, 0 .5px black, .5px 0 black, 0 -.5px black;
  }

  .About {
    text-align: center;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    color: #001F66;
    text-decoration: none;
    font-size: 4vmin;
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
    transform: translateZ(-600px) scale(3);
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

  * {
    margin:0;
    padding:0;
  }

  .parallax {
    font-size: 200%;
  }

  #group2 {
    z-index: 3;
  }

  #group2 .parallax__layer--back {
    background: #FFFFFF;
  }

  #group3 {
    z-index: 4;
  }

  #group3 .parallax__layer--base {
    /*background: black;*/
  }
</style>
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
          <p>
            Developer with experience at Yahoo, Spark, and TRMG. Pursuing a dual degree in Computer Science and Economics from New York University.</p> <br />
          <p class = "email">
            Email:<a href="mailto:kennethzhang@yahoo.com"> kenneth.zhang@nyu.edu</a> 
          </p>
        </div>
      </div>
      <div class="parallax__layer parallax__layer--base">
        <!--<img src = "http://i.imgur.com/Burv9vn.gif" height = "100%" width = "100%" id = "forest"/> -->
      </div>
    </div>
  </div>
</body>
</html>