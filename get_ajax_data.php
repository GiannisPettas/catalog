<?php include "./conn.php" ?>
<?php
  session_start();

  $logedIn = False;
  if(isset($_SESSION["userEmail"])){
    $logedIn = True;
  }

  $getRequest = "";
  if (isset($_REQUEST['request'])){
    $getRequest = $_REQUEST['request'];
  }


  if($getRequest == "view" && isset($_REQUEST['id']) && isset($_REQUEST['column'])){
    $id = $_REQUEST['id'];
    $column = $_REQUEST['column'];
    if($column == "all") $column = "*";
    if($id == "all"){
      $query = 
        "SELECT $column
        FROM user";
    }
    else{
      $query = 
        "SELECT $column
        FROM user
        WHERE `id` = '$id'";
    }

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    array_push($data, $logedIn);
    print json_encode($data);
    
  }

  if(isset($_POST['id']) 
    && isset($_POST['name'])  
    && isset($_POST['surname'])  
    && isset($_POST['email'])  
    && isset($_POST['telephone'])  
    && isset($_POST['address'])  
    && isset($_POST['city'])  
    && isset($_POST['country'])  
    && isset($_POST['action'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone']; 
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country']; 
    $action = $_POST['action']; 
  
    if( $action == "filter"){
      echo "FILTERED";
    }

    if($logedIn){
      if( $action == "update"){
        $query = 
        "UPDATE user
        SET `name` = '$name',
            `surname` = '$surname',
            `email` = '$email',
            `telephone` = '$telephone',
            `address` = '$address',
            `city` = '$city',
            `country` = '$country'
        WHERE `id` = '$id'";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "UPDATED";
      }

      if( $action == "add"){
        $query = "INSERT INTO user (`name`, `surname`, `email`, `telephone`, `address`, `country`)
        VALUES ('$name', '$surname', '$email', '$telephone', '$address', '$country')";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "ADDED";
      }

      if( $action == "delete"){
        $query = "DELETE FROM `user` WHERE `id` = '$id' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "DELETED";
      }
    }
  }

  if($getRequest == 'delete' && isset($_REQUEST['row']) && $logedIn){
    $row = $_REQUEST['row'];
    $query = 
      "DELETE 
      FROM user 
      WHERE row = $row";
  }

?>

      