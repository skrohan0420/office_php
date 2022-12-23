<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0px;
            padding: 0px
        }
        #formCon{
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column ;
        }
        #form{
            border: 1px solid #666;
            padding: 20px;
            margin: 0px 0px 30px 0px
        }
        .inputCon{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0px 20px 0px
        }
        .inputCon input{
            margin: 0px 0px 0px 20px;
            padding: 5px
        }
        #btn{
            padding: 5px 20px 5px 20px;
            cursor: pointer
        }
        #msg{
            color: red;
            font-weight: 400;
            text-align: center;
            position: fixed;
            font-size: 25px;
            width: 100vw;
            padding: 20px;
                        
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>
<body>

    <p id="msg">
        <?php echo $this->session->flashdata('login_faild');?>
    </p>

    <div id="formCon">
        <form action="login" method="post" id="form">
            <div class="inputCon">
                <label for="userName"> User Name </label>
                <input type="text" placeholder="Name" name="userName">
            </div>
            <div class="inputCon">
                <label for="userName"> User Password </label>
                <input type="password" placeholder="Password" name="password">
            </div>
            <div>
                <input type="submit" value="login" id="btn">
            </div>
        </form>

        <p>Don't have an account <a href="signup"> Create New</a></p>

    </div>
    
    <script>

        $(document).ready(function(){
            setTimeout(() => {
                $('#msg').fadeOut()
            }, 5000);
        });

    </script>

</body>
</html>