<!-- navbar.php -->
<style>
    .card-img-top {
        height: 500px;
        object-fit: cover;
    }

    /* Sidebar styles */
    .offcanvas {
        width: 250px;
    }

    .offcanvas-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    /* Customize sidebar button styles */
    .side-link {
        text-align: left;
        width: 100%;
        margin-bottom: 10px;
    }

    .side-link i {
        margin-right: 10px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <h1 class="navbar-brand" href="#" style="color: white;">Inventory Dashboard</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="pages/Customer.html" style="color: rgb(201, 68, 6);">Graphs and Trends...</a>
                </li>
            </ul>
            <!-- Add button with icon on the right -->
            <div class="ms-auto">
                <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                    <i class="bi bi-list"></i> <!-- Sidebar icon -->
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar (offcanvas) -->
<div class="offcanvas offcanvas-end bg-grey" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Admin Panel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group">
            <li class="list-group-item p-0">
                <a href="../../index.php" class="btn btn-dark side-link">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
                <a href="modules/notifications/atocknotification.php" class="btn btn-warning side-link">
                    <i class="bi bi-bell"></i> Notification
                </a>
                <a href="modules/products/products.php" class="btn btn-warning side-link">
                    <i class="bi bi-item-list"></i> Products
                </a>
                <a href="modules/orders/orders.php" class="btn btn-warning side-link">
                    <i class="bi bi-receipt"></i> Orders
                </a>
                <a href="modules/returns/returns.php" class="btn btn-warning side-link">
                    <i class="bi bi-arrow-return-left"></i> Returns
                </a>
                <a href="modules/dashboard/dashboard.php" class="btn btn-warning side-link">
                    <i class="bi bi-boxes"></i> Stock
                </a>
                <a href="modules/dashboard/dashboard.php" class="btn btn-dark side-link">
                    <i class="bi bi-plus-circle"></i> Extra
                </a>
            </li>
        </ul>
    </div>
</div>
