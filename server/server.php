<?php
require('connection.php');
require('auth.php');

if (isset($_POST['new_complete'])){
    create_event();
}

if (isset($_POST['event_delete'])){
    event_del($_POST['eventid']);
}

if (isset($_POST['save_changes'])){
    save_changes();
}
if (isset($_POST['event_cancel'])){
    
    unset($_POST['event_cancel']);
    $_POST['status'] = 3;
    $_POST['table'] = 'event';
    $_POST['dummy'] = 0;
    $_POST['dummy'] = 0;
    print_r($_POST);
    save_changes();
}
if (isset($_POST['event_complete'])){
    
    unset($_POST['event_complete']);
    $_POST['status'] = 1;
    $_POST['table'] = 'event';
    $_POST['dummy'] = 0;
    $_POST['dummy'] = 0;
    print_r($_POST);
    save_changes();
}

if (isset($_POST['event_resume'])){
    
    unset($_POST['event_resume']);
    $_POST['status'] = 0;
    $_POST['table'] = 'event';
    $_POST['dummy'] = 0;
    $_POST['dummy'] = 0;
    print_r($_POST);
    save_changes();
}

if (isset($_GET['guestid'])){
    guest_actions();
}
if (isset($_POST['add_guest'])){
    guest_actions();
}
if (isset($_GET['food_edit'])){
    food_actions();
}
if (isset($_POST['add_food'])){
    food_actions();
}
if (isset($_POST['qty_change'])){
    food_actions();
}
if (isset($_POST['submit_receipt'])){
    $eventid=$_POST['eventid'];
    echo 'Sorry File Uploads are temporarily not allowed <br> Please send in the 
    receipt to <a href="mailto:finance@party.lk">finance@party.lk</a> 
    with your name and user email';
    echo '<br> Go back to <a href="../pages/profile.php?eventid='.$eventid.'&">Party.lk</a>';
}

//Gets a list of events created by a user
function get_event($user){
    global $db;
    $query0= "SELECT userid FROM user WHERE username='$user'";
    $result0=mysqli_query($db,$query0);
    $userid =  mysqli_fetch_assoc($result0)['userid'];
    $query = "SELECT * FROM event WHERE userid='$userid'";
    $result = mysqli_query($db,$query);
    $len = mysqli_num_rows($result);
    while ($event = mysqli_fetch_assoc($result)){
        //sets GET['eventid'] value to eventid
        $eventpath = "profile.php?eventid=".$event['eventid'];
        //generates list elements for eventname
        echo "<li> <a href='$eventpath'>",$event['event_name'], "</a></li>";
        }

}

//Gets event details
function get_info($eventid){
    global $db,$eventname,$location;
    $query1 = "SELECT * from event WHERE eventid ='$eventid'";
    $result=mysqli_query($db,$query1);
    $event = mysqli_fetch_assoc($result);
    $name= $event['event_name'];
    // $name= $event['event_name'];
    // echo $name;
    return $event;

}

//generate selection lists from table
function gen_list($table){
    global $db;
    
    //prevents the reserved entry from being displayed
    $query = "SELECT * FROM $table";
    $result =array_keys(mysqli_fetch_array(mysqli_query($db,$query)));
    $id = $result[1];
        //selects from the second entry
    $query = "SELECT * FROM $table WHERE $id <> 1";
    $result = mysqli_query($db,$query);
    // echo '<select>';    
    while( $list = mysqli_fetch_assoc($result)){
        $keys = array_keys($list);
        $value = $list[$keys[0]];
        $name = $list[$keys[1]];
        echo '<option value="'.$value.'">'.$name.'</option>';
    }
    // echo '</select>';
}
//Save event details
function create_event(){
   global $db;
   $event_name = mysqli_real_escape_string($db,$_POST['event_name']);
   $event_date = $_POST['event_date'];
   $event_start = $_POST['event_start'];
   $event_to = $_POST['event_to'];
   $event_city = mysqli_real_escape_string($db,$_POST['event_city']);
   $event_venue = $_POST['event_venue'];
   $event_cater = $_POST['event_cater'];
   $event_photo = $_POST['event_photo'];
   $event_av = $_POST['event_av'];
   $userid =$_SESSION['userid'];

   $query1 = "INSERT INTO `event` (event_name, location, date, start, end, userid) VALUES('$event_name','$event_city','$event_date','$event_start','$event_to','$userid');";
   
   $result = mysqli_query($db,$query1);
   $eventid = mysqli_insert_id($db);
   
   $query  = "INSERT INTO event_av(eventid,supplierid) VALUES('$eventid','$event_av');";
   $query .= "INSERT INTO event_catering(catererid,eventid) VALUES('$event_cater','$eventid');";
   $query .= "INSERT INTO event_photography(eventid,photgrapherid  ) VALUES ('$eventid','$event_photo');";
   $query .= "INSERT INTO event_venues(eventid,venueid) VALUES('$eventid','$event_venue')";
   
   $result2 = mysqli_multi_query($db,$query);
   
   
   if(!$result2){
      // header("location:../pages/profile.php");
    echo "errr";
    echo ($query);
      return FALSE;
  }
  else{
    header("location:../pages/profile.php");
    return TRUE;
  }
}

