<!-- login -->
<!--===============================================================================================-->
	<script src="{{url('/')}}/adminlte/login/js/frontend.js"></script>
<!--===============================================================================================-->
	<script src="/adminlte/login/vendor/animsition/js/animsition.min.js"></script>



        <script src="{{url('/')}}/frontend/js/jquery-3.4.1.min.js"></script>
        <script src="{{url('/')}}/frontend/js/bootstrap.min.js"></script>
        <script src="{{url('/')}}/frontend/js/wow.min.js"></script>
        <script src="{{url('/')}}/frontend/js/frontend.js"></script>
        <script>

            new WOW().init();
            $(function(){

                $('#sections').change(function () {
                     if (this.options[this.selectedIndex].value == 'teacher') {
                         $('.code').slideUp();
                     }

                     if (this.options[this.selectedIndex].value == 'doctor') {
                         $('.code').slideUp();
                     }

                     if (this.options[this.selectedIndex].value == 'student') {
                         $('.code').slideDown();
                     }
                 });
            });
        </script>
    </body>
</html>
