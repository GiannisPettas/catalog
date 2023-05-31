<?php include "./conn.php" ?>
<?php
  session_start();
  if(!isset($_SESSION["userEmail"])){
    header("Location:index.php");
  }
  $message ='';
  if (isset($_POST['add'])){
		//read form data
		$name       = $_POST['name'];
		$surname    = $_POST['surname'];
		$email      = $_POST['email'];
		$telephone  = $_POST['telephone'];
		$address    = $_POST['address'];
    $city       = $_POST['city'];
    $country    = $_POST['country'];
		
		//build query
		$query = "INSERT INTO `user` (`id`, `name`, `surname`, `email`, `image`, `telephone`, `address`, `city`, `country`)  
    VALUES (NULL, '$name', '$surname', '$email', '', '$telephone', '$address', '$city', '$country')"	;
		//execute query and assign output to $result variable
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    //clear POST
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']."?success=true");
	}
  if(isset($_REQUEST['success'])){
    $message = "Η επαφή αποθηκεύτηκε επιτυχώς!";
  }
?>
<?php include "./header.php" ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
                  <li class="breadcrumb-item active">Προσθήκη Εγγραφής</li>
                </ol>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
          <?php
            if($message != ""){
              print '<div class="callout callout-success">';
              print ('<p>' . $message  . '</p>');
              print '</div>';
            } 
          ?>
          <div class="card card-primary card-outline">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h3 class="card-title">Προσθήκη Εγγραφής</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form id="quickForm" action="add_member.php" method="post">
                  <div class="form-group">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div> 
                  <div class="form-group">
                    <label for="surname">ΕΠΙΘΕΤΟ</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                  </div> 
                  <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div> 
                  <div class="form-group">
                    <label for="telephone">ΤΗΛΕΦΩΝΟ</label>
                    <input type="number" maxlength="10"class="form-control" id="telephone" name="telephone" required>
                  </div> 
                  <div class="form-group">
                    <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div> 
                  <div class="form-group">
                    <label for="city">ΠΟΛΗ</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                  </div> 
                  <div class="form-group">
                    <label for="country">ΧΩΡΑ</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add">Αποθήκευση</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->

<?php include "./footer.php" ?>
      