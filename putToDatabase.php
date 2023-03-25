<?php
$postIndex = $_POST['postIndex'];
$country = $_POST['country'];
$area = $_POST['area'];
$city = $_POST['city'];
$settlement = $_POST['settlement'];
$typeSettlement = $_POST['typeSettlement'];
$street = $_POST['street'];
$streetType = $_POST['streetType'];
$korpusOrBuilding = $_POST['korpusOrBuilding'];
$house = $_POST['house'];
$flat = $_POST['flat'];
$fio = $_POST['fio'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "INSERT INTO ResultTable ([Почтновый адрес], [Страна], [Область], [Город], [Тип населённого пункта], [Населённый пункт], [Тип улицы], [Улица], [Дом], [КорпусСтроение], [Квартира], [ФИО]) VALUES ('".$postIndex."', '".$country."', '".$area."', '".$city."', '".$typeSettlement."', '".$settlement."', '".$streetType."', '".$street."', '".$house."', '".$korpusOrBuilding."', '".$flat."', '".$fio."')";
$stmt = sqlsrv_query($conn, $sql);
sqlsrv_close($conn);
?>