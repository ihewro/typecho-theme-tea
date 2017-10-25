/// Shop-specific scripts
function mobileLayout() {
  return $(window).width() < 768;
}

var lightbox_min_window_width = 768;
var lightbox_min_window_height = 580;

$('html').removeClass('no-js');

jQuery(function($){
  
  /// Header images
  var $head_bg = $('#pageheader img.background');
  //If header exists... (remember switch from port->land on 7" tablet)
  if($head_bg.length > 0) {
    var fillModeIsCover = $('#pageheader .head-img-cont.fillmode-cover').length == 1;
    $('body').addClass('header-has-bg');
    if(fillModeIsCover) {
      $head_bg.willFillParent({ closest: '.head-img-cont', windowEvent: 'updateheaderimg debouncedresize' });
    }
    $head_bg.imagesLoaded(function(){
      
      $('<div class="background-shadow main"/><div class="background-shadow content-top"><div class="container"></div></div>')
      .css('opacity', 0).insertAfter($head_bg).animate({opacity:1}, 500);
      
      $head_bg.animate({opacity:1}, 500);
      $(window).trigger('updateheaderimg');
    });
    
    
    //Subtle parallax
    //Skip on tablets, for all manner of reasons
    var mobile = /iPad|iPhone|iPod|android|blackberry|mini|windows\sce|palm/i.test( navigator.userAgent );
    mobile || $(window).on('scroll scrollheaderbackground', function(){
      
      var h = $('#pageheader .head-img-cont').height();
      var scrollAmt = $(window).scrollTop();
      var fracScrolledPastImage = scrollAmt > h ? 1 : scrollAmt / h;
      var newOffsetTop = fracScrolledPastImage * h / 2; // Change '2' to adjust relative scroll
      
      if(fillModeIsCover) {
        $head_bg.css('margin-top', newOffsetTop);
      } else {
        $('#pageheader .head-img-cont').css('background-position', 'center ' + newOffsetTop + 'px');
      }
    }).trigger('scrollheaderbackground');
    
  }
  
  /// Galleries (only on large screens)
  if($(window).height() >= lightbox_min_window_height && $(window).width() >= lightbox_min_window_width) {
    $('a[rel="gallery"]').colorbox({rel:'gallery'});
  }
       
  /// Main nav
       
  /// Sub-navs (aria-haspopup is for IE touchscreens)
  $('#pageheader .nav ul li:has(ul)').addClass('has-children').children('a').attr('aria-haspopup', 'true');
  
  //Remove aria from subnav if it is permanently visible
  
  $('#pageheader .nav ul li.has-children ul a').removeAttr('aria-haspopup');
  
       
  //Double tap plugin courtesy of http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly
  //Handles showing dropdowns nicely on all devices. Only needed when not using mobile nav.
  if($('#pageheader .links-etc').css('position') != 'fixed') {
    $('#pageheader .nav > ul > li.has-children').doubleTapToGo();
  }
  //Extra event to handle when inner menus are expanded
  $('#pageheader .nav > ul > li.has-children a:not([aria-haspopup="true"])').on('click', function(){ window.location = $(this).attr('href') });
       
  //If expanding dropdown, make sure it's fully visible
  $('#pageheader').on('mouseenter', '.nav > ul > li.has-children', function(){
    var $dropdown = $(this).children('ul');
    $dropdown.toggleClass('anchor-right', $(this).offset().left + $dropdown.width() > $('#pageheader').width());
  });
       
  // Expanding sub-sub-nav
  $('#pageheader').on('click', '.nav li.has-children > a', function(){
    var $sub = $(this).siblings('ul');
    if($sub.css('min-height') == '1px') { // Make sure it's allowed to expand
      if($(this).parent().toggleClass('reveal').hasClass('reveal')) {
        $sub.slideDown(250);
      } else {
        $sub.slideUp(250);
      }
      return false;
    }
  });
  
  /// Mobile nav
  $(document).on('click', '.mobile-nav-toggle', function(e){
    e.preventDefault();
    $('body').toggleClass('reveal-mobile-nav');
  });
  $('<a href="#" class="mobile-nav-toggle" id="mobile-nav-return"></a>').appendTo('body');
  
  /// Button to scroll to the top (I've never really understood the point of these)
  $(window).on('scroll', function(){
    $('body').toggleClass('reveal-scroll-top', $(window).scrollTop() > 500);
  });
  $('#scroll-top').on('click', function(e){
    e.preventDefault();
    $('html:not(:animated),body:not(:animated)').animate({ scrollTop: 0}, 500 );
  });
  
  /// Modal search
  $(document).on('click', 'a[href="/search"], #search-modal', function(e){
    e.preventDefault();
    $('body').toggleClass('reveal-search-modal');
    if($('body').hasClass('reveal-search-modal')) {
      $('#search-modal input[name="q"]').focus();
    }
  }).on('click', '#search-modal form', function(e){
    e.stopPropagation(); // Don't trigger click on parents
  });
  
  /// Any slideshows?
  var defaultFlexsliderOpts = {
    controlNav: false,
    animation: 'fade', // 'slide' will also work
    slideshowSpeed: 7000 // delay between changing slides, default: 7000 (milliseconds)
  };
  $('.flexslider').flexslider(defaultFlexsliderOpts);
       
  /// Text that scales up/down based on container width
  var full_site_width = 1024;
  $(window).on('resizeScalingText debouncedresize', function(){
    $('.scaled-text').each(function(){
      var $base = $(this).closest('.scaled-text-base');
      var scale = $base.width() / (typeof $base.data('text-scale-from') != 'undefined' ? $base.data('text-scale-from') : full_site_width);
      $(this).css('font-size', (scale * 100) + '%');
  	});
  }).trigger('resizeScalingText');
       
  /// Gallery
  $('.product-photos').on('click', '.thumbnails .thumb', function(e){
    e.preventDefault();
    var $photoCont = $(this).closest('.product-photos');
    var $imgToChange = $photoCont.find('.main img');
    if($imgToChange.attr('alt', $(this).attr('title')).fadeToAnotherImage($(this).data('display-url'))) {
      $photoCont.find('.main a').attr({ href: $(this).attr('href'), title: $(this).attr('title') });
      $(this).addClass('active').siblings('.active').removeClass('active');
    }
  }).on('click', '.load-all-thumbs', function(){
    //Expand all thumbs, removing gallery feature
    var $cont = $(this).closest('.product-photos').addClass('expanded-all');
    var $thumbs = $cont.find('.thumbnails');
    //Lightboxes?
    var usingLightbox = $cont.find('.main a').length > 0;
    //Revert main image to first thumbnail
    $thumbs.find('.thumb:first').click();
    //Create new images
    $thumbs.find('.thumb:not(:first)').each(function(index){
      var $img = $('<img/>').attr({ src: $(this).data('display-url'), alt: $(this).attr('title') }).hide();
      var $row = $('<div class="main exp-image loading-img"/>');
      if(usingLightbox) {
        $row.append( $('<a/>').attr({ href: $(this).attr('href'), title: $(this).attr('title') }).append($img) );
      } else {
        $row.append($img);
      }
      $row.appendTo($cont).imagesLoaded(function(){
        $row.height($row.height());
        $img.css('opacity', 0).show().animate({opacity:1}, 2000);
        $row.animate({height: $img.height()}, 1000, function(){
          $(this).css('height', '');
        });
      });
    });
    $thumbs.remove();
    return false;
  }).on('click', '.main a', function(e){
    e.preventDefault();
    //Don't do anything if the screen isn't very tall, otherwise, lightbox!
    if($(window).height() >= lightbox_min_window_height && $(window).width() >= lightbox_min_window_width) {
      var $prodPhotoCont = $(this).closest('.product-photos');
      if($prodPhotoCont.find('img').length == 1) {
        //One image only?
        $.colorbox({ href: $(this).attr('href') });
      } else {
        //Many images. Dupe thumbs to create a faux-gallery
        var imgSel = $prodPhotoCont.find('.main').length > 1 ? '.main' : '.thumbnails';
        $('#gallery-cont').remove();
        var $galleryCont = $('<div id="gallery-cont"/>').append(
          $prodPhotoCont.find(imgSel).find('a:has(img)').clone().attr({ rel: 'gallery', title: '' })
        ).hide().appendTo('body');
        //Trigger box (on the right one)
        $galleryCont.children().colorbox().filter('[href="'+$(this).attr('href')+'"]').first().click();
      }
    }
  });


  //Show a quick generic text popup above an element
  window.showQuickPopup = function(message, $origin){
    var $popup = $('<div class="simple-popup"/>');
    var offs = $origin.offset();
    $popup.html(message).css({ 'left':offs.left, 'top':offs.top }).hide();
    $('body').append($popup);
    $popup.css('margin-top', - $popup.outerHeight() - 10);
    $popup.fadeIn(200).delay(3500).fadeOut(400, function(){
      $(this).remove();
    });
  };
       
  
  //Ajax add-to-cart
  var shopifyAjaxAddURL = '/cart/add.js';
  var shopifyAjaxCartURL = '/cart.js';
  var shopifyAjaxStorePageURL = '/search';
   
  $(document).on('submit', 'form[action="/cart/add"]:not(.noAJAX)', function(e) {
    if(mobileLayout()) {
      return true;
    }
    var $form = $(this);
    //Disable add button
    $form.find(':submit').attr('disabled', 'disabled').each(function(){
      var contentFunc = $(this).is('button') ? 'html' : 'val';
      $(this).data('previous-value', $(this)[contentFunc]())[contentFunc]("Adding...");
    });
    
    //Add to cart
    $.post(shopifyAjaxAddURL, $form.serialize(), function(itemData) {
      //Enable add button
      $form.find(':submit').each(function(){
        $btn = $(this);
        var contentFunc = $(this).is('button') ? 'html' : 'val';
        //Set to 'DONE', alter button style, wait a few secs, revert to normal
        $btn[contentFunc]("Added to cart");
        setTimeout(function(){
          $btn.removeAttr('disabled')[contentFunc]($btn.data('previous-value'));
        }, 4000);
      });
      
      //Update header summary
      $.get(shopifyAjaxStorePageURL, function(data){
        var cartSummarySelector = '#pageheader .checkout-link';
        var $newCartObj = $($.parseHTML('<div>' + data + '</div>')).find(cartSummarySelector);
        var $currCart = $(cartSummarySelector);
        $currCart.replaceWith($newCartObj);
        //Show cart dropdown for a few seconds
        $newCartObj.addClass('reveal');
        setTimeout(function(){
          $newCartObj.removeClass('reveal');
        }, 4000);
      });
      
      
    }, 'text').error(function(data) {
      //Enable add button
      var $firstBtn = $form.find(':submit').removeAttr('disabled').each(function(){
        var $btn = $(this);
        var contentFunc = $btn.is('button') ? 'html' : 'val';
        $btn[contentFunc]($btn.data('previous-value'))
      }).first();
      
      //Not added, show message
      if(typeof(data) != 'undefined' && typeof(data.status) != 'undefined') {
        var jsonRes = $.parseJSON(data.responseText);
        window.showQuickPopup(jsonRes.description, $firstBtn);
      } else {
        //Some unknown error? Disable ajax and submit the old-fashioned way.
        $form.addClass('noAJAX');
        $form.submit();
      }
    });
    return false;
  });
  
       
  //General lightbox for all
  $('a[rel=lightbox]').colorbox();
       
  //Immmediately select contents when focussing on some inputs
  $(document).on('focusin click', 'input.select-on-focus', function(){
    $(this).select();
  }).on('mouseup', 'input.select-on-focus', function(e){
    e.preventDefault(); //Prevent mouseup killing select()
  });
       
  //Product blocks to have consistent heights, purely visual
  $(window).on('load debouncedresize checkcaptionheights', function(){
    var $firstBlock = $('.prod-block:first');
    var productsPerRow = Math.round($firstBlock.parent().width() / $firstBlock.width());

    var $caps = $('.prod-caption');    
    for(var i = 0; i < Math.ceil($caps.length / productsPerRow); i++) {
      var $toProcess = $caps.slice(i*productsPerRow, (i+1)*productsPerRow);
      var h = 0;
      $toProcess.each(function(){
        var ch = $(this).children().outerHeight();
        if(ch > h) h = ch;
      }).height(h);
    }
  }).trigger('checkcaptionheights');
});
