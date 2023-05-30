<!DOCTYPE html>
<html lang="en" class="no-js">


<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Easy Mail</title>
    <meta name="author" content="Reverie Tech" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

</head>

<body>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="login.php">Easy Mail</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="add_email.php">Add Email</a>
                    </li>
                    <li>
                        <a href="add_cat.php">Add Category</a>
                    </li>
                    <li>
                        <a href="add_info.php">Add Information</a>
                    </li>
                    <li>
                        <a href="comp_mail.php">Compose Mail</a>
                    </li>
                    <li>
                        <a href="log.php">Email log</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-user"></i> <strong class="caret"></strong>&nbsp;</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Logout</a></li>
                                </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
        </div>
        <!-- /.container -->
    </nav>
    <br><br>
<header>
	<h1> EASY MAIL<small>V 1.0</small></h1>
</header>

<h3> <center> Welcome To EASY MAIL</center></h3>

<div class="container">
	
	<div class="col-md-offset-3 col-md-6" style="margin-top:130px;">

     <div class="panel panel-primary">
      <div class="panel-heading"> <center><h4>Add Your List</h4> </center></div>
      <div class="panel-body">
      	<form role="form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
        <label>Upload csv File</label>
        <input type="file" name="file" id="BSbtninfo">
    </div>
  <div class="form-group">
    <label for="pwd">List Name:</label>
    <input type="text" name="list_name" class="form-control" id="pwd">
  </div>
  
  <button type="submit" name="import" class="btn btn-primary col-md-offset-3 col-md-6">Add</button>
</form>
<script>
      $('#BSbtndanger').filestyle({
        buttonName : 'btn-danger',
                buttonText : ' File selection'
      });
      $('#BSbtnsuccess').filestyle({
        buttonName : 'btn-success',
                buttonText : ' Open'
      });
      $('#BSbtninfo').filestyle({
        buttonName : 'btn-primary',
                buttonText : ' Select a File'
      });                        
</script>
      </div>
    </div>
    </div>
    
</div>

<footer style="margin-top:230px;">
  <p>© 2016 Profile Login Form. All Rights Reserved | Design & Developed By  <a href="http://realcoresolutions.com/" target="_blank" style="color:#000000;">Realcore Solutions</a></p>

</footer>

</body>

</html>
<?php 
if(isset($_POST["import"]))
{
    
    
     $conn = mysqli_connect('localhost', 'root', '', 'db_lms');
    //mysqli_select_db($conn) or die (mysql_error());
    $filename=$_FILES['file']["tmp_name"];
    if($_FILES['file']["size"] > 0)
    {
       $file = fopen($filename, "r");
      //$sql_data = "SELECT * FROM prod_list_1 ";
      $list=$_POST['list_name'];

      $count = 0;                                         // add this line
      while (($emapData = fgetcsv($file, 30000, ",")) !== FALSE)
      {
          //print_r($emapData);
          //exit();
          $count++;                                      // add this line
		  
			//$old_date = date($emapData[13]);            // works
			$middle = strtotime($emapData[0]);             // returns bool(false)
			$mysqldate1 = date('Y-m-d', $middle);
		  
			
			
          if($count>1){                                  // add this line
            $sql = "INSERT INTO `student_fee_receiving`(`transaction_date`, `activity_branch`, `DIB_ref_no`, `payment_type`, `GRNO`, `Dr_Cr`, `PKR_Amount`) VALUES  ('$mysqldate1','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]')";
            mysqli_query($conn,$sql);
          }                                              // add this line
		 
      }
	  
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>
