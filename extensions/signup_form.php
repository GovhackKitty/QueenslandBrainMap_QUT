<!--SIGNUP FORM-->
<form id="registration-form" method="post" action="signup.php">

    <label for="userID">User ID:</label>
    <input type="text" id="userID" name="userID" onkeypress="validateUserID()" value="<?php
        if(isset($_POST['userID']))
            echo htmlspecialchars($_POST['userID']);
        ?>" required/>
    <span id="idError" title="Only letters, numbers, and underscores allowed">Invalid format</span>
    <br/>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" onkeypress="validatePassword()" value="<?php
        if(isset($_POST['password']))
            echo htmlspecialchars($_POST['password']);
        ?>" required/>
    <span id="passwordError" title="Only letters, numbers, and underscores allowed">Invalid format</span>
    <br/>
    
    <label for="rePW">Re-enter Password:</label>
    <input type="password" id="rePW" name="rePW" onchange="validateMatch()" value="<?php
        if(isset($_POST['rePW']))
            echo htmlspecialchars($_POST['rePW']);
        ?>" required/>
    <span id="noMatch">Unmatching Passwords</span>
    <br/>
    
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" onchange="validateEmail()" value="<?php
        if(isset($_POST['email']))
            echo htmlspecialchars($_POST['email']);
        ?>" required/>
    <span id="emailError">Invalid Email</span>
    <br/>
    
    <label for="dob">Date of Birth:</label>
    <select id="day" name="day" onchange="validateDOB()">
        <option>0</option>
        <script type="text/javascript">
            fillDays();
        </script>
    </select>
    <select id="month" name="month" onchange="validateDOB()">
        <option>0</option>
        <script type="text/javascript">
            fillMonths();
        </script>
    </select>
    
    <select id="year" name="year" onchange="validateDOB()">
        <option>0</option>
        <script type="text/javascript">
            fillYears();
        </script>
    </select>
    (D/M/Y)
    <span id="dateError">Invalid Date</span>
    <br/>
    <br/>
    
    
    <div class="centerTxt">	
        <input type="submit" value="Submit"/>
        <input type="reset"/>
    </div>
</form>
<!--END OF SIGNUP FORM-->