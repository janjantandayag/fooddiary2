<?php
   	include('database/Function.php');
    $db = new Database;
    $db->isLogin();    
    if(!isset($_SESSION['detail']['emotionId'])){
    	echo "<script>alert('Oops! Please select meal type first!')</script>";
    	echo "<script>window.location.href='add-entry.php'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry - Food Detail</title>
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
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span>steps</a></li>
							<li  class="userNav"><a href="#"><span class="fa fa-user"></span> Hello, <?= $_SESSION['name'] ?></a>
                            <div class="dropdown-content">
						    	<a href="setting.php"><span class="fa fa-gear"></span>settings</a>
						    	<a href="database/logout.php"><span class="fa fa-power-off"></span>logout</a>
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
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span> steps</a></li>
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
					<a href="circumplex.php"  class="breadcrumb-link">STEP 1</a>
					<a href="#"  class="breadcrumb-link  breadcrumb-link-active">STEP 2</a>
					<a href="#" id="help-circumplex" data-toggle="modal" title="Click for further info" data-target="#myModal"><span class="fa fa-question-circle"></span></a>
				</div>
			</div>
		</div>
	</section>
	<div class="mainPageFoodDetail">
		<div class="mainPageFoodDetailContainer">
			<div class="container foodDetailContainer">
				<div class="row">
					<div class="col-md-4 col-sm-5 uploadPhoto">	
						<form action='food-detail.php' method="POST" enctype="multipart/form-data">
							<h1 class="uploadPhotoHeader">Upload Photo</h1>
							<div class="degree90">
								<label for="file-photo-90" class="custom-file-take">
								    <i class="fa fa-cloud-upload"></i> Select Photo
								</label>
								<input type="file" id="file-photo-90" name="deg90" accept="image/*" capture="camera" onchange="document.getElementById('deg90').src = window.URL.createObjectURL(this.files[0])" >
								<div class="imgContainer">
									<img src="img/icon-img.png" id="deg90"  class="imgPreview" />
								</div>
							</div>
					</div>
					<div class="col-md-8 col-sm-7 foodDetails">						
						<h1 class="foodDetailsHeader">Details</h1>
						<div class="formContainer">							
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
									    	<label for="foodName" class="labelFood">Food Name</label>
									    	<input type="text" class="form-control" id="foodName" name="foodName" required>
									  	</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
									    	<label for="servingSize" class="labelFood">Serving Size</label>
									    	<input type="text" class="form-control" id="servingSize" name="servingSize" required>
									  	</div>
									</div>
								</div>
							  	<div class="form-group">
							    	<label for="description" class="labelFood">Description</label>
							    	<textarea class="form-control" id="description" name="description" required></textarea>
							  	</div>
							  	<div class="form-group">
									<label for="servingSize" class="labelFood">Time Eaten</label>
									<p style="font-family: novaThin;color:#8a8989;font-weight: bold;margin-bottom: 4px;font-style: italic">Default time is the current time</p>
									<input type='time' class='form-control' name='time' value="<?php echo date('H:i'); ?>" required />
							  	</div>
							  	<input type="submit" name="addDiary" class="detailSubmit" value="Add to Diary" />
						 	</form>
							<?php
								if(isset($_POST['addDiary'])){
									if($_FILES['deg90']['size'] == 0){
										echo "<script>alert('Image is required!');</script>";
									}
									else{
										$img90 = $_FILES["deg90"]["tmp_name"];
										$_SESSION['time'] = $_POST['time'];
										$_SESSION['item']['name'] = strtolower($_POST['foodName']);
										$_SESSION['item']['serving'] = strtolower($_POST['servingSize']);
										$_SESSION['item']['description'] = strtolower($_POST['description']);
										$_SESSION['item']['photo'] =  file_get_contents($img90);
										if (!array_key_exists('entry', $_SESSION['detail'])){
											$_SESSION['detail']['entry'] = [];
										}									
										array_push($_SESSION['detail']['entry'], $_SESSION['item']);
										$_SESSION['item'] = [];
										echo "<script>window.location.href='entry-list.php';</script>";
									}
								}
							?>						 	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" id="helpCircumplexdialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Process</h4>
	      </div>
	      <div class="modal-body">
	      	<video width="100%" controls>
			  <source src="video/food-detail.mp4" type="video/mp4">
			  <source src="video/food-detail.mp4" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>