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
        #mainCon{
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
        <?php echo $this->session->flashdata('Email_exists');?>
    </p>

    <div id="mainCon">

        <form action="signUpAct" method="post" id="form">
            <div class="inputCon">
                <label> Name </label>
                <input type="text" placeholder="Name" name="userName" required>
            </div>
            <div class="inputCon">
                <label> Email </label>
                <input type="email" placeholder="email" name="email" required>
            </div>
            <div class="inputCon">
                <label>Phone Number</label>
                <input type="number" placeholder="Phone Number" name="phoneNumber" required>
            </div>
            <div class="inputCon">
                <label> City </label>
                <input type="text" placeholder="Your City" name="city" required>
            </div>
            <div class="inputCon">
                <label> Password </label>
                <input type="password" placeholder="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Sign Up" id="btn">
            </div>
        </form>
        <p>Already have an Account <a href="login"> Log In</a></p>
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