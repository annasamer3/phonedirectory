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
    if (isset($_GET['id'])){
        $pId = $_GET['id'];
        $query = "SELECT * FROM `person` WHERE pId = $pId" ;
        $result = mysqli_query($connection, $query);
        $row = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
</head>
<body>
<form class="dataEntry" method="post" action="welcome.php" style="margin-left: 400px;">
    <input type="hidden" name="pId" value="<?php echo $pId ?>">
  EditName: <input value="<?php echo $row['pName'] ?>" required type="text" name="pName" style="margin-left: 9px;">
<br> <br>
    EditNumber: <input value="<?php echo $row['pNumber'] ?>" required type="text" name="pNumber">
    <br> <br>
     <button class="btn type="submit" style="margin-left: 80px;">Submit</button>
</form>
</body>
</html>