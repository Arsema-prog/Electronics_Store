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
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            flex-direction: row-reverse;;
            /* justify-content: space-between; */
            align-items: center;
            margin-bottom: 20px;
            margin-right: 10px;
            gap: 15px;
        }
        .header button {
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        .header button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td img {
            max-width: 100px;
            border-radius: 4px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons button {
            padding: 5px 10px;
            background-color: gray;
            border: none;
            border-radius: 4px;
            color: black;
            cursor: pointer;
        }
        
        .action-buttons button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="header">
    <button onclick="window.location.href='adminout.php'">Logout</button>
    <button onclick="window.location.href='productadd.php'"> + Add Product</button>
</div>

<h2>Product List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php
    $conn = new mysqli("localhost", "root", "", "electronics_store");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM electronics_store ");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>$" . $row['price'] . "</td>";
            echo "<td><img src='" . $row['image'] . "' alt='Product Image'></td>";
            echo "<td class='action-buttons'>";
            // echo "<button><a href='edit_product.php?id=" . $row['id'] . "' > <i class='fas fa-edit'></i> Edit </a></button>";
            // echo "<button><a href='productlist.php?id=" . $row['id'] . "' > <i class='fas fa-edit'></i> Delete </a></button>";
            echo "<button onclick=\"window.location.href='edit_product.php?id=" . $row['id'] . "'\">Edit</button>";
            echo "<button class='delete' onclick=\"deleteProduct(" . $row['id'] . ")\">Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No products found</td></tr>";
    }

    $conn->close();
    ?>
</table>

<script>
function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'delete_product.php?id=' + id;
    }
}
</script>

</body>
</html>
