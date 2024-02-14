<?php
include_once "./backend-of-frontend/conn.php";

// $command = "mysql --user={$username} --password='{$password}' "
//     . "-h {$servername} -D {$dbname} < {$script_path}";

// $output = shell_exec($command . '/silverstaronline.sql');
$conn->query('SET foreign_key_checks = 0');
if ($result = $conn->query("SHOW TABLES")) {
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        $conn->query('DROP TABLE IF EXISTS ' . $row[0]);
    }
}

$conn->query('SET foreign_key_checks = 1');

$sql = file_get_contents('./silverstaronline.sql');

if ($conn->multi_query($sql)) {
    $conn->close();
    echo "Successfully imported";
} else {
    throw new Exception($conn->error);
}