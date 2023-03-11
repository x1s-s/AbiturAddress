<?php
$settlement = $_GET['settlement'];
$city = $_GET['city'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [AbiturSOATO].[dbo].[SOATO_Улицы].[Name] FROM [AbiturSOATO].[dbo].[SOATO_ГородаРайоны], [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты], [AbiturSOATO].[dbo].[SOATO_Улицы] WHERE [AbiturSOATO].[dbo].[SOATO_ГородаРайоны].Name = '".$city."' AND [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты].Name = '".$settlement."' AND [AbiturSOATO].[dbo].[SOATO_НаселенныеПункты].[SOATO] = [AbiturSOATO].[dbo].[SOATO_Улицы].[SOATO] and [AbiturSOATO].[dbo].[SOATO_ГородаРайоны].[SOATO] = [AbiturSOATO].[dbo].[SOATO_Улицы].[SOATO]";
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