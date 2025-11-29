<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard - PES Blood Bank">
    <meta name="author" content="">
    <title>Admin Dashboard | PES Blood Bank</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        :root {
            --primary-red: #E74C3C;
            --dark-red: #C0392B;
            --light-bg: #F8F9FA;
            --text-dark: #2C3E50;
        }
        
        body {
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
        }
        
        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-brand:hover {
            color: white !important;
        }
        
        .btn-logout {
            background: white;
            color: var(--primary-red);
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: #F8F9FA;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        /* Page Title */
        .page-title-section {
            padding: 30px 0;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }
        
        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border: none;
            overflow: hidden;
            position: relative;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .stat-card.primary::before {
            background: var(--primary-red);
        }
        
        .stat-card.success::before {
            background: #2ECC71;
        }
        
        .stat-card.info::before {
            background: #3498DB;
        }
        
        .stat-card.warning::before {
            background: #F39C12;
        }
        
        .stat-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .stat-icon.primary {
            color: var(--primary-red);
        }
        
        .stat-icon.success {
            color: #2ECC71;
        }
        
        .stat-icon.info {
            color: #3498DB;
        }
        
        .stat-icon.warning {
            color: #F39C12;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1;
        }
        
        .stat-number.primary {
            color: var(--primary-red);
        }
        
        .stat-number.success {
            color: #2ECC71;
        }
        
        .stat-number.info {
            color: #3498DB;
        }
        
        .stat-number.warning {
            color: #F39C12;
        }
        
        .stat-label {
            color: #666;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .stat-footer a {
            color: #666;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .stat-footer a:hover {
            color: var(--primary-red);
        }
        
        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 25px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #F5F7FA 0%, #C3CFE8 100%);
            border: none;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            color: var(--text-dark);
            margin-bottom: 15px;
        }
        
        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.2);
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
        }
        
        .action-btn i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }
        
        .action-btn .action-title {
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <i class="fas fa-droplet"></i> PES Blood Bank - Admin Panel
        </a>
        <div class="d-flex align-items-center gap-3">
            <span style="color: white; font-weight: 600;">
                <i class="fas fa-user-circle"></i> Welcome, <?php echo htmlentities($_SESSION['alogin']); ?>
            </span>
            <a href="logout.php" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid">
    <!-- Page Title -->
    <div class="page-title-section">
        <h1 class="page-title">
            <i class="fas fa-chart-line"></i> Dashboard Overview
        </h1>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row">
        <!-- Blood Groups Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card primary">
                <div class="text-center">
                    <div class="stat-icon primary">
                        <i class="fas fa-droplet"></i>
                    </div>
                    <?php 
                    $sql = "SELECT id from tblbloodgroup";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $bg = $query->rowCount();
                    ?>
                    <div class="stat-number primary"><?php echo htmlentities($bg); ?></div>
                    <div class="stat-label">Listed Blood Groups</div>
                </div>
                <div class="stat-footer">
                    <a href="manage-bloodgroup.php">
                        <span>View Details</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Registered Donors Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card success">
                <div class="text-center">
                    <div class="stat-icon success">
                        <i class="fas fa-users"></i>
                    </div>
                    <?php 
                    $sql1 = "SELECT id from tblblooddonars";
                    $query1 = $dbh->prepare($sql1);
                    $query1->execute();
                    $regbd = $query1->rowCount();
                    ?>
                    <div class="stat-number success"><?php echo htmlentities($regbd); ?></div>
                    <div class="stat-label">Registered Donors</div>
                </div>
                <div class="stat-footer">
                    <a href="donor-list.php">
                        <span>View Details</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Queries Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card info">
                <div class="text-center">
                    <div class="stat-icon info">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <?php 
                    $sql6 = "SELECT id from tblcontactusquery";
                    $query6 = $dbh->prepare($sql6);
                    $query6->execute();
                    $totalquery = $query6->rowCount();
                    ?>
                    <div class="stat-number info"><?php echo htmlentities($totalquery); ?></div>
                    <div class="stat-label">Total Queries</div>
                </div>
                <div class="stat-footer">
                    <a href="manage-conactusquery.php">
                        <span>View Details</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Active Donors Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card warning">
                <div class="text-center">
                    <div class="stat-icon warning">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <?php 
                    $sql7 = "SELECT id from tblblooddonars WHERE status=1";
                    $query7 = $dbh->prepare($sql7);
                    $query7->execute();
                    $activedonors = $query7->rowCount();
                    ?>
                    <div class="stat-number warning"><?php echo htmlentities($activedonors); ?></div>
                    <div class="stat-label">Active Donors</div>
                </div>
                <div class="stat-footer">
                    <a href="donor-list.php">
                        <span>View Details</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="quick-actions">
                <h3 class="section-title">
                    <i class="fas fa-tasks"></i> Quick Actions
                </h3>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <a href="add-bloodgroup.php" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <div class="action-title">Add Blood Group</div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="donor-list.php" class="action-btn">
                            <i class="fas fa-list"></i>
                            <div class="action-title">View All Donors</div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="manage-pages.php" class="action-btn">
                            <i class="fas fa-file-alt"></i>
                            <div class="action-title">Manage Pages</div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../index.php" class="action-btn" target="_blank">
                            <i class="fas fa-globe"></i>
                            <div class="action-title">View Website</div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="manage-donorlogs.php" class="action-btn" >
                            <i class="fas fa-globe"></i>
                            <div class="action-title">Donor Logs</div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="search-donor-by-id.php" class="action-btn" >
                            <i class="fas fa-search"></i>
                            <div class="action-title">Search Donor by ID</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php } ?>