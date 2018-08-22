<?php

if (!isset ($_SESSION['flag'])){
    header('location:../../index.php');
}
get_info($_GET['eventid']);

$eventid = $_GET['eventid'];
$_SESSION['eventid']=$eventid;
$event= get_info($eventid);
echo $event['event_name'];  
if ($event['status']==0){
    echo '<div class="label_pending">Pending</div>';
}
elseif($event['status']==1){
    echo '<div class="label_completed">Completed</div>';
}
else{
    echo '<div class="label_cancelled">Cancelled</div>';
}

// $sub_total = $_SESSION['sub'];
// $grand_total = $_SESSION['tot'];
?>

<div>
    <div class="label">
        <h3>General</h3>
        <a id="edit_triggesr" href="#" onClick="set_type('edit_general')">[Edit]</a>
        <ul>
            <li>
                Date: <?php echo get_entry('eventid',$eventid,'event','date',0);?>
            </li>
            <li>
                From: <?php echo get_entry('eventid',$eventid,'event','start',0);?>
            </li>
            <li>
                To: <?php echo get_entry('eventid',$eventid,'event','end',0);?>
            </li>

            <li>
                City: <?php echo get_entry('eventid',$eventid,'event','location',0);?>
            </li>
            <li>
                Created by: <?php 
                $overridequery = "SELECT username FROM user
                INNER JOIN `event` ON user.userid=`event`.userid
                WHERE eventid=$eventid";
                echo get_entry('eventid',$eventid,'event','username',$overridequery);?>
            </li>
        </ul>
    </div>
    <div class="label">
        <h3>Budget</h3><br>
        
        <span style="font-size:20px;">
            TOTAL: <?php echo get_rates('array')['total'];?> LKR
        </span>
        <ul>
        <li>
                Sub Total: <?php echo get_rates('array')['subtotal'];?>LKR 
            </li>
            <li>
                Site Charges: 500 LKR
            </li>
            <span>
            <span>
                <a id="edit_trigger" href="#" onClick="set_type('budget')">See Detailed Budget</a>
            </span>
            
                <?php 
                    $pay_stat =  get_entry('eventid',$eventid,'event','payment',0);
                    
                    if($pay_stat==1){
                        
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Paid</div>';
                    }
                    else{
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Payment</div>';
                    }
                ;
                echo '    <form action ="../server/admin.php" method="POST">
                <input type="hidden" name="table" value="event">
                <input type="hidden" name="paychange" value="1">'.
                '<input type="hidden" name="eventid" value="'.$eventid.'">'.   
                '<button style="background-color:green;height:25px" type="submit" name="pay" value="1">Paid</button>
                <button style="background-color:orange;color:black;height:25px" type="submit" name="pay" value="0">Pending</button>
    
                </form>'
                ?>
            </span>
        </ul>
    </div>


    <div class="label">
        <h3>Venue</h3>
        <a id="edit_trigger" href="#" onClick="set_type('edit_venue')">[Edit]</a>
        <ul>
            <li>
                Venue: <?php 
                $overridequery_venue = "SELECT `venues`.`venue_name`,`event_venues`.`eventid` FROM `venues` 
                INNER JOIN `event_venues` 
                ON `venues`.`venueid` = event_venues.venueid 
                WHERE `event_venues`.`eventid` = '$eventid'";
                get_entry('eventid',$eventid,'event_venues','venue_name',$overridequery_venue);?>
            </li>   
            <li>
                Hourly Rate: <?php get_rates('venue');?>
            </li>
            <span>
                <?php 
                    $ven_stat =  get_entry('eventid',$eventid,'event_venues','status',0);
                    
                    if($ven_stat==1){
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Booking Completed</div>';
                    }
                    else{
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Booking Pending</div>';
                    }
                ;
                
                echo '    <form action ="../server/admin.php" method="POST">
                <select style="width:150px;text-align:left" name = "status">
                Set Status
                    <option value = "1">Confirmed</option>
                    <option value = "0">Pending</option>
                <select>
                <input type="hidden" name="table" value="event_venues">'.
                '<input type="hidden" name="eventid" value="'.$eventid.'">'.   
                '

                <button type="submit" name="stat_change_save">Save</button>
            </form>'?>


            </span>
        </ul>
    </div>

    <div class="label">
        <h3>Food</h3>
    <a id="edit_trigger" href="#" onClick="set_type('edit_caterer')">[Edit]</a>
    
        <ul>
            <li> Caterer:
            <?php 
                $overridequery = "SELECT `caterers`.`name`,`event_catering`.`eventid` FROM `caterers` 
                INNER JOIN `event_catering` 
                ON `caterers`.`catererid` = event_catering.catererid 
                WHERE `event_catering`.`eventid` = '$eventid'";
                get_entry('eventid',$eventid,'event_catering','name',$overridequery);?>
            </li>
            <li>
                Food Items: <a id="foodlist" href="#foodlist" onClick="set_type('food_list')">[see list]</a>
            </li>
            <span>
            <?php 
                    $pay_stat =  get_entry('eventid',$eventid,'event_catering','status',0);
                    
                    if($pay_stat==1){
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Order Accepted</div>';
                    }
                    else{
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Order Pending</div>';
                    }
                ;
                echo '    <form action ="../server/admin.php" method="POST">
                <select style="width:150px;text-align:left" name = "status">
                Set Status
                    <option value = "1">Confirmed</option>
                    <option value = "0">Pending</option>
                <select>
                <input type="hidden" name="table" value="event_catering">
                '.
                '<input type="hidden" name="eventid" value="'.$eventid.'">'.   
                '
                <button type="submit" name="stat_change_save">Save</button>
            </form>'
                ?>
            </span>

        </ul>
        
    </div>

    <div class="label">
        <h3>Audio Video</h3>
        <a id="edit_trigger" href="#" onClick="set_type('edit_av')">[Edit]</a>
        <ul>
            <li> Supplier:
            <?php 
                $overridequery = "SELECT `av_suppliers`.`name`,`event_av`.`eventid` FROM `av_suppliers` 
                INNER JOIN `event_av` 
                ON `av_suppliers`.`avsupplierid` = event_av.supplierid 
                WHERE `event_av`.`eventid` = '$eventid'";
                get_entry('eventid',$eventid,'event_av','name',$overridequery);?>
            </li>
            <li>Hourly Rate: <?php get_rates('av');?></li>
            <span>
            <?php 
                    $pay_stat =  get_entry('eventid',$eventid,'event_av','status',0);
                    
                    if($pay_stat==1){
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Confirmed</div>';
                    }
                    else{
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Pending</div>';
                    }
                    echo '    <form action ="../server/admin.php" method="POST">
                    <select style="width:150px;text-align:left" name = "status">
                    Set Status
                        <option value = "1">Confirmed</option>
                        <option value = "0">Pending</option>
                    <select>
                    <input type="hidden" name="table" value="event_av">
                    '.
                '<input type="hidden" name="eventid" value="'.$eventid.'">'.   
                '
                    <button type="submit" name="stat_change_save">Save</button>
                </form>'
                ;?>
            
            </span>
        </ul>



    </div>

    <div class="label">
        <h3>Photography</h3>
        <a id="edit_trigger" href="#" onClick="set_type('edit_photo')">[Edit]</a>
        <ul>
            <li> Supplier:
            <?php
                 $overridequery = "SELECT `photographer`.`name`,`event_photography`.`eventid` FROM `photographer` 
                 INNER JOIN `event_photography` 
                 ON `photographer`.`photographerid` = event_photography.photgrapherid 
                 WHERE `event_photography`.`eventid` = '$eventid'";
                 get_entry('eventid',$eventid,'event_photography','name',$overridequery);?>
            </li>
            <li>Hourly Rate: <?php get_rates('photo');?></li>
            <span>
            <?php 
                    $pay_stat =  get_entry('eventid',$eventid,'event_photography','status',0);
                    
                    if($pay_stat==1){
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_completed">Confirmed</div>';
                    }
                    else{
                        echo '<div style="display:inline-block; margin:5px;;height:10px;font-size:10px;" class="label_pending">Pending</div>';
                    }
                ;
                echo '    <form action ="../server/admin.php" method="POST">
                <select style="width:150px;text-align:left" name = "status">
                Set Status
                    <option value = "1">Confirmed</option>
                    <option value = "0">Pending</option>
                <select>
                <input type="hidden" name="table" value="event_photography">
                '.
                '<input type="hidden" name="eventid" value="'.$eventid.'">'.   
                '
                <button type="submit" name="stat_change_save">Save</button>
            </form>'
                ?>
            </span>
        </ul>
    </div>


    <div class="label" id="guests">
        <h3>Guests</h3>
        
            <ul>
                <li>
                    Invited: <?php counter('guests','eventid',$eventid,0,0);?>
                </li>
                <li>
                    Confirmed: <?php counter('guests','eventid',$eventid,'rsvp',1);?>
                </li>
                <li>
                    Declined: <?php counter('guests','eventid',$eventid,'rsvp',2);?>
                </li>
                <li>
                    Pending: <?php counter('guests','eventid',$eventid,'rsvp',0);?>
                </li>
                <li>
                    Guest List: <a id="edit_trigger" href="#"onClick="set_type('edit_guests')">[See List]</a>
                </li>
            </ul>
    </div>

    <div class="label">
        <h3 style="color:red">Event Actions</h3>
        <form action = "../server/server.php" method="POST">
        <?php echo '<input type="hidden" name="eventid" value ="'.
        $eventid.'">';
        ?>
        <button name="event_complete" style="height:30px;background-color:green;width:150px">Mark as Completed</button>
        <button name="event_cancel" style="height:30px;width:150px">Cancel Event</button>
        <button name="event_resume" style="height:30px;width:150px">Resume Event</button>
        <button name="event_delete" style="height:30px; background-color:red;width:150px">Delete Event</button>
        </form>
    </div>

    <div id="edit_general" style="height:250px;" class="newevent">
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
        ?>
        Edit General Information
        <form name="edit_general" action ="../server/server.php" method="POST" style="font-size: 12px;" >
            <label>Event Name</label>
            <?php edit_event($eventid,'event','event_name','text');?>
            
            <label>Date</label>
            <?php edit_event($eventid,'event','date','date');?>
            <label>From</label>
            <?php edit_event($eventid,'event','start','time');?>
			<label>To</label>
            <?php edit_event($eventid,'event','end','time');?>
			<label>Nearest City</label>
            <?php edit_event($eventid,'event','location','close');?>
            <?php echo '<input type="hidden" name="eventid" value ="'.$eventid.'">';?>
            <input type="hidden" name="table" value ="event">
			<button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>
    <!-- Edit Venue Information Modal -->
        <div id="edit_venue" style="height:250px;" class="newevent">
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
        ?>
        Edit Venue Information
        <form name="edit" action ="../server/server.php" method="POST" style="font-size: 12px;" >
            <select name="venueid">
				<option value="custom">Custom Venue</option>
			<?php gen_list("venues");?>
            </select>
            <?php echo '<input type="hidden" name="eventid" value ="'.$eventid.'">';?>
            <input type="hidden" name="table" value ="event_venues">
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>

    <div id="edit_caterer" style="height:250px;" class="newevent">
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
        ?>
        Change Caterer 
        <form name="edit" action ="../server/server.php" method="POST" style="font-size: 12px;" >
            <select name="catererid">
				<option value="custom">No Thank You!</option>
			<?php gen_list("caterers");?>
            </select>
            <?php echo '<input type="hidden" name="eventid" value ="'.$eventid.'">';?>
            <input type="hidden" name="table" value ="event_catering">
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>

    <div id="edit_av" style="height:250px;" class="newevent">
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
        ?>
        Change Audio Visual Equipment Supplier
        <form name="edit" action ="../server/server.php" method="POST" style="font-size: 12px;" >
            <select name="supplierid">
				<option value="custom">No Thank You!</option>
			<?php gen_list("av_suppliers");?>
            </select>
            <?php echo '<input type="hidden" name="eventid" value ="'.$eventid.'">';?>
            <input type="hidden" name="table" value ="event_av">
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>

    <div id="edit_photo" style="height:250px;" class="newevent">
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
        ?>
        Change Audio Visual Equipment Supplier
        <form name="edit" action ="../server/server.php" method="POST" style="font-size: 12px;" >
            <select name="photgrapherid">
				<option value="custom">No Thank You!</option>
			<?php gen_list("photographer");?>
            </select>
            <?php echo '<input type="hidden" name="eventid" value ="'.$eventid.'">';?>
            <input type="hidden" name="table" value ="event_photography">
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>

    <div id="edit_guests" style="height:400px;" class="newevent">
         Guest List
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            echo '<div style="overflow:auto;height:250px;font-size:12px;">';
            get_guests($eventid);
            echo '</div>';
        ?>
        <form style="margin-top:5px;font-size:12px" action ="../server/server.php" method="POST">
            <label>Add New Guest</label><br>
            <label>Name</label>
            <input style="display:inline-block;height:15px;width:200px;"name="guest_name" type="text">
            <label>RSVP</label>
            <select style="display:inline-block;width:200px;" name ="status">
                <option  value="0">Pending</option>
                <option  value="1">Confirmed</option>
                <option  value="2">Declined</option>
            </select>
            <?php echo '<input type="hidden" name="eventid" value = "'.$eventid.'">';?>
            <button style="height:45px;width:50px;" type="submit" name="add_guest">Add</button>
        </form>
    </div>

    <div id ="food_list" style = "height:400px" class = "newevent">
        Food Items
        <?php
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            echo '<div style="overflow:auto;height:250px;font-size:12px;">';
            get_food($eventid);
            echo '</div>';
        ?>
        Add Food
        <span style="font-size:12px;display:inline;">Only food items available with your caterer are listed</span>
        <form action = "../server/server.php" method="POST">
        <select style="width:200px;" name="itemid">
            <?php gen_food_list($eventid);?>
			</select>
        <input style="width:50px;heightadd_food:40px;"type="number" name="quantity" placeholder="QTY">
        <?php echo '<input type="hidden" name="eventid" value = "'.$eventid.'">';?>
        <button type="submit" name="add_food">Add Food</button>
        </form>
    </div>

    <div id ="budget" style = "height:400px" class = "newevent">
        Budget of 
        <?php 
            echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            echo $event['event_name'].'<br>';
            $rates= get_rates('array');
            $subtotal=0;
            // echo $rates['hours'];
        ?>
        <div style="overflow:auto;height:250px;font-size:12px;">
            <ul style="font-size:18px;">
                <li>
                    Food<br>
                    <span style="font-size:12px;">
                        <span style="margin-left:200px;color:gray">Item</span>
                        <span style="float:right;color:gray">Rate x Qty = Total</span><br>
                        <hr style="margin-left:200px">
                        <?php get_rates('print_food');?>
                    </span>
                    
                    <hr>
                </li>   
                <li>
                    Venue <br>
                    <span style="font-size:12px;">
                        <span style="margin-left:200px;color:gray">Venue</span>
                        <span style="float:right;color:gray">Hourly Rate x Hours = Total</span><br>
                        <hr style="margin-left:200px">   
                        <span style="margin-left:200px;">
                        <?php 
                $overridequery_venue = "SELECT `venues`.`venue_name`,`event_venues`.`eventid` FROM `venues` 
                INNER JOIN `event_venues` 
                ON `venues`.`venueid` = event_venues.venueid 
                WHERE `event_venues`.`eventid` = '$eventid'";
                get_entry('eventid',$eventid,'event_venues','venue_name',$overridequery_venue);?>
                        </span>
                        <span style="float:right">
                            <?php 
                            $rate = $rates['venue'];
                            $hours = $rates['hours'];
                            echo $rate.' x '.$hours .' = '.$rate*$hours;
                            ?>
                        </span><br>
                    <hr>
                </li>
                <li>
                    Photography <br>
                    <span style="font-size:12px;">
                        <span style="margin-left:200px;color:gray">Provider</span>
                        <span style="float:right;color:gray">Hourly Rate x Hours = Total</span><br>
                        <hr style="margin-left:200px">


                    <span style="margin-left:200px;">
                        <?php 
                                 $overridequery = "SELECT `photographer`.`name`,`event_photography`.`eventid` FROM `photographer` 
                                 INNER JOIN `event_photography` 
                                 ON `photographer`.`photographerid` = event_photography.photgrapherid 
                                 WHERE `event_photography`.`eventid` = '$eventid'";
                                 get_entry('eventid',$eventid,'event_photography','name',$overridequery);?>
                        </span>
                        <span style="float:right">
                            <?php 
                            $rate = $rates['photo'];
                            // $hours = get_rates('array')['hours'];
                            echo $rate.' x '.$hours .' = '.$rate*$hours;
                            ?>
                        </span><br>                
                    </span>
                    <hr>
                </li>
                
                <li>
                    Audio Visual<br>
                    <span style="font-size:12px;">
                        <span style="margin-left:200px;color:gray">Provider</span>
                        <span style="float:right;color:gray">Hourly Rate x Hours = Total</span><br>
                        <hr style="margin-left:200px">
                        
                        <span style="margin-left:200px;">
                        <?php 
                        $overridequery = "SELECT `av_suppliers`.`name`,`event_av`.`eventid` FROM `av_suppliers` 
                        INNER JOIN `event_av` 
                        ON `av_suppliers`.`avsupplierid` = event_av.supplierid 
                        WHERE `event_av`.`eventid` = '$eventid'";
                        get_entry('eventid',$eventid,'event_av','name',$overridequery);?>
                        </span>
                            <span style="float:right">
                                <?php 
                                $rate = $rates['av'];
                                // $hours = get_rates('array')['hours'];
                                echo $rate.' x '.$hours .' = '.$rate*$hours;
                                ?>
                            </span><br>
                        
                        
                        
                        


                    </span>
                    <hr>
                </li>

                <!-- <li>
                    Other<br>
                    <span style="font-size:12px;">
                        <span style="margin-left:200px;color:gray">Particulars</span>
                        <span style="float:right;color:gray">Rate x Qty = Total</span><br>
                        <hr style="margin-left:200px">
                    </span>
                    <hr>
                </li> -->

                <span>

                    <span style="font-size:12px;">
                        <span style="margin-left:200px;">Sub Total
                        <span style="float:right">
                        <?php echo $sub =$_SESSION['sub']=$rates['subtotal'].' LKR';?>
                        </span>
                        </span><br>
                            
                        </span>
                        <br>
                        <hr style="margin-left:200px;">
                        <span style="margin-left:200px;font-size:12px;">VAT (10%):
                            <span style="float:right">
                                <?php echo $vat=$rates['subtotal']*(10/100).' LKR';?>
                             </span>
                        </span>
                        <br>
                        <hr style="margin-left:200px">
                        <span style="margin-left:200px;font-size:12px;">Site Charges</span>
                        <span style="float:right;font-size:12px;">500 LKR</span><br>
                        <hr style="margin-left:200px">
                        <br>
                    </span>
                    TOTAL: <?php echo ($total=$_SESSION['tot']=$vat+$sub+500).' LKR';?>
</span>
            </ul>
</div>
          
        </div>




        
</div>