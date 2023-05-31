<?php include "./conn.php" ?>
<?php
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
                  <li class="breadcrumb-item active"><?=$name . " " .$surname?> - προβολή</li>
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
          <div class="card card-primary card-outline">
            <div class="card-header text-center">
              <h5 class="m-0"><?=$name . " " .$surname?> - αναλυτικά στοιχεία</h5>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
              <tbody>
                  <tr>
                    <th>ΟΝΟΜΑ</th>
                    <td><?=$name?></td>
                  </tr>
                  <tr>
                    <th>ΕΠΩΝΥΜΟ</th>
                    <td><?=$surname?></td>
                  </tr>
                  <tr>
                    <th>EMAIL</th>
                    <td><?=$email?></td>
                  </tr>
                  <tr>
                    <th>ΤΗΛΕΦΩΝΟ</th>
                    <td><?=$telephone?></td>
                  </tr>
                  <tr>
                    <th>ΔΙΕΥΘΥΝΣΗ</th>
                    <td><?=$address?></td>
                  </tr>
                  <tr>
                    <th>ΠΟΛΗ</th>
                    <td><?=$city?></td>
                  </tr>
                  <tr>
                    <th>ΧΩΡΑ</th>
                    <td><?=$country?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-primary card-outline">
            <div class="card-header text-center">
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
      