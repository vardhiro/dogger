<h2>Last 10 public entries made</h2>
<?php
$pdo = new PDO("sqlite:dogger.db");
$sql = $pdo->query("SELECT * FROM diary_entries WHERE reach='public' ORDER BY time DESC LIMIT 10");
$rows = $sql->fetchAll();
foreach ($rows as $row) {
?>
    <h4><?php echo $row[2]; ?></h4>
    <small>Written by <?php echo $row[1]; ?> on <?php echo date('D, d F Y', $row[6]); ?></small><br>
    <a href="show.php?id=<?php echo $row[0]; ?>">Show full entry</a>
<?php
}
?>