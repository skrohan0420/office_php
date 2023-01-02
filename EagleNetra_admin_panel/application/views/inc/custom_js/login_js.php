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
    // console.log('LOGIN_JS')


    <?php if($this->session->flashdata(key_wrong_user_name)){ ?>
        toastr.error("<?= text_incorrect_username_or_password ?>");
    <?php } ?>


})





</script>