<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
    exit;
}

$msg = $error = '';
if(isset($_POST['submit']) && $_POST['submit']=="Update") {
    $pagetype=$_GET['type'];
    $pagedetails=$_POST['pgedetails'];
    try {
        $sql = "UPDATE tblpages SET detail=:pagedetails WHERE type=:pagetype";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetype',$pagetype, PDO::PARAM_STR);
        $query->bindParam(':pagedetails',$pagedetails, PDO::PARAM_STR);
        $query->execute();
        $msg = "Page data updated successfully";
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pages | Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script src="nicEdit.js"></script>
    <script>
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas(); }); 
    </script>
    
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
        
        .alert-success {
            background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
            border-left: 5px solid #28A745;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #F8D7DA 0%, #F5C6CB 100%);
            border-left: 5px solid #DC3545;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .form-select, .form-control {
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-select:focus, .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        
        .badge-page {
            display: inline-block;
            background: var(--primary-red);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
        }
        
        .btn-update {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
            color: white;
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
    <div class="page-header-section">
        <h1 class="page-title">
            <i class="fas fa-file-alt"></i> Manage CMS Pages
        </h1>
    </div>
    
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-edit"></i> Edit Page Content
        </h3>
        
        <?php if($error){ ?>
            <div class="alert-danger">
                <strong><i class="fas fa-exclamation-triangle"></i> ERROR:</strong> <?php echo htmlentities($error); ?>
            </div>
        <?php } else if($msg){ ?>
            <div class="alert-success">
                <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>
        
        <form method="post">
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-list"></i> Select Page
                </label>
                <select class="form-select" onchange="location = this.value;">
                    <option value="">-- Choose a Page --</option>
                    <option value="manage-pages.php?type=aboutus" <?php if(isset($_GET['type']) && $_GET['type']=="aboutus") echo "selected"; ?>>About Us</option>
                    <option value="manage-pages.php?type=donor" <?php if(isset($_GET['type']) && $_GET['type']=="donor") echo "selected"; ?>>Why Become Donor</option>
                </select>
            </div>
            
            <?php if(isset($_GET['type'])) { ?>
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-check-circle"></i> Currently Editing
                </label>
                <div>
                    <span class="badge-page">
                        <?php
                            switch($_GET['type']){
                                case "aboutus": echo "About Us"; break;
                                case "donor": echo "Why Become Donor"; break;
                                case "terms": echo "Terms and Conditions"; break;
                                case "privacy": echo "Privacy Policy"; break;
                                case "faqs": echo "FAQs"; break;
                                default: echo "Unknown Page";
                            }
                        ?>
                    </span>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-align-left"></i> Page Content
                </label>
                <textarea class="form-control" name="pgedetails" id="pgedetails" rows="10" required><?php 
                    $pagetype=$_GET['type'];
                    $sql = "SELECT detail FROM tblpages WHERE type=:pagetype";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0) {
                        foreach($results as $result) {
                            echo htmlentities($result->detail);
                        }
                    }
                ?></textarea>
            </div>
            
            <div class="text-end">
                <button type="submit" name="submit" value="Update" class="btn-update">
                    <i class="fas fa-save me-2"></i>Update Page Content
                </button>
            </div>
            <?php } ?>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
