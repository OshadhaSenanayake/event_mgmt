<?php
require('connection.php');


$statchange = isset($_POST['stat_change_save']);
$paychange = isset($_POST['paychange']);
$useredit = isset($_POST['user_edit']);
$userdel = isset($_POST['user_del']);
$supedit = isset($_POST['sup_edit']);
$supdel = isset($_POST['sup_del']);
$addsup = isset($_POST['add_sup']);


if($useredit){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $userid = $_POST['userid'];
    $eventid = $_POST['eventid'];
    $query = "UPDATE user 
    SET fullname = '$fullname',
    email ='$email'
    ,contact = '$contact'
    ,`password` = '$password'
    WHERE user.userid = $userid";
    $result = mysqli_query($db,$query);
    // echo $query;
    header('location:../pages/admin.php?eventid=0'.$eventid.'&useredit=on');

}

if($userdel){
    $userid = $_POST['userid'];
    
    $query = "DELETE FROM user WHERE user.userid = $userid";
    $result = mysqli_query($db,$query);
    // echo $query;
    $query = "SELECT eventid FROM `event` WHERE `event`.userid=$userid";
    $result = mysqli_query($db,$query);
    while($event=mysqli_fetch_assoc($result)){
        event_del_admin($event['eventid']);
    }
    $_SESSION['message'] = "Successfully Deleted Event";
    header('location:../pages/admin.php?eventid='.$eventid.'&useredit=on');
}

if($supedit){
    $table = $_POST['table'];
    unset($_POST['table']);
    unset($_POST['sup_edit']);
    $keys = array_keys($_POST);
    $id = $keys[0];
    $idval=$_POST[$keys[0]];
    // print_r($_POST);
    // echo '<br>';
    // print_r($keys);
    
    $query = "UPDATE $table SET ";

    for($i=1; $i<count($keys);$i++){
        $query .= $keys[$i].'='."'".$_POST[$keys[$i]]."'";
        if ((count($keys)-1)-$i!=0){
            $query .= ', ';
        }
        

    }
     $query.= " WHERE $table.$id = $idval";
     $result = mysqli_query($db,$query);
    //  echo $query;
     $_SESSION['message'] = "Changes Saved";
     header('location:../pages/admin.php?eventid=0&edit_sup='.$table);
}

if($supdel){
    $id = array_keys($_POST)[0];
    $id_val = $_POST[$id];
    $table = $_POST['table'];
    
    $query = "DELETE FROM $table WHERE $table.$id = $id_val";
    $result = mysqli_query($db,$query);
    $_SESSION['message'] = "Changes Saved";
     header('location:../pages/admin.php?eventid=0&edit_sup='.$table);
}

if ($statchange ||  $paychange){
    $eventid = $_POST['eventid'];
    $table = $_POST['table'];
    if($statchange){
        // print_r($_POST);
       $value = $_POST['status'];

       $query = "UPDATE $table
       SET status = $value
       WHERE $table.eventid = $eventid";

       $result = mysqli_query($db,$query);
    //    echo $query;
    }
    elseif($paychange){
                // print_r($_POST);
       $value = $_POST['pay'];

       $query = "UPDATE $table
       SET payment = $value
       WHERE eventid = $eventid";

       $result = mysqli_query($db,$query);
       echo $query;
    }
    $_SESSION['message'] = "Successfully Deleted User";
    header('location:../pages/admin.php?eventid='.$eventid);
}

if($addsup){
    $table = $_POST['table'];
    unset($_POST['table']);
    unset($_POST['add_sup']);
    $keys = array_keys($_POST);
    $query ="INSERT INTO $table(";
    // print_r($keys);
    for($i=0; $i<count($keys);$i++){
        $query .= $keys[$i];
        if ((count($keys)-1)-$i!=0){
            $query .= ', ';
        }
    }
    $query .= ") VALUES(";
    for($i=0; $i<count($keys);$i++){
        $query .= "'".$_POST[$keys[$i]]."'";
        if ((count($keys)-1)-$i!=0){
            $query .= ', ';
        }
    }
    $query .= ")";
    $result =mysqli_query($db,$query);
    $_SESSION['message'] = "Successfully Added Item";
    header('location:../pages/admin.php?eventid=0&edit_sup='.$table);
}


function get_event_admin(){
    global $db;
    $query = "SELECT * FROM event WHERE userid LIKE '%' ";
    $result = mysqli_query($db,$query);
    $len = mysqli_num_rows($result);
        while ($event = mysqli_fetch_assoc($result)){
            //sets GET['eventid'] value to eventid
            $eventpath = "admin.php?eventid=".$event['eventid'];
            $status = $event['status'];
            //generates list elements for eventname
            echo "<li> <a href='$eventpath'>",$event['event_name'], "</a>";
            if($status==1){
                echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Completed</div>';
                }
                elseif($status==0){
                    echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Pending</div>';
                }
                else{
                    echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_cancelled">Cancelled</div>';
                    
                }
                echo '</li>';
        }

}

