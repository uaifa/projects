 </div>
    </div>
</div>
  <script type="text/javascript" src="{{ asset('assets') }}/js/jquery.min.js"></script>
  <!-- Bootstrap core JS-->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>

    <script type="text/javascript">
      $(".toggle-password").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
          input = $(this).parent().find("input");
          if (input.attr("type") == "password") {
              input.attr("type", "text");
          } else {
              input.attr("type", "password");
          }
      });

    </script>
    @stack('js')
</body>

</html>
