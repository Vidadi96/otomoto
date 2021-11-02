
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

	console.log('something');
	$('#registrationForm').validate({
		rules: {
			name: {
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

//COMEMMEKSFKDKSNF

//-----
