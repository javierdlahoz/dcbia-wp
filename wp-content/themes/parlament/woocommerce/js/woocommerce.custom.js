jQuery(document).ready(function($) {
	icy_downloadable_prod_cartadd();
	icy_cartdropdown_hover();
	icy_track_add_to_cart();
	icy_add_product_to_cart();
	setTimeout(on_refresh_load, 10);
	jQuery('body').bind('added_to_cart', update_cart_dropdown);

	jQuery(".quantity input[type=number]").each(function()
	{
		var number = $(this),
			newNum = jQuery(jQuery('<div />').append(number.clone(true)).html().replace('number','text')).insertAfter(number);
			number.remove();
	});
});

var icy_clicked_product = {};
function icy_track_add_to_cart()
{
	jQuery('body').on('click','.add_to_cart_button', function()
	{	
		var productContainer = jQuery(this).parents('.product').eq(0), product = {};
			product.name	 = productContainer.find('h3').text();
			product.image	 = productContainer.find('img');
			product.price	 = productContainer.find('.price .amount').last().text();			
			
			if(product.image.length) product.image = "<img class='added-product-image' src='" + product.image.get(0).src + "' title='' alt='' />";
			
			icy_clicked_product = product;
	});
}

function update_cart_dropdown(event)
{
	var menu_cart 		= jQuery('.icy_cart_dropdown'),
		empty 			= menu_cart.find('.empty'),
		msg_success		= menu_cart.data('success'),
		dropdown_cart 	= menu_cart.find('.dropdown_widget_cart:eq(0)'),
		subtotal 		= menu_cart.find('.cart_subtotal'),
		subtotal_new 	= dropdown_cart.find('.total .amount'),
		product 		= jQuery.extend({name:"Product", price:"", image:""}, icy_clicked_product);
		
		if(!empty.length)
		{
			menu_cart.addClass('visible_cart');
		}
		
		if(typeof event != 'undefined')
		{
			var header		 =  jQuery('.icy_cart_dropdown_first'),
				subtotal 	 = jQuery('.icy_cart_dropdown .cart_subtotal'),
				template 	 = jQuery("<div class='added_to_cart_notification'><div class='added-product-text'><strong>\"" + product.name +"\"</strong> "+ msg_success+ "</div> " + product.image +"</div>").css( 'opacity', 0 );
			
			if(!header.length) header = 'body';

			setTimeout(function(){ subtotal.html(subtotal_new.html()); }, 500);
				
			template.bind('mouseenter icy_hide', function()
			{
				template.animate({opacity:0, top: parseInt(template.css('top'),10) + 15 }, function()
				{
					template.remove();
				});
				
			}).appendTo(header).animate({opacity:1},500);
			
			setTimeout(function(){ template.trigger('icy_hide'); }, 2500);
		}
}

function on_refresh_load()
{
	var limit = 5, counter = 0, ms = 500,

		check = function()
		{
			var new_total = jQuery('.icy_cart_dropdown .dropdown_widget_cart:eq(0) .total .amount');			
			if(new_total.length)
			{
				update_cart_dropdown();
			}
			else
			{
			counter++;
				if(counter < limit)
				{
					setTimeout(check, ms);
				}
			}
		};		
	check();
}

function icy_add_product_to_cart()
{
	var body = jQuery('body');

	body.on('click', '.add_to_cart_button', function(){
		var product = jQuery(this).parents('.product:eq(0)').addClass('adding-to-cart-loading').removeClass('added-to-cart-check');
	});
	
	body.bind('added_to_cart', function(){
		jQuery('.adding-to-cart-loading').removeClass('adding-to-cart-loading').addClass('added-to-cart-check');
	});
}

function icy_downloadable_prod_cartadd()
{		
	jQuery('.product_type_downloadable, .product_type_virtual').addClass('product_type_simple');
}

function icy_cartdropdown_hover()
{
	var dropdown = jQuery('.icy_cart_dropdown'), subelement = dropdown.find('.dropdown_widget').css({display:'none', opacity:0});
	
	dropdown.hover(
	function(){ subelement.css({display:'block'}).stop().animate({opacity:1}); },
	function(){ subelement.stop().animate({opacity:0}, function(){ subelement.css({display:'none'}); }); }
	);
}



