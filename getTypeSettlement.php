<?php
$settlement = $_GET['settlement'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [TypeNS] FROM [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты] WHERE [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты].[Name] = " . $settlement . "";
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $array[$i] = $row['TypeNS'];
        $i++;
    }
}
sqlsrv_close($conn);
foreach ($array as $value) {
    echo $value;
}
?>
