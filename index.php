<?php
session_start();
include "components/_header.php";
?>
<title>Welcome | Dogger, your online diary</title>
<?php
include "components/_nav.php";
?>
<div class="container">
    <br><br>
    <div class="col-md-6">
    <h1>Welcome to dogger!</h1>
    <br>
    <img src="images/diary.jpg">
    <br>
<br>
The dogger is a free project to provide an online diary service for all. 
<br>
<h1>An open-source and free initiative</h1>
We believe in open-source, so the source code for this project along with the database structure is hosted github.
<br>
<h1>Pls contribute!</h1>
We don't want any contribution in the form of money but by the review of our source code and regular issue updates on github. It also motivates us if you <a href="signup.php">create an account</a> and maintain your regular diary. 
<h2>Thanking you, </h()2>
<h3>Agent vardhiro (doggo code: 420)</h3>
<img src="images/doge.jpg" alt="">
<br><br>
<hr>
<?php include('last10.php'); ?>
<br><br>
<?php
include "components/_footer.php";
?>