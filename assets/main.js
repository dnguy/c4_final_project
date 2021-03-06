var img_array = [];
var current_image_index = 0;
function retrieve_info_images() {
    $.ajax({
        url: 'index_page_load.php',
        dataType: 'json',
        method: 'POST',
        success: function(response) {
            display_images(response);

        }
    });
};

function display_images(response) {
    console.log(response.items);
    for (var i = 0; i < response.items.length; i++) {
        var img_div = $('<div>').addClass('col-sm-2 col-xs-5 image_container').attr({
            user_id: response.items[i].user_id,
            id: response.items[i].id,
            index_number: i
        });
        var img_container = $('<div>');
        var img = $('<img>').attr('src', response.items[i].filepath);
        var item_title = $('<div>').text('$' + response.items[i].price);
        $(img_container).append(img);
        $(img_div).append(img_container, item_title);
        $('.item_container').append(img_div);

        $(img_div).click(function() {
            $('.modal-title').html('');
            $('.modal-body').html('');

            var image_container = $('<div>').attr('id', 'image_container');
            var image_controller = $('<div>').addClass('dots');

            //retrieving extra images for item from database
            $.ajax({
                url: 'item_image_handler.php',
                data: {
                    postid: response.items[$(this).attr('index_number')].id
                },
                dataType: 'json',
                method: 'POST',
                success: function(data_image) {
                    img_array = [];
                    current_image_index = 0;
                    img_array = img_array.concat(data_image.images);
                    for (i = 0; i < img_array.length; i++) {
                        var img = $('<img>').attr('src', img_array[i].filepath).addClass('additional_images');
                        $('#image_container').append(img);

                        //creating divs which will be used as navigation per image in array
                        var circle_dots = $('<div>').addClass('dot_list');

                        //placing click handler with the function next_img and will take in the parameter of the index of the image on the DOM
                        $(circle_dots).click(function() {
                            next_img($('.dots').find('div').index($(this)));
                        });
                        $('.dots').append(circle_dots);
                    }

                    //function to move all elements except the first image to the right outside of the container
                    initialize();
                    $('.dots').find('div').eq(0).addClass('active_dot');

                }


            });

            //shoe information DOM creation
            var title = $('<div>').text(response.items[$(this).attr('index_number')].title);
            var shoe_condition = $('<div>').text('Condition: ' + response.items[$(this).attr('index_number')].shoe_condition)
            var details = $('<div>').text('Details: ' + response.items[$(this).attr('index_number')].details);
            var size = $('<div>').text('size: ' + response.items[$(this).attr('index_number')].size);
            var price = $('<div>').text('$' + response.items[$(this).attr('index_number')].price);
            var contact_buyer_button = $('<button>').attr({
                type: 'submit',
                index_number: $(this).attr('index_number')
            }).text('Contact').addClass('btn btn-default');
            // var purchase_item_button = $('<button>').attr('type', 'submit').text('Purchase').addClass('btn btn-default');
            var vote_priority_button = $('<i>').addClass('fa fa-thumbs-o-up fa-2x').attr('index_number', $(this).attr('index_number'));

            $(contact_buyer_button).click(function() {
                $('.modal-title').html('');
                $('.modal-body').html('');

                var subject = $('<input>').attr({
                    placeholder: 'Subject',
                    name: 'subject'
                }).addClass('subject_input col-xs-8 col-xs-offset-2');
                var message = $('<textarea>').attr({
                    placeholder: 'Message',
                    name: 'message'
                }).addClass('message_input col-xs-8 col-xs-offset-2');
                var submit_message_button = $('<button>').attr({
                    type: 'submit',
                    index_number: $(this).attr('index_number')
                }).addClass('col-xs-3 col-xs-offset-7').text('Send');

                $('.modal-title').html('Message');
                $('.modal-body').append(subject, message, submit_message_button);

                $(submit_message_button).click(function() {
                    $.ajax({
                        url: 'message_handler.php',
                        dataType: 'json',
                        data: {
                            subject: $(subject).val(),
                            message: $(message).val(),
                            sender: response.email,
                            postid: response.items[$(this).attr('index_number')].id,
                        },
                        method: 'POST',
                        success: function(response) {
                            if (response.success) {
                                $('.modal-title').html('');
                                $('.modal-body').html('');
                                $('.modal-body').html('Your message has been sent!')
                                $('#myModal').modal('show');
                            } else if (!response.success) {
                                $('.alert').remove();
                                var error_message = $('<div>').addClass('alert alert-danger col-xs-12').text(response.errors);
                                $('.modal-body').append(error_message);
                            }
                        }
                    });
                });
            });
            $(vote_priority_button).click(function() {
                $.ajax({
                    url: 'vote_priority_handler.php',
                    data: {
                        user_id: response.id,
                        post_id: response.items[$(this).attr('index_number')].id,
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log('item was liked');
                            $('.alert').remove();
                            var success_message = $('<div>').addClass('alert alert-success').text('Item was liked');
                            $('.modal-body').append(success_message);

                        } else if (!response.success) {
                            $('.alert').remove();
                            var error_message = $('<div>').addClass('alert alert-danger').text(response.errors);
                            $('.modal-body').append(error_message);
                        }
                    }
                });
            });

            $('.modal-title').html(title);
            $('.modal-body').append(image_container, image_controller, shoe_condition, details, size, price, contact_buyer_button, vote_priority_button);
            $('#myModal').modal('show');

        });
    }
}

