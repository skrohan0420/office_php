<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <center>

        <h1>Hello <?php echo $this->session->userData('userName') ?></h1>
        <h2>your mobile no is <?php echo  $this->session->userData('phoneNumber') ?></h2>
        <h2>and Your city is <?php echo $this->session->userData('city')?></h2>


        <a href="logout">
            <h3>LOGOUT</h3>
        </a>

    </center>


</body>
</html>