<?php include 'includes/html.inc' ?>
<html>
    <head>
        <?php include 'includes/head.inc' ?>
        <title>QBM: Sign-Up</title>
		<script src="js/main.js" type="text/javascript"></script>
    </head>
    
    <body>
        <?php include 'includes/header.inc' ?> 
        <!--FORM AREA-->
        <div class="middle">
            <div class="contentTab" style="font-size: 150%">
                Sign Up
            </div>
            
            <!--LOGIN CONTENTS-->
            <div id="loginContent">
            <?php
                session_start();
                if($_SESSION['userActive']){
                    echo "You are Logged in ";
                    echo ($_SESSION['userName']);
                } else {
                    $errors = array();
                    require ('classes/user.php');
                    $user = new user();
                    
                    if (isset($_POST['email'])){
                        $user->validateEmail($errors, $_POST, 'email');
                        $user->validatePassword($errors, $_POST, 'password');
                        $user->validateUsername($errors, $_POST, 'userID');
                        $user->validateDate($errors, $_POST, 'day', 'month', 'year');
                        
                        if ($errors){
                            foreach ($errors as $field => $error)
                                echo "$error </br>";
                            // redisplay the form
                            include 'extensions/signup_form.php';
                        } else {
                            $user->registerUser($_POST, 'userID', 'password', 'email', 'day', 'month', 'year');
                            echo 'You have successfully registered. <br/> <h4>Please Login</h4> <br/>';
                        }
                    } else{
                        include 'extensions/signup_form.php';
                    }
                }
            ?>
            </div>
            <!--END OF LOGIN CONTENTS-->
        </div>
    </body>
</html>