<?php include "inc/header.php" ?>
<?php include "inc/nav.php"    ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="p-3 col text-center mt-5 text-white bg-primary">All Employees</h2>
    </div>
    <?php if (count($db->read_user("employees"))) : ?>
      <div class="col-sm-12">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Department</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($db->read_user('employees') as $row) : ?>
                  <tr>
                    <td><?= $row['name']        ?></td>
                    <td><?= $row['email']       ?></td>
                    <td><?= $row['department']  ?></td>
                    <td>
                      <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                      <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
  </div>
  <?php include("inc/footer.php") ?>