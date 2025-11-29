<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {

// Delete log
if(isset($_REQUEST['del'])) {
    $log_id = intval($_GET['del']);
    $sql = "DELETE FROM donor_logs WHERE log_id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $log_id, PDO::PARAM_INT);
    $query->execute();
    $msg = "Log deleted successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donor Logs | Admin Panel</title>
    
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
        
        .badge-added {
            background: #D4EDDA;
            color: #28A745;
        }
        
        .badge-updated {
            background: #FFF3CD;
            color: #856404;
        }
        
        .badge-deleted {
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
            <i class="fas fa-clock-rotate-left"></i> Manage Donor Activity Logs
        </h1>
    </div>
    
    <div class="content-card">
        <h3 class="card-title">
            <i class="fas fa-history"></i> Donor Activity History
        </h3>
        
        <?php if(isset($msg)) { ?>
            <div class="alert-success">
                <strong><i class="fas fa-check-circle"></i> SUCCESS:</strong> <?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>
        
        <div class="table-responsive">
            <table id="logsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Donor Name</th>
                        <th>Donor ID</th>
                        <th>Action</th>
                        <th>Log Date & Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT l.log_id, l.donor_id, l.action, l.timestamp, d.FullName
                            FROM donor_logs l
                            LEFT JOIN tblblooddonars d ON l.donor_id = d.id
                            ORDER BY l.timestamp DESC";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { 
                            // Determine badge class based on action
                            $badgeClass = 'badge-added';
                            if(stripos($result->action, 'update') !== false) {
                                $badgeClass = 'badge-updated';
                            } elseif(stripos($result->action, 'delete') !== false) {
                                $badgeClass = 'badge-deleted';
                            }
                    ?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><strong><?php echo htmlentities($result->FullName ? $result->FullName : 'Unknown'); ?></strong></td>
                        <td><?php echo htmlentities($result->donor_id); ?></td>
                        <td>
                            <span class="badge-status <?php echo $badgeClass; ?>">
                                <?php 
                                if(stripos($result->action, 'add') !== false) {
                                    echo '<i class="fas fa-plus-circle"></i> ';
                                } elseif(stripos($result->action, 'update') !== false) {
                                    echo '<i class="fas fa-edit"></i> ';
                                } elseif(stripos($result->action, 'delete') !== false) {
                                    echo '<i class="fas fa-trash"></i> ';
                                }
                                echo htmlentities($result->action); 
                                ?>
                            </span>
                        </td>
                        <td><?php echo htmlentities($result->timestamp); ?></td>
                        <td>
                            <a href="manage-donor_logs.php?del=<?php echo htmlentities($result->log_id); ?>" 
                               class="action-btn btn-delete"
                               onclick="return confirm('Do you really want to delete this log entry?')">
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
    $('#logsTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        "order": [[4, "desc"]],
        "language": {
            "search": "Search logs:",
            "lengthMenu": "Show _MENU_ logs per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ logs"
        }
    });
});
</script>

</body>
</html>
<?php } ?>
