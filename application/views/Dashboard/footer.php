        </div>
      </div> <!-- Main Container -->
      <script src="/assets/dashboard/toastr/toastr.min.js"></script>      
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
      <script src="/assets/js/tez_header.js"></script>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <?php if($this->session->userdata('autosalon')==1){ ?>
      <?php if(isset($map) && $map): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1DaQZa2SGmEf4fihVZbhjFQqZASUQ5YM&libraries=places&language=az" async defer>
        </script>
        <script src="/assets/js/map.js"></script>
      <?php endif; } ?>
    </body>
</html>
