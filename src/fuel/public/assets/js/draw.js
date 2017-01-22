(function() {
	Array.prototype.getLastVal = function (){ return this[this.length -1];};
	
	var STATUS = {
	  'DRAW' 	 : 1,
	  'DRAW_END' : 2,
	  'CLEAR'    : 3
	};
	
	// パラメータの取得
	var arg = getArgs();
	
	// セッションIDの取得
	var session_id = generateRandomStr(8);
		
    // HTML上の canvas タグを取得
    var canvas = document.getElementById('myCanvas');
 
    // レスポンシブ対応 画面サイズでキャンバスサイズを調整
    if (screen.width < 860) {
        canvas.width = 700 * screen.width / 860;
        canvas.height = 400 * screen.width / 860;
    }
 
    //キャンバスの背景カラーを決定。 fillRectは長方形に塗るメソッド
    var ctx = canvas.getContext('2d');
    ctx.beginPath();
    ctx.fillStyle = "#f5f5f5";
    ctx.fillRect(0, 0, 700, 400);
 
    //初期値（サイズ、色、アルファ値）の決定
    var defosize = 7;
    var defocolor = "#555555";
    var defoalpha = 1.0;
 
    //最後のマウスの終了位置
    var lastEndX = "";
    var lastEndY = "";
 
    //各イベントに紐づけ
    canvas.addEventListener('mousemove', onMove, false);
    canvas.addEventListener('mousedown', onClick, false);
    canvas.addEventListener('mouseup', mouseUp, false);
    canvas.addEventListener('mouseout', mouseOut, false);
    
    // 絵の初期値の描写
    var lastDrawingID = 0;
    initCanvas();
    
    // クリアボタンにイベント紐づけ
    var clearBtn = document.getElementById('clearBtn');
    clearBtn.addEventListener('click', clickClearBtn);

    //　キャンバスの初期化
    var fetchDrawingDone;
    var fetchDrawingFail;
    function initCanvas(){
	    fetchDrawingDone = function(data){
		    if (data["error"] !== undefined) return;
		    lastDrawingID = data.getLastVal()["id"];
		    
		    data.forEach(function(drawing) {
			    switch(drawing["status_id"]) {
				    case STATUS.DRAW: 
				    	draw_line(drawing["start_x"], drawing["start_y"], drawing["end_x"], drawing["end_y"]);
				    	break;
				    case STATUS.DRAW_END: 
				    	drawEnd(); 
				    	break;
				    case STATUS.CLEAR:
				    	clearCanvas();
				        drawEnd();
				        break;
			    }
			    console.log(drawing["id"]);
		    })
		};
		
		fetchDrawingFail = function(){
			// do something...
		};
		
		var data = {
			'id': arg.id,
			'min': lastDrawingID,
			'session_id': session_id
		};
		apiJson('draw.json', 'GET', data, true, fetchDrawingDone, fetchDrawingFail);
	}
	
	// 一定時間おきに絵のデータを取得する
	setInterval(function(){
		var data = {
			'id': arg.id,
			'min': lastDrawingID,
			'session_id': session_id
		};
        apiJson('draw.json', 'GET', data, true, fetchDrawingDone, fetchDrawingFail);
    },400);
    
    function post_drawEnd(){
	    var data = {
			'room_id' :	arg.id,
			'status_id' : STATUS.DRAW_END,
			'session_id': session_id
		};
		
		apiJson('draw.json', 'POST', data, true, function(){});
    }
	
	// 絵をサーバにポストする
	function post_drawing(startX, startY, endX, endY, status_id){
		var data = {
			'start_x' : startX,
			'start_y' : startY,
			'end_x' : endX,
			'end_y' : endY,
			'room_id' :	arg.id,
			'status_id' : status_id,
			'session_id': session_id
		};
		
		apiJson('draw.json', 'POST', data, true, function(){});
	}
	
     
    //マウス動いていて、かつ左クリック時に発火。
    function onMove(e) {
        if (e.buttons === 1 || e.witch === 1) {
            var rect = e.target.getBoundingClientRect();
            var endX = ~~(e.clientX - rect.left);
            var endY = ~~(e.clientY - rect.top);
            var startX = ((lastEndX !== "") ? lastEndX : endX);
            var startY = ((lastEndY !== "") ? lastEndY : endY);
                                    
	        post_drawing(startX, startY, endX, endY, 1);
			draw_line(startX, startY, endX, endY);
			
			lastEndX = endX;
			lastEndY = endY;	
        }
    };
    
    // 左クリック時に発火
    function onClick(e) {
        if (e.button === 0) {
            var rect = e.target.getBoundingClientRect();
            var rect = e.target.getBoundingClientRect();
            var endX = ~~(e.clientX - rect.left);
            var endY = ~~(e.clientY - rect.top);
			var startX = ((lastEndX !== "") ? lastEndX : endX);
            var startY = ((lastEndY !== "") ? lastEndY : endY);
               
	        post_drawing(startX, startY, endX, endY, 1);
			draw_line(startX, startY, endX, endY)
			
            lastEndX = endX;
			lastEndY = endY;
        }
    };
     
    // 始点と終点をもとに線を引く
    function draw_line(startX, startY, endX, endY){
	    ctx.beginPath();
        ctx.globalAlpha = defoalpha;
        
        //スタート位置とゴール位置を指定
        ctx.moveTo(startX, startY);
	    ctx.lineTo(endX, endY);
       
        //直線の角を「丸」、サイズと色を決める
        ctx.lineCap = "round";
        ctx.lineWidth = defosize * 2;
        ctx.strokeStyle = defocolor;
        ctx.stroke();
    }
 
    //左クリック終了、またはマウスが領域から外れた際、継続値を初期値に戻す
    function drawEnd() {
		lastEndX = "";
		lastEndY = "";
    }
    
    function mouseUp() {
	    if (lastEndX !== ""){
	    	post_drawEnd();
	    	drawEnd();
	    }
    }
    
    function mouseOut() {
	    if (lastEndX !== ""){
	    	post_drawEnd();
	    	drawEnd();
	    }
    }
        
    function delete_drawing(){
		var data = {
				'room_id' :	arg.id,
				'status_id' : 3,
				'session_id': session_id
			};
		
		apiJson('draw.json', 'POST', data, true, function(){});
	}

	// クリアボタンがクリックされたときに発火
	function clickClearBtn() {
		if (confirm("本当にクリアしますか？")) {
			clearCanvas();
			delete_drawing();
		}
	}
	
	// キャンバスをクリアにする
	function clearCanvas(){
	    ctx.beginPath();
	    ctx.fillStyle = "#f5f5f5";
	    ctx.globalAlpha = 1.0;
	    ctx.fillRect(0, 0, 700, 400);
	}
    
    //　ランダムな文字列を生成
	function generateRandomStr(length){
		var c = "abcdefghijklmnopqrstuvwxyz0123456789";
		var cl = c.length;
		var session_id = "";
		for(var i=0; i<length; i++){
		  session_id += c[Math.floor(Math.random()*cl)];
		}
		return session_id;
	}
	
	// パラメータの取得
	function getArgs(){
		var args = new Object;
		var pair=location.search.substring(1).split('&');
		for(var i=0;pair[i];i++) {
		    var kv = pair[i].split('=');
		    args[kv[0]]=kv[1];
		}
		return args;
	}
})();