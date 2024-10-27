<?php
include 'header.php';
require '../app/db.conn.php';

try {
    // Check connection
    if ($conn->errorInfo()[0] != 00000) {
        throw new Exception("Failed to connect to MySQL: " . implode(", ", $conn->errorInfo()));
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM blood_camps ORDER BY id ASC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Display any info -->
<?php if (isset($_REQUEST['info'])) { ?>
    <?php if ($_REQUEST['info'] == "added") { ?>
        <div class="alert alert-success" role="alert">
            Blood Camp Added successfully!
        </div>
    <?php } ?>
    <?php if ($_REQUEST['info'] == "delete") { ?>
        <div class="alert alert-danger" role="alert">
            Blood Camp deleted successfully!
        </div>
    <?php } ?>
<?php } ?>

<p class="h1 text-center">Blood Donation Camp Schedule</p>
<div><a href="add_blood_camps.php" class="btn btn-success ml-3">Add blood camps</a></div>
<table class="table mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Camp Name</th>
            <th scope="col">Address</th>
            <th scope="col">State</th>
            <th scope="col">District</th>
            <th scope="col">Contact</th>
            <th scope="col">Conducted By</th>
            <th scope="col">Organized by</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($result) > 0) { 
            foreach ($result as $row) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= date('d/m/y', strtotime($row['sdate'])) . " - " . date('d/m/y', strtotime($row['edate'])) ?></td>
                    <td><?= date('h:i a', strtotime($row['stime'])) . " - " . date('h:i a', strtotime($row['etime'])) ?></td>
                    <td><?= htmlspecialchars($row['cname']) ?></td>
                    <td><?= htmlspecialchars($row['cadd']) ?></td>
                    <td><?= htmlspecialchars($row['state']) ?></td>
                    <td><?= htmlspecialchars($row['district']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><?= htmlspecialchars($row['conducted']) ?></td>
                    <td><?= htmlspecialchars($row['organized']) ?></td>
                    <td><a href='logic.php?del_blood_camp=<?= $row['id'] ?>' type='button' class='btn btn-danger'>Delete</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php
// Close the PDO connection
$conn = null;
?>
