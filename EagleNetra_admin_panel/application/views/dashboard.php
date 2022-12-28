<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/styles/styles.css')?>">
    <style>
        form{
            width: 300px;
            outline: 1px solid gray;
            padding: 20px;
        }
        body{
            display: flex;
            align-items:center;
            justify-content:center;
            flex-direction: column;
        }
    </style>
    <title>dashboard</title>
</head>
<body>
    <div class="con">
        <h1>Add new Admin</h1>
        <p id="flash_data">  
            <?= $this->session->flashdata('admin_exists')?>
            <br>
            <?= $this->session->flashdata('data_inserted')?>
            <br>
            <?= $this->session->flashdata('wrong_user')?>
        </p>
        <form action="<?= base_url('Admin/add_admin')?>" method="post" >
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

    </div>
        <table border='1' >
            <thead>
                <tr>
                    <td>id</td>
                    <td>user_type</td>
                    <td>name</td>
                    <td>email</td>
                    <td>relationship</td>
                    <td>phone_number</td>
                    <td>image</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($userData as $data){
                        echo 
                        '<tr>
                            <td>'. $data['id'].'</td>
                            <td>'. $data['user_type'].'</td>
                            <td>'. $data['name'].'</td>
                            <td>'. $data['email'].'</td>
                            <td>'. $data['relationship'].'</td>
                            <td>'. $data['phone_number'].'</td>
                            <td>'. $data['image'].'</td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
   
</body>
</html>