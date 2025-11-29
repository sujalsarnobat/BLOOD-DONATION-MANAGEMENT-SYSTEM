<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {

// Hide donor (Make Hidden)
if(isset($_REQUEST['hidden'])) {
    $eid = intval($_GET['hidden']);
    $status = "0";
    $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Donor successfully hidden";
}

// Make donor public
if(isset($_REQUEST['public'])) {
    $aeid = intval($_GET['public']);
    $status = 1;
    $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:aeid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Donor successfully made public";
}

// Delete donor
if(isset($_REQUEST['del'])) {
    $did = intval($_GET['del']);
    $sql = "DELETE FROM tblblooddonars WHERE id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();
    $msg = "Record deleted successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Donor List - PES Blood Bank Admin">
    <title>Donor List | Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        
        /* Navbar - Same as dashboard */
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
        
        .btn-download {
            background: linear-gradient(135deg, #2ECC71 0%, #27AE60 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
            color: white;
        }
        
        /* Table Styling */
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
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
        
        .badge-hidden {
            background: #F8D7DA;
            color: #DC3545;
        }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin: 2px;
            transition: all 0.3s ease;
        }
        
        .btn-hide {
            background: #FFF3CD;
            color: #856404;
        }
        
        .btn-hide:hover {
            background: #F39C12;
            color: white;
        }
        
        .btn-show {
            background: #D4EDDA;
            color: #155724;
        }
        
        .btn-show:hover {
            background: #28A745;
            color: white;
        }
        
        .btn-delete {
            background: #F8D7DA;
            color: #721C24;
        }
        
        .btn-delete:hover {
            background: #DC3545;
            color: white;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            padding: 8px 15px;
        }
        
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            padding: 5px 10px;
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
            <i class="fas fa-users"></i> Donors List
        </h1>
    </div>
    
    <!-- Content Card -->
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-list"></i> All Registered Donors
        </h3>
        
        <?php if(isset($error)) { ?>
            <div class="alert-error">
                <strong><i class="fas fa-exclamation-circle"></i> ERROR:</strong> <?php echo htmlentities($error); ?>
            </div>
        <?php } else if(isset($msg)) { ?>
            <div class="alert-success">
                <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>
        
        <a href="download-records.php" class="btn-download">
            <i class="fas fa-download"></i> Download Donor List
        </a>
        
        <div class="table-responsive">
            <table id="donorTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood Group</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM tblblooddonars ORDER BY id DESC";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { 
                    ?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><strong><?php echo htmlentities($result->FullName); ?></strong></td>
                        <td><?php echo htmlentities($result->MobileNumber); ?></td>
                        <td><?php echo htmlentities($result->EmailId); ?></td>
                        <td><?php echo htmlentities($result->Age); ?></td>
                        <td><?php echo htmlentities($result->Gender); ?></td>
                        <td><span class="badge bg-danger"><?php echo htmlentities($result->BloodGroup); ?></span></td>
                        <td><?php echo htmlentities($result->Address); ?></td>
                        <td><?php echo htmlentities($result->Message); ?></td>
                        <td>
                            <?php if($result->status == 1) { ?>
                                <span class="badge-status badge-active">
                                    <i class="fas fa-check-circle"></i> Public
                                </span>
                            <?php } else { ?>
                                <span class="badge-status badge-hidden">
                                    <i class="fas fa-eye-slash"></i> Hidden
                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($result->status == 1) { ?>
                                <a href="donor-list.php?hidden=<?php echo htmlentities($result->id); ?>" 
                                   class="action-btn btn-hide"
                                   onclick="return confirm('Do you really want to hide this donor?')">
                                    <i class="fas fa-eye-slash"></i> Inactivate 
                                </a>
                            <?php } else { ?>
                                <a href="donor-list.php?public=<?php echo htmlentities($result->id); ?>" 
                                   class="action-btn btn-show"
                                   onclick="return confirm('Do you really want to make this donor public?')">
                                    <i class="fas fa-eye"></i> Activate
                                </a>
                            <?php } ?>
                            
                            <a href="donor-list.php?del=<?php echo htmlentities($result->id); ?>" 
                               class="action-btn btn-delete"
                               onclick="return confirm('Do you really want to delete this record permanently?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php 
                        $cnt++;
                        }
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#donorTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        "lengthChange": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "search": "Search donors:",
            "lengthMenu": "Show _MENU_ donors per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ donors",
            "infoEmpty": "No donors found",
            "infoFiltered": "(filtered from _MAX_ total donors)",
            "zeroRecords": "No matching donors found"
        }
    });
});
</script>

</body>
</html>
<?php } ?>