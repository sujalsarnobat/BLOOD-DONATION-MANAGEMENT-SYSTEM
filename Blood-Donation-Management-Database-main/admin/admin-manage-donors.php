<?php
session_start();
error_reporting(0);
include('../includes/config.php');

// Check if admin is logged in
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {

// Update donor status using stored procedure
if(isset($_GET['action']) && isset($_GET['id'])) {
    $donorId = $_GET['id'];
    $newStatus = ($_GET['action'] == 'activate') ? 1 : 0;
    
    try {
        $sql = "CALL UpdateDonorStatus(:donorid, :newstatus)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':donorid', $donorId, PDO::PARAM_INT);
        $query->bindParam(':newstatus', $newStatus, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
        
        $msg = "Donor status updated successfully!";
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Donors | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Manage Blood Donors</h2>
    
    <?php if(isset($msg)) { ?>
        <div class="alert alert-success"><?php echo $msg; ?></div>
    <?php } ?>
    
    <?php if(isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id, FullName, BloodGroup, MobileNumber, EmailId, status FROM tblblooddonars";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            
            if($query->rowCount() > 0) {
                $cnt = 1;
                foreach($results as $result) {
            ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo htmlentities($result->FullName); ?></td>
                <td><span class="badge bg-danger"><?php echo htmlentities($result->BloodGroup); ?></span></td>
                <td><?php echo htmlentities($result->MobileNumber); ?></td>
                <td><?php echo htmlentities($result->EmailId); ?></td>
                <td>
                    <?php if($result->status == 1) { ?>
                        <span class="badge bg-success">Active</span>
                    <?php } else { ?>
                        <span class="badge bg-secondary">Inactive</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($result->status == 1) { ?>
                        <a href="?action=deactivate&id=<?php echo $result->id; ?>" 
                           class="btn btn-sm btn-warning"
                           onclick="return confirm('Are you sure you want to deactivate this donor?');">
                            <i class="fas fa-ban"></i> Deactivate
                        </a>
                    <?php } else { ?>
                        <a href="?action=activate&id=<?php echo $result->id; ?>" 
                           class="btn btn-sm btn-success"
                           onclick="return confirm('Are you sure you want to activate this donor?');">
                            <i class="fas fa-check"></i> Activate
                        </a>
                    <?php } ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>