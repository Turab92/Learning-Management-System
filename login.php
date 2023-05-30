<?php 
session_start();
include('include/function.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>AL-KAHF</b> Academy</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form name="login" action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="name" id="name" placeholder="UserName">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<?php 
      if (isset($_POST['login']))
			 {
				
			 $name= mysqli_real_escape_string ($conn,$_POST['name']);
			 $pass= mysqli_real_escape_string ($conn,md5($_POST['password']));
			
                 
				$sql = "SELECT * FROM portal_user WHERE USER_NAME = '$name' and user_pass ='$pass'";
						$select = mysqli_query($conn, $sql);
						//$row = mysqli_fetch_array($select);
						$count=mysqli_num_rows($select);

						if ($count == 1)
						 {

                             while ($rk=mysqli_fetch_array($select)){
                                 $userid=$rk['user_id'];
                             }
							 
                                
                                 $_SESSION['name']=$name;
                                 echo "<div class='alert alert-success'>
					           		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Logged In Sucessfully.
									</div>";
                                 echo "<script>window.open('mainmenu.php','_self')</script>";
                             
						}
						else
						{
							echo "<div class='alert alert-danger'>
					           		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Username And Password is Invalid
									</div>";
						}
			}  
            

      ?>
	
	
	

    
    <!-- /.social-auth-links -->

   
   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