//get data from an entry
function get_entry($key,$value ,$table,$column,$overridequery){
        global $db;
        $query = "SELECT * FROM `$table` WHERE `$key` = '$value'";
        // echo $overridequery;
        if ($overridequery!==0){
            $result= (mysqli_query($db,$overridequery));
            while($entry = mysqli_fetch_assoc($result)){
                echo $entry[$column];
 
            }
    
            if(!$result){
                echo 'Error';
            }
        }
        else{
            $result = mysqli_query($db,$query);
            while($entry = mysqli_fetch_assoc($result)){
                return $entry[$column];

            }
        }

        }

// deletes an event along with all related entries

function event_del($eventid){
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
    // echo $query;

    $result = mysqli_query($db,$query);

    if(!$result){
        echo 'Error'; 
    }
    else{
        $_SESSION['message'] = "Successfully Deleted Event";
        $userid =$_SESSION['userid'];
        if($userid !=1){
            // echo 'hi';
            header("location:../pages/profile.php?eventid=$eventid");

        }
        else{
            header("location:../pages/admin.php?eventid=$eventid");

        }
        
        
    }
    
}

//generate edit forms and update
function edit_event($eventid,$table,$column,$type){
    global $db;
    $query = "SELECT $column FROM $table WHERE eventid =$eventid ";
    // echo $query;
    $result = mysqli_fetch_assoc(mysqli_query($db, $query));
    $value = $result[$column];

    echo '<input type="'.$type.'" name="'.$column.'" value="'.$value.'" ><br>';
}

function save_changes(){
    global $db;
    $keys = array_keys($_POST);
    $columns = "";

    $table = $_POST['table'];
    $eventid = $_POST ['eventid'];
    $userid =$_SESSION['userid'];

    for ($i=0; $i<count($keys)-2;$i++){
        $value = mysqli_real_escape_string($db,$_POST[$keys[$i]]);
        $columns .= $keys[$i].'='."'".$value."'";
        if(count($keys)-3-$i!=0){
            $columns .= ',';
        }
    }
    // echo $columns;
    $query= "UPDATE $table 
    SET $columns
    WHERE $table.`eventid` = $eventid";

    $result = mysqli_query($db,$query);

    if(!$result){
        echo 'Error'; 
        echo $query;
    }
    else{
        // echo $query;
        $_SESSION['message'] = "Successfully Changed Event";
        if($userid !=1){
            header("location:../pages/profile.php?eventid=$eventid");

        }
        else{
            header("location:../pages/admin.php?eventid=$eventid");

        }
        
    }

    // echo $query;
}

//guest management
function get_guests($eventid){
    global $db;
    $query = "SELECT * FROM guests WHERE eventid='$eventid'";
    $result = mysqli_query($db,$query);
    // echo '<select>';    
    while( $list = mysqli_fetch_assoc($result)){
        $keys = array_keys($list);
        $value = $list[$keys[0]];
        $name = $list[$keys[2]];
        $guestid = $list[$keys[0]];
        $status =$list['rsvp'];
        echo '<label style="font-size:15px">'.$name.'</label>';
        if ($status==0){
            echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Pending</div>';
        }
        elseif($status==1){
            echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Confirmed</div>';
        }
        else{
            echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_cancelled">Declined</div>';
        }
       
        echo ' <br><span style="float:left">Actions:';
        
        echo
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&guestid='.$guestid.'&delete=1">Delete</a>'.
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&guestid='.$guestid.'&status=1">Mark as Confirmed</a>'.
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&guestid='.$guestid.'&status=2">Mark as Declined</a>'.
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&guestid='.$guestid.'&status=0">Mark as Pending</a>'.
        '</span><br><hr>';
    }
}

