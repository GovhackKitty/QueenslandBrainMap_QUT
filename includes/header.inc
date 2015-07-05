<?php
session_start();
$loginTab;
$uName = "";
if(isset($_SESSION['login'])&&isset($_SESSION['userActive'])){
    if(isset($_SESSION['userName'])){$uName = ' '.$_SESSION['userName'];}
    else {$_SESSION['userName'] = $uName;}
    if(!$_SESSION['userActive']){
        $_SESSION['login'] = "Login";
    } else {
        $_SESSION['login'] = "Logout";
    }
    $loginTab = $_SESSION['login'];
} else {
    $_SESSION['login'] = "Login";
    $loginTab = $_SESSION['login'];
}
?>
<div id="content-wrapper">
    <div id="header" title="Home" onclick="location.href = 'index.php';">
        <div id="headerIMG">
            <img src = "images/brain.png" style="max-height: 100%;"/>
        </div>
        <div id="headerTXT">
            <div style="font-size: 300%;">QLD - Brain Maps </div>
        </div>						
    </div>	

    <div class="menuBar">
        <!--Set in a slightly strange format so items can display as intended -->
        <div class="menu">
            <a style="padding-left: 0px; padding-right: 0px;"></a
            ><a href="index.php">Home</a
            ><a href="unavailable.php">Events</a
            ><a href="login.php"><?php echo ($loginTab);?></a
            ><?php echo(" ".$uName);?>
        </div>	
    </div>
    
    <!--MAIN CONTENTS-->
	<div id="middle-contents">	