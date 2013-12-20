<div class="col-lg-4 col-md-3 col-sm-0"></div>
<div class="col-lg-4 col-md-3 col-sm-0">
<form method='POST' action='/users/p_login' role='form'>
	<div class='form_group'>
		<label for='email'>Email</label>
		<input type='text' name='email' class="form-control" placeholder='Email'>
	</div>
	<br>
	<div class='form_group'>
		<label for='password'>Password</label>
		<input type='password' name='password' class="form-control" placeholder='Password'>
	</div>
	<?php if(isset($error)): ?>
		<div class='error'>
			Login failed. Double check your email and password.
		</div>
		<br>
	<?php endif; ?>
	<br>
	<button type='submit' class='btn btn-default'>Login</button>
</form>
</div>
<div class="col-lg-4 col-md-3 col-sm-0"></div>