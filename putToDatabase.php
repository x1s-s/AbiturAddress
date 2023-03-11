<?php
$postIndex = $_POST['postIndex'];
$country = $_POST['country'];
$area = $_POST['area'];
$city = $_POST['city'];
$typeSettlement = $_POST['typeSettlement'];
$settlement = $_POST['settlement'];
$streetType = $_POST['streetType'];
$street = $_POST['street'];
$house = $_POST['house'];
$building = $_POST['building'];
if($building == "true") $building = 1;
else $building = 0;
$korpus = $_POST['korpus'];
if($korpus == "true") $korpus = 1;
else $korpus = 0;
$buldintOrKorpus = $_POST['buldintOrKorpus'];
$flat = $_POST['flat'];
$fio = $_POST['fio'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "INSERT INTO [AbiturSOATO].[dbo].[ResultTable] ([Почтновый адрес], [Страна], [Область], [Город], [Тип населённого пункта], [Населённый пункт], [Тип улицы], [Улица], [Дом], [Корпус], [Строение], [Квартира], [ФИО]) VALUES ('".$postIndex."', '".$country."', '".$area."', '".$city."', '".$typeSettlement."', '".$settlement."', '".$streetType."', '".$street."', '".$house."', ".$korpus.", ".$building.", '".$flat."', '".$fio."')";
$stmt = sqlsrv_query($conn, $sql);
sqlsrv_close($conn);
echo "All good!";
?>