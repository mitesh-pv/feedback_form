<?php
      session_start();

      if($_SESSION["username"]==true){
        $user=$_SESSION["username"];
      }else{
        header('location: index.php');
      }

      require_once './local_resources/components/header.php';
      header("Location: member.php");
?>
<body style="background-color: blue ">
<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div>
<div class="sk-fading-circle">
  <div class="sk-circle1 sk-circle"></div>
  <div class="sk-circle2 sk-circle"></div>
  <div class="sk-circle3 sk-circle"></div>
  <div class="sk-circle4 sk-circle"></div>
  <div class="sk-circle5 sk-circle"></div>
  <div class="sk-circle6 sk-circle"></div>
  <div class="sk-circle7 sk-circle"></div>
  <div class="sk-circle8 sk-circle"></div>
  <div class="sk-circle9 sk-circle"></div>
  <div class="sk-circle10 sk-circle"></div>
  <div class="sk-circle11 sk-circle"></div>
  <div class="sk-circle12 sk-circle"></div>
</div>
</div>
<?php require_once './local_resources/components/footer.php';?>