function guest_actions(){
    global $db;
    $status = $_GET['status'];
    $guestid = $_GET['guestid'];
    $eventid = $_GET['eventid'];
    $userid = $_SESSION['userid'];
    if(isset($_GET['delete'])){
        echo 'delete';
        
        $query = "DELETE FROM guests WHERE guestid = $guestid";
        $result = mysqli_query($db,$query);
        if($result){
            // echo 'success';
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&guest_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&guest_edit=on");
            }

        }
    }
    elseif(isset($_GET['status'])){
        $query = "UPDATE guests SET rsvp = '$status' WHERE guestid = '$guestid' ";
        $result = mysqli_query($db,$query);
        if($result){
            // echo 'success';
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&guest_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&guest_edit=on");
            }
        }
        echo 'status:'.$_GET['status'];
    }
    elseif(isset($_POST['add_guest'])){
        $eventid = $_POST['eventid'];
        $guest_name=$_POST['guest_name'];
        $status=$_POST['status'];

        $query = "INSERT INTO guests(eventid,guestname,rsvp) VALUES('$eventid','$guest_name','$status')";
        $result= mysqli_query($db,$query);

        if($result){
            // echo 'success';
            $_SESSION['message'] = "Successfully Added Guest";
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&guest_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&guest_edit=on");
            }

        }
        else{
            echo 'error';
            echo $query;
        }

    }
}

//item lists
function get_food($eventid){
    global $db;
    $query = "SELECT * FROM event_food
     INNER JOIN fooditems ON event_food.itemid = fooditems.itemid   
     WHERE eventid='$eventid'";
    $result = mysqli_query($db,$query);
    // echo $query;    
    while( $list = mysqli_fetch_assoc($result)){
        $keys = array_keys($list);
        $value = $list[$keys[0]];
        $name = $list['itemname'];
        $unit =$list['unit'];
        $qty = $list['quantity'];
        $food_id = $list['id'];
        
        echo '<label style="font-size:15px">'.$name.'</label>';
        echo ' <br><span style="float:left">Actions:';
        echo
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&del_food=1&fd_id='.$food_id.'&food_edit=on">Delete</a>'.
        '<form style="display:inline-block;" action="../server/server.php" method="POST">
        Quantity:
        <input style="height:10px;width:50px;" type="number" name="qty" value="'.$qty.'">'.
        '<input type="hidden" name="foodid" value="'.$food_id.'">'.
        '<input type="hidden" name="eventid" value="'.$eventid.'">'.
        '<button style="display:inline-block;height:18px;margin-left:5px;font-size:10px;" type="submit" name="qty_change">Change</button><br>'.
        '</form><br>'.
        '</span><br><hr style="margin-top:5px;">';
    }
}

function food_actions(){
    global $db;
    $userid = $_SESSION['userid'];
    if(isset($_GET['del_food'])){
        $eventid = $_GET['eventid'];
        $fd_id = $_GET['fd_id'];
        // echo 'delete';
        
        $query = "DELETE FROM event_food WHERE id = $fd_id";
        $result = mysqli_query($db,$query);
        if($result){
            echo 'success';
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&food_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&food_edit=on");
            }
            

       }
       else{
           echo $query;
       }
    }
    elseif(isset($_POST['add_food'])){
        $eventid=$_POST['eventid'];
        $itemid =$_POST['itemid'];
        $qty=$_POST['quantity'];
        $query = "INSERT INTO event_food(eventid,itemid,quantity)
        VALUES('$eventid','$itemid','$qty')";
        $result = mysqli_query($db,$query);
        echo $query;
        if($result){
            // echo 'success';
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&food_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&food_edit=on");
            }

       }
       else{
           echo $query;
       }
    }
    elseif(isset($_POST['qty_change'])){
        $eventid=$_POST['eventid'];
        $qty = $_POST['qty'];
        $foodid = $_POST['foodid'];
        $query = "UPDATE event_food
        SET quantity=$qty
        WHERE id=$foodid";
        $result = mysqli_query($db,$query);
        // echo $query;
        if($result){
            // echo 'success';
            if($userid !=1){
                header("location:../pages/profile.php?eventid=$eventid&food_edit=on");

            }
            else{
                header("location:../pages/admin.php?eventid=$eventid&food_edit=on");
            }

       }
       else{
           echo $query;
       }

    }
}

function gen_food_list($eventid){
    global $db;
    $query = "SELECT * FROM fooditems 
    INNER JOIN event_catering ON fooditems.catererid = event_catering.catererid 
    WHERE eventid=$eventid";
    echo $query;
    $result = mysqli_query($db,$query);
    // echo '<select>';    
    while( $list = mysqli_fetch_assoc($result)){
        // echo $list['catererid'];
        $value = $list['itemid'];
        $name = $list['itemname'];
        $unit = $list['unit'];
        echo '<option value="'.$value.'">'.$name.'('.$unit.')</option>';
    }
    // echo '</select>';
}

