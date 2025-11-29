<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
{
    $name=$_POST['fullname'];
    $email=$_POST['email'];
    $contactno=$_POST['contactno'];
    $message=$_POST['message'];
    $sql="INSERT INTO tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg="Your message has been sent successfully! We will contact you shortly.";
    }
    else
    {
        $error="Something went wrong. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Contact Us - PES Blood Bank">
    <meta name="author" content="PES Blood Bank">
    <title>Contact Us | PES Blood Bank</title>
    
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
            left: -10%;
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
        
        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            margin-bottom: 20px;
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
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .contact-form-section {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
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
        
        .btn-send {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 14px 50px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-send:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .contact-info-section {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .info-item {
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(10px);
        }
        
        .info-icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .info-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .info-text {
            opacity: 0.95;
            line-height: 1.6;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
            border-left: 5px solid #28A745;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .alert-error {
            background: linear-gradient(135deg, #F8D7DA 0%, #F5C6CB 100%);
            border-left: 5px solid #DC3545;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .contact-form-section,
            .contact-info-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<?php include('includes/header.php');?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="fas fa-envelope"></i> Get in Touch
        </h1>
        <p class="page-subtitle">We're here to help. Send us a message anytime!</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8 mb-4">
            <div class="contact-form-section">
                <h2 class="section-title">
                    <i class="fas fa-paper-plane"></i> Send us a Message
                </h2>
                
                <?php if($error){?>
                <div class="alert-error">
                    <strong><i class="fas fa-exclamation-circle"></i> ERROR:</strong> <?php echo htmlentities($error); ?>
                </div>
                <?php } else if($msg){?>
                <div class="alert-success">
                    <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
                </div>
                <?php }?>
                
                <form name="sentMessage" method="post">
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="fas fa-user"></i> Full Name *
                        </label>
                        <input type="text" class="form-control" id="name" name="fullname" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email Address *
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone"></i> Phone Number *
                        </label>
                        <input type="tel" class="form-control" id="phone" name="contactno" placeholder="Enter your phone number" required pattern="[0-9]{10}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="message" class="form-label">
                            <i class="fas fa-comment"></i> Message *
                        </label>
                        <textarea rows="6" class="form-control" id="message" name="message" placeholder="Write your message here..." required maxlength="999" style="resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" name="send" class="btn-send">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="col-lg-4 mb-4">
            <?php
            $sql = "SELECT Address, EmailId, ContactNo from tblcontactusinfo";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            
            if($query->rowCount() > 0)
            {
                foreach($results as $result)
                { 
            ?>
            <div class="contact-info-section">
                <h2 class="section-title" style="color: white;">
                    <i class="fas fa-info-circle"></i> Contact Information
                </h2>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-title">Our Address</div>
                    <div class="info-text"><?php echo htmlentities($result->Address); ?></div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-title">Phone Number</div>
                    <div class="info-text">
                        <a href="tel:<?php echo htmlentities($result->ContactNo); ?>" style="color: white; text-decoration: none;">
                            <?php echo htmlentities($result->ContactNo); ?>
                        </a>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-title">Email Address</div>
                    <div class="info-text">
                        <a href="mailto:<?php echo htmlentities($result->EmailId); ?>" style="color: white; text-decoration: none;">
                            <?php echo htmlentities($result->EmailId); ?>
                        </a>
                    </div>
                </div>
                
                <div class="info-item" style="margin-bottom: 0;">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-title">Working Hours</div>
                    <div class="info-text">
                        Monday - Friday: 9:00 AM - 6:00 PM<br>
                        Saturday: 9:00 AM - 2:00 PM<br>
                        Sunday: Closed
                    </div>
                </div>
            </div>
            <?php 
                }
            } else { 
            ?>
            <div class="contact-info-section">
                <h2 class="section-title" style="color: white;">Contact Information</h2>
                <p>Contact information not available at the moment.</p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>