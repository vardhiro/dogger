<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:silver;">
  <a class="navbar-brand" href=".">Dogger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="https://dogger.vardhiro.repl.co/">Home<span class="sr-only">(current)</span></a>
      </li>
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        ?>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Do:
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="add.php">Add today's record</a>
            <a class="dropdown-item" href="edit.php">Edit your diary</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="delete.php">Delete a record</a>
            <a class="dropdown-item text-danger" href="logout.php">Logout</a>
          </div>
        </li>
        <?php
      }else{
        ?>
        <li class="nav-item active">
          <a class="nav-link" href="https://dogger.vardhiro.repl.co/signup.php">Get Started</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link " href="login.php">Login</a>
        </li>
        <?php
      }
      ?>
    </ul>
    <form class="form-inline my-lg-0" action="search.php" method="GET">
      <input class="form-control mr-sm-2" name='k' type="search" placeholder="Search for a public diary" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>