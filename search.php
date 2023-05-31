<?php include "./conn.php" ?>
<?php
session_start();
  $message ='';
  if (isset($_POST['search'])){
		//read form data
		$name       = $_POST['name'];
		$surname    = $_POST['surname'];
		$email      = $_POST['email'];
		$telephone  = $_POST['telephone'];
		$address    = $_POST['address'];
    $city       = $_POST['city'];
    $country    = $_POST['country'];
		
		//build query
		$query = "SELECT * FROM `user` WHERE ";
    $first = True;
    if($name != NULL){
      if(!$first) $query .= " AND";
      $query .= "`name` LIKE  '%$name%'";
      $first = False;
    }
    if($surname != NULL){
      if(!$first) $query .= " AND";
      $query .= "`surname` LIKE '%$surname%'";
      $first = False;
    }
    if($email != NULL){
      if(!$first) $query .= " AND";
      $query .= "`email` LIKE '%$email%'";
      $first = False;
    }
    if($telephone != NULL){
      if(!$first) $query .= " AND";
      $query .= "`telephone` LIKE '%$telephone%'";
      $first = False;
    }
    if($address != NULL){
      if(!$first) $query .= " AND";
      $query .= "`address` LIKE '%$address%'";
      $first = False;
    }
    if($city != NULL){
      if(!$first) $query .= " AND";
      $query .= "`city` LIKE '%$city%'";
      $first = False;
    }
    if($country != NULL){
      if(!$first) $query .= " AND";
      $query .= "`country` LIKE '%$country%'";
      $first = False;
    }
		//execute query and assign output to $result variable
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
                  <li class="breadcrumb-item active">Αναζήτηση Εγγραφής</li>
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
        <div class="col-lg-3">
          <div class="card card-primary card-outline">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h3 class="card-title">Αναζήτηση Εγγραφής</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form id="quickForm" action="search.php" method="post">
                  <div class="form-group">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div> 
                  <div class="form-group">
                    <label for="surname">ΕΠΙΘΕΤΟ</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                  </div> 
                  <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div> 
                  <div class="form-group">
                    <label for="telephone">ΤΗΛΕΦΩΝΟ</label>
                    <input type="number" maxlength="10"class="form-control" id="telephone" name="telephone">
                  </div> 
                  <div class="form-group">
                    <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
                    <input type="text" class="form-control" id="address" name="address">
                  </div> 
                  <div class="form-group">
                    <label for="city">ΠΟΛΗ</label>
                    <input type="text" class="form-control" id="city" name="city">
                  </div> 
                  <div class="form-group">
                    <label for="country">ΧΩΡΑ</label>
                    <input type="text" class="form-control" id="country" name="country">
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="search">Αναζήτηση</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card card-primary card-outline">
            <div class="card-header text-center">
              <h5 class="m-0">Αποτελέσματα Αναζήτησης</h5>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ΟΝΟΜΑ</th>
                    <th>ΕΠΙΘΕΤΟ</th>
                    <th>EMAIL</th>
                    <th>ΤΗΛΕΦΩΝΟ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   if (isset($_POST['search'])){ 
                    while($row = mysqli_fetch_assoc($result)){
                      $id           = $row['id'];
                      $name         = $row['name'];
                      $surname      = $row['surname'];
                      $email        = $row['email'];
                      $telephone    = $row['telephone'];
                  ?>
                  <tr>
                    <td> <?= $name ?> </td>
                    <td> <?= $surname ?> </td>
                    <td> <?= $email ?>   </td>
                    <td> <?= $telephone ?> </td>
                    <td> 
                      <?php
                        print('<td>');  
                        print('<a href="view_member.php?id='. $id .'" class="btn btn-success m-1">Προβολή</a>');    
                        if(isset($_SESSION["userEmail"])){  
                          print('<a href="edit_member.php?id='. $id .'" class="btn btn-info m-1">Επεξεργασία</a>'); 
                          print('<a href="delete_member.php?id='. $id .'" class="btn btn-danger m-1">Διαγραφή</a>');
                        }
                        print('</td>');
                      ?>
                    </td>     
                  </tr>
                    <?php }} ?>
                </tbody>
              </table>
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
      