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
    <form action="edit.php" method="get">
        <h1>Select which record to edit</h1>
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
        <button class="btn btn-secondary">Edit it</button>
    </form>
</div>
<?php
if (isset($_GET['id'])) {
    $uname = $_SESSION['uname'];
    $id = $_GET['id'];
    $sql = $pdo->query("SELECT * FROM diary_entries WHERE id = '$id' AND user = '$uname'");
    $rows = $sql->fetchAll();
    foreach ($rows as $row) {
?>
        <div class="container">
            <br>
            <script src="ckeditor/ckeditor.js"></script>
            <h1>Edit entry</h1>
            <br>
            <form action="edit.php?step3" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="title">New title for entry</label>
                <input type="text" name="title" class="form-control" value="<?php echo $row[2]; ?>" required>
                <br><br>
                Header Image (required):
                <input type="file" name="uploadImageFile" id="" required>
                <br><br>
                This will be :
                <input type="radio" name="reach" value="public" required> Public &nbsp;
                <input type="radio" name="reach" value="private" required checked> Private
                <br><br>
                <label for="editor1">Enter your content for today's entry</label>
                <textarea name="editor1" class="form-control" required>
                <?php echo $row[3] ?>
            </textarea>
                <script>
                    CKEDITOR.replace('editor1', {
                        extraPlugins: 'imageuploader'
                    });
                </script>
                <br><br>
                <button class="btn btn-success">Publish</button>
            </form>
        </div>
<?php
    }
}
?>
<?php
if (isset($_GET['step3'])) {
    if (isset($_POST['title']) && isset($_POST['reach']) && isset($_POST['editor1']) && isset($_POST['id']) /* && isset($_FILES['uploadImageFile'])*/) {
        $id = $_POST['id'];
        $user = $_SESSION['uname'];
        $title = $_POST['title'];
        $body = $_POST['editor1'];
        $reach = $_POST['reach'];
        $time = time();
        $filepath =
            $_FILES['uploadImageFile']['tmp_name'];
        $file = fopen($filepath, "rb");
        $pdo = new PDO('sqlite:dogger.db');
        $sql = "UPDATE diary_entries SET title = '$title', body='$body', header_image = :fille, reach= '$reach', time='$time' WHERE id = '$id'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fille', $file, \PDO::PARAM_LOB);
        echo ($stmt->execute()) ? "<div class='alert alert-warning'>Entry updated!</div>" : "<div class='alert alert-warning'>There was a failure</div>";
    }
}
?>
<?php
include("components/_footer.php");
?>