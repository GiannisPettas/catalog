<?php include "./conn.php" ?>
<?php
  session_start();
  if(!isset($_SESSION["userEmail"])){
    header("Location:index.php");
  }
  $message ='';
  if (isset($_POST['edit'])){
		//read form data
    $id         = $_POST['id'];
		$name       = $_POST['name'];
		$surname    = $_POST['surname'];
		$email      = $_POST['email'];
		$telephone  = $_POST['telephone'];
		$address    = $_POST['address'];
    $city       = $_POST['city'];
    $country    = $_POST['country'];
		
		//build query
		$query = "UPDATE user 
					SET
					name        = '$name',
					surname     = '$surname',
					email       = '$email',
					telephone   = '$telephone',
          address     = '$address',
          city        = '$city',
          country     = '$country'
					WHERE 
					id = '$id' ";
		//execute query and assign output to $result variable
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$message = "Η επαφή αποθηκεύτηκε επιτυχώς!";
	}

	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		//build query
		$query = "SELECT * FROM user WHERE id = '$id' ";
		//execute query and assign output to $result variable
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));	
		
		$row = mysqli_fetch_assoc($result);
		$name       = $row['name'];
		$surname    = $row['surname'];
		$email      = $row['email'];
		$image      = $row['image'];
		$telephone  = $row['telephone'];
		$address    = $row['address'];
    $city       = $row['city'];
    $country    = $row['country'];
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
                  <li class="breadcrumb-item active"><?=$name . " " .$surname?> - Επεξεργασία</li>
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
                <h3 class="card-title"><?=$name . " " .$surname?> - Επεξεργασία</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form id="quickForm" novalidate="novalidate" action="edit_member.php" method="post">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?=$id?>" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                  </div> 
                  <div class="form-group">
                    <label for="surname">ΕΠΙΘΕΤΟ</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="<?=$surname?>">
                  </div> 
                  <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$email?>">
                  </div> 
                  <div class="form-group">
                    <label for="telephone">ΤΗΛΕΦΩΝΟ</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="<?=$telephone?>">
                  </div> 
                  <div class="form-group">
                    <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?=$address?>">
                  </div> 
                  <div class="form-group">
                    <label for="city">ΠΟΛΗ</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?=$city?>">
                  </div> 
                  <div class="form-group">
                    <label for="country">ΧΩΡΑ</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?=$country?>">
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="edit">Αποθήκευση</button>
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
      