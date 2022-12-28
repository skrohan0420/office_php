<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="<?= base_url('assets/styles/styles.css')?>">
</head>
<body>
    <div id="formCon">
        <p id="flash_data">
            <?= $this->session->flashdata('wrong_user')?>                    
        </p>
        <form action="<?= base_url('Admin/login')?>" method="post" id="form">
            <div class="inputCon">
                <label> Admin Name </label>
                <input type="text" placeholder="Name" name="name">
            </div>
            <div class="inputCon">
                <label> Admin Password </label>
                <input type="password" placeholder="Password" name="password">
            </div>
            <div>
                <input type="submit" value="login" id="btn">
            </div>
        </form>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.1.js" 
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" 
            crossorigin="anonymous"></script>
    <script>
        
    </script>
</body>
</html>