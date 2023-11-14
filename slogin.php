<?php

/* Initialize the session */
session_start();

/* Check if the user is already logged in, if yes then redirect him to welcome page */

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

/* Include config file */

require_once

    "config.php";

/* Define variables and initialize with empty values */

$username = $password = "";
$username_err = $password_err = "";

/* Processing form data when form is submitted */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Escape the user input */
    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $password = mysqli_real_escape_string($link, $_POST["password"]);

    /* Prepare a sql query statement */
    $sql = "SELECT id, username FROM users WHERE username = ? AND password = MD5(?)";

    /* Create a prepared statement */
    $stmt = $link->prepare($sql);

    /* Bind the user input to the query parameters */
    $stmt->bind_param("ss", $username, $password);

    /* Execute the prepared statement */
    $stmt->execute();

    $result = $stmt->get_result();

    /* If a row is returned, the user is logged in */
    if ($result->num_rows > 0) {
        // session_regenerate_id(true);
        /* Store the user's data in session variables */
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $result->fetch_assoc()["id"];
        $_SESSION["username"] = $username;

        /* Redirect the user to the welcome page */
        header("location: welcome.php");
    } else {
        /* Display an error message if the user is not logged in */
        $password_err = "The password you entered was not valid.";
    }

    /* Close the prepared statement */
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
            margin: 0 auto;
            /* Center the div horizontally */
            margin-top: 100px;
            /* Adjust the top margin to center vertically */
            border: 1px solid #ccc;
            /* Add a border for better visualization */
            border-radius: 5px;
            /* Add rounded corners for aesthetics */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>