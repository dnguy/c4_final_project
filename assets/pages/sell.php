<div class="col-xs-10 col-xs-offset-1 sell_container">
<form enctype="multipart/form-data" id="file_upload" action="file_handler.php" method="POST">
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
<input type="text" name="title" placeholder="Title"><br>
<textarea type="text" name="details" placeholder="Details"></textarea><br>
<input type="text" name="size" placeholder="Size"><br>
<input type="text" name="price" placeholder="Price"><br>
<input type="text" name="location" placeholder="Location"><br>
<input type="text" name="postal_code" placeholder="Postal Code"><br>
<select name="shoe_condition">
	<option value="brand-new">Brand New</option>
	<option value="pre-owned">Pre-owned</option>
</select><br>
<input type="file" name="fileToUpload" id="fileToUpload"><br>
<input class="form_button" type="submit" value="Submit" name="submit">
</form>

</div>