function get_users_admin($eventid){
    global $db;
    $query = "SELECT * FROM user" ;
    $result = mysqli_query($db,$query);
    // echo '<select>';    
    while( $list = mysqli_fetch_assoc($result) ){
        echo '<form action="../server/admin.php" method="POST">';
        echo '<b>User ID:</b> '. $list['userid'].'<br>'; 
        echo '<input type="hidden" name="userid" value=" '. $list['userid'].'">';
        echo '<input type="hidden" name="eventid" value=" '. $eventid.'">';
        echo '<b>Username:</b> '. $list['username'].'<br>';
        echo '<b>Full Name:</b> <input name="fullname" value="'. $list['fullname'].'"><br>';
        echo '<b>Email:</b> <input style="margin-left:25px;"name="email" value="'. $list['email'].'"><br>';
        echo '<b>Contact:</b> <input style="margin-left:13px;"name="contact" value="'. $list['contact'].'"><br>';
        echo '<b>Password:</b> <input style="margin-left:1px;"name="password" value="'. $list['password'].'"><br>';
        $userid=$list['userid'];
        echo
        // '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&userid='.$userid.'&status=1">Save</a>'.
        '<input style="height:15px;width:50px;padding:0px;" type="submit" value="Save" name="user_edit">'.
        '<input style="margin-left:5px;height:15px;width:50px;padding:0px;background-color:red" type="submit" value="Delete" name="user_del">'.
        // '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&userid='.$userid.'&delete=1">Delete</a>'.
        '</form></span><hr>';
    }
}


function event_del_admin($eventid){
    global $db;
    // echo 'EVENT:'. $eventid.'<br>';
   
    $query = "DELETE `event`,`event_av`,`event_avitems`,`event_catering`,`event_food`,`event_photography`,`event_venues`,`guests`
    FROM `event` 
    LEFT JOIN `event_av` on `event`.`eventid` = `event_av`.`eventid` 
    LEFT JOIN  `event_avitems` on `event`.`eventid` = `event_avitems`.`eventid`
    LEFT JOIN  `event_catering` on `event`.`eventid` = `event_catering`.`eventid`
    LEFT JOIN  `event_food` on `event`.`eventid` = `event_food`.`eventid`
    LEFT JOIN  `event_photography` on `event`.`eventid` = `event_photography`.`eventid`
    LEFT JOIN  `event_venues` on `event`.`eventid` = `event_venues`.`eventid`
    LEFT JOIN  `guests` on `event`.`eventid` = `guests`.`eventid`

    WHERE `event`.`eventid` = '$eventid'";
    echo $query;
    echo '<br>';

    $result = mysqli_query($db,$query);


    
}

function get_all($table){
    global $db;
    //prevents the reserved entry from being displayed
    $query = "SELECT * FROM $table";
    $result =array_keys(mysqli_fetch_array(mysqli_query($db,$query)));
    $id = $result[1];
    //selects from the second entry
    $query = "SELECT * FROM $table WHERE $id <> 1";

    $result =mysqli_query($db,$query);


    while($line = mysqli_fetch_assoc($result)) {
        echo '<form action="../server/admin.php" method="POST">';
        $columnarray = array_keys($line);
        echo '<input type="hidden" name="'.$columnarray[0].'" value="'.$line[$columnarray[0]].'">';
        echo '<b>'.ucwords($columnarray[0]).':</b> ';
        echo $line[$columnarray[0]];
        echo '<br>';
        for($i=1; $i< count($columnarray);$i++){
            echo '<b>'.ucwords($columnarray[$i]);
            echo ':</b><input  style="width:200px"   value=" ';
            echo $line[$columnarray[$i]];
            echo '" name="';
            echo $columnarray[$i];
            echo'"><br>';
        }
        echo '<input type="hidden" name="table" value="'.$table.'">';
        echo '<input style="height:15px;width:50px;padding:0px;" type="submit" value="Save" name="sup_edit">';
        echo'<input style="margin-left:5px;height:15px;width:50px;padding:0px;background-color:red" type="submit" value="Delete" name="sup_del">';
        echo '</form><hr>';
    }
}

function insert_form($table){
    global $db;
    $query = "SELECT * FROM $table";
    $result = mysqli_fetch_assoc(mysqli_query($db,$query));
    $keys = array_keys($result);
    echo '<form action="../server/admin.php" method="POST">';
    for($i=1; $i< count($keys);$i++){
        echo '<b> '. ucwords($keys[$i]).': </b>';
        echo '<input name="';
        echo $keys[$i];
        echo '">';
    }
    echo '<input type="hidden" name="table" value="'.$table.'">';
    echo '<input type="submit" style="margin-left:10px;height:30px;width:80px;padding:0px;" name="add_sup" value="Add New">';
}
?>
