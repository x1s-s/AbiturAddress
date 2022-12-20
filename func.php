<?php
$BDtype = $_GET['BDtype'];
$anketa = $_GET['anketa'];
$serverName = "F1L1N\SQLExpress";
$connectionInfo = array(
    'CharacterSet' => 'UTF-8',
    "Database" => "AbiturSOATO"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_" . $BDtype ."]";
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $array[$i] = $row['Name'];
        $i++;
    }
}
sqlsrv_close($conn);
foreach ($array as $value) {
    echo "<a style=\"display: block\" onclick=\"editInput('" . $value . "', '". $anketa ."')\">" . $value . "</a>";
}
?>