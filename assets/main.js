var item_array = [];

function retrieve_info_images(){
	$.ajax({
		url: 'index_page_load.php',
		dataType: 'json',
		method: 'POST',
		success: function(response){
			item_array = response; 
			for(var i = 0; i < item_array.length; i++){
			var img_div = $('<div>').addClass('col-xs-3').attr({user_id: response[i].user_id, id: response[i].id, index_number: i});
			var img = $('<img>').attr('src', response[i].filepath);
			$(img_div).append(img);
			$('.item_container').append(img_div);

			$(img_div).click(function(){
				$('.modal-title').html('');
				$('.modal-body').html('');
				console.log(item_array[$(this).attr('index_number')].filepath)
				var modal_img = $('<img>').attr('src', item_array[$(this).attr('index_number')].filepath);
				var title = $('<div>').text(item_array[$(this).attr('index_number')].title);
				var shoe_condition = $('<div>').text('Condition: ' + item_array[$(this).attr('index_number')].shoe_condition)
				var details = $('<div>').text(item_array[$(this).attr('index_number')].details);
				var size = $('<div>').text('size: ' + item_array[$(this).attr('index_number')].size);
				var price = $('<div>').text('$' + item_array[$(this).attr('index_number')].price);
				var contact_buyer_button = $('<button>').attr('type', 'submit').text('Contact');

				$('.modal-title').html(title);
				$('.modal-body').append(modal_img,shoe_condition, details, size, price, contact_buyer_button);
				$('#myModal').modal('show');

			});
		}
		}
	});
};

$(document).ready(function(){
	retrieve_info_images();

});