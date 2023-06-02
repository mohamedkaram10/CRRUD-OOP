<?php include "inc/header.php" ?>
<?php include "inc/nav.php"    ?>


<?php 
if (isset($_GET['id']) && is_numeric($_GET['id'])) :
  $id = $_GET['id'];
  $row = $_GET['id'];
  if ($row) : 
    $row = $db->find_user("employees", $_GET['id']);

  $departments = ["it", "cs"];
  $error = '';
  $success = '';

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name         = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email        = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $department   = filter_var($_POST['department'], FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($department)) {
      $error = "Please Fill All Fields";
    } else {
      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $department = strtolower($department);
        if (in_array($department, $departments)) {
          // header("refresh: 3; url = employees.php"); 
          if (!empty($_POST['password'])) {
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            if (strlen($password) > 7) {
              $hashed_password = $db->hashed_password($password);
            } else {
              $error = "Password Must Be Greater Than <strong>7</strong> Chars";
            }
          }
          else {
            $password = $row['password'];
          }
          $sql = "UPDATE employees SET name = '$name', email = '$email', department = '$department', password = '$hashed_password' WHERE id = '$id' ";
            $success = $db->update_user($sql);
        } else {
          $error = "This Department <strong>Not Found</strong>";
        }
      } else {
        $error = "Please Enter Valid <strong>Email</strong>";
      }
    }
  }

  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="p-3 col text-center mt-5 text-white bg-primary">Edit Employees</h2>
      </div>
      <?php if ($error != '') : ?>
        <h2 class="alert alert-danger mt-5 text-center p-2 col"><?= $error ?></h2>
      <?php endif; ?>
      <?php if ($success != '') : ?>
        <h2 class="alert alert-success mt-5 text-center p-2 col"><?= $success ?></h2>
      <?php endif; ?>
    </div>
  </div>


    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-12">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
              <label for="username">Name</label>
              <input class="form-control mb-3 bg-#f4f4f4" value="<?= $row['name'] ?>" type="text" name="username" id="username" placeholder="Enter Name" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="department">Department</label>
              <input class="form-control mb-3 bg-#f4f4f4" value="<?= $row['department'] ?>" type="text" name="department" id="department" placeholder="Enter Department" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input class="form-control mb-3 bg-#f4f4f4" value="<?= $row['email'] ?>" type="text" name="email" id="email" placeholder="Enter Email" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control mb-3 bg-#f4f4f4" type="password" name="password" id="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>

  <?php endif; ?>
<?php endif; ?>
<?php include("inc/footer.php") ?>