<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">
	<script src="/js/respond.js"></script>	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
		<!-- if user is logged in, show menu  -->
		<?php if($user): ?>
				<!-- nav -->
				<div class="row">
					<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
								<span class="sr-only">Toggle Navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="collapse">
							<ul class="nav navbar-nav pull-right">
								<li><a href='/users/home'>Home</a></li>
								<li><a href='/users/logout'>Logout</a></li>
								<li><a href='/library'>Library</a></li>
							</ul>
						</div>
					</nav>
				</div>
				<!-- end of nav -->
				<div class="buffer"></div>
				<?php if(isset($content)) echo $content; ?>
		<?php else: ?>

			
			<?php if(isset($content)) echo $content; ?>

		<?php endif ?>
		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</div>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>