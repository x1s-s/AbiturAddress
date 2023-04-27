<?php
$postIndex = $_GET['postIndex'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT SOATO_Области.Name AS Region,
SOATO_ГородаРайоны.Name AS City,
SOATO_НаселенныеПункты.Name AS Settlement,
SOATO_НаселенныеПункты.TypeNS AS SettlementType,
SOATO_НаселенныеПункты.SelSovet AS RuralCouncil
FROM SOATO_ПочтовыеИндексы, SOATO_ГородаРайоны, SOATO_НаселенныеПункты, SOATO_Области
WHERE PostIndex = ". $postIndex . "
AND SOATO_Области.Id = SOATO_ПочтовыеИндексы.КодОбласти
AND (SOATO_ГородаРайоны.SOATO = SOATO_НаселенныеПункты.SOATO OR SOATO_ГородаРайоны.IdRegion = SOATO_НаселенныеПункты.IdRegion)
AND SOATO_НаселенныеПункты.SOATO = SOATO_ПочтовыеИндексы.SOATO";
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
$newArray = array();
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $newArray[$i] = array(
            'Region' => $row['Region'],
            'City' => $row['City'],
            'Settlement' => $row['Settlement'],
            'RuralCouncil' => $row['RuralCouncil'],
            'SettlementType' => $row['SettlementType']);
        $i++;
    }
}
sqlsrv_close($conn);
echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
?>
