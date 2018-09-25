<?php
    require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_GET['id'])){
        $pId = $_GET['id'];
        $query = "DELETE FROM `person` WHERE pId = $pId";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Deleted Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }
    ?>