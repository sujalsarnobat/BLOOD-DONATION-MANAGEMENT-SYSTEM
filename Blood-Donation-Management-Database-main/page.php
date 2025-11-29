<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PES Blood Bank Information Pages">
    <meta name="author" content="PES Blood Bank">
    
    <?php 
    $pagetype=$_GET['type'];
    $sql = "SELECT PageName from tblpages where type=:pagetype";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
    $pageTitle = $result ? htmlentities($result->PageName) : 'Information';
    ?>
    
    <title><?php echo $pageTitle; ?> | PES Blood Bank</title>
    
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
            color: var(--text-dark);
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: rgba(255,255,255,0.6);
        }
        
        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: white;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .content-section {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 50px;
            line-height: 1.8;
        }
        
        .content-section h1,
        .content-section h2,
        .content-section h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .content-section h1 {
            font-size: 2.5rem;
            border-bottom: 3px solid var(--primary-red);
            padding-bottom: 15px;
        }
        
        .content-section h2 {
            font-size: 2rem;
            color: var(--primary-red);
        }
        
        .content-section h3 {
            font-size: 1.5rem;
        }
        
        .content-section p {
            font-size: 1.05rem;
            color: #555;
            margin-bottom: 20px;
            text-align: justify;
        }
        
        .content-section ul,
        .content-section ol {
            margin-bottom: 25px;
            padding-left: 30px;
        }
        
        .content-section li {
            margin-bottom: 12px;
            color: #555;
            font-size: 1.05rem;
        }
        
        .content-section strong {
            color: var(--primary-red);
            font-weight: 600;
        }
        
        .content-section a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .content-section a:hover {
            color: var(--dark-red);
            text-decoration: underline;
        }
        
        .cta-box {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin-top: 50px;
        }
        
        .cta-box h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }
        
        .cta-box p {
            font-size: 1.1rem;
            margin-bottom: 25px;
            opacity: 0.95;
            color: white;
        }
        
        .cta-btn {
            background: white;
            color: var(--primary-red);
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: var(--primary-red);
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .content-section {
                padding: 30px 20px;
            }
            
            .content-section h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<?php include('includes/header.php');?>

<?php 
$pagetype=$_GET['type'];
$sql = "SELECT type, detail, PageName from tblpages where type=:pagetype";
$query = $dbh->prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0) {
    foreach($results as $result) { 
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="fas fa-info-circle"></i> <?php echo htmlentities($result->PageName); ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><?php echo htmlentities($result->PageName); ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Content Section -->
<div class="container">
    <div class="content-section">
        <?php echo $result->detail; ?>
    </div>
    
<?php 
    } // End foreach loop here
?>
    
    <!-- Call to Action - OUTSIDE the loop -->
    <div class="cta-box">
        <h3>Ready to Make a Difference?</h3>
        <p>Join our community of lifesavers and help save lives through blood donation</p>
        <a href="become-donar.php" class="cta-btn">
            <i class="fas fa-heart"></i> Become a Donor Today
        </a>
    </div>
</div>

<?php 
} else { 
?>

<!-- Page Not Found -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="fas fa-exclamation-triangle"></i> Page Not Found
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Error</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="content-section text-center">
        <i class="fas fa-search" style="font-size: 5rem; color: #ddd; margin-bottom: 30px;"></i>
        <h2 style="color: var(--text-dark); font-weight: 700;">Page Not Found</h2>
        <p style="font-size: 1.1rem; color: #666; margin-bottom: 30px;">
            The page you are looking for does not exist or has been moved.
        </p>
        <a href="index.php" class="btn btn-primary" style="background: var(--primary-red); border: none; padding: 12px 40px; border-radius: 50px; font-weight: 600;">
            <i class="fas fa-home"></i> Go Back Home
        </a>
    </div>
</div>

<?php } ?>

<!-- Footer -->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>