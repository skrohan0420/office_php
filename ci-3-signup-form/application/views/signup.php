<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>User Registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<style>
		body{
			padding: 140px 160px 140px 160px
		}
	</style>

</head>
<body>
	<div class="signup-form">
		<?php echo form_open('Signup',['name'=>'userregistration','autocomplete'=>'off']);?>
		<div class="form-group">
			<div class="row">
				<div class="col">
					<?php echo form_input([
						'name'=>'firstname',
						'class'=>'form-control',
						'placeholder'=>'Enter First Name'
					]);?>
				</div>
				<div class="col">
					<?php echo form_input([
						'name'=>'lastname',
						'class'=>'form-control',
						'placeholder'=>'Enter Last Name'
					]);?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_input([
				'name'=>'emailid',
				'class'=>'form-control',
				'placeholder'=>'Enter your Email id'
			]);?>
		</div>

		<div class="form-group">
			<?php echo form_password([
				'name'=>'password',
				'class'=>'form-control',
				'placeholder'=>'Password'
			]);?>
		</div>
		<div class="form-group">
			<?php echo form_submit([
				'name'=>'insert',
				'value'=>'Submit',
				'class'=>'btn btn-success btn-lg btn-block'
			]);?>
		</div>
	</div>
	<?php echo form_close();?>
	<div class="text-center">Already have an account? <a href="<?php echo site_url('Signin');?>">Sign in</a></div>
</div>
</body>
</html>