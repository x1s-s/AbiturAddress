<?php
$area = $_POST['area'];
$region = $_POST['region'];
$city = $_POST['city'];
$street = $_POST['street'];
$house = $_POST['house'];
$postindex = $_POST['postindex'];
$fullname = $_POST['fullname'];
$passport = $_POST['passport'];
$str = $area . ", " . $region . ", " . $city . ", " . $street . ", " . $house . ", " . $postindex;
$serverName = "F1L1N\SQLExpress";
$connectionInfo = array(
    'CharacterSet' => 'UTF-8',
    "Database" => "AbiturSOATO"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "INSERT INTO [AbiturSOATO].[dbo].[ResultTable] 
        (ФИО, [Номер паспорта], Область, Город, [Населённый пункт], Улица, [Номер строения], [Почтовый индекс]) 
        VALUES ('$fullname', 
                '$passport', 
                '$area', 
                '$region',
                '$city',
                '$street', 
                '$house', 
                '$postindex')";
$stmt = sqlsrv_query($conn, $sql);
sqlsrv_close($conn);
?>