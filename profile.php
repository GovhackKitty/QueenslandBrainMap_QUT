<?php
    session_start();
    //echo "session started ";
    if(isset($_SESSION['userActive'])){
        if($_SESSION['userActive']){ ?>
            <?php include 'includes/html.inc' ?>
            <html>
                <head>
                    <?php include 'includes/head.inc' ?>
                    <title>QBM: <?php echo ($_SESSION['login']);?></title>
                </head>
                
                <body>
                    <?php include 'includes/header.inc'?>
                    <?php include 'includes/rightbar.inc'?>
                    <?php include 'includes/leftbar.inc'?>
                    <!--MIDDLE CONTENTS-->
                    <div class="middle">
                        <div class="contentTab">
                            Profile
                        </div>
                        <div class="content">
                            <?php 
                                require ('classes/user.php');
                                $user = new user();
                                $details = $user->getUserDetails($_SESSION['userName']);
                                foreach($details as $detail => $value){
                                    if($detail != 'userPassword'){
                                        echo "<p><b>$detail: </b>$value <br/></p>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                    <!--END OF MIDDLE CONTENTS-->
                    <?php include 'includes/footer.inc' ?>
                </body>
            </html><?php
        } else {
            header('Location: http://localhost/login.php');
        }
    } else {
        header('Location: http://localhost/login.php');
    }
?>  
