<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {

// Mark as read
if(isset($_REQUEST['eid'])) {
    $eid = intval($_GET['eid']);
    $status = 1;
    $sql = "UPDATE tblcontactusquery SET status=:status WHERE id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Query marked as read";
}

// Delete query
if(isset($_REQUEST['del'])) {
    $did = intval($_GET['del']);
    $sql = "DELETE FROM tblcontactusquery WHERE id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();
    $msg = "Query deleted successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Queries | Admin Panel</title>
    
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
        
        .badge-read {
            background: #D4EDDA;
            color: #28A745;
        }
        
        .badge-pending {
            background: #FFF3CD;
            color: #856404;
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
        
        .btn-read {
            background: #D4EDDA;
            color: #155724;
        }
        
        .btn-read:hover {
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
            <i class="fas fa-envelope"></i> Manage Contact Us Queries
        </h1>
    </div>
    
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-comments"></i> User Queries
        </h3>
        
        <?php if(isset($msg)) { ?>
            <div class="alert-success">
                <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>
        
        <div class="table-responsive">
            <table id="queriesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Message</th>
                        <th>Posting Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM tblcontactusquery ORDER BY id DESC";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { 
                    ?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><strong><?php echo htmlentities($result->name); ?></strong></td>
                        <td><?php echo htmlentities($result->EmailId); ?></td>
                        <td><?php echo htmlentities($result->ContactNumber); ?></td>
                        <td><?php echo htmlentities($result->Message); ?></td>
                        <td><?php echo htmlentities($result->PostingDate); ?></td>
                        <td>
                            <?php if($result->status == 1) { ?>
                                <span class="badge-status badge-read">
                                    <i class="fas fa-check-circle"></i> Read
                                </span>
                            <?php } else { ?>
                                <span class="badge-status badge-pending">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($result->status == 0) { ?>
                                <a href="manage-conactusquery.php?eid=<?php echo htmlentities($result->id); ?>" 
                                   class="action-btn btn-read"
                                   onclick="return confirm('Mark this query as read?')">
                                    <i class="fas fa-check"></i> Mark Read
                                </a>
                            <?php } ?>
                            <a href="manage-conactusquery.php?del=<?php echo htmlentities($result->id); ?>" 
                               class="action-btn btn-delete"
                               onclick="return confirm('Do you really want to delete this query?')">
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
    $('#queriesTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        "order": [[0, "desc"]],
        "language": {
            "search": "Search queries:",
            "lengthMenu": "Show _MENU_ queries per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ queries"
        }
    });
});
</script>

</body>
</html>
<?php } ?>