<?php
session_start();
include './returns/products.php';


 // Make sure the path is correct

$productObj = new Product();

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Call the method to add the product
    if ($productObj->addProduct($name, $price, $quantity)) {
        $_SESSION['message'] = "Product added successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to add product.";
        $_SESSION['message_type'] = "danger";
    }

    // Redirect to the product page after processing
    header("Location: addproduct.php");  // Make sure addproduct.php exists at this location
    exit();
}

// Update Product
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Call the method to update the product
    if ($productObj->updateProduct($id, $name, $price, $quantity)) {
        $_SESSION['message'] = "Product updated successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update product.";
        $_SESSION['message_type'] = "danger";
    }

    // Redirect after updating
    header("Location: ./modules/addproduct.php");  // Ensure the correct path
    exit();
}

// Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Call the method to delete the product
    if ($productObj->deleteProduct($id)) {
        $_SESSION['message'] = "Product deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete product.";
        $_SESSION['message_type'] = "danger";
    }

    // Redirect after deletion
    header("Location: ./modules/addproduct.php");  // Ensure the correct path
    exit();
}
?>
