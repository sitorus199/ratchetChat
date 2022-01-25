<!DOCTYPE html>
<html>
<head>
	<!-- <title></title> -->
	<title>Chat Admin</title>
	<!-- Bootstrap core CSS -->
    <link href="vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="vendor-front/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="vendor-front/parsley/parsley.css"/>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor-front/jquery/jquery.min.js"></script>
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script> 

    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
	<style type="text/css">
		html,
		body {
		  height: 100%;
		  width: 100%;
		  margin: 0;
		}
		#wrapper
		{
			display: flex;
		  	flex-flow: column;
		  	height: 100%;
		}
		#remaining
		{
			flex-grow : 1;
		}
		#messages {
			height: 200px;
			background: whitesmoke;
			overflow: auto;
		}
		#chat-room-frm {
			margin-top: 10px;
		}
		#user_list
		{
			height:450px;
			overflow-y: auto;
		}

		#messages_area
		{
			height: 650px;
			overflow-y: auto;
			background-color: grey;
		}
	</style>
</head>
<body>
<div class="card-body" id="messages_area"></div>

	<form method="post" id="chat_form" data-parsley-errors-container="#validation_error">
		<div class="input-group mb-3">
			<textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" data-parsley-maxlength="1000" data-parsley-pattern="/^[a-zA-Z0-9\s]+$/" required></textarea>
			<div class="input-group-append">
				<button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
			</div>
		</div>
		<div id="validation_error"></div>
	</form>

	<!-- <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" /> -->
	<input type="hidden" name="login_user_id" id="login_user_id" value="1" />
				<!-- <div class="mt-3 mb-3 text-center">
					<img src="<?php echo $value['profile']; ?>" width="150" class="img-fluid rounded-circle img-thumbnail" />
					<h3 class="mt-2">
						<?php echo $value['name']; ?>
							
						</h3>
					<a href="profile.php" class="btn btn-secondary mt-2 mb-2">Edit</a>
					<input type="button" class="btn btn-primary mt-2 mb-2" name="logout" id="logout" value="Logout" />
				</div> -->

<script type="text/javascript">
	
	$(document).ready(function(){

		var conn = new WebSocket('ws://localhost:8081');
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

		conn.onmessage = function(e) {
		    console.log(e.data);

		    var data = JSON.parse(e.data);

		    var row_class = '';

		    var background_class = '';

		    if(data.from == 'Me')
		    {
                row_class = 'row justify-content-end';
                background_class = 'alert-info';
		    }
		    else
		    {
		    	data.from = 'You';
                row_class = 'row justify-content-start';
                background_class = 'text-dark alert-light';
		    }

		    var html_data = "<div class='"+row_class+"'><div class='col-sm-10'><div class='shadow-sm alert "+background_class+"'><b>"+data.from+" - </b>"+data.msg+"<br /><div class='text-right'><small><i>"+moment().format('LT')+"</i></small></div></div></div></div>";

		    $('#messages_area').append(html_data);

		    $("#chat_message").val("");
		};

		// $('#chat_form').parsley();

		$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

		$('#chat_form').on('submit', function(event){

			event.preventDefault();

			if($('#chat_form').parsley().isValid())
			{

				var user_id = $('#login_user_id').val();

				var message = $('#chat_message').val();

				var data = {
					userId : user_id,
					msg : message
				};

				conn.send(JSON.stringify(data));
				// conn.send('Halo');

				$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

			}

		});
		
		// $('#logout').click(function(){

		// 	user_id = $('#login_user_id').val();

		// 	$.ajax({
		// 		url:"action.php",
		// 		method:"POST",
		// 		data:{user_id:user_id, action:'leave'},
		// 		success:function(data)
		// 		{
		// 			var response = JSON.parse(data);

		// 			if(response.status == 1)
		// 			{
		// 				conn.close();
		// 				location = 'index.php';
		// 			}
		// 		}
		// 	})

		// });

	});
	
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- moment Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</body>
</html>