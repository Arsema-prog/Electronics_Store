<!-- <?php
        session_start();
        if (isset($_SESSION["adminpass"])) {
            header("Location: productlist.php");
            exit();
        }
        ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin: 10px 0;
            text-align: center;
        }

        /* .form-group{
             margin-bottom:30px;
           } */


        .error {
            color: red;
            margin: 10px 0;
            text-align: center;
        }

        .success {
            color: green;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($password == "12345678" && $email == "arsema@gmail.com") {
            $_SESSION["adminpass"] = "yes";
            header("Location: productlist.php");
            exit();
        } else {
            echo "<p class='error'>Password or email does not match</p>";
        }
    }
    ?>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>



        </form>
    </div>
</body>

</html>