function get_av($eventid){
    global $db;
    $query = "SELECT * FROM event_food
     INNER JOIN fooditems ON event_food.itemid = fooditems.itemid   
     WHERE eventid='$eventid'";
    $result = mysqli_query($db,$query);
    // echo $query;    
    while( $list = mysqli_fetch_assoc($result)){
        $keys = array_keys($list);
        $value = $list[$keys[0]];
        $name = $list['itemname'];
        $unit =$list['unit'];
        $qty = $list['quantity'];
        $food_id = $list['id'];
        
        echo '<label style="font-size:15px">'.$name.'</label>';
        echo ' <br><span style="float:left">Actions:';
        echo
        '<a style="margin:5px;" href="../server/server.php?eventid='.$eventid.'&del_food=1&fd_id='.$food_id.'&food_edit=on">Delete</a>'.
        '<form style="display:inline-block;" action="../server/server.php" method="POST">
        Quantity:
        <input style="height:10px;width:50px;" type="number" name="qty" value="'.$qty.'">'.
        '<input type="hidden" name="foodid" value="'.$food_id.'">'.
        '<input type="hidden" name="eventid" value="'.$eventid.'">'.
        '<button style="display:inline-block;height:18px;margin-left:5px;font-size:10px;" type="submit" name="qty_change">Change</button><br>'.
        '</form><br>'.
        '</span><br><hr style="margin-top:5px;">';
    }
}
//budget functions
function get_rates($table){
    global $db;
    $eventid = $_SESSION['eventid'];
    
    //calculate event hours
        $hours = get_info($eventid)['end']- get_info($eventid)['start'];
        // echo abs($hours);
    
    //av supplier rate hourly
    $query = "SELECT rate FROM event_av 
    INNER JOIN av_suppliers ON event_av.supplierid = av_suppliers.avsupplierid
    WHERE eventid=$eventid";
    $result = mysqli_fetch_assoc(mysqli_query($db,$query));
    $av_rate = $result['rate'];
    

    //photography rate hourly
    $query = "SELECT rate FROM event_photography
    INNER JOIN photographer ON event_photography.photgrapherid = photographer.photographerid
    WHERE eventid=$eventid";
    // echo $query;
    $result = mysqli_fetch_assoc(mysqli_query($db,$query));
    $photo_rate = $result['rate'];
    
    //venue rate hourly
    $query = "SELECT rate FROM event_venues
    INNER JOIN venues ON event_venues.venueid = venues.venueid
    WHERE eventid=$eventid";
    $result = mysqli_fetch_assoc(mysqli_query($db,$query));
    $venue_rate = $result['rate'];

    //food per item rate
    $query = "SELECT * FROM event_food
    INNER JOIN fooditems ON event_food.itemid = fooditems.itemid
    WHERE eventid=$eventid";
    $result = mysqli_query($db,$query);
    $food = $result;
    
    $food_amount=0;
    if($table=='venue'){
        echo $venue_rate .' LKR';
    }
    elseif($table=='av'){
        echo $av_rate .' LKR';
    }
    elseif($table=='photo'){
        echo $photo_rate .' LKR';
    }
    elseif($table=='print_food'){
         while($foodlist=mysqli_fetch_assoc($result)){
            $food_subtotal=0;
            echo'<span style="margin-left:200px;">'.($foodlist['itemname']).'</span>' ;
            echo ' <span style="float:right"> ';
            echo($foodlist['price']) ;
            echo ' x ';
            echo($foodlist['quantity']);
            echo '=';
            $food_amount = $foodlist['price']*$foodlist['quantity'];
            echo $food_amount;
            $food_subtotal += $food_amount;
            echo ' </span> ';
            echo '<br>';
      }

        
        // echo $food_amount;
        
    }
    elseif($table=='array'){
        $food_subtotal=0;
        while($foodlist=mysqli_fetch_assoc($result)){
            $food_amount = $foodlist['price']*$foodlist['quantity'];
            $food_subtotal += $food_amount;
      }
        $priceset = array();
        $priceset['hours'] = $hours;
        $priceset['venue'] = $venue_rate;
        $priceset['photo'] = $photo_rate;
        $priceset['av'] = $av_rate;
        $priceset['food'] = $food_subtotal;
        $priceset['subtotal'] = ($venue_rate+$photo_rate+$av_rate)*$hours + $food_subtotal;
        $priceset['total']= $priceset['subtotal']*(1+(10/100))+500;
        return $priceset;
    }
}

//counter
function counter($table,$column,$value,$condcol,$condval){
    global $db;
    $query = "SELECT * FROM $table WHERE $column = $value ";
    if ($condcol!==0){
        $query .= "AND $condcol = $condval";
    }
    // echo $query;
    $result = mysqli_num_rows(mysqli_query($db, $query));
    echo $result;
}






?>
