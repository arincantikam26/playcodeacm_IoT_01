<?php 

include "../db_connection.php";

$sql = "SELECT * FROM dht_table ORDER BY id DESC LIMIT 1";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['temp'] = $row['temp'];
    $data['humidity'] = $row['humidity'];
}  else {
    $data['temp'] = "0";
    $data['humidity'] = "0";
}

echo json_encode($data);

$conn->close();

?>