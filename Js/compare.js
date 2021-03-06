function compare_init(){       
  if(localStorage.getItem('cs-compare') == null || localStorage.getItem('cs-compare') == '[]' ){
    $('#comparecontent .none').css( 'display', 'block' );
    $('#comparecontent ul').css( 'display', 'none' );
    $('#comparecontent .compare-count').css( 'display', 'none' );
  }
  else{
    var activeID = [];
    activeID = JSON.parse(localStorage.getItem('cs-compare'));
    for(i=0; i<activeID.length; i++ ){
      var classadded = '.compare-'+activeID[i];        
      $(classadded).addClass("compare-added").removeClass("compare");
    }
  }
}

function compare_add(){
  $( "a.compare" ).on( "click", function(e) {
    if(!$(this).hasClass('compare-added')){
      e.preventDefault();                        
	  $('#quick-shop-modal').modal('hide');
      //store product ID      
      var storeID = [];        
      if(localStorage.getItem('cs-compare') == null )
        storeID = [];
      else
        storeID = JSON.parse(localStorage.getItem('cs-compare'));
      if(storeID.length < 3){
        storeID.push($(this).data("comparehandle"));        
        localStorage.setItem('cs-compare', JSON.stringify(storeID));        

        //add class and update count
        $('.compare-'+$(this).data("comparehandle")).addClass("compare-added").removeClass("compare").attr("title","Compare Added");; 

        var url="/products/"+$(this).data("comparehandle")+".js";
        var content = '#modalCompare';
        jQuery.getJSON(url, function(product) {
          $("#modalCompare").find('.compare-image').attr('class','compare-image modal-image compare-image-'+product.id);
          $("#modalCompare").find('.compare-image').html('<img src="'+product.featured_image+'" alt="'+product.title+'" />');
          $("#modalCompare").find('.compare-name').html('<a href="'+product.url+'">'+product.title+'</a>'); 
          $("#modalCompare").find('.compare-price').attr('class','compare-price compare-price-'+product.id);
          $("#modalCompare").find('.variants-form').attr('id','compare-form-cart-'+product.id);
          $("#modalCompare").find('.add-to-cart').attr('id','compare-addToCart-'+product.id);
          $("#modalCompare").find('.variants-wrapper').attr('id','compare-variants-container-'+product.id);

          addToVariantsCompare(product);
        });
        //Modal
        $('#modalCompare').modal();
      }
      else{
        //Modal
        $('#modalCompare1').modal();
      }
    }     
  });
} 

function compare_show(){    
  var cont = '#comparecontent ul',
      productjson = '/products.js',
      getID= [];
  if(localStorage.getItem('cs-compare') != null ){
    getID = JSON.parse(localStorage.getItem('cs-compare'));
    $('.compare-page .compare-count').html(getID.length+' Saved products');
    for(j=0; j<getID.length; j++){
      var url = "/products/"+getID[j]+".js";
      
      jQuery.getJSON(url, function(product) {
        var wcn = ".compare-"+product.handle;              
        $(cont).append('<li class="compare compare-'+product.handle+'"><div class="compare-remove" data-comparehandle="'+product.handle+'"><span class="cs-icon icon-close"></span></div><div class="compare-image compare-image-'+product.id+'"></div><div class="compare-name"></div><div class="compare-price compare-price-'+product.id+'"></div><div class="compare-addCart"></div></li>');                    
        $(wcn).find('.compare-image-'+product.id).append('<img src="'+product.featured_image+'" alt="" />');
        $(wcn).find('.compare-name').append('<a href="'+product.url+'">'+product.title+'</a>');
        
        $(wcn).find('.compare-addCart').append('<form action="/cart/add" method="post" class="variants" id="compare-form-cart-'+product.id+'" enctype="multipart/form-data"><div id="compare-variants-container-'+product.id+'" class="variants-wrapper"></div><div class="quantity-content"><label>QTY</label><input type="text" size="5" class="item-quantity item-quantity-qs" name="quantity" value="1" /></div><div class="others-bottom"><a id="compare-addToCart-'+product.id+'" class="_btn btn-quick-shop add-to-cart">Add to cart</a><div class="compare-remove" data-comparehandle="'+product.handle+'"><span class="lnr lnr-trash"></span></div></div></form>');  
                            
        addToVariantsCompare(product);
        
        $(GLOBAL['common']['init']);
        
        $(wcn).find('.compare-remove').on("click", function(){ 
          $(wcn).hide("fade");
          $(wcn).remove();
          var storeID2= [],
              ri = $(this).data("comparehandle");            
          storeID2 = JSON.parse(localStorage.getItem('cs-compare'));            
          storeID2 = jQuery.grep(storeID2, function(value) {
            return value != ri;
          });
          localStorage.setItem('cs-compare', JSON.stringify(storeID2));
          if(storeID2.length == 0){
            $('#comparecontent .none').css( 'display', 'block' );
            $('#comparecontent ul').css( 'display', 'none' );
            $('#comparecontent .compare-count').css( 'display', 'none' );
          }
          $('.compare-page .compare-count').html(storeID2.length+' Saved products');
        });
        $(wcn).find('.compare-detail').append('<a href="'+product.url+'">View More</a>');
        
      });
      
    }
  }
  else{
    $('.compare-0').hide();
    $('#comparecontent .none').show();
  }
  
}

