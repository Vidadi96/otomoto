$(document).ready(function() {
  var message = $('input[name="message"]').val();
  if(message == 1)
    toastr.success('Mesajınız göndərildi. Sorğunuza tezliklə baxılacaq', 'Uğur');
  else if(message == 2)
    toastr.success('Xəta baş verdi. Xaiş olunur yenidən cəhd edin. Mətnin həcmi 500 simvoldan çox olmamalıdır', 'Xəta');
});
