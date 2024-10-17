<?php
include "./db_connection.php";

$sql = "SELECT * FROM dht_table ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="table-responsive">
    <table id="table_data" class="table table-striped table-hover" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Time</th>
                <th>Temperature</th>
                <th>Humidity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {   
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['time'] ?></td>
                        <td><?= $row['temp'] ?>&deg;C</td>
                        <td><?= $row['humidity'] ?> %</td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="5">Data Not Found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#table_data').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>

<?php
$conn->close();
?>
