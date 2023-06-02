<?php include "inc/header.php" ?>
<?php include "inc/nav.php"    ?>
<?php 
if (isset($_GET['id']) && is_numeric($_GET['id'])) :
  $row = $_GET['id'];
  if ($row) :
    $row = $db->delete_user("employees", $_GET['id']);
    header("refresh: 3; url = employees.php"); 
    $success = "Deleted Success"
?>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="p-3 col text-center mt-5 text-white bg-primary">Delete Employees</h2>
        </div>
          <h2 class="alert alert-danger mt-5 text-center p-2 col"><?= $success ?></h2>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php include("inc/footer.php") ?>