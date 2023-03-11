<?php
$area = $_GET['area'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [AbiturSOATO].[dbo].[SOATO_ГородаРайоны].[Name] 
FROM [AbiturSOATO].[dbo].[SOATO_ГородаРайоны], [AbiturSOATO].[dbo].[SOATO_Области] 
WHERE [AbiturSOATO].[dbo].[SOATO_ГородаРайоны].[IdOblast] = [AbiturSOATO].[dbo].[SOATO_Области].[Id] 
  AND [AbiturSOATO].[dbo].[SOATO_Области].[Name] = '" . $area . "'";
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
    echo "<option value='" . $value . "'>" . $value . "</option>";
}
?>

