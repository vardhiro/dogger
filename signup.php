<?php
session_start();
include('components/_header.php');
include('components/_nav.php');
?>
<title>Sign Up | Dogger, your online diary</title>
<br><br>
<div class="container">
  <form action="signup.php" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" class="form-control" name="uname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <br>
  <i>No excess creds, no bs</i>
  <?php
  if (isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['password'])) {
    // collect all creds 

    $uname = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // initalize connection 

    $pdo = new PDO('sqlite:dogger.db');
    // queried the db 

    $q = $pdo->query("SELECT * FROM users where uname = '$uname' OR email = '$email'");

    // checking ..

    $rows = $q->fetchAll();

    if (count($rows) == 0) {
      $date = time();
      $stmt = $pdo->exec("INSERT INTO users (uname, email, password, date_joined) VALUES ('$uname', '$email', '$password', '$date')");
      echo ($stmt) ? "<div class='alert alert-warning'>You are registred successfully!<a href='login.php'>Login</a></div>" : "<div class='alert alert-warning'>There was a failure</div>";
    } else {
      echo "<div class='alert alert-warning'>You are already registred! <a href='login.php'>Login</a></div>";
    }
  }
  ?>
</div>
<?php
include('components/_footer.php');
?>