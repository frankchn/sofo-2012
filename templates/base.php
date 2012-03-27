<html>
	<head>
		<title>Micro-Flick</title>
		<link rel="stylesheet" href="../static/css/main.css" />
	</head>
	<body>
		<div id="outer_container">
			<div id="top_bar">
				<?php if($user == null) { ?>
				<div id="right_banner">
					<a href="<?=create_link('home/signup')?>">Sign Up</a> | 
					<a href="<?=create_link('home/signin')?>">Sign In</a>
				</div>	
				<?php } else { ?>
				<div id="right_banner">
					<strong>Welcome <?=_s($user->full_name)?></strong> | 
					<a href="<?=create_link('photostream/view', array('user_id' => $user->id))?>">My Photostream</a> |
					<a href="<?=create_link('sets/view', array('user_id' => $user->id))?>">My Sets</a> |
					<a href="<?=create_link('friends/view', array('user_id' => $user->id))?>">My Friends</a> |
					<a href="<?=create_link('home/signout')?>">Sign Out</a>
				</div>	
				<?php } ?>			
				<div id="left_banner"><a href="<?=create_link('home/welcome')?>">Micro-Flick</a> | <small>A FroSoCo SoFo Teaching Project</small></div>
			</div>
			<div id="content_container">
				<div id="content">
					<?php echo($content); ?>
				</div>
			</div>
		</div>
	</body>
</html>
