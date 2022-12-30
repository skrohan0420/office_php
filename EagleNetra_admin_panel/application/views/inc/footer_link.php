 <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <!-- <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('./assets/vendors/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
    <!-- <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('./assets/vendors/popper.js/dist/umd/popper.min.js')?>" type="text/javascript"></script>
    <!-- <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('./assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <!-- <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('./assets/vendors/jquery-validation/dist/jquery.validate.min.js')?>" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <!-- <script src="assets/js/app.js" type="text/javascript"></script> -->
    <script src="<?= base_url('assets/js/app.js')?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

        $(document).ready(function(){
            $(function() {
                $('#login-form').validate({
                    errorClass: "help-block",
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true
                        }
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                });
            });
            $('#close-eye').hide();
            $('#open-eye').on('click', function(){
                $('#pass').attr('type', 'text')
                $('#open-eye').hide();
                $('#close-eye').show();
            })
            $('#close-eye').on('click', function(){
                $('#pass').attr('type', 'password')
                $('#close-eye').hide();
                $('#open-eye').show();
            })
        })

    </script>
</body>

</html>