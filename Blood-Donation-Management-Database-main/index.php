<?php
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PES Blood Bank - Save Lives Through Blood Donation">
    <meta name="author" content="PES Blood Bank">
    <title>BloodBank & Donor | PES Blood Bank</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
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
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.95;
            font-weight: 300;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn-hero {
            padding: 12px 35px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-hero-primary {
            background-color: white;
            color: var(--primary-red);
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: var(--primary-red);
            text-decoration: none;
        }
        
        .btn-hero-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-hero-secondary:hover {
            background-color: white;
            color: var(--primary-red);
            text-decoration: none;
        }
        
        /* Stats Section */
        .stats-section {
            padding: 60px 0;
            background: white;
            border-radius: 15px;
            margin-top: -40px;
            position: relative;
            z-index: 10;
            margin-left: 15px;
            margin-right: 15px;
        }
        
        .stat-card {
            text-align: center;
            padding: 30px;
            border-radius: 12px;
            background: linear-gradient(135deg, #F5F7FA 0%, #C3CFE8 100%);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.2);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            color: var(--primary-red);
            margin-bottom: 15px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-red);
        }
        
        .stat-label {
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 600;
        }
        
        /* Info Cards Section */
        .info-section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .info-card {
            background: white;
            border-radius: 12px;
            padding: 40px 30px;
            border-left: 5px solid var(--primary-red);
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.15);
        }
        
        .info-card h4 {
            color: var(--primary-red);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.4rem;
        }
        
        .info-card p {
            color: #555;
            line-height: 1.8;
            font-size: 0.95rem;
        }
        
        /* Donors Section */
        .donors-section {
            background: linear-gradient(135deg, #F5F7FA 0%, #C3CFE8 100%);
            padding: 80px 0;
        }
        
        .donor-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .donor-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 50px rgba(231, 76, 60, 0.25);
        }
        
        .donor-image {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .donor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .donor-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            color: var(--primary-red);
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
        }
        
        .donor-info {
            padding: 25px;
        }
        
        .donor-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }
        
        .donor-details {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .donor-detail {
            text-align: center;
        }
        
        .donor-detail-label {
            font-size: 0.8rem;
            color: #999;
            font-weight: 600;
        }
        
        .donor-detail-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-red);
        }
        
        /* Blood Groups Section */
        .blood-groups-section {
            padding: 80px 0;
        }
        
        .blood-group-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        
        .blood-group-item {
            background: white;
            border: 2px solid var(--primary-red);
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .blood-group-item:hover {
            background: var(--primary-red);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.3);
        }
        
        .blood-group-item .group-name {
            font-size: 2rem;
            font-weight: 700;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 15px;
            text-align: center;
            margin: 60px 0;
        }
        
        .cta-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }
        
        .cta-button {
            background: white;
            color: var(--primary-red);
            padding: 15px 50px;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: var(--primary-red);
            text-decoration: none;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<?php include('includes/header.php');?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="hero-title">Save Lives Through Blood Donation</h1>
                    <p class="hero-subtitle">Every two seconds, someone needs blood. Be the hero in someone's story.</p>
                    <div class="hero-buttons">
                        <a href="become-donar.php" class="btn-hero btn-hero-primary">
                            <i class="fas fa-heart"></i> Become a Donor
                        </a>
                        <a href="search-donor.php" class="btn-hero btn-hero-secondary">
                            <i class="fas fa-search"></i> Find Blood
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-droplet" style="font-size: 150px; color: rgba(255,255,255,0.3);"></i>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<div class="container">
    <div class="stats-section">
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div class="stat-number">
                        <?php 
                        $sql = "SELECT COUNT(*) as count from tblblooddonars where status=1";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $result=$query->fetch(PDO::FETCH_OBJ);
                        echo htmlentities($result->count);
                        ?>
                    </div>
                    <div class="stat-label">Active Donors</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-heartbeat"></i>
                    <div class="stat-number">
                        <?php 
                        $sql = "SELECT COUNT(*) as count from tblbloodgroup";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $result=$query->fetch(PDO::FETCH_OBJ);
                        echo htmlentities($result->count);
                        ?>
                    </div>
                    <div class="stat-label">Blood Groups</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-hospital"></i>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Availability</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-award"></i>
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Verified</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Section -->
<section class="info-section">
    <div class="container">
        <h2 class="section-title">Why Donate Blood?</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-hand-heart"></i> The Need for Blood</h4>
                    <p>Blood cannot be manufactured outside the body and has a limited shelf life. Every day, hospitals need blood for surgeries, transfusions, and emergency treatments. Your donation can save up to 3 lives.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-shield-heart"></i> Health Benefits</h4>
                    <p>Regular blood donation helps reduce iron levels in the blood, lowers heart disease risk, and improves overall cardiovascular health. Donors often report feeling great after donation.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-star"></i> Make a Difference</h4>
                    <p>Be a hero for accident victims, cancer patients, burn victims, and those undergoing surgery. Your donation provides hope and a second chance at life for thousands of patients.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Donors Section -->
<section class="donors-section">
    <div class="container">
        <h2 class="section-title">Featured Donors</h2>
        <div class="row">
            <?php
            $status=1;
            $sql = "SELECT * from tblblooddonars where status=:status order by rand() limit 6";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            
            if($query->rowCount() > 0) {
                foreach($results as $result) { 
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="donor-card">
                    <div class="donor-image">
                        <img src="images/blood-donr.jpg" alt="Donor">
                        <div class="donor-badge"><?php echo htmlentities($result->BloodGroup); ?></div>
                    </div>
                    <div class="donor-info">
                        <div class="donor-name"><?php echo htmlentities($result->FullName); ?></div>
                        <div class="donor-details">
                            <div class="donor-detail">
                                <div class="donor-detail-label">Gender</div>
                                <div class="donor-detail-value"><?php echo htmlentities($result->Gender); ?></div>
                            </div>
                            <div class="donor-detail">
                                <div class="donor-detail-label">Age</div>
                                <div class="donor-detail-value"><?php echo htmlentities($result->Age); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else { 
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">No donors available at the moment.</p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="blood-stats-section" style="padding: 80px 0; background: white;">
    <div class="container">
        <h2 class="section-title" style="text-align: center; font-size: 2.5rem; font-weight: 700; color: #2C3E50; margin-bottom: 50px;">
            Blood Group Availability
        </h2>
        <div class="row">
            <?php
            $bloodGroups = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
            $colors = ['#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#9B59B6', '#1ABC9C', '#E67E22', '#34495E'];
            
            foreach($bloodGroups as $index => $group) {
                // Use CountByBloodGroup function
                $sql = "SELECT CountByBloodGroup(:bloodgroup) as count";
                $query = $dbh->prepare($sql);
                $query->bindParam(':bloodgroup', $group, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);
                $count = $result ? $result->count : 0;
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="blood-stat-card" style="background: white; border: 2px solid <?php echo $colors[$index]; ?>; border-radius: 15px; padding: 30px; text-align: center; transition: all 0.3s ease;">
                    <div style="font-size: 3rem; font-weight: 700; color: <?php echo $colors[$index]; ?>; margin-bottom: 10px;">
                        <?php echo $group; ?>
                    </div>
                    <div style="font-size: 2.5rem; font-weight: 700; color: #2C3E50; margin-bottom: 10px;">
                        <?php echo $count; ?>
                    </div>
                    <div style="color: #666; font-weight: 600;">
                        Donors Available
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<style>
.blood-stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}
</style>
<!-- Blood Groups Section -->
<section class="blood-groups-section">
    <div class="container">
        <h2 class="section-title">Blood Group Information</h2>
        <p class="text-center" style="color: #666; font-size: 1.1rem; margin-bottom: 40px;">
            Every blood type is precious and plays a vital role in saving lives
        </p>
        <div class="blood-group-grid">
            <div class="blood-group-item">
                <div class="group-name">O+</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">O-</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">A+</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">A-</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">B+</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">B-</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">AB+</div>
            </div>
            <div class="blood-group-item">
                <div class="group-name">AB-</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">Ready to Save Lives?</h2>
        <p class="cta-text">Join our community of lifesavers. Register as a donor today and make a difference.</p>
        <a href="become-donar.php" class="cta-button">Start Your Journey</a>
    </div>
</section>

<!-- Footer -->
<?php include('includes/footer.php');?>

<!-- Bootstrap & JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

</body>
</html>