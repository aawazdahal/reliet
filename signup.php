<?php
    include "./partials/db.php";
    $idchkalert = False;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
                                    
      $idchk = "SELECT * from users where username = '$username'";
      $result = mysqli_query($conn, $idchk);
      $num = mysqli_num_rows($result);
      
      if ($num == 1) {
        $idchkalert = "There is already an account with this username";
      }
      else{
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$pass')";
        if (mysqli_query($conn, $sql)) {
          header("Location: ./home.php");
          session_start();
          $_SESSION['loggedIn'] = True;
          $_SESSION['id'] = $username;
        } 
        mysqli_close($conn);
      }    
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up To Reliet</title>
    <link rel="shortcut icon" href="https://imgs.search.brave.com/-JgpzW-wYPgg_5qwmXTPRu5M0ftRossmu6LUgZlRwi4/rs:fit:800:800:1/g:ce/aHR0cDovL3d3dy5j/bGlwYXJ0YmVzdC5j/b20vY2xpcGFydHMv/ZWlNL2s5ci9laU1r/OXJheVQuanBn" type="image/x-webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="home.php">RELIET</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Technology</a></li>
            <li><a class="dropdown-item" href="#">Sports</a></li> 
          </ul>
        </li>
        <button class="btn btn-primary" onclick="location.href='login.php'">Log In</button>
      </ul>
    </div>
</div>
</nav>
<?php if ($idchkalert) { echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>'.$idchkalert.'</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';} ?>
    <h1>Sign Up</h1>
    <form class="d-flex" style="flex-direction: column" method="POST" action="signup.php">
        <input type="text" required="required" class="username" name="username" placeholder="Username"><br>
        <input type="email" required="required"  class="email" name="email" placeholder="Email address"><br>
        <input type="password" required="required"  class="pass" name="pass" placeholder="Password"><br>
        <input type="password" required="required"  class="pass" name="pass" placeholder="Re-enter password"><br>
        <button class="btn btn-primary" type="submit">Sign Up</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>