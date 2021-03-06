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
        $query = "DELETE FROM `person` WHERE pId = $pId";
        $result = mysqli_query($connection, $query);
         
        if($query){
            echo json_encode("Delete Successfully");
        }else{
            echo json_encode("Failed To Delete");
        }
    }
    // If the values are posted, insert them into the database.
    if (isset($_POST['pName']) && isset($_POST['pNumber'])){
        $UserName = $_POST['pName'];
        $AddNumber = $_POST['pNumber'];
        
        if(isset($_POST['pId'])){
          $pId = $_POST['pId'];
          $query = "UPDATE `person` SET `pName`='$UserName',`pNumber`='$AddNumber' WHERE `pId` = '$pId'";
          mysqli_query($connection, $query);
        }else{
        $query = "INSERT INTO `person` (pName, pNumber, created_user_id) VALUES ('$UserName', '$AddNumber', '$userid')";
        $result = mysqli_query($connection, $query);
        if($result){
            header("location: welcome.php" , "refresh");
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
      }

    }
    //$query = "SELECT * FROM `person` WHERE created_user_id='$userid'";
    //$result = mysqli_query($connection, $query);
    $query="SELECT person.pId, numbers.phoneNumber, person.pName , person.pNumber
    FROM person
    LEFT JOIN numbers ON person.pId=numbers.num_pId WHERE created_user_id='$userid'";
    $result = mysqli_query($connection, $query);
    // print_r($row = $result->fetch_assoc());
    // die();
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
        <h1>Hi,Welcome to our site.</h1>
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
        <th><?php echo $row["pNumber"]; ?><br><?php echo $row["phoneNumber"]; ?></th>
    <th> 
        <a href="add.php?id=<?php echo $row["pId"]?> " value="<?php echo $row["pId"] ?>" class="btn btn-primary">Add</a>
        <a href="edit.php?id=<?php echo $row["pId"]?> " value="<?php echo $row["pId"] ?>" class="btn btn-default">Edit</a>
        <a type="button" at="<?php echo $row["pId"] ?>" class="add btn btn-danger">Delete</a>
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
<form class="dataEntry alert alert-success" method="post" style="margin-left: 450px; margin-right: 450px;">
  UserName: <input required type="text" name="pName" class="form-control">
<br> <br>
    AddNumber: <input required type="text" class="form-control" name="pNumber">
    <br> <br>
     <button class="btn btn-lg btn-primary">Submit</button>
</form>

<br>
 <p style="margin-left: 400px; margin-top: 50px;">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

</body>
<script type="text/javascript">
    $( ".add" ).click(function() {
      
      var id = $(this).attr('at');

      
  var r=confirm("Click the OK button now!");
if (r==true)
{
  $.ajax({
    type: "GET",
    url: 'welcome.php',
    data: {id: id},
    success: function(data){
        location.reload();
    }
});
}
else
{
  alert("You pressed Cancel!");
}
});

</script>
</html>