function addToVariantsCompare(product){
  var selectedProduct = product;
  
  var selectedProductID = selectedProduct.id;
  var productVariants = selectedProduct.variants;
  var quickShopVariantsContainer = $('#compare-variants-container-'+selectedProductID);
  var quickShopAddButton = $('#compare-addToCart-'+selectedProductID);
  var quickShopAddToCartButton = $('#compare-addToCart-'+selectedProductID); 
  quickShopVariantsContainer.html('');
  var productVariantsCount = product.variants.length;
  var quickShopPriceContainer = $('.compare-price-'+selectedProductID);
  if (productVariantsCount > 1) {  
        // Reveal variants container
        quickShopVariantsContainer.show();
          
        // Build variants element
        var quickShopVariantElement = $('<select>',{ 'id': ('compare-variants-' + selectedProductID) , 'name': 'id'});
        var quickShopVariantOptions = '';
        for (var i=0; i < productVariantsCount; i++) {
          quickShopVariantOptions += '<option value="'+ productVariants[i].id +'">'+ productVariants[i].title +'</option>'
        };
        
        // Add variants element to page
        quickShopVariantElement.append(quickShopVariantOptions);
        quickShopVariantsContainer.append(quickShopVariantElement);
          
        // Bind variants to OptionSelect JS
    
        new Shopify.OptionSelectors(('compare-variants-' + selectedProductID), { product: selectedProduct, onVariantSelected: selectOptionCallbackCompare });
        
        for( var i=0; i < selectedProduct.options.length ; i++ ){
          $('#compare-variants-'+selectedProductID+'-option-'+i).parent().find('label').html(selectedProduct.options[i].name);
        }  
        // Add label if only one product option and it isn't 'Title'.
        if (selectedProduct.options.length == 1 && selectedProduct.options[0] != 'Title' ){
          $('#compare-variants-container-'+selectedProductID+' .selector-wrapper:eq(0)').prepend('<label>'+ selectedProduct.options[0].name +'</label>');
        }
      }
  else { // If product only has a single variant    
        // Hide unnecessary variants container
        quickShopVariantsContainer.hide();  
        // Build variants element
        var quickShopVariantElement = $('<select>',{ 'id': ('compare-variants-' + selectedProductID) , 'name': 'id'});
        var quickShopVariantOptions = '';
          
        for (var i=0; i < productVariantsCount; i++) {
          quickShopVariantOptions += '<option value="'+ productVariants[i].id +'">'+ productVariants[i].title +'</option>'
        };
        quickShopVariantElement.append(quickShopVariantOptions);
        quickShopVariantsContainer.append(quickShopVariantElement);  
        quickShopAddToCartButton.removeAttr('disabled').fadeTo(200,1);
        quickShopAddToCartButton.data('variant-id', productVariants[0].id);
        if (selectedProduct && selectedProduct.available) {
          if ( productVariants[0].compare_at_price > 0 && productVariants[0].compare_at_price > productVariants[0].price ) {
            quickShopPriceContainer.html('<span class="price">'+ Shopify.formatMoney(productVariants[0].price, quickShop_money_format) +'</span>'+'<del class="price_compare">'+ Shopify.formatMoney(productVariants[0].compare_at_price, quickShop_money_format) + '</del>' );
          } else {
            quickShopPriceContainer.html('<span class="price">'+ Shopify.formatMoney(productVariants[0].price, quickShop_money_format) + '</span>' );
          }  
        }
        else {
		  quickShopAddToCartButton.attr('disabled', 'disabled').fadeTo(200,0.5);
          var message = selectedProduct ? "Sold Out" : "Unavailable";    
          quickShopPriceContainer.html('<span class="unavailable">' + message + '</span>');
        }
      } // END of (productVariantsCount > 1)
  
  // Update currency
  currenciesCallbackSpecial($('.compare-price-'+selectedProductID+' span.money'));
  
}
/* selectOptionCallback
    ===================================== */
var selectOptionCallbackCompare = function(variant, selector) {
  var quickShopAddButton = $('#compare-addToCart-'+selector.product.id);
  var quickShopAddToCartButton = $('#compare-addToCart-'+selector.product.id); 
  
  var quickShopPriceContainer = $('.compare-price-'+selector.product.id);
  //change image
  if (variant && variant.featured_image) {
    var newImage = variant.featured_image; // New image object.
    $('.compare-image-'+variant.featured_image.product_id+' img').attr('src',newImage.src);
  }

  //change
  if (variant && variant.available) {
    quickShopAddToCartButton.data('variant-id', variant.id);
    quickShopAddToCartButton.removeAttr('disabled').fadeTo(200,1);        
    // determine if variant is on sale
    if ( variant.compare_at_price > 0 && variant.compare_at_price > variant.price ) {
      quickShopPriceContainer.html('<span class="price">'+ Shopify.formatMoney(variant.price, quickShop_money_format) +'</span>' + '<del class="price_compare">'+ Shopify.formatMoney(variant.compare_at_price, quickShop_money_format) + '</del>');
    } else {
      quickShopPriceContainer.html('<span class="price">'+ Shopify.formatMoney(variant.price, quickShop_money_format) + '</span>' );
    };     
    // selected an invalid or out of stock variant 
  } else {
    // variant doesn't exist
    quickShopAddToCartButton.attr('disabled', 'disabled').fadeTo(200,0.5);
    var message = variant ? "Sold Out" : "Unavailable";    
    quickShopPriceContainer.html('<span class="unavailable">' + message + '</span>');         
  }
  //swatch
  var form = jQuery('.quick-shop form.variants');
  if(variant!=null){
    for (var i=0,length=variant.options.length; i<length; i++) {
      var radioButton = form.find('.swatch[data-option-index="' + i + '"] :radio[value="' + variant.options[i] +'"]');
      if (radioButton.size()) {
        radioButton.get(0).checked = true;
      }
    }
  }

  
  // Update currency
  currenciesCallbackSpecial(quickShopPriceContainer.find('span.money'));
  
} 
$(window).ready(function($) {
  //LocalStore
  compare_init();
  compare_add();
  if(comparepage == 1) compare_show();
});