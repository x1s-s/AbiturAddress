<?php
$args = include 'db.php';
$login = $_GET['login'];
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "EXEC dbo.prGetSOATOAddress '".$login."'";
$stmt = sqlsrv_query($conn, $sql);
$array = array(sqlsrv_num_fields($stmt));
$newArray = array();
if (sqlsrv_num_fields($stmt) == false) {
    echo "No rows returned.";
} else {
    $i = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if($row['Сельсовет'] != ''){
            $newArray[$i] = array(
                'postIndex' => $row['ПочтовыйИндекс'],
                'country' => $row['Страна'],
                'area' => $row['ОбластьСтраны'],
                'city' => $row['ГородРайон'],
                'settlementType' => $row['ТипНаселенногоПункта'],
                'settlement' => $row['НаселенныйПункт'].' с-совет: '.$row['Сельсовет'],
                'streetType' => $row['ТипУлицы'],
                'street' => $row['Улица'],
                'house' => $row['Дом'],
                'haveKorpus' => $row['ЕстьКорпус'],
                'korpus' => $row['Корпус'],
                'flat' => $row['Квартира']
            );
        } else {
            $newArray[$i] = array(
                'postIndex' => $row['ПочтовыйИндекс'],
                'country' => $row['Страна'],
                'area' => $row['ОбластьСтраны'],
                'city' => $row['ГородРайон'],
                'settlementType' => $row['ТипНаселенногоПункта'],
                'settlement' => $row['НаселенныйПункт'],
                'streetType' => $row['ТипУлицы'],
                'street' => $row['Улица'],
                'house' => $row['Дом'],
                'haveKorpus' => $row['ЕстьКорпус'],
                'korpus' => $row['Корпус'],
                'flat' => $row['Квартира']
            );
        }
        $i++;
    }
}
sqlsrv_close($conn);
echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
?>