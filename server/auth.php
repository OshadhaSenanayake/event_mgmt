<?php
session_start();
require('connection.php');

// $_SESSION['flag']=NULL;
// $_SESSION['username']='Shehan Kulathilalke';
if(isset($_POST['usercheck'])){
    check_username();
    // echo 'hi';
}

if(isset($_POST['login'])){
   
    $username = $_POST['username'];
    $password = $_POST['pwd'];

    $query= "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db,$query);
    $userinfo = mysqli_fetch_assoc($result);
    
    if (mysqli_num_rows($result) == 1){
        $_SESSION['flag']=TRUE;
        $_SESSION['fullname'] = $userinfo['fullname'];
        $_SESSION['username'] = $userinfo['username'];
        $userid = $_SESSION['userid'] = $userinfo['userid'];
        $query = "SELECT eventid FROM event WHERE userid = $userid ORDER BY eventid DESC";
        $idresult=mysqli_fetch_assoc(mysqli_query($db,$query));
        $latest=$idresult['eventid'];
        if(!isset($latest)){
            $latest=0;
        }
        if($userid==1){
            header('location:../pages/admin.php?eventid='.$latest);
        }
        else{

            header('location:../pages/profile.php?eventid='.$latest);
        }
    }
    else{
        $_SESSION['message'] = "Wrong Username Password Combination. Try Again.";
        header('location:../index.php');
    }
}

if(isset($_POST['register'])){
    global $db;
    if(check_username()){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $query = "INSERT INTO user(fullname,email,contact,username,password) VALUES
        ('$fullname','$email','$contact','$username','$pass')";
        echo $query;
        $result = mysqli_query($db,$query);
        if($result){
            echo 'ok';
            header ('location:../index.php');
        }
        else{
            echo 'error';
        }
    }
}

function check_username(){
    global $db;
    $username = $_POST['username'];
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result=mysqli_query($db,$query);
    // echo $query;
    if(mysqli_num_rows($result)!=0){
        echo 'Username is taken<br>
        Go <a href="../pages/signup.php">Back</a>';
        return FALSE;
    }
    else{
        echo 'Username is available<br>
        Go <a href="../pages/signup.php">Back</a>';
        return TRUE;
    }
}


if(isset($_POST['logout'])){
    session_destroy();
    header('location:../index.php');
}

?>