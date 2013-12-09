<h1>homepage</h1>
<a href="/users/logout">Logout</a>
<br>
<!-- if no current Tale 
 form for New Tale -->
 <?php if($user->current_tale == NULL): ?>
 New Tale
<form method='POST' action='/tales/p_new' role='form'>
	<div class='form_group'>
		<input type='text' name='title' class="form-control" placeholder='Title'>
	</div>
	<br>
	<div class='form_group'>
		<label for='content'>Start a story:</label>
		<input type='text' name='content' class="form-control">
	</div>
	<br>
	<div class='form_group'>
		<label for='email_next'>Pass it along</label>
		<input type='text' name='email_next' class="form-control" placeholder='Email of who to pass along to'>
	</div>
	<br>
	<button type='submit' class='btn btn-default'>Submit</button>
</form>
<?php endif ?>
<!--else, display current Tale -->