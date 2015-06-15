var item_array = [];

function retrieve_info_images(){
	$.ajax({
		url: 'index_page_load.php',
		dataType: 'json',
		method: 'POST',
		success: function(response){
			window.response =response;
			item_array = response;
		}
	});
};

$(document).ready(function(){
	retrieve_info_images();

});