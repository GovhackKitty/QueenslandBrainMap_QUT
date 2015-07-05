<?php include 'includes/html.inc' ?>
<?php session_start();?>
<html>
    <head>
        <?php include 'includes/head.inc' ?>
        <title>QBM: <?php echo ($_SESSION['login']);?></title>
    </head>
    
    <body>
        <?php include 'includes/header.inc'?>
        <!--MIDDLE CONTENTS-->	        
        <div class="middle">
            <div class="logInBox">
                <div class="contentTab" style="font-size: 150%">
                    Login
                </div>
                <div id="loginContent">		
                <?php
                    if($_SESSION['userActive']){
                        session_destroy(); 
                        echo "You are Logged Out ";
                ?>
                        <head>
                        <meta http-equiv='refresh' content='2;'>
                        </head>
                <?php
                    } else {
                        require ('classes/user.php');
                        //echo "validate pass";
                        $user = new user();
                        //echo "user object created ";
                        
                        $errors = array();
                        
                        if (isset($_POST['userID'])){
                            $user->verifyUsername($errors, $_POST, 'userID');
                            if(!$errors){
                                $user->verifyPassword($errors, $_POST, 'userID', 'password');                  
                            }
                            if ($errors){
                                foreach ($errors as $field => $error)
                                    echo "$error<br/><br/>";
                                include 'extensions/login_form.php';
                            }
                            else{
                                echo "You are Logged in ";
                                session_start();
                                $_SESSION['userActive'] = true;                            
                                $uName = $user->getUserDetails($_POST['userID']);   
                                $_SESSION['userName'] = $uName['userName'];
                                echo ($uName['userName']);
                                header('Location: index.php');
                            }
                        } else{
                            //echo 'No post data <br/>';
                            include 'extensions/login_form.php';
                        }
                    }
                ?>
                </div>	
            </div>
        </div>
	</body>
</html>