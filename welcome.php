<?php
/* Initialize the session */
session_start();

/* Check if the user is logged in, if not then redirect him to login page */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <style type="text/css">
    body {
      font: 14px sans-serif;
      text-align: center;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="dynamic1.php">Home Inventory</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dynamic1.php">Home</a>
          </li>


        </ul>
        <div class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap navbar-dark">

          <li class="nav-item dropstart">
            <a class="nav-link dropdown-toggle fw-bolder  text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['username']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
            </ul>
          </li>

        </div>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li> -->
      </div>
    </div>
  </nav>
  <div class="welcome_page mb-5" style="background-color: #754ffe!important; height: 100vh; padding:113px;">
    <div class="container">
      <div class="xss_attack">
        <?php
        // Get user input from the form
        $name = $_GET['name'] ?? '';
        // $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
        //prevent xss attack
        
        // $name = htmlspecialchars($name);
        // Display user input without escaping or filtering
        if (isset($name)) {
          echo "<h1> $name</h1>";
        }
        ?>
        <form action="" method="get" class="p-5">
          <label for="name" class="text-white">Xss session hijack</label>
          <input type="text" id="name" name="name" >
          <input type="submit" value="Submit">
        </form>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <h1 class="font-monospace fs-1 fw-bolder text-white">Welcome</h1> <br>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <h1 class="font-monospace fs-1 fw-bolder text-white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>