function next_img(image_clicked) {
    //checking if the the navigation element clicked is further down the list than the current image
    //will move current image to left and stage next photo to come in from right
    if (image_clicked > current_image_index) {
        $('.additional_images').eq(current_image_index).animate({
            left: '-120%',
        }, 500);
        $('.dots').find('div').eq(current_image_index).removeClass('active_dot')

        $('.additional_images').eq(image_clicked).css('left', '120%')
        $('.additional_images').eq(image_clicked).animate({
            left: '0',
        }, 500);
        $('.dots').find('div').eq(image_clicked).addClass('active_dot')
        current_image_index = image_clicked;
    }
    //checking if the the navigation element clicked is before the current element clicked
    //will move current image to right and stage next photo to come in from left
    else if (image_clicked < current_image_index) {
        $('.additional_images').eq(current_image_index).animate({
            left: '120%',
        }, 500);
        $('.dots').find('div').eq(current_image_index).removeClass('active_dot')

        $('.additional_images').eq(image_clicked).css('left', '-120%')
        $('.additional_images').eq(image_clicked).animate({
            left: '0',
        }, 500);
        $('.dots').find('div').eq(image_clicked).addClass('active_dot')
        current_image_index = image_clicked;
    }
}

function initialize() {
    for (i = 1; i < img_array.length; i++) {
        $('.additional_images').eq(i).css('left', '120%');
    }
}
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    window.response = response;
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
        API_call();
        $('.login_button').hide();
        // var logout_button = $('<button>').attr('type', 'button').addClass('logout_button');
        // var link_to_logout = $('<a>').attr('href', 'index.php?page=logout').text('Logout');
        // var account_button = $('<button>').attr('type', 'button').addClass('account_button');
        // var link_to_account = $('<a>').attr('href', 'index.php?page=account').text('Account');
        // $(account_button).append(link_to_account);
        // $(logout_button).append(link_to_logout);
        // $(logout_button).click(function() {
        //     logout();
        // });

        // $('.logout_container').append(logout_button, account_button);

    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into this website.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
       
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId: '1665864463643141',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.2' // use version 2.2
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        $('#status').html('');
        console.log('Successful login for: ' + response.name);
        var welcome_div = $('<div>').addClass('welcome_message').text('Welcome, ' + response.name);
        var user_div = $('<div>').addClass('btn-group pull-right');
        var user_button = $('<button>').attr('type','button').addClass('user_div btn btn-default dropdown-toggle').attr('data-toggle','dropdown').attr('aria-haspopup','true').attr('aria-expanded','false').html('<i class="fa fa-user"></i> <span class="caret"></span>');
        var user_list = $('<ul>').addClass('dropdown-menu');
        var link_to_logout = $('<li>').html("<a href='index.php?page=logout'>Logout</a>");
        var link_to_account = $('<li>').html("<a href='index.php?page=account'>Account</a>");
        var messages_button = $('<button>').addClass('btn btn-primary message_notification pull-right').attr('type','button').html('<a href="index.php?page=messages">Inbox</a><span class="badge">0</span>');
        $(link_to_logout).click(function() {
            logout();
        });
        $(user_list).append(link_to_account, link_to_logout);
        $(user_div).append(user_button, user_list);
        $('#status').append(welcome_div);
        $('.user_links').append(user_div, messages_button);
    }); 
}

