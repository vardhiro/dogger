<?php
header('Content-type: image');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = new PDO('sqlite:dogger.db');
    $sql = $pdo->query("SELECT header_image FROM diary_entries WHERE id='$id'");
    $rows = $sql->fetchAll();
    foreach($rows as $row){
        echo $row[0];
    }
}
?>