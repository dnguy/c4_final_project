<?php 
session_start();
?>
<div class="col-xs-10 col-xs-offset-1 account_container">
<div class="col-xs-12"><h1>ACCOUNT<h1></div>
<div class="col-xs-12">
<?php 
print_r('Name : ' . $_SESSION['name']);
?>
</div>
<div class="col-xs-12">
<?php 
print_r('Email: ' . $_SESSION['email']);
?>
</div>

<?php 
require('mysql_connect.php');
$user_id = $_SESSION['id'];
$query = "SELECT * FROM `items` WHERE user_id='$user_id'";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		// print_r($row);
		$output[]= $row;
	}
}
?>
<script>
var user_item_array = <?php echo json_encode($output); ?>;
for(var i = 0; i < user_item_array.length; i++){
			var img_div = $('<div>').addClass('col-xs-2').attr({user_id: user_item_array[i].user_id, id: user_item_array[i].id, index_number: i});
			var img = $('<img>').attr('src', user_item_array[i].filepath);
			var edit_item_button = $('<button>').attr('type', 'submit').text('Edit').attr('index_number', i);
			var delete_item_button = $('<button>').attr('type', 'submit').text('Delete').attr('index_number', i);
			$(img_div).append(img, edit_item_button, delete_item_button);
			$('.account_container').append(img_div);

			$(edit_item_button).click(function(){
				$('.modal-title').html('');
				$('.modal-body').html('');
				
				var modal_img = $('<img>').attr('src', user_item_array[$(this).attr('index_number')].filepath).addClass('modal_img');
				var title_container = $('<div>').text('Title: ');
				var title = $('<input>').attr('value', user_item_array[$(this).attr('index_number')].title).addClass('title_update');
				var shoe_condition_container = $('<div>').text('Condition: ');
				var shoe_condition = $('<select>').attr('name','shoe_condition').addClass('condition_update').html('<option value="brand-new">Brand New</option> <option value="pre-owned">Pre-owned</option>')
				var details_container = $('<div>').text('Details: ');
				var details = $('<textarea>').text(user_item_array[$(this).attr('index_number')].details).addClass('details_update');
				var size_container = $('<div>').text('Size: ');
				var size = $('<input>').attr('value', user_item_array[$(this).attr('index_number')].size).addClass('size_update');
				var price_container = $('<div>').text('Price: ')
				var price = $('<input>').attr('value', user_item_array[$(this).attr('index_number')].price).addClass('price_update');
				var update_button = $('<button>').attr({type: 'button', index_number: $(this).attr('index_number')}).text('Update Item');

				$(title_container).append(title);
				$(shoe_condition_container).append(shoe_condition);
				$(details_container).append(details);
				$(size_container).append(size);
				$(price_container).append(price);

				$(update_button).click(update_item);
		

				$('.modal-title').html(title_container);
				$('.modal-body').append(modal_img, shoe_condition_container, details_container, size_container, price_container, update_button);
				$('#myModal').modal('show');

			});
		}

function update_item() {
    console.log('ajax getting called')
    $.ajax({
    	dataType: 'json',
        data: {
            postid: user_item_array[$(this).attr('index_number')].id,
            title: $('.title_update').val(),
            shoe_condition: $('.condition_update').val(),
            details: $('.details_update').val(),
            size: $('.size_update').val(),
            price: $('.price_update').val(),
        },
        method: 'POST',
        url: 'edit_item_handler.php',
        cache: false,
        crossDomain: true,
        success: function(data) {
            window.data = data;
            console.log(data);
           if(data.success){
           	$('.modal-title').html('');
			$('.modal-body').html('');
			$('.modal-body').html('Your item has been updated. Please refresh the page to see the changes.')
			$('#myModal').modal('show');
           }


        }

    });
}
</script>
</div>
