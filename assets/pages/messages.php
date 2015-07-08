<div class="col-xs-12">
<h1>Messages</h1>
</div>
<div class="col-xs-12 messages"></div>

<?php 
session_start();
require('mysql_connect.php');
$user_email = $_SESSION['email'];
$output['email']= $user_email;
$query = "SELECT * FROM `messages` WHERE recipient='$user_email' || sender='$user_email'";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		// print_r($row);
		$output['messages'][]= $row;
	}
}
?>

<script>
var user_messages = <?php echo json_encode($output); ?>;
console.log(user_messages);
var duplicate_message_check = [user_messages.messages[0].thread_id];
var display_messages = [user_messages.messages[0]];
for(var i = 1; i < user_messages.messages.length; i++){
	console.log($.inArray(user_messages.messages[i].thread_id,duplicate_message_check));
	if($.inArray(user_messages.messages[i].thread_id,duplicate_message_check) == 0){
		continue;
	}
	else{
		display_messages.push(user_messages.messages[i]);
	}
}
// 	var message_div = $('<div>').addClass('col-xs-12 well').attr('thread_id', user_messages.messages[0].thread_id).attr('index_number','0');
// 	var message_sender = $('<div>').text('From: ' + user_messages.messages[0].sender).addClass('col-xs-6');
// 	var message_subject = $('<div>').text('Subject: ' + user_messages.messages[0].subject).addClass('col-xs-6');

// 		$(message_div).click(display_thread_messages);

// 		$(message_div).append(message_sender, message_subject);
// 		$('.messages').append(message_div);
console.log(display_messages);
for(var i = 0; i < display_messages.length; i++){

	var message_div = $('<div>').addClass('col-xs-12 well').attr('thread_id', display_messages[i].thread_id).attr('index_number', i);
	var message_sender = $('<div>').text('From: ' + display_messages[i].sender).addClass('col-xs-12 col-sm-6');
	var message_subject = $('<div>').text('Subject: ' + display_messages[i].subject).addClass('col-xs-12 col-xs-6');

	$(message_div).click(display_thread_messages);

	$(message_div).append(message_sender, message_subject);
	$('.messages').append(message_div);
	}
	

function display_thread_messages(){
		$('.messages').html('');
		var messages_link = $('<a>').attr('href', 'index.php?page=messages').text('Back to inbox');
		var thread_subject = $('<div>').html('Subject: ' + display_messages[$(this).attr('index_number')].subject);
		var thread_sender_name = $('<div>').html('From: ' + '<span class="sender_name">'+display_messages[$(this).attr('index_number')].sender+'</span>');
		var reply_input = $('<textarea>').attr({name: 'reply_message', placeholder: 'Reply..'}).addClass('col-xs-10 col-xs-offset-1');
		var submit_reply = $('<button>').attr('type','button').addClass('col-xs-2 col-xs-offset-5').text('Send').attr({index_number: $(this).attr('index_number'), thread_id: $(this).attr('thread_id')})

		$(submit_reply).click(function(){
			$.ajax({
				url:'message_reply_handler.php',
				dataType: 'json',
				method: 'POST',
				data: { postid: $(this).attr('thread_id'),
						sender: user_messages.email, 
						recipient: user_messages.messages[$(this).attr('index_number')].sender,
						subject: user_messages.messages[$(this).attr('index_number')].subject,
						message: $(reply_input).val(), 
					  },
				success:function(response){
					if(response.success){
						$('.messages').html('');
						$('.messages').html('Your message has been seent!');
						$('.messages').append(messages_link);
					}
				}
			});
		});

		$('.messages').append(messages_link, thread_subject, thread_sender_name);
		for(i=0; i < user_messages.messages.length ; i++){
			if($(this).attr('thread_id') == user_messages.messages[i].thread_id){
				var thread_message_div_container = $('<div>').addClass('thread_message_container');
				var thread_message_div = $('<div>').html(user_messages.messages[i].message).addClass('col-xs-6');
				var thread_message_timestamp = $('<div>').html(user_messages.messages[i].timestamp).addClass('col-xs-6 pull-right');
				if(user_messages.messages[i].recipient == user_messages.email){
					$(thread_message_div_container).addClass('sender_message_background');
					$(thread_message_div_container).addClass('col-xs-12 col-sm-6 col-sm-offset-2');
				}
				else{
					$(thread_message_div_container).addClass('user_message_background');
					$(thread_message_div_container).addClass('col-xs-12 col-sm-6 col-sm-offset-4');

				}
				thread_message_div_container.append(thread_message_div, thread_message_timestamp);

				$('.messages').append(thread_message_div_container);
			}
		}
		$('.messages').append(reply_input, submit_reply);
}
</script>