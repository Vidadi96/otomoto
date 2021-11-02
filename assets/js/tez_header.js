
// KATALOG OPEN AND CHANGE FIXED POSITION TO ABSOLUTE

$('#katalog').hover(
function(){
	$('#header').css('position', 'absolute').css('top', ($(document).scrollTop()-90))
},
function(){
	$('#header').css('position', 'fixed').css('top', '0')
})

// OPEN SEARCH FORM

$(document).on('click', '.search-button', function () {
	$(this).parent().parent().toggleClass('active')
})

// SHOW AND HIDE PASSWORD

function view(id1, id2) {
		$('#' + id1).addClass('noview')
		$('#' + id2).prop('type', 'text')
}

function noview(id1, id2) {
		$('#' + id1).removeClass('noview')
		$('#' + id2).prop('type', 'password')
}

// CLOSE LOGIN FORM

$('#close').click(function(){
	$('.zanaveska').hide()
})

// OPEN LOGIN form

$('#signIn').click(function(){
	$('.zanaveska').show()
	if(!$('.login').hasClass('activeTitle'))
	{
		$('.registration').removeClass('activeTitle')
		$('.login').addClass('activeTitle')
		$('#loginForm').show()
		$('#forRegistrationScroll').hide()
	}
})

$('#signIn2').click(function(){
	$('.zanaveska').show();
	if(!$('.login').hasClass('activeTitle'))
	{
		$('.registration').removeClass('activeTitle')
		$('.login').addClass('activeTitle')
		$('#loginForm').show()
		$('#forRegistrationScroll').hide()
	}
})

// OPEN REGISTRATION form

$('#registration').click(function(){
	$('.zanaveska').show()
	if(!$('.registration').hasClass('activeTitle'))
	{
		$('.login').removeClass('activeTitle')
		$('.registration').addClass('activeTitle')
		$('#forRegistrationScroll').show()
		$('#loginForm').hide()
	}
});

$('#registration2').click(function(){
	$('.zanaveska').show()
	$('.zanaveska').show();
	if(!$('.registration').hasClass('activeTitle'))
	{
		$('.login').removeClass('activeTitle')
		$('.registration').addClass('activeTitle')
		$('#forRegistrationScroll').show()
		$('#loginForm').hide()
	}
})

// TOGGLE REGISTRATION AND Login

$('.login').click(function(){
	if(!$(this).hasClass('activeTitle'))
	{
		$('.registration').removeClass('activeTitle')
		$(this).addClass('activeTitle')
		$('#forRegistrationScroll').hide()
		$('#loginForm').show()
	}
})

$('.registration').click(function(){
	if(!$(this).hasClass('activeTitle'))
	{
		$('.login').removeClass('activeTitle')
		$(this).addClass('activeTitle')
		$('#loginForm').hide()
		$('#forRegistrationScroll').show()
	}
});

// VALIDATE REGISTRATION FORM

$(document).ready(function() {
	$('#registrationForm').validate({
		rules: {
			full_name: {
				required: true
			},
			mail: {
				required: true,
				email: true
			},
			phone: {
				required: true
			},
			password2: {
				required: true,
				minlength: 6
			},
			repeatPassword: {
				equalTo: '#password2'
			}
		},
		messages: {
			full_name: {
				required: 'Bu xananın doldurulması vacibdir'
			},
			mail: {
				required: 'Bu xananın doldurulması vacibdir',
				email: 'Düzgün e-poçt daxil edin'
			},
			phone: {
				required: 'Bu xananın doldurulması vacibdir'
			},
			password2: {
				required: 'Bu xananın doldurulması vacibdir',
				minlength: 'Bu xanaya 6 simvoldan az simvol daxil edilə bilməz'
			},
			repeatPassword: {
				equalTo: 'Şifrələr bir birinə uyğun deyil'
			}
		}
	});
});

function replaceElementTag(targetSelector, newTagString) {
	$(targetSelector).each(function(){
		var newElem = $(newTagString, {html: $(this).html()});
		$.each(this.attributes, function() {
			newElem.attr(this.name, this.value);
		});
		$(this).replaceWith(newElem);
	});
}

replaceElementTag('.subKataloqContent', '<a></a>');
replaceElementTag('.subCategoryContent', '<a></a>');

// CLOSE LOGIN FORM

$('#close2').click(function(){
	$('.zanaveska2').hide()
})

// OPEN LOGIN form

