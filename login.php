<?php include "./conn.php" ?>
<?php
  session_start();
  $error="";
  if (isset($_POST['login'])){
    $userEmail = $_POST['email'];
    $pass = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$userEmail' AND pass = '$pass' ");
    $result = mysqli_fetch_array($query);

    if(is_array($result)){
      $_SESSION["userEmail"] = $result['email'];
      }
    else{
      $error = "Λάθος στοιχεία! παρακαλώ δοκιμάστε ξανά!";
    }
  }
  if(isset($_SESSION["userEmail"])){
  header("Location:index.php");
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
                  <li class="breadcrumb-item active">Είσοδος Διαχειριστή </li>
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
        <div class="col-lg-8">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Είσοδος Διαχειριστή</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="login.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Δώσε το email σου" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Κωδικός</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Δώσε τον κωδικό σου" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="login" value="login">Είσοδος</button>
                </div>
              </form>
            </div>
        </div>
        <?php
        if($error != ""){
            print '<div class="col-lg-8"><div class="card card-default">';
            print '<div class="card-header">';
            print '</div>';
            print '<div class="card-body">';
            print '<div class="callout callout-danger">';
            print ('<p>' . $error  . '</p>');
            print '</div>';
            print '</div>';
            print '</div>';
            print '</div>';
          }
        ?>
        
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->

<?php include "./footer.php" ?>
      