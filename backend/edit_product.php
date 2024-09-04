<?php
session_start();

if (!isset($_SESSION["adminpass"])) {
    header("Location: admin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "electronics_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM electronics_store WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No product found!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $image = 'images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = $row['image'];
    }

    $sql = "UPDATE electronics_store SET product_name='$product_name', description='$description', category='$category', price='$price', image='$image' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: productlist.php?update=1");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input[type="text"], form input[type="number"], form input[type="file"], form textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        form button {
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">
    <div>
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
    </div>
    <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $row['category']; ?>" required>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>" required>
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <img src="<?php echo $row['image']; ?>" alt="Product Image" style="max-width: 100px; margin-top: 10px;">
    </div>
    <button type="submit">Update Product</button>
</form>

</body>
</html>