$('#elaqe_click').click(function(){
	$('.zanaveska2').show()
});

	/*----- PHONE INPUT -----*/

	$(document).on('input', '.only_numeric', function(evt){
		let text = $(this).val();
		if (text.length == 4) {
			if (text != '(050' && text != '(051' && text != '(055' && text != '(070' && text != '(077' && text != '(099') {
				alert('Format düzgün deyil!');
				$(this).val('');
				return
			}
		}

		var cursor_pos = $(this).getCursorPosition()
	  if (!(/^[0-9 \(\)\-]{0,15}$/.test($(this).val())) ) {
      $(this).val($(this).attr('data-value'))
      $(this).setCursorPosition(cursor_pos - 1)
      return
	  }
	  $(this).attr('data-value', $(this).val())
	})

	$('.phone_format')

		.keydown(function (e) {
			var key = e.which || e.charCode || e.keyCode || 0;
			$phone = $(this);

	    // Don't let them remove the starting '('
	    if ($phone.val().length === 1 && (key === 8 || key === 46)) {
				$phone.val('(');
	      return false;
			}
	    // Reset if they highlight and type over first char.
	    else if ($phone.val().charAt(0) !== '(') {
				$phone.val('('+String.fromCharCode(e.keyCode)+'');
			}

			// Auto-format- do not expose the mask as the user begins to type
			if (key !== 8 && key !== 9) {
				if ($phone.val().length === 4) {
					$phone.val($phone.val() + ')');
				}
				if ($phone.val().length === 5) {
					$phone.val($phone.val() + ' ');
				}
				if ($phone.val().length === 9) {
					$phone.val($phone.val() + '-');
				}
	      if ($phone.val().length === 12) {
					$phone.val($phone.val() + '-');
				}
			}

			// Allow numeric (and tab, backspace, delete) keys only
			if ($phone.val().length > 14)
				return (key == 8 ||
						key == 9 ||
						key == 46 ||
						(key >= 96 && key <= 105));
			else
				return (key == 8 ||
						key == 9 ||
						key == 46 ||
						(key >= 48 && key <= 57) ||
						(key >= 96 && key <= 105));
		})

		.bind('focus click', function () {
			$phone = $(this);

			if ($phone.val().length === 0) {
				$phone.val('(');
			}
			else {
				var val = $phone.val();
				$phone.val('').val(val); // Ensure cursor remains at the end
			}
		})

		.blur(function () {
			$phone = $(this);

			if ($phone.val() === '(') {
				$phone.val('');
			}
		});


/*----- ONLY ALPHABET -----*/

// $('.alphabet').input(function(e){
//   let key = e.keyCode;
//   return ((key >= 65 && key <= 90) || key == 8 || key == 32);
// })

$(document).on('input', '.alphabet', function(evt){
	var cursor_pos = $(this).getCursorPosition()
  if(!(/^[a-zA-Z ']*$/.test($(this).val())) ) {
      $(this).val($(this).attr('data-value'))
      $(this).setCursorPosition(cursor_pos - 1)
      return
  }
  $(this).attr('data-value', $(this).val())
})

$.fn.getCursorPosition = function() {
    if(this.length == 0) return -1
    return $(this).getSelectionStart()
}
$.fn.setCursorPosition = function(position) {
    if(this.lengh == 0) return this
    return $(this).setSelection(position, position)
}
$.fn.getSelectionStart = function(){
  if(this.lengh == 0) return -1
  input = this[0]
  var pos = input.value.length
  if (input.createTextRange) {
    var r = document.selection.createRange().duplicate()
    r.moveEnd('character', input.value.length)
    if (r.text == '')
    pos = input.value.length
    pos = input.value.lastIndexOf(r.text)
  } else if(typeof(input.selectionStart)!="undefined")
  pos = input.selectionStart
  return pos
}
$.fn.setSelection = function(selectionStart, selectionEnd) {
  if(this.lengh == 0) return this
  input = this[0]
  if(input.createTextRange) {
    var range = input.createTextRange()
    range.collapse(true)
    range.moveEnd('character', selectionEnd)
    range.moveStart('character', selectionStart)
    range.select()
  }
  else if (input.setSelectionRange) {
    input.focus()
    input.setSelectionRange(selectionStart, selectionEnd)
  }
  return this
}


/*----- OPEN SIDE BAR -----*/

$('.bar i').click(function(){
	if ($(this).hasClass('opened')) {
		$('.open_bar').hide(100);
		$(this).removeClass('opened');
		$(this).removeClass('fa-times');
		$(this).addClass('fa-bars');
	} else {
		$('.open_bar').show(200);
		$(this).addClass('opened');
		$(this).addClass('fa-times');
		$(this).removeClass('fa-bars');
	}
})

/*------ FOOTER CHANGE SIZE ------*/

$(document).ready(function() {
	if($(window).width() > 470)
		$('#haqqimizda').css('height', $('#kataloq').height());
});

/*----- CHANGE ICON WITH SCROLL DOWN -----*/

$(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
			var data = '<div class="fmci">' +
										'<i class="fa fa-arrow-up" aria-hidden="true"></i>' +
									'</div>' +
									'<span class="fmct mobile_text">Yuxarı</span>';

			$('.mobile_home').html(data);
			$('.mobile_home').addClass('scroll_top');
		} else {
			var data =  '<a href="/">' +
										 '<div class="fmci">' +
											 '<i class="fa fa-home" aria-hidden="true"></i>' +
										 '</div>' +
										 '<span class="fmct mobile_text">Əsas</span>' +
									'</a>';

			$('.mobile_home').removeClass('scroll_top');
			$('.mobile_home').html(data);
		}
});

$(document).on('click', '.scroll_top', function(){
	window.scrollTo({ top: 0, behavior: 'smooth' });
});

$(document).on('click', '.mobile_category', function(){
	$('.cat_mob_win').animate({width: '100%'}, 200);
	window.scrollTo(0,0);
});

$(document).on('click', '.cat_mob_back', function(){
	$('.cat_mob_win').animate({width: 0}, 200);
});

$(document).on('click', '.open_login', function(event){
	event.preventDefault();
	$('.bar i').trigger('click');
});

/*----- OPEN BUTTONS -----*/

$(document).on('click', 'span.new_ad_button', function(){
	$('.buttons_shadow').css('display', 'flex');
});

$(document).on('click', '.open_buttons', function(){
	$('.buttons_shadow').css('display', 'flex');
});

/*----- CLOSE BUTTONS -----*/

$(document).on('click', '.buttons_close', function(){
	$('.buttons_shadow').css('display', 'none');
});

//COMEMMEKSFKDKSNF

//-----
