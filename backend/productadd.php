<?php
session_start();
if (!isset($_SESSION["adminpass"])) {
   header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-container input[type="text"], .form-container input[type="email"], .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="file"] {
            margin: 10px 0;
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
        .success {
            color: green;
            margin: 10px 0;
            text-align: center;
        }
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a href="productlist.php" class="back-button">&lt; Back</a>
<div class="form-container">
    <h2>Add New Product</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productName = $_POST['productName'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image = $_FILES['image'];
        $status = 'available';
        $errors = [];

        if (empty($productName)) {
            $errors[] = "Product name is required.";
        }
        if (empty($email)) {
            $errors[] = "Email is required.";
        }
        if (empty($description)) {
            $errors[] = "Description is required.";
        }
        if (empty($price) || !is_numeric($price)) {
            $errors[] = "Valid price is required.";
        }
        if (empty($category)) {
            $errors[] = "Category is required.";
        }
        if (empty($image)) {
            $errors[] = "image is required.";

        }
        if ($image['error'] != 0) {
            $errors[] = "Product image is required.";
        }

        $targetDir = "uploades/";
        $targetFile = $targetDir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            $errors[] = "File is not an image.";
        }

        if (file_exists($targetFile)) {
            $errors[] = "Sorry, file already exists.";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $errors[] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        }

        if (empty($errors)) {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                $conn = new mysqli("localhost", "root", "", "electronics_store");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO electronics_store (product_name, email, description, price, category, image, status) VALUES ('$productName', '$email', '$description', '$price', '$category', '$targetFile', '$status')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p class='success'>Product added successfully!</p>";
                } else {
                    echo "<p class='error'>Error: " . $conn->error . "</p>";
                }

                $conn->close();
            } else {
                echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
            }
        } else {
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
        }
    }
    ?>

    <form action="productadd.php" method="post" enctype="multipart/form-data">
        <input type="text" name="productName" placeholder="Product Name">
        <input type="email" name="email" placeholder="Email">
        <textarea name="description" placeholder="Product Description"></textarea>
        <input type="text" name="price" placeholder="Price">
        <select name="category">
            <option value="">Select Category</option>
            <option value="Phone">Phone</option>
            <option value="Laptop">Laptop</option>
            <option value="Watch">Watch</option>
            <option value="Perfume">Perfume</option>
        </select>
        <input type="file" name="image">
        <button type="submit">Add Product</button>
    </form>
</div>

</body>
</html>
