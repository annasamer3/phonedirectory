<?php
// Initialize the session
session_start();
 $userid=$_SESSION['id'];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["id"])){
    header("location: login.php");
    exit;
}
?>
<?php
    require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['pId']) && isset($_POST['phoneNumber'])){
        $pId = $_POST['pId'];
        $phoneNumber= $_POST['phoneNumber'];
        $query = "INSERT INTO `numbers` (phoneNumber, num_pId, createdUserId) VALUES ('$phoneNumber', '$pId', '$userid')";
        $result = mysqli_query($connection, $query);
        if($result){
            header("location: welcome.php" , "refresh");
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
</head>
<body>
<form class="dataEntry" method="post" action="add.php" style="margin-left: 400px;">
    <input type="hidden" name="pId" value="<?php echo $_GET['id'] ?>">
<br> <br>
    Number <input required type="text" name="phoneNumber">
    <br> <br>
     <button class="btn type="submit" style="margin-left: 80px;">Submit</button>
</form>
</body>
</html>