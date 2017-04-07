<?php
   	include('database/Function.php');
    $db = new Database;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry</title>
	<?php include ('include/links.php'); ?>
</head>
<body class="sharingBody">
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <img src="img/logo.png" class="logo"/>
          <h1>Food App</h1>
        </div>
      </div>
    </div>
  </header>
  <section id="sharingContent">
    <div class="container sharingContentContainer">
      <div class="row">
        <div class="col-md-12">
          <div class="sharingContent-top">
            <div class="user-datecontainerMobile">
              <span class="user-date">Apr 17, 2017</span>
              <span class="user-time">8:23 PM</span>
            </div>
            <div>
              <span class="user-img fa fa-user" ></span>
              <span class="user-name">Jan-Jan Tandayag</span>
              <span class="user-emotion">Pleasure</span>
            </div>
            <div class="user-datecontainer">
              <span class="user-date">Apr 17, 2017</span>
              <span class="user-time">8:23 PM</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row contentContainer">
        <div class="col-md-12">
          <p class="food-description">Lami kaayo ni siya</p>
          <img class="food-img" src="img/halo-halo.jpg" />
          <p class="food-name">Halo-halo</p>
          <p class="food-serving">5 cups</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="index.php" class="sharing-signInButton">Sign in</a>
        </div>
      </div>
    </div>
  </section>
</body>
</html>