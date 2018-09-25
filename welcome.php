<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["username"])){
    header("location: login.php");
    exit;
}
?>
  <?php
    require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['pName']) && isset($_POST['pNumber'])){
        $UserName = $_POST['pName'];
        $AddNumber = $_POST['pNumber'];
 
        $query = "INSERT INTO `person` (pName, pNumber) VALUES ('$UserName', '$AddNumber')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }

    }
    $query = "SELECT * FROM `person`";
    $result = mysqli_query($connection, $query);
    ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="page-header" style="margin-left: 30px;">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
<div class="container">
  <h2>Phone Number List</h2>           
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Number</th>
         <th>Action</th>
      </tr>
    </thead>
     <tbody>
   <?php      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
             <tr>
        <th><?php echo $row["pName"]; ?></th>
        <th><?php echo $row["pNumber"]; ?></th>
    <th> 
        <a href="add.php" value="<?php echo $row["pId"] ?>" class="btn btn-primary">Add</a>
        <a href="edit.php" value="<?php echo $row["pId"] ?>" class="btn btn-default">Edit</a>
        <a href="delete.php" value="<?php echo $row["pId"] ?>" class="btn btn-danger">Delete</a>
    </th>
      </tr>
    <?php }
} else {
    echo "0 results";
}
?>
   </tbody>
  </table>
</div>
<br>
<form class="dataEntry" method="post" style="margin-left: 400px;">
  UserName: <input type="text" name="pName" style="margin-left: 9px;">
<br> <br>
    AddNumber: <input type="text" name="pNumber">
    <br> <br>
     <button class="btn type="submit" style="margin-left: 80px;">Submit</button>
</form>

<br>
 <p style="margin-left: 400px; margin-top: 50px;">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

</body>
</html>