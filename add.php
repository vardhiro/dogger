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
    Add today's entry | Dogger, your online diary
</title>
<?php
include("components/_nav.php");
?>
<br>
<div class="container">
    <script src="ckeditor/ckeditor.js"></script>
    <h1>Add today's entry</h1>
    <br>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="title">Enter the title for today's entry</label>
        <input type="text" name="title" class="form-control" required>
        <br><br>
        Header Image (required):
        <input type="file" name="uploadImageFile" id="" required>
        <br><br>
        This will be :
        <input type="radio" name="reach" value="public" required> Public &nbsp;
        <input type="radio" name="reach" value="private" required checked> Private
        <br><br>
        <label for="editor1">Enter your content for today's entry</label>
        <textarea name="editor1" class="form-control" required></textarea>
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
include("components/_footer.php");
?>
<?php
if (isset($_POST['title']) && isset($_POST['reach']) && isset($_POST['editor1']) /* && isset($_FILES['uploadImageFile'])*/) {
    $user = $_SESSION['uname'];
    $title = $_POST['title'];
    $body = $_POST['editor1'];
    $reach = $_POST['reach'];
    $time = time();
    $filepath =
        $_FILES['uploadImageFile']['tmp_name'];
    $file = fopen($filepath, "rb");
    $pdo = new PDO('sqlite:dogger.db');

    $q = $pdo->query("SELECT * FROM diary_entries WHERE user = '$user' ORDER BY time DESC LIMIT 1");
    $row = $q->fetchAll();
    $flag = 0;
    if(count($row) == 0){
        $flag = 1;
    }else{
        if(date('d/m/y', $row[0]['time']) == date('d/m/y')){
            $flag = 0;
        }else{
            $flag = 1;
        }
    }
    if($flag == 1){
    $sql = "INSERT INTO diary_entries (user, title, body, header_image, reach, time) values ('$user', '$title', '$body', :fille, '$reach', '$time')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fille', $file, \PDO::PARAM_LOB);
    echo ($stmt->execute()) ? "<div class='alert alert-warning'>Today's entry done!</div>" : "<div class='alert alert-warning'>There was a failure</div>";
    }
    else{
    echo "<div class='alert alert-warning'>Eh! no two records on the same day</div>";
    }
}
?>