<?php 
  include('authentication.php');
  $admin_id = $_SESSION['auth_admin_id'];
  $users_query = "SELECT * FROM users WHERE id <> '$admin_id'";
  $users_result = mysqli_query($con,$users_query);

  include('includes/header.php');
?>
    
<div class="container-fluid px-4 my-2">

  <?php include('../message.php') ?>

  <h4 class="mt-4">Users</h4>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
      <li class="breadcrumb-item active">User</li>
  </ol>
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Registered User</h4>
        </div>
        <div class="card-body">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php if(mysqli_num_rows($users_result) == 0): ?>
                <tr>
                  <th colspan="6">No Record Found</th>
                </tr>
              <?php else: ?>
                <?php while($user = mysqli_fetch_assoc($users_result)): ?>
                  <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['fname'] ?></td>
                    <td><?= $user['lname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                      <?php 
                        if($user['role_as'] == '1') {
                          echo 'Admin';
                        } elseif ($user['role_as'] == '0') {
                          echo 'User';
                        }
                      ?>
                    </td>
                    <td><a href="edit-register.php" class="btn btn-success" >Edit</a></td>
                    <td><button class="btn btn-success">delete</button></td>
                  </tr>
                <?php endwhile ?>
              <?php endif ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
    
  </div>
</div>

<?php 
  include('./includes/footer.php');
  include('./includes/script.php')
?>
     