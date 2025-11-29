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
    <meta name="description" content="Search for Blood Donors - PES Blood Bank">
    <meta name="author" content="PES Blood Bank">
    <title>Search Blood Donors | PES Blood Bank</title>
    
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
            padding: 60px 0 40px;
            margin-bottom: 50px;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .search-section {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        
        .search-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
            text-align: center;
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
        
        .btn-search {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .results-section {
            margin-top: 50px;
        }
        
        .result-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-left: 5px solid var(--primary-red);
            transition: all 0.3s ease;
        }
        
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.15);
        }
        
        .donor-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }
        
        .donor-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-icon {
            color: var(--primary-red);
            font-size: 1.2rem;
        }
        
        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 0.9rem;
        }
        
        .info-value {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1rem;
        }
        
        .blood-badge {
            display: inline-block;
            background: var(--primary-red);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .city-badge {
            display: inline-block;
            background: #3498DB;
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            margin-left: 10px;
        }
        
        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .no-results i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
        
        .no-results h4 {
            color: var(--text-dark);
            font-weight: 600;
        }
        
        .search-info {
            background: linear-gradient(135deg, #F5F7FA 0%, #C3CFE8 100%);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .search-info p {
            margin: 0;
            color: var(--text-dark);
            font-weight: 500;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<?php include('includes/header.php');?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Search Blood Donors</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Search Donors</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Search Section -->
<div class="container">
    <div class="search-section">
        <h2 class="search-title"><i class="fas fa-search"></i> Find a Blood Donor</h2>
        <div class="search-info">
            <p><i class="fas fa-info-circle"></i> Search by selecting both blood group AND city to find available donors</p>
        </div>
        <form method="post" name="search">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="bloodgroup" class="form-label">
                        <i class="fas fa-droplet"></i> Blood Group <span style="color: var(--primary-red);">*</span>
                    </label>
                    <select class="form-select" name="bloodgroup" id="bloodgroup" required>
                        <option value="">Select Blood Group</option>
                        <?php 
                        $sql = "SELECT * from tblbloodgroup";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { 
                        ?>
                        <option value="<?php echo htmlentities($result->BloodGroup);?>" 
                            <?php if(isset($_POST['bloodgroup']) && $_POST['bloodgroup'] == $result->BloodGroup) echo 'selected'; ?>>
                            <?php echo htmlentities($result->BloodGroup);?>
                        </option>
                        <?php 
                            }
                        } 
                        ?>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">
                        <i class="fas fa-city"></i> City <span style="color: var(--primary-red);">*</span>
                    </label>
                    <input type="text" class="form-control" name="city" id="city" 
                           placeholder="Enter city name" 
                           value="<?php echo isset($_POST['city']) ? htmlentities($_POST['city']) : ''; ?>" required>
                </div>
                
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" name="search" class="btn-search">
                        <i class="fas fa-search"></i> Search Donors
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    <?php
    if(isset($_POST['search'])) {
        $bloodgroup = $_POST['bloodgroup'];
        $city = $_POST['city'];
    ?>
    <div class="results-section">
        <h3 style="font-weight: 700; color: var(--text-dark); margin-bottom: 30px;">
            <i class="fas fa-list"></i> Search Results: 
            <?php if($bloodgroup) { ?>
                <span class="blood-badge"><?php echo htmlentities($bloodgroup);?></span>
            <?php } ?>
            <?php if($city) { ?>
                <span class="city-badge"><i class="fas fa-city"></i> <?php echo htmlentities($city);?></span>
            <?php } ?>
            <?php if(!$bloodgroup && !$city) { ?>
                <span class="blood-badge">All Donors</span>
            <?php } ?>
        </h3>
        
        <?php 
        try {
            // Call the stored procedure SearchDonors (only 2 parameters)
            $sql = "CALL SearchDonors(:bloodgroup, :city)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
            $query->bindParam(':city', $city, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            
            if($query->rowCount() > 0) {
                foreach($results as $result) { 
        ?>
        
        <div class="result-card">
            <div class="donor-name">
                <i class="fas fa-user-circle" style="color: var(--primary-red);"></i> 
                <?php echo htmlentities($result->FullName);?>
            </div>
            <div class="donor-info">
                <div class="info-item">
                    <i class="fas fa-droplet info-icon"></i>
                    <div>
                        <div class="info-label">Blood Group</div>
                        <div class="info-value"><?php echo htmlentities($result->BloodGroup);?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-venus-mars info-icon"></i>
                    <div>
                        <div class="info-label">Gender</div>
                        <div class="info-value"><?php echo htmlentities($result->Gender);?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar info-icon"></i>
                    <div>
                        <div class="info-label">Age</div>
                        <div class="info-value"><?php echo htmlentities($result->Age);?> years</div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone info-icon"></i>
                    <div>
                        <div class="info-label">Mobile</div>
                        <div class="info-value"><?php echo htmlentities($result->MobileNumber);?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope info-icon"></i>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo htmlentities($result->EmailId);?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt info-icon"></i>
                    <div>
                        <div class="info-label">Address</div>
                        <div class="info-value"><?php echo htmlentities($result->Address);?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
                }
            } else { 
        ?>
        
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h4>No donors found matching your search criteria</h4>
            <p style="color: #666;">
                <?php 
                if($bloodgroup && $city) {
                    echo "Try searching with different blood group or city.";
                } elseif($bloodgroup) {
                    echo "Try searching for blood group " . htmlentities($bloodgroup) . " in a different city or search without specifying city.";
                } elseif($city) {
                    echo "Try searching in city " . htmlentities($city) . " with a different blood group or search without specifying blood group.";
                } else {
                    echo "Please try different search criteria.";
                }
                ?>
            </p>
        </div>
        
        <?php 
            }
            
            // Close the cursor to free up the connection for the next query
            $query->closeCursor();
            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
    <?php } ?>
</div>

<!-- Footer -->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>