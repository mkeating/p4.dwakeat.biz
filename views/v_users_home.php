<h1>homepage</h1>
<a href="/users/logout">Logout</a>
<br>
<!-- if no current Tale 
 form for New Tale -->
 New Tale
<form method='POST' action='' role='form'>
	<div class='form_group'>
		<input type='text' name='title' class="form-control" placeholder='Title'>
	</div>
	<br>
	<div class='form_group'>
		<label for='password'>Password</label>
		<input type='text' name='email' class="form-control" placeholder='Email of who to pass along to'>
	</div>
	<br>
	<button type='submit' class='btn btn-default'>Submit</button>
</form>
<!--else, display current Tale -->