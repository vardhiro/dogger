<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = new PDO('sqlite:dogger.db');
    $sql = $pdo->query("SELECT * FROM diary_entries WHERE id='$id'");
    $rows = $sql->fetchAll();
    include "components/_header.php";
    foreach ($rows as $row) {
        if ($row[5] == 'public' || $_SESSION['uname'] == $row[1]) {
?>
            <title></title>
            <?php
            include "components/_nav.php";
            ?>
            <div class="container">
                <br><br>
                <div class="col-md-12">
                    <h1><?php echo $row[2]; ?></h1>Written by <?php echo $row[1]; ?> on <?php echo date('D, d F Y', $row[6]); ?><br><br>
                        <img style="max-height: 200px;" src="image.php?id=<?php echo $id; ?>">
                        <br>
                        <br>
                        <?php echo $row[3]; ?>
                        <br><br>
                        <hr>
                        <?php include('last10.php'); ?>
                        <br><br>
            <?php
            include "components/_footer.php";
        } else {
        }
    }
}
            ?>