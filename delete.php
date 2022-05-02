<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    if (!$_SESSION['loggedin']) {
        echo "<script>location.href = 'login.php';</script>";
    }
} else {
    echo "<script>location.href = 'login.php';</script>";
}
?>
<?php
include("components/_header.php")
?>
<title>
    Edit a previous entry | Dogger, your online diary
</title>
<?php
include("components/_nav.php");
$pdo = new PDO("sqlite:dogger.db");
?>
<br>
<div class="container">
    <form action="delete.php" method="get">
        <h1>Select which record to delete</h1>
        <select name="id" class="form-control col-md-6">
            <?php
            $uname = $_SESSION['uname'];
            $sql = $pdo->query("SELECT * FROM diary_entries WHERE user='$uname'");
            $rows = $sql->fetchAll();
            foreach ($rows as $row) {
            ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?> | <?php echo date('D, d F Y', $row[6]); ?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <button class="btn btn-warning">Delete it</button>
    </form>
</div>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    ?>
        <div class="container">
            <br>
            <script src="ckeditor/ckeditor.js"></script>
            <h1>Final Confirmation</h1>
            <br>
            <form action="delete.php?step3" method="post">
                <label for="conf">Are you sure to delete this entry?</label>
                <input type="radio" name="conf" value="n" checked> No
                <input type="radio" name="conf" value="y"> Yes <br>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-danger">Do as I said</button>
            </form>
        </div>
<?php
    }
?>
<?php
if (isset($_GET['step3'])) {
    if (isset($_POST['id']) && isset($_POST['conf'])) {
        $id = $_POST['id'];
        $conf = $_POST['conf'];
        if($conf == 'y'){
            $pdo = new PDO('sqlite:dogger.db');
            $sql = "DELETE FROM diary_entries WHERE id = '$id'";
            $stmt = $pdo->prepare($sql);
            echo ($stmt->execute()) ? "<div class='alert alert-warning'>Entry deleted!</div>" : "<div class='alert alert-warning'>There was a failure</div>";
        }else{
            echo
            "<br><div class='alert alert-warning'>Woof! You got saved in time. (entry not deleted)</div>";
        }
    }
}
?>
<?php
include("components/_footer.php");
?>