<?php
session_start();
if (isset($_GET['k'])) {
    $k = $_GET['k'];
    $pdo = new PDO("sqlite:dogger.db");
    $sql = $pdo->query("SELECT * FROM diary_entries WHERE title LIKE '%$k%' AND reach='public'");
    $rows = $sql->fetchAll();
    include "components/_header.php";
?>
    <title>Search results for `<?php echo $k; ?>`</title>
    <?php
    include "components/_nav.php";
    ?>
    <div class="container">
        <br><br>
        <div class="col-md-12">
            <h1>Search results for `<?php echo $k; ?>`</h1>
            <br>
            <img src="images/diary.jpg">
            <br>
            <br>
            <?php
            foreach ($rows as $row) {?>
                <h4><?php echo $row[2]; ?></h4>
    <small>Written by <?php echo $row[1]; ?> on <?php echo date('D, d F Y', $row[6]); ?></small><br>
    <a href="show.php?id=<?php echo $row[0]; ?>">Show full entry</a><hr>
            <?php
            }
            ?>
        <?php
        include "components/_footer.php";
    }
        ?>