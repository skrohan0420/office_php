<!-- <!DOCTYPE html> -->
<!-- <html> -->

<!-- <head> -->
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width initial-scale=1.0"> -->
    <!-- <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Login</title> -->
    <!-- GLOBAL MAINLY STYLES-->
    <!-- <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" /> -->
    <!-- <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" /> -->
    <!-- <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" /> -->
    <!-- THEME STYLES -->
    <!-- <link href="assets/css/main.css" rel="stylesheet" /> -->
    <!-- PAGE LEVEL STYLES-->
    <!-- <link href="./assets/css/pages/auth-light.css" rel="stylesheet" /> -->
    <!-- <style>
        .input-icon{
            cursor: pointer;
        }
    </style> -->
<!-- </head> -->

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <div class="link"><img src="<?= base_url('assets/img/logo.png') ?>" alt=""></div>
        </div>
        <form id="login-form" action="<?= base_url('Admin/login') ?>" method="post">
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon" id="open-eye"><i class="fa fa-eye font-16" ></i></div>
                    <div class="input-icon" id="close-eye"><i class="fa fa-eye-slash font-16" ></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password" id="pass">
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox">
                    <span class="input-span"></span>Remember me</label>
                <!-- <a href="forgot_password.html">Forgot password?</a> -->
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
        <!-- <div class="social-auth-hr">
                <span>Or login with</span>
            </div>
            <div class="text-center social-auth m-b-20">
                <a class="btn btn-social-icon btn-twitter m-r-5" href="javascript:;"><i class="fa fa-twitter"></i></a>
                <a class="btn btn-social-icon btn-facebook m-r-5" href="javascript:;"><i class="fa fa-facebook"></i></a>
                <a class="btn btn-social-icon btn-google m-r-5" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                <a class="btn btn-social-icon btn-linkedin m-r-5" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                <a class="btn btn-social-icon btn-vk" href="javascript:;"><i class="fa fa-vk"></i></a>
            </div>
            <div class="text-center">Not a member?
                <a class="color-blue" href="register.html">Create accaunt</a>
            </div> -->
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>


    
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <!-- <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script> -->
    <!-- <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script> -->
    <!-- <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script> -->
    <!-- PAGE LEVEL PLUGINS -->
    <!-- <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script> -->
    <!-- CORE SCRIPTS-->
    <!-- <script src="assets/js/app.js" type="text/javascript"></script> -->
    <!-- PAGE LEVEL SCRIPTS-->
    <!-- <script type="text/javascript"> -->

        <!-- $(document).ready(function(){
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
        }) -->

    <!-- </script> -->
<!-- </body> --> 
<!-- </html> -->