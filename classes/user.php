<?php
require_once("classes/database.php");
//echo("require database pass");
class user{
    function validateEmail(&$errors, $field_list, $field_name){
        $allow = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
            $errors[$field_name] = 'Email required ';
        else if (!preg_match($allow, $field_list[$field_name]))
            $errors[$field_name] = 'Email Invalid ';
    }

    function verifyUsername(&$errors, $field_list, $username){
        //echo "in validate username ";
        if (!isset($field_list[$username]) || empty($field_list[$username])){
            $errors[$username] = 'Username required ';
            return false;
        } else {
            $database = new database();
            //echo "new passed";
            $query = $database->getUsers($field_list[$username]);
            if(($query->rowCount()) < 1){
                $errors[$username] = 'Username does not exist ';
                return false;
            }
        }
        return true;
    }
    
    function validateUsername(&$errors, $field_list, $username){
        $allow = '/^[A-Za-z0-9_]+$/';
        if (!isset($field_list[$username]) || empty($field_list[$username])){
            $errors[$username] = 'Username required ';
            return false;
        } else if(!preg_match($allow, $field_list[$username])){
            $errors[$username] = 'Invalid Username ';
            return false;
        } else {
            $database = new database();
            //echo "new passed";
            $query = $database->getUsers($field_list[$username]);
            if(($query->rowCount()) > 0){
                $errors[$username] = 'Username is already being used ';
                return false;
            }
        }
        return true;
    }
    

    function verifyPassword(&$errors, $field_list, $username, $password){
        if (!isset($field_list[$password]) || empty($field_list[$password])){
            $errors[$password] = 'Password required ';
            return false;
        } else {
            $database = new database();
            //echo "match password check ";
            $query = $database->matchPassword($field_list[$username], $field_list[$password]);
            if($query->rowCount() < 1){
                $errors[$username] = 'Password incorrect ';
                return false;
            }
            return true;
        }
        
    }

    function validatePassword(&$errors, $field_list, $password){
        $allow = '/^[A-Za-z0-9_]+$/';
        if (!isset($field_list[$password]) || empty($field_list[$password])){
            $errors[$password] = 'Password required ';
        } else if(!preg_match($allow, $field_list[$password])){
            $errors[$password] = 'Invalid Password ';
            return false;
        }
        return true;
    }
    
    function validateDate(&$errors, $field_list, $day, $month, $year){
        if(isset($field_list[$month])&&isset($field_list[$day])&&isset($field_list[$year])){
            if(checkdate($field_list[$month], $field_list[$day], $field_list[$year])){
                return true;
            }
        } 
        $errors[$date] = 'Invalid Date ';
        return false;
    }
    
    function getUserDetails($username){
        $database = new database();
        $result = $database->getUserDetails($username);
        return $result;
    }
    
    function registerUser($field_list, $username, $password, $email, $day, $month, $year){
        $dob = "";
        $dob = ($field_list[$year]."-".$field_list[$month]."-".$field_list[$day]);
        //echo ".$dob.";
        $database = new database();
        $database->addUser($field_list[$username], $field_list[$password], $field_list[$email], $dob);
    }
}
?>