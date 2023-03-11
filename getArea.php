<?php
$PostIndex = $_GET['postIndex'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
log($PostIndex);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_ПочтовыеИндексы], [AbiturSOATO].[dbo].[SOATO_Области]  WHERE [AbiturSOATO].[dbo].[SOATO_ПочтовыеИндексы].[КодОбласти] = [AbiturSOATO].[dbo].[SOATO_Области].[Id] AND [AbiturSOATO].[dbo].[SOATO_ПочтовыеИндексы].[PostIndex] = " . $PostIndex . "";
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
    echo $value;
}
?>