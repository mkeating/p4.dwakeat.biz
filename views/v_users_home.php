<h1>homepage</h1>
<a href="/users/logout">Logout</a>
<br>
<!-- if no current Tale 
 form for New Tale -->
 <?php if($user->current_tale == NULL): ?>
 <p>New Tale</p>
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
<?php else: ?>
	<p>Continue Tale</p>
	<!-- Display the current contents of the Tale -->
	<p>THE STORY SO FAR....</p>
	<?php if(isset($story)) echo $story; ?>
	<br><br>
	<form method='POST' action='/tales/p_continue' role='form'>
		
		<div class='form_group'>
			<label for='content'>Continue the story:</label>
			<input type='text' name='content' class="form-control">
		</div>
		<br>
		<!-- Need a check here to see if the Tale is at section=3, if so, omit pass it along field -->
		<div class='form_group'>
			<label for='email_next'>Pass it along</label>
			<input type='text' name='email_next' class="form-control" placeholder='Email of who to pass along to'>
		</div>
		<br>
		<button type='submit' class='btn btn-default'>Submit</button>
	</form>

<?php endif ?>
<!--else, display current Tale -->