//     <div class="btn-group">
//   <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//     <i class='fa fa-user'></i> <span class="caret"></span>
//   </button>
//   <ul class="dropdown-menu">
//     <li><a href="index.php?page=account">Account</a></li>
//     <li><a href="index.php?page=logout">Logout</a></li>
//   </ul>
// </div>
// }

function API_call() {
    FB.api('/me', function(response) {
        $.ajax({
            url: 'login_handler.php',
            data: {
                first_name: response.first_name,
                last_name: response.last_name,
                id: response.id,
                email: response.email,
            },
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('account created');
                    $('.modal-body').text('Thank You for Logging in. A new account has been created for you. You can now start to posting shoes and contacting sellers!');
                    $('#myModal').modal('show');
                } else if (!response.success) {
                    console.log('account already exists');
                }
            }
        });
    });
};

function logout() {
    FB.logout(function(response) {
        $('.login_button').show();
        $('#status').html('');
        $('.logout_button').remove();
        $('.account_button').remove();
        statusChangeCallback(response);

    });
};


$(document).ready(function() {
    $('.navbar-nav>li>a').click(function(){
    console.log('function firing');
    $('.navbar-nav>li>a').css('color','#aaaaaa');
    $(this).css('color','black');
    });
    
    $('.brands > p').click(function() {
        $.ajax({
            url: 'brand_search_handler.php',
            data: {
                brand: $(this).html()
            },
            dataType: 'json',
            method: 'POST',
            success: function(response) {
                $('.item_container').html('');
                console.log(response.items[0].brand);
                var brand_title = $('<div>').addClass('col-xs-12 brand_title').html(response.items[0].brand);
                $('.item_container').append(brand_title);
                display_images(response);

            }
        });
    });
    $('.search_button').click(function(){
            $.ajax({
                url: 'search_handler.php',
                data:{shoe_description: $('.search_input').val()},
                method:'POST',
                dataType: 'json',
                success:function(response){
                    console.log($('.search_input').serialize());
                    $('.item_container').html('');
                    $('.brands').remove();
                    var search_title = $('<h4>').text('Search Results For: ' + response.title);
                    $('.item_container').append(search_title);
                    display_images(response);
                    $('.refine_search').html('');
                    var refine_search_title = $('<h4>').text('Refine Search');
                    var refine_size_input = $('<input>').attr('placeholder', 'Size').addClass('refine_size_input');
                    var refine_price_input = $('<input>').attr('placeholder', 'Max Price').addClass('refine_price_input');
                    var refine_zipcode_input = $('<input>').attr('placeholder','Zip Code').addClass('refine_zipcode_input');
                    var refine_zipcode_miles = $('<select>').addClass('miles').attr('name','miles').html('<option value="25">25 Miles</option><option value="50">50 Miles</option><option value="100">100 Miles</option>')
                    var refine_button = $('<button>').attr({type: 'button'}).text('Search').addClass('btn btn-default');
                    $('.refine_search').append(refine_search_title, refine_size_input, refine_price_input, refine_zipcode_input,refine_zipcode_miles, refine_button);

                    $(refine_button).click(function(){
                        $.ajax({
                            url: 'refine_size_handler.php',
                            data: {size: $('.refine_size_input').val(), price: $('.refine_price_input').val(), zipcode: $('.refine_zipcode_input').val(), miles: $('.miles').val()},
                            method: 'POST',
                            dataType: 'json',
                            success:function(response){
                                $('.item_container').html('');
                                var search_title_size = $('<h4>').text('Search Results For: ' + response.title);
                                $('.item_container').append(search_title_size);
                                display_images(response);
                            }
                        })
                    });


                }

            });
    });

});
