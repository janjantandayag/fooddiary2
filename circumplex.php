<?php
   	include('database/Function.php');
    $db = new Database;
    $db->isLogin();
    if(!isset($_SESSION['detail']['mealType'])){
    	echo "<script>alert('Oops! Please select meal type first!')</script>";
    	echo "<script>window.location.href='add-entry.php'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry - How do you feel?</title>
	<?php include ('include/links.php'); ?>
</head>
<body class="mainPage">
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="left-col">
						<img src="img/logo.png">
						<h1 class="foodAppName" >Food Diary App</h1>
					</div>
					<div class="right-col">
						<ul id="topNav">
							<li><a href="archive.php"><span class="fa fa-calendar-o"></span>archive</a></li>
							<li class="navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span>add entry</a></li>	
							<li><a href="dashboard.php"><span class="fa fa-dashboard"></span>dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-question-circle"></span>help</a></li>
							<li  class="userNav"><a href="#"><span class="fa fa-user"></span> Hello, <?= $_SESSION['name'] ?></a>
                            <div class="dropdown-content">
						    	<a href="setting.php"><span class="fa fa-gear"></span>Settings</a>
						    	<a href="database/logout.php"><span class="fa fa-power-off"></span>Logout</a>
						  	</div>
							</li>
						</ul>	
					</div>
					<div>
						<a href="javascript:void(0);" onclick="myFunction();" class="icon">&#9776;</a>
                        <ul  id="mobile"  class="displayNone">
                            <li><a href="archive.php"><span class="fa fa-calendar-o"></span> archive</a></li>
                            <li  class="mobile-navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span> add entry</a>  </li>   
                            <li><a href="dashboard.php"><span class="fa fa-dashboard"></span> dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-question-circle"></span> help</a></li>
                            <li><a href="setting.php"><span class="fa fa-gear"></span> setting</a></li>
                            <li><a href="database/logout.php"><span class="fa fa-power-off"></span> <?= $_SESSION['name'] ?>, logout</a>
                            </li>
                        </ul>   
                    </div>
				</div>
			</div>
		</div>
	</header>
	<section id="breadcrumb">
		<div class="container">
			<div class="row breadcrumbContainer">
				<div class="col-md-12">
					<a href="dashboard.php" class="breadcrumb-link"><span class="fa fa-dashboard"></span> dashboard</a>
					<a href="add-entry.php"  class="breadcrumb-link"><span class="fa fa-plus-square-o"></span> add entry</a>
					<a href="#"  class="breadcrumb-link  breadcrumb-link-active">STEP 1</a>
				</div>
			</div>
		</div>
	</section>
	<div class="mainCircumplex">
		<section id="circumplexHeader">
			<div class="container circumplexHeader">
				<div class="row">
					<div class="col-md-12">
						<h2 class="circumplexHeading">How do you feel?</h2>
						<p class="circumplexHeading--helper">*Click on the square below</p>
					</div>
				</div>
			</div>
		</section>
		<section id="circumplexBody">
			<div class="container">
				<div class="row circumplexBody">
					<div class="col-md-7 ">
						<div class="circumplexModel" id="circumplexModel">			
							<div class="label top">Pumped</div>
							<div class="label left">Negative</div>
							<div class="label right">Positive</div>
							<div class="label bottom">Relaxed</div>
							<div id="marker" id="marker" class="marker"></div>
						</div>
					</div>
					<div class="col-md-5">
						<a href="food-detail.php" class="circumplex--button">Next Step</a>
					</div>
				</div>
			</div>
		</section>
	</div>
<script>
	$( '#circumplexModel' ).click( function(e)
        {

            var coordX = ( e.pageX - $( this ).offset().left - ( $( this ).width()  * 0.5 ) );
            var coordY = -( e.pageY - $( this ).offset().top  - ( $( this ).height() * 0.5 ) );

            var posX = (e.pageX - $(this).offset().left)/$(this).width()*100;
            var posY = (e.pageY - $(this).offset().top)/$(this).width()*100;
            
            mark = document.getElementById('marker');
          	mark.style.top = posY-4.5+ '%';
           	mark.style.left = posX-4.5 + '%';    

            var x = coordX.toFixed(1);
            var y = coordY.toFixed(1);	
            var angle = Math.atan2(y,x);
            var deg = angle * (180/Math.PI);
             function isNegative(degree){
	            return degree = 360 + degree;
            }
           	function borderColor(deg){
            	/*FIRST QUADRANT*/
            	if(deg < 0){
            		deg = isNegative(deg);
            	}
	            if(deg>=0 && deg <= 45){
	            	colorValue = ' #ecec1c';
	            }
	            if(deg>=46 && deg <= 90){
	            	colorValue =' #f38c25';
	            }
	            // /*SECOND QUADRANT*/
	            if(deg>=91 && deg <= 135){
	            	colorValue =' #e10823';
	            }
	            if(deg>=136 && deg <= 180){
	            	colorValue =' #d57193';
	            }
	            // /*THIRD QUADRANT*/
	            if(deg >= 181 && deg <= 224 ){
	            	colorValue =' #63519d';
	            }
	            if(deg >= 225  && deg <= 269){
	            	colorValue =' #5970b3';
	            }
	            // /*FOURTH QUADRANT*/
	            if(deg >=270 && deg <= 314){
	            	colorValue =' #138047';
	            }
	            if(deg >= 315 && deg <= 360){
	            	colorValue =' #85c435';
	            }
	            return colorValue;
            }

            borderColor = borderColor(deg);
           	mark.style.border = '10px dotted '+ borderColor;
            function degEmotion(deg){
            	/*FIRST QUADRANT*/
	            if(deg>=0 && deg <= 45){
	            	emotionId = '1';
	            }
	            if(deg>=46 && deg <= 90){
	            	emotionId = '2';
	            }
	            // /*SECOND QUADRANT*/
	            if(deg>=91 && deg <= 135){	            	
	            	emotionId = '3';
	            }
	            if(deg>=136 && deg <= 180){	            	
	            	emotionId = '4';
	            }
	            // /*THIRD QUADRANT*/
	            if(deg >= 181 && deg <= 224 ){
	            	emotionId = '5';
	            }
	            if(deg >= 225  && deg <= 269){
	            	emotionId = '6';
	            }
	            // /*FOURTH QUADRANT*/
	            if(deg >=270 && deg <= 314){
	            	emotionId = '7';
	            }
	            if(deg >= 315 && deg <= 360){
	            	emotionId = '8';
	            }
	            /*
				posX
				posY
				deg
				emotionId
	        	*/
	        	$.ajax({
					type: 'GET',
					url: 'database/script-meal-1.php?posX='+Math.round(posX)+'&posY='+Math.round(posY)+'&deg='+Math.round(deg)+'&emotionId='+emotionId
				});
            }


            function isNegative(degree){
	            return degree = 360 + degree;
            }

            function emotionName(degree){         
            	//check if negative -> convert to positive
            	if(degree < 0){
            		degree = isNegative(degree);
            	}
            	degEmotion(degree);
            }
            emotionName(Math.round(deg));
        });
</script>
</body>
</html>