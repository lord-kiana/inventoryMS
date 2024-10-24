<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
   
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<body>

    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="#">Inventory Management System</a>
            </nav>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <nav class="sidebar">
    <ul class="navbar-nav flex-column list-group">
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'dashboard' ? 'active' : ''; ?>" href="dashboard.php?page=dashboard">
                <i class="fas fa-home icon"></i> DashBoard
            </a>
        </li>
        <li class="nav-heading">Managements</li>
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'stock-management' ? 'active' : ''; ?>" href="dashboard.php?page=stock-management">
                <i class="fas fa-boxes icon"></i> Stock Management
            </a>
        </li>
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'addproduct' ? 'active' : ''; ?>" href="dashboard.php?page=addproduct">
                <i class="fas fa-boxes icon"></i>Add product
            </a>
        </li>
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'order_management' ? 'active' : ''; ?>" href="dashboard.php?page=order_management">
                <i class="fas fa-shopping-cart icon"></i> Order Management
            </a>
        </li>
        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'archive' ? 'active' : ''; ?>" href="dashboard.php?page=archive">
                <i class="fas fa-archive icon"></i> Archive
            </a>
        </li>
        <li class="nav-item">
            <a class="list-group-item <?php echo ($_GET['page'] ?? '') === 'reports' ? 'active' : ''; ?>" href="dashboard.php?page=reports">
                <i class="fas fa-chart-line icon"></i> Reports
            </a>
        </li>
    </ul>
</nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-custom">
            <div class="content-area">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'dashboard':
                                include 'default_page.php';
                                break;
                            case 'stock-management':
                                include './modules/stock_management.php';
                                break;
                                case 'addproduct':
                                    include './modules/addproduct.php';
                                    break;
                            case 'order_management':
                                include './modules/orders.php';
                                break;
                            case 'archive':
                                include './modules/view_archive.php';
                                break;
                            case 'reports':
                                include './modules/reports.php';
                                break;
                            default:
                                include 'default_page.php';
                                break;
                                case 'summary-overview':
                                    include './dashboard_cards/summary_overview.php';
                                    break;
                                case 'recent-orders':
                                    include './dashboard_cards/recent_orders.php';
                                    break;
                                case 'stock-alerts':
                                    include './dashboard_cards/stocknotification.php';
                                    break;
                                case 'graphs-trends':
                                    include './dashboard_cards/graphs.php';
                                    break;
                        }
                    } else {
                        include 'default_page.php';
                    }
                    ?>
               
            </div>
        </div>
    </div>

</body>
</html>
