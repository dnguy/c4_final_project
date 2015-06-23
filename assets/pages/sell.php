<script>
	$(document).ready(function(){
		$('#file_upload').submit(function(e){
			var formData = new FormData($(this)[0]);
			$.ajax({
				url:'file_handler.php',
				type: 'POST',
				data: formData ,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data){
					if(data.success){
						console.log("data: ", data);
						$('.alert').remove();
						var success_message = $('<div>').addClass('alert alert-success').text('You item was uploaded');
						$('.modal-title').html('');
						$('.modal-body').html('');
						$('.modal-body').append(success_message);
						$('#myModal').modal('show');
						$('.title_input, .details_input , .size_input, .price_input, .location_input, .postal_code_input, .file_upload').val('');

					}
					if(!data.success){
						console.log(data.errors);
					}
				}
			});
			e.preventDefault();
		});

		$('.clear_button').click(function(){
			console.log('clear working');
			$('.title_input, .details_input , .size_input, .price_input, .location_input, .postal_code_input, .file_upload').val('');
		});
	});

</script>

<div class="col-xs-10 col-xs-offset-1 sell_container">
<form enctype="multipart/form-data" id="file_upload">
<select name="brand">
	<option value="nike">Nike</option>
	<option value="nike basketball">Nike Basketball</option>
	<option value="adidas">Adidas</option>
	<option value="jordan brand">Jordan Brand</option>
	<option value="new balance">New Balance</option>
	<option value="asics">Asics</option>
	<option value="reebok">Reebok</option>
	<option value="saucony">Saucony</option>
	<option value="vans">Vans</option>
	<option value="puma">Puma</option>
	<option value="others">Others</option>
</select><br>
<input type="text" class="title_input" name="title" placeholder="Title"><br>
<textarea type="text" class="details_input" name="details" placeholder="Details"></textarea><br>
<input type="text" class="size_input" name="size" placeholder="Size"><br>
<input type="text" class="price_input" name="price" placeholder="Price"><br>
<input type="text" class="location_input" name="location" placeholder="Location"><br>
<input type="text" class="postal_code_input" name="postal_code" placeholder="Postal Code"><br>
<select name="shoe_condition">
	<option value="brand-new">Brand New</option>
	<option value="pre-owned">Pre-owned</option>
</select><br>
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload" name="fileToUpload[]" id="fileToUpload"><br>
<input class="form_button" type="submit" value="Submit" name="submit">
<button type="button" class="clear_button">Clear Form</button>
</form>

</div>