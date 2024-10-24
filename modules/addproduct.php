<?php
session_start();
include './returns/products.php';

$productObj = new Product();
$products = $productObj->getAllProducts();

// If editing, fetch product details
if (isset($_GET['edit'])) {
    $product = $productObj->getProductById($_GET['edit']);
} else {
    $product = ['id' => '', 'name' => '', 'price' => '', 'quantity' => ''];
}

?>

    <div class="container mt-5">
        <h1>Products Dashboard</h1>
        

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <!-- Products Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $productRow): ?>
                    <tr>
                        <td><?= $productRow['id'] ?></td>
                        <td><?= $productRow['name'] ?></td>
                        <td><?= $productRow['price'] ?></td>
                        <td><?= $productRow['quantity'] ?></td>
                        <td>
                            <a href="products.php?edit=<?= $productRow['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="product_action.php?delete=<?= $productRow['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add / Edit Product Form -->
        <h2><?= isset($_GET['edit']) ? 'Edit Product' : 'Add New Product' ?></h2>
       <form action="classes/product_action.php"method="POST">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $product['quantity'] ?>" required>
            </div>
            <button type="submit" name="<?= isset($_GET['edit']) ? 'update_product' : 'add_product' ?>" class="btn btn-primary">
                <?= isset($_GET['edit']) ? 'Update Product' : 'Add Product' ?>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
