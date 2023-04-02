<?php
$area = $_GET['area'];
$city = $_GET['city'];
$argc = include 'db.php';
$serverName = $argc['dsn'];
$connectionInfo = array(
    'CharacterSet' => $argc['charset'],
    "Database" => $argc['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
//echo substr($city, -7);
$sql = '';
if(substr($city, -7) == 'р-он'){
    $sql = "SELECT [Name] FROM [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты]
  WHERE IdRegion = (SELECT [IdRegion] FROM [AbiturSOATO].[dbo].[SOATO_ГородаРайоны] WHERE [Name] = '".$city."')
  AND IdOblast = (SELECT [Id] FROM [AbiturSOATO].[dbo].[SOATO_Области] WHERE [Name] = '".$area."')";
} else {
    $sql = "SELECT [Name] FROM [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты]
  WHERE IdRegion IS NULL
  AND IdOblast = (SELECT [Id] FROM [AbiturSOATO].[dbo].[SOATO_Области] WHERE [Name] = '".$area."')";
}
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
$newArray = array();
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $newArray[$i] = array(
            'name' => $row['Name']);
        $i++;
    }
}
sqlsrv_close($conn);
echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
?>