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
			<div class="col-sm-8">
				<h4>参加する部屋を選んでください</h4>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoom">新規作成</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-10">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th> 
							<th>部屋の名前</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rooms as $room) : ?>
						<tr>
							<th scope="row"><?php echo $room->id; ?></th>
							<td><?php echo $room->name; ?></td>
							<td><button type="button" class="btn btn-info btn-sm" onclick="<?php echo "enterRoom($room->id)"; ?>">入室</button></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="createRoom" tabindex="-1" role="dialog" aria-labelledby="createRoomLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="createRoomLabel">新規作成</h4>
		      </div>
		      <form action="./" method="post">
		      	<div class="modal-body">
					<div class="form-group">	
					    <label for="name">部屋の名前</label>
					    <input type="text" class="form-control" id="name" name="name" placeholder="例: ボケモンのイラストを書く部屋">
					</div>
		      	</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			        <button type="submit" class="btn btn-primary">作成</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
	</div>
	
	
	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Bootstrap -->
	<?php echo Asset::js(array('bootstrap.js', 'rooms.js')); ?>
</body>
</html>