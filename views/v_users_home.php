
<br>
<!-- if no current Tale 
 form for New Tale -->
 <?php if($user->current_tale == NULL): ?>
	 <p>Start a tale</p>
	 <div class="col-lg-4 col-md-3 col-sm-0"></div>
	 <div class="col-lg-3 col-md-4 col-sm-10">
		<form method='POST' action='/tales/p_new' role='form'>
			<div class='form_group'>
				<input type='text' name='title' class="form-control titlefield"  placeholder='Title'>
			</div>
			<br>
			<div class='form_group'>
				<!-- need a JS check for word limit -->
				<textarea rows = '10' name='content' class="form-control storyfield" placeholder='Start your tale here...'></textarea>
			</div>
			<br>
			<div class='form_group'>
				<label for='email_next'>Pass it along</label>
				<input type='text' name='email_next' class="form-control titlefield" placeholder='Email of who to pass along to'>
			</div>
			<?php if(isset($error)): ?>
				<div class='error'>
					That user is already working on a tale. Pick someone else. 
				</div>
			<br>
			<?php endif; ?>
			<br>
			<button type='submit' class='btn btn-default'>Submit</button>
		</form>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 wordcounter">
		<p> JS word count goes here
	</div>
	<div class="col-lg-3 col-md-2 col-sm-0"></div>
<?php else: ?>
	<div class="col-lg-4 col-md-3 col-sm-0"></div>
		 <div class="col-lg-3 col-md-4 col-sm-10">
			
			<!-- Display the current contents of the Tale -->
			<p>THE STORY SO FAR....</p>
			<div class = "display_title">
				<?php if(isset($story_title)) echo $story_title; ?>
			</div>
			<br>
			<div class = "display_content">
				<?php if(isset($story)) echo $story; ?>
			</div>
			<br><br>
			<form method='POST' action='/tales/p_continue' role='form'>
				
				<div class='form_group'>
					<?php if(isset($label)) echo $label; ?>
					<!-- need a JS check for word limit -->
					<textarea rows = '10' name='content' class="form-control storyfield" placeholder='Continue the tale here...'></textarea>
				</div>
				<br>
				<!-- Need a check here to see if the Tale is at section=3, if so, omit pass it along field -->
				<?php if(isset($email_form)) echo $email_form; ?>
				<br>
				<?php if(isset($error)): ?>
					<div class='error'>
						That user has already contributed to this tale. Pick someone else. 
					</div>
					<br>
				<?php endif; ?>
		
			<button type='submit' class='btn btn-default'>Submit</button>
		</form>
		</div>
	<div class="col-lg-2 col-md-2 col-sm-2 wordcounter">
		<p> JS word count goes here
	</div>
	<div class="col-lg-3 col-md-2 col-sm-0"></div>
<?php endif; ?>
