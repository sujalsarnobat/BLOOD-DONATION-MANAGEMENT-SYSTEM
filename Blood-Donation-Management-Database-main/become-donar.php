<?php
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit']))
{
    $fullname=$_POST['fullname'];
    $mobile=$_POST['mobileno'];
    $email=$_POST['emailid'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $blodgroup=$_POST['bloodgroup'];
    $address=$_POST['address'];
    $message=$_POST['message'];
    $status=1;
    $sql="INSERT INTO tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':blodgroup',$blodgroup,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg="Your information has been submitted successfully! Thank you for becoming a donor.";
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
    <meta name="description" content="Become a Blood Donor - PES Blood Bank">
    <meta name="author" content="PES Blood Bank">
    <title>Become a Donor | PES Blood Bank</title>
    
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
        
        .form-section {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            margin-bottom: 50px;
        }
        
        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
            text-align: center;
        }
        
        .form-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 1.05rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-label .required {
            color: var(--primary-red);
        }
        
        .form-control,
        .form-select {
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 14px 50px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
            color: white;
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
        
        .benefits-section {
            background: linear-gradient(135deg, #F5F7FA 0%, #C3CFE8 100%);
            padding: 50px;
            border-radius: 15px;
            margin-bottom: 50px;
        }
        
        .benefits-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .benefit-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.2);
        }
        
        .benefit-icon {
            font-size: 3rem;
            color: var(--primary-red);
            margin-bottom: 20px;
        }
        
        .benefit-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }
        
        .benefit-text {
            color: #666;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .form-section {
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
            <i class="fas fa-hand-holding-heart"></i> Become a Blood Donor
        </h1>
        <p class="page-subtitle">Join our community of lifesavers and help save lives</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Become a Donor</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    
    <!-- Benefits Section -->
    <div class="benefits-section">
        <h2 class="benefits-title">Why Donate Blood?</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                    <h3 class="benefit-title">Save Lives</h3>
                    <p class="benefit-text">One donation can save up to 3 lives. Be a hero for someone in need.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-shield-heart"></i>
                    </div>
                    <h3 class="benefit-title">Health Benefits</h3>
                    <p class="benefit-text">Regular donation reduces heart disease risk and improves cardiovascular health.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="benefit-title">Make Impact</h3>
                    <p class="benefit-text">Join thousands of donors making a real difference in our community.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration Form -->
    <div class="form-section">
        <h2 class="form-title">Donor Registration Form</h2>
        <p class="form-subtitle">Fill in your details below to register as a blood donor</p>
        
        <?php if($error){?>
        <div class="alert-error">
            <strong><i class="fas fa-exclamation-circle"></i> ERROR:</strong> <?php echo htmlentities($error); ?>
        </div>
        <?php } else if($msg){?>
        <div class="alert-success">
            <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
        </div>
        <?php }?>
        
        <form name="donar" method="post">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-user"></i> Full Name <span class="required">*</span>
                    </label>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-phone"></i> Mobile Number <span class="required">*</span>
                    </label>
                    <input type="text" name="mobileno" class="form-control" placeholder="Enter mobile number" required pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input type="email" name="emailid" class="form-control" placeholder="Enter email address">
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-calendar"></i> Age <span class="required">*</span>
                    </label>
                    <input type="number" name="age" class="form-control" placeholder="Enter your age" required min="18" max="65">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-venus-mars"></i> Gender <span class="required">*</span>
                    </label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-droplet"></i> Blood Group <span class="required">*</span>
                    </label>
                    <select name="bloodgroup" class="form-select" required>
                        <option value="">Select Blood Group</option>
                        <?php 
                        $sql = "SELECT * from tblbloodgroup";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            { 
                        ?>
                        <option value="<?php echo htmlentities($result->BloodGroup);?>">
                            <?php echo htmlentities($result->BloodGroup);?>
                        </option>
                        <?php 
                            }
                        } 
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 mb-4">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i> City
                    </label>
                    <textarea class="form-control" name="address" rows="3" placeholder="Enter your complete address"></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 mb-4">
                    <label class="form-label">
                        <i class="fas fa-comment"></i> Message <span class="required">*</span>
                    </label>
                    <textarea class="form-control" name="message" rows="4" placeholder="Any additional information or questions?" required></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" name="submit" class="btn-submit">
                        <i class="fas fa-heart"></i> Submit Registration
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>