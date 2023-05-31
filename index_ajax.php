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
          <div class="container-fluid form-holder">
            <!--Advanced Search Form -->
            <div class="" id="advanced_search_form";>
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">ΦΙΛΤΡΑΡΙΣΜΑ ΕΓΓΡΑΦΩΝ</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input type="text" class="form-control name" name="name">
                  </div> 
                  <div class="form-group">
                    <label for="surname">ΕΠΙΘΕΤΟ</label>
                    <input type="text" class="form-control surname" name="surname">
                  </div>
                  <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="telephone">ΤΗΛΕΦΩΝΟ</label>
                    <input type="number" maxlength="10" class="form-control telephone" name="telephone">
                  </div> 
                  <div class="form-group">
                    <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
                    <input type="text" class="form-control address" name="address">
                  </div> 
                  <div class="form-group">
                    <label for="city">ΠΟΛΗ</label>
                    <input type="text" class="form-control city" name="city">
                  </div> 
                  <div class="form-group">
                    <label for="country">ΧΩΡΑ</label>
                    <input type="text" class="form-control country" name="country">
                  </div>
                  <div class="form-group">
                  <label></label>
                    <button type="submit" class="btn btn-success m-1 submit-form" name="search">Αναζήτηση</button> 
                  </div>
                </div>
                <!-- /.card-body -->
              </div><!-- /.card-primary -->
            </div>
            <!--Add Form -->
            <div class="" id="add_form">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">ΠΡΟΣΘΗΚΗ ΕΓΓΡΑΦΗΣ</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input type="text" class="form-control name" name="name">
                  </div> 
                  <div class="form-group">
                    <label for="surname">ΕΠΙΘΕΤΟ</label>
                    <input type="text" class="form-control surname" name="surname">
                  </div>
                  <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="telephone">ΤΗΛΕΦΩΝΟ</label>
                    <input type="number" maxlength="10" class="form-control telephone" name="telephone">
                  </div> 
                  <div class="form-group">
                    <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
                    <input type="text" class="form-control address" name="address">
                  </div> 
                  <div class="form-group">
                    <label for="city">ΠΟΛΗ</label>
                    <input type="text" class="form-control city" name="city">
                  </div> 
                  <div class="form-group">
                    <label for="country">ΧΩΡΑ</label>
                    <input type="text" class="form-control country" name="country">
                  </div>
                  <div class="form-group">
                  <label></label>
                    <button type="submit" class="btn btn-info m-1 add-form" name="search">Προσθήκη</button> 
                  </div>
                </div>
                <!-- /.card-body -->
              </div><!-- /.card-primary -->
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-12">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap" id="data-table">
                <thead>
                  <tr>
                    <th class="table-header" data-sort="ASC" data-name="name"><h1>ΟΝΟΜΑ</h1><img src="dist/img/sort.png"></th>
                    <th class="table-header" data-sort="NONE" data-name="surname"><h1>ΕΠΙΘΕΤΟ</h1></th>
                    <th class="table-header" data-sort="NONE" data-name="email"><h1>EMAIL</h1></th>
                    <th class="table-header" data-sort="NONE" data-name="telephone"><h1>ΤΗΛΕΦΩΝΟ</h1></th>
                    <th><h1>ΕΝΕΡΓΕΙΕΣ</h1></th>
                  </tr>
                </thead>
                <tbody id="main-table">
                </tbody>
              </table>
            </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
  </div>
      <!-- /.content-wrapper -->



      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline"></div>
        <!-- Default to the left -->
        <strong
          >Copyright &copy; 2023
          <a href="">OTE</a>.</strong
        >
        All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous">
    </script>
    <script src="dist/js/ajax.js"></script>
  </body>
</html>



      