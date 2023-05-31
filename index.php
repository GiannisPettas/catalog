<?php include "./conn.php" ?>
<?php
  session_start();
	$query = 
  "SELECT *
  FROM user 
  ORDER BY name ASC";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
                  <li class="breadcrumb-item active">Αρχική σελίδα</li>
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
        <div class="col-lg-12">
          <div class="card card-primary card-outline">
            <div class="card-header text-center">
              <h5 class="m-0">Τηλεφωνικός Κατάλογος</h5>
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
                    <?php } ?>
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
      