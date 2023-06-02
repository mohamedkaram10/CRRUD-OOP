<?php include("inc/header.php") ?>
<?php include("inc/nav.php") ?>
<?php

$sql = "SELECT * FROM crud_php_oop";
$result = mysqli_query($this->$conn, $sql);

?>
<!-- <div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="p-3 col text-center mt-5 text-white bg-primary">Hello</h2>
    </div>
  </div>
</div> -->





>

<?php //else : ?>
  <div class="col-sm-12">
    <h3 class="alert alert-danger m-3 text-center">Not Found Data</h3>
  </div>
  <?php   //endif; ?>
<?php include("inc/footer.php") ?>