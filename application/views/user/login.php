<?php
    $abc = $this->session->userdata('nama');
    if(!(empty($abc))){
      header("Location: admin");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/login/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>assets/login/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/login/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/login/assets/css/style-responsive.css" rel="stylesheet">

    </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
	  		<?php if (isset($error)) {
          echo '<div class="alert alert-danger waduh">
          <strong>Waduh!</strong> '.$error.'
          </div>';
        } ?>
		      <form class="form-login" action="<?php echo base_url('Home/do_login');?>" method="post">
		        <h2 class="form-login-heading">login now</h2>
		        <div class="login-wrap">

		            <input type="text" class="form-control" name="username" placeholder="username" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
	
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> LOGIN</button>
		            <br>
		            <h5> <a href="<?php echo base_url('Home/signup')?>"> I have no account!  Click Here to register!</a> <h5>
		
		        </div>
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="?php echo base_url(); ?>assets/login/assets/js/jquery.js"></script>
    <script src="?php echo base_url(); ?>assets/login/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
