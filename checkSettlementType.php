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
$sql = "SELECT TypeNS 
FROM SOATO_ГородаРайоны INNER JOIN SOATO_НаселенныеПункты ON SOATO_ГородаРайоны.IdREgion = SOATO_НаселенныеПункты.IdREgion 
WHERE SOATO_ГородаРайоны.Name = '" . $city . "' AND SOATO_НаселенныеПункты.Name = '" . $settlement . "'";
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
$newArray = array();
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $newArray[$i] = array(
            'name' => $row['TypeNS']);
        $i++;
    }
}
sqlsrv_close($conn);
echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
?>