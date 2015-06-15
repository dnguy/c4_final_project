var item_array = [];

function retrieve_info_images(){
	$.ajax({
		url: 'index_page_load.php',
		dataType: 'json',
		method: 'POST',
		success: function(response){
			item_array = response; 
			for(var i = 0; i < item_array.length; i++){
			var img_div = $('<div>').addClass('col-xs-3').attr({user_id: response[i].user_id, id: response[i].id});
			var img = $('<img>').attr('src', response[i].filepath);
			$(img_div).append(img);
			$('.item_container').append(img_div);
		}
		}
	});
};

$(document).ready(function(){
	retrieve_info_images();

});