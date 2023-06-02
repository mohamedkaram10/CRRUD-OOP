<?php include "inc/header.php" ?>
<?php include "inc/nav.php"    ?>
<?php

$departments = ["it", "cs"];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $name         = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email        = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $department   = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
  $password     = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  if (empty($name) || empty($email) || empty($department) || empty($password)) {
    $error = "Please Fill All Fields";
  } else {
    if (strlen($name) > 3) {
      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $department = strtolower($department);
        if (in_array($department, $departments)) {
          if (strlen($password) > 7) {
            $hashed_password = $db->hashed_password($password);
            $sql = "INSERT INTO employees (name, email, department, password) VALUES ('$name', '$email', '$department', '$hashed_password')";
            $success = $db->insert_user($sql);
          } else {
            $error = "Password Must Be Greater Than <strong>7</strong> Chars";
          }
        } else {
          $error = "This Department <strong>Not Found</strong>";
        }
      } else {
        $error = "Please Enter Valid <strong>Email</strong>";
      }
    } else {
      $error = "Name Must Be Greater Than <strong>4</strong> Chars";
    }
  }
}

?>


<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="p-3 col text-center mt-5 text-white bg-primary">Create Employees</h2>
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
          <input class="form-control mb-3 bg-#f4f4f4" type="text" name="username" id="username" placeholder="Enter Name" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <input class="form-control mb-3 bg-#f4f4f4" type="text" name="department" id="department" placeholder="Enter Department" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input class="form-control mb-3 bg-#f4f4f4" type="text" name="email" id="email" placeholder="Enter Email" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control mb-3 bg-#f4f4f4" type="password" name="password" id="password" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</div>

<?php include("inc/footer.php") ?>