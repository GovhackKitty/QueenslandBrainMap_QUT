<!--LOGIN FORM-->
<form id="login-form" method="post" action="login.php">  				
    <label for="userID">User ID:</label>
    <input type="text" id="userID" name="userID" value="<?php
        if(isset($_POST['userID']))
            echo htmlspecialchars($_POST['userID']);
        ?>" required/>
    <br/>						
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required/>	
    <br/>
    <br/>				
    <div class="centerTxt">
        <input type="submit" value="Login"/>      
        <input type="button" onclick="location.href='signup.php'" value="Sign-Up"/>
        <br/>	
        <br/>		
        <a href="unavailable.php"><u>Forgot Password</u></a>
    </div>
</form>
    
<!--END OF LOGIN FORM-->