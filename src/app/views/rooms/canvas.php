<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>お絵かきチャット</title>
	<!-- Bootstrap CSS -->
	<?php echo Asset::css('bootstrap.css'); ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2>お絵かきチャット</h2>
			<hr>
		</div>
		
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-8">
				<h3><?php echo $room->name ?></h3>
			</div>
			<div class="col-xs-1 col-sm-1 col-md-1">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoom" id="clearBtn">クリア</button>
			</div>
		</div>
		
		<!-- Canvaus Area -->
		<div class="row">
			<canvas id="myCanvas" width="700" height="400"></canvas>
		</div>
	</div>
	
	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Bootstrap -->
	<?php echo Asset::js(array('bootstrap.js', 'api.js', 'draw.js')); ?>
</body>
</html>