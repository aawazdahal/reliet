<?php
  include "./partials/db.php";

  session_start();
  
  if ($_SESSION['loggedIn'] != True) {
    header("Location: index.php");
  }

  $username = $_SESSION['id'];

  // POSTING SECTION CODE STARTS HERE
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $sql = "INSERT INTO posts (username, posts) VALUES ('$username', '$status')";
    if (mysqli_query($conn, $sql)) {
      ;
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RELIET</title>
    <link rel="shortcut icon" href="https://imgs.search.brave.com/-JgpzW-wYPgg_5qwmXTPRu5M0ftRossmu6LUgZlRwi4/rs:fit:800:800:1/g:ce/aHR0cDovL3d3dy5j/bGlwYXJ0YmVzdC5j/b20vY2xpcGFydHMv/ZWlNL2s5ci9laU1r/OXJheVQuanBn" type="image/x-webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RELIET</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" role="button" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <button class="btn btn-success" onclick="location.href='myaccount.php'">My Account</button>
        </li>
      </ul>
      <li class="nav-item">
          <button class="btn btn-primary" onclick="location.href='./partials/logout.php'">Log Out</button>
        </li>
    </div>
  </div>
</nav>
<div class="container mx-2" style="flex-direction: row">
  <h1>Latest Posts</h1>
  
  <?php 
      // HOME FEEDS DISPLAY SECTION STARTS HERE
      $sql2 = "SELECT * from posts ORDER by sn DESC";
      $result2 = mysqli_query($conn, $sql2);

      while ($row2 = mysqli_fetch_assoc($result2)) { 
        $desc = $row2['posts'];         // DATA SYNTHESIS OF EACH USER AND POST
        $user = $row2['username'];
        $verChk = "SELECT * from users where username = '$user'";
        $verChkConfirm = mysqli_query($conn, $verChk);
        $verChkUser = mysqli_fetch_assoc($verChkConfirm);
        $verBool = $verChkUser['verification'];
        if ($verBool == 1){
          $vBadge = '<img style="width: 18px"src="https://miro.medium.com/max/800/1*fFUnF8o4URvCowXSacCgGA.jpeg">';
        }
        else{
          $vBadge = '';
        }

        echo '<div class="card">
        <div  class="card-header" style="display: flex">
        <img style="width: 3.5%; margin-right: 0.5%" src="https://imgs.search.brave.com/LZWMwMYighRobOnIxKjwvfkpEhzakLjzUY4-2MccZM4/rs:fit:860:880:1/g:ce/aHR0cHM6Ly93d3cu/a2luZHBuZy5jb20v/cGljYy9tLzI0LTI0/ODcyOV9zdG9ja3Zh/ZGVyLXByZWRpY3Rl/ZC1hZGlnLXVzZXIt/cHJvZmlsZS1pbWFn/ZS1wbmctdHJhbnNw/YXJlbnQucG5n" alt="">
        <p>'.$user.'  '.$vBadge.'</p>
        <p style="margin-left: 83%;">' .$display_date.'</p>
        </div>
        <div class="card-body">
        <h5 style="font-size: 90%"class="card-title">' .$desc.    '</h5>
        </div>
        </div><br>';
      }




  ?>

</div>
  <button type="button" style="background-color:; position: fixed; right: 45px; bottom: 58px;"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create a post</button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create a post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- POSTING FORM STARTS HERE -->
        <form action="home.php" method="POST">
          <div class="mb-3">
            <label for="message-text" class="col-form-label"><?php echo '@'.$username ?> </label>
            <textarea class="form-control" name="status" placeholder="Type something....." id="message-text"></textarea>
          </div>
          <button type="sumbit" class="btn btn-primary">Post</button>  
        </form>
        <!-- POSTING FORM ENDS HERE -->
      </div>
  </div>
</div>   
  

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>