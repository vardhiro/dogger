<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    if (!$_SESSION['loggedin']) {
        echo "<script>location.href = 'login.php';</script>";
    }
} else {
    echo "<script>location.href = 'login.php';</script>";
}
include('components/_header.php');
?>
<title>Dashboard | Dogger, your online diary</title>
<?php
include('components/_nav.php');
?>
<br><br>
<div class="container">
    <center>
        <div class="row" style="max-width:90%;">
            <div class="card col-md-12 text-center">
                <h1>Welcome to the Dashboard</h1>
            </div>
            <div class="card col-md-6 text-center mt-4">
                <h2>Add today's entry</h2><br>
                <a href="add.php" class="btn btn-success">Add</a><br>
            </div>
            <div class="card col-md-6 text-center mt-4">
                <h2>Edit a previous entry</h2><br>
                <a href="edit.php" class="btn btn-secondary text-light">Edit</a><br>
            </div>
            <div class="card col-md-6 text-center mt-4">
                <h2>Delete entry</h2><br>
                <a href="delete.php" class="btn btn-danger text-light">Delete</a><br>
            </div>
            <div class="card col-md-6 text-center mt-4">
                <h2>Logout</h2><br>
                <a href="logout.php" class="btn btn-warning text-light">Logout</a><br>
            </div>
        </div>
    </center>
</div>
<?php
include('components/_footer.php');
?>