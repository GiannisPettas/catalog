<?php include "./conn.php" ?>
<?php
  session_start();
  if(!isset($_SESSION["userEmail"])){
    header("Location:index.php");
  }
  if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
    // $requester = $_REQUEST['requester'];
		//build query
		$query = "DELETE FROM user WHERE id = '$id' ";
		//execute query and assign output to $result variable
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    unset($_POST);
    header("Location:index.php");
	}
?>