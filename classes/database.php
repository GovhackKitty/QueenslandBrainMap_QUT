<?php
    require_once ("db_set.php");
    class database{
        private $pdo;
    
        function database(){
            //$this->pdo = new PDO('mysql:host=localhost;dbname=Knowledge_Maps');
            $this->pdo = new PDO(SOURCE, USER, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        function getUsers($username){        
            try{
                //echo "inside checkusername ";
                $query = $this->pdo->prepare("SELECT * FROM users WHERE userName = :userName");
                $query->bindValue(':userName', $username);                
                $query->execute();
                //echo $query->rowCount();
                //$result = $query->fetch(PDO::FETCH_ASSOC);
               // print_r($result);
                return $query;
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        function getEmails($email){        
            try{
                //echo "inside checkusername ";
                $query = $this->pdo->prepare("SELECT * FROM users WHERE userEmail = :userEmail");
                $query->bindValue(':userEmail', $email);                
                $query->execute();
                return $query;
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        
        function matchPassword($username, $password){        
            try{
                //echo "inside checkusername ";
                $query = $this->pdo->prepare("SELECT * FROM users WHERE userName = :userName AND userPassword = SHA2(:password, 0)");
                $query->bindValue(':userName', $username);
                $query->bindValue(':password', $password);
                $query->execute();
                //echo "execute success ";
                //echo $query->rowCount() > 0;
                return $query;
            } catch (PDOException $e){
                echo ($e->getMessage());
            }
        }
        
        function getUserDetails($username){
            $query = $this->pdo->prepare("SELECT * FROM users WHERE userName = :userName");
            $query->bindValue(':userName', $username);                
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        
        function addUser($username, $password, $email, $dob){
            try{
                $strq = "INSERT INTO users (userName, userPassword, userEmail, dob) 
                   VALUES (:userName, SHA2(:userPassword, 0), :userEmail, :dob)";
                $query = $this->pdo->prepare($strq);
                $query->bindValue(':userName', $username); 
                $query->bindValue(':userPassword', $password); 
                $query->bindValue(':userEmail', $email); 
                $query->bindValue(':dob', $dob); 
                $query->execute();
            } catch (PDOException $e){
                echo ($e->getMessage());
            }
        }
    }
?>