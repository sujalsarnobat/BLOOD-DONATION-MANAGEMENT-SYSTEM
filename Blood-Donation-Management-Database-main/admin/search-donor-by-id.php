<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {
    $donorName = "";
    $donorDetails = null;
    $errorMsg = "";
    
    if(isset($_POST['search'])) {
        $donorId = intval($_POST['donor_id']);
        
        // Get donor name using the GetDonorName function
        $sql = "SELECT GetDonorName(:donorid) as donorname";
        $query = $dbh->prepare($sql);
        $query->bindParam(':donorid', $donorId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if($result && $result->donorname) {
            $donorName = $result->donorname;
            
            // Get full donor details
            $sql = "SELECT * FROM tblblooddonars WHERE id=:donorid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':donorid', $donorId, PDO::PARAM_INT);
            $query->execute();
            $donorDetails = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $errorMsg = "No donor found with ID: " . $donorId;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Search Donor by ID - PES Blood Bank Admin">
    <title>Search Donor by ID | Admin Panel</title>
    
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
        
        /* Navbar - Same as other pages */
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
        
        /* Page Content */
        .page-header-section {
            padding: 30px 0;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        
        .btn-search {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
            border-left: 5px solid #28A745;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .alert-error {
            background: linear-gradient(135deg, #F8D7DA 0%, #F5C6CB 100%);
            border-left: 5px solid #DC3545;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        /* Result table */
        .result-table {
            width: 100%;
            margin-top: 20px;
        }
        
        .result-table tr {
            border-bottom: 1px solid #f0f0f0;
        }
        
        .result-table tr:last-child {
            border-bottom: none;
        }
        
        .result-table td {
            padding: 15px 10px;
        }
        
        .result-table td:first-child {
            font-weight: 600;
            color: var(--text-dark);
            width: 200px;
        }
        
        .result-table td:last-child {
            color: #555;
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .badge-active {
            background: #D4EDDA;
            color: #28A745;
        }
        
        .badge-inactive {
            background: #F8D7DA;
            color: #DC3545;
        }
        
        .blood-group-badge {
            background: var(--primary-red);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 700;
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
    <!-- Page Header -->
    <div class="page-header-section">
        <h1 class="page-title">
            <i class="fas fa-search"></i> Search Donor by ID
        </h1>
    </div>
    
    <!-- Search Card -->
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-search-plus"></i> Enter Donor ID to Search
        </h3>
        
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="donor_id" class="form-label">
                            <i class="fas fa-id-card"></i> Donor ID
                        </label>
                        <input type="number" class="form-control" id="donor_id" name="donor_id" 
                               placeholder="Enter donor ID (e.g., 1, 2, 3...)" required min="1">
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-3">
                <button type="submit" name="search" class="btn-search">
                    <i class="fas fa-search"></i> Search Donor
                </button>
                <a href="dashboard.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </form>
    </div>

    <?php if($errorMsg): ?>
    <div class="alert-error">
        <strong><i class="fas fa-exclamation-circle"></i> ERROR:</strong> <?php echo $errorMsg; ?>
    </div>
    <?php endif; ?>

    <?php if($donorDetails): ?>
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-user-circle"></i> Donor Information
        </h3>
        
        <table class="result-table">
            <tr>
                <td><i class="fas fa-hashtag"></i> Donor ID:</td>
                <td><?php echo htmlentities($donorDetails->id); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-user"></i> Full Name:</td>
                <td><strong><?php echo htmlentities($donorDetails->FullName); ?></strong></td>
            </tr>
            <tr>
                <td><i class="fas fa-phone"></i> Mobile Number:</td>
                <td><?php echo htmlentities($donorDetails->MobileNumber); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope"></i> Email ID:</td>
                <td><?php echo htmlentities($donorDetails->EmailId); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-venus-mars"></i> Gender:</td>
                <td><?php echo htmlentities($donorDetails->Gender); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-birthday-cake"></i> Age:</td>
                <td><?php echo htmlentities($donorDetails->Age); ?> years</td>
            </tr>
            <tr>
                <td><i class="fas fa-tint"></i> Blood Group:</td>
                <td><span class="blood-group-badge"><?php echo htmlentities($donorDetails->BloodGroup); ?></span></td>
            </tr>
            <tr>
                <td><i class="fas fa-map-marker-alt"></i> Address:</td>
                <td><?php echo htmlentities($donorDetails->Address); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-comment"></i> Message:</td>
                <td><?php echo htmlentities($donorDetails->Message); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-calendar"></i> Registration Date:</td>
                <td><?php echo htmlentities($donorDetails->PostingDate); ?></td>
            </tr>
            <tr>
                <td><i class="fas fa-toggle-on"></i> Status:</td>
                <td>
                    <?php if($donorDetails->status == 1): ?>
                        <span class="badge-status badge-active">
                            <i class="fas fa-check-circle"></i> Active
                        </span>
                    <?php else: ?>
                        <span class="badge-status badge-inactive">
                            <i class="fas fa-times-circle"></i> Inactive
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php } ?>
