<?php
session_start();
if(isset($_SESSION['loggedin'])){
    if($_SESSION['loggedin']){
        echo '<script>location.href = "admin.php";</script>';
    }
}
include('components/_header.php');
include('components/_nav.php');
?>
<title>Login | Dogger, your online diary</title>
<br><br>
<div class="container">
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" name="uname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" required>
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
    if (isset($_POST['uname']) && isset($_POST['password'])) {
        // collect all creds 

        $uname = trim($_POST['uname']);
        $password = trim($_POST['password']);

        // initalize connection 

        $pdo = new PDO('sqlite:dogger.db');
        // queried the db 

        $q = $pdo->query("SELECT * FROM users where uname = '$uname' AND password = '$password'");

        // checking ..

        $rows = $q->fetchAll();

        if (count($rows) == 0) {
            echo "You have entered wrong credintials";
        } else {
            $_SESSION['loggedin'] = true;
            $_SESSION['uname'] = $uname;
            $_SESSION['password'] = $password;
            echo '<script>location.href = "admin.php";</script>';
        }
    }
    ?>
</div>
<?php
include('components/_footer.php');
?>