<?php
session_start();
$login = $_SESSION['login'];
$postIndex = $_POST['postIndex'];
$country = $_POST['country'];
$area = $_POST['area'];
$city = $_POST['city'];
$settlementType = $_POST['settlementType'];
$settlement = $_POST['settlement'];
$ruralCouncil = $_POST['ruralCouncil'];
$ruralCouncilToAddress = $_POST['ruralCouncilNameToAddress'];
$streetType = $_POST['streetType'];
$street = $_POST['street'];
$house = $_POST['house'];
$haveKorpus = $_POST['korpus'];
$korpus = $_POST['korpusOrBuilding'];
$flat = $_POST['flat'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "";
if ($ruralCouncilToAddress == 1) {
    $sql = "
    DECLARE @soato as varchar(100) = (select TOP(1) SOATO_НаселенныеПункты.SOATO from SOATO_НаселенныеПункты, SOATO_Области, SOATO_ГородаРайоны
WHERE 
    SOATO_НаселенныеПункты.IdRegion = SOATO_ГородаРайоны.IdRegion AND
    SOATO_НаселенныеПункты.IdOblast = SOATO_Области.Id AND
	SOATO_НаселенныеПункты.SelSovet = '".$ruralCouncil."' AND
    SOATO_ГородаРайоны.Name = '" . $city . "' AND
    SOATO_НаселенныеПункты.Name = '" . $settlement . "' AND
    SOATO_НаселенныеПункты.TypeNS = '" . $settlementType . "' AND
    SOATO_Области.Name = '" . $area . "')
exec prSetSOATOAddress 
'" . $login . "',
'" . $postIndex . "',  
@soato,
'" . $country . "', 
'" . $area . "', 
'" . $city . "', 
'" . $settlementType . "', 
'" . $settlement . "', 
'" . $streetType . "', 
'" . $street . "', 
'" . $house . "', 
'" . $haveKorpus . "', 
'" . $korpus . "', 
'" . $flat . "',
'" . $ruralCouncilToAddress . "'";
} else {
    if (substr($city, -7) == 'р-он') {
        $sql = "
        DECLARE @soato as varchar(100) = (select TOP(1) SOATO_НаселенныеПункты.SOATO from SOATO_НаселенныеПункты, SOATO_Области, SOATO_ГородаРайоны
WHERE 
    SOATO_НаселенныеПункты.IdRegion = SOATO_ГородаРайоны.IdRegion AND
    SOATO_НаселенныеПункты.IdOblast = SOATO_Области.Id AND
    SOATO_ГородаРайоны.Name = '" . $city . "' AND
    SOATO_НаселенныеПункты.Name = '" . $settlement . "' AND
    SOATO_НаселенныеПункты.TypeNS = '" . $settlementType . "' AND
    SOATO_Области.Name = '" . $area . "')
exec prSetSOATOAddress 
'" . $login . "',
'" . $postIndex . "',  
@soato,
'" . $country . "', 
'" . $area . "', 
'" . $city . "', 
'" . $settlementType . "', 
'" . $settlement . "', 
'" . $streetType . "', 
'" . $street . "', 
'" . $house . "', 
'" . $haveKorpus . "', 
'" . $korpus . "', 
'" . $flat . "',
'" . $ruralCouncilToAddress . "'";
    } else {
        $sql = "
        DECLARE @soato as varchar(100) = (select TOP(1) SOATO_НаселенныеПункты.SOATO from SOATO_НаселенныеПункты, SOATO_Области
WHERE 
    SOATO_НаселенныеПункты.IdRegion IS NULL AND
    SOATO_НаселенныеПункты.IdOblast = SOATO_Области.Id AND
    SOATO_НаселенныеПункты.Name = '" . $settlement . "' AND
    SOATO_НаселенныеПункты.TypeNS = '" . $settlementType . "' AND
    SOATO_Области.Name = '" . $area . "')
exec prSetSOATOAddress 
'" . $login . "',
'" . $postIndex . "',  
@soato,
'" . $country . "', 
'" . $area . "', 
'" . $city . "', 
'" . $settlementType . "', 
'" . $settlement . "', 
'" . $streetType . "', 
'" . $street . "', 
'" . $house . "', 
'" . $haveKorpus . "', 
'" . $korpus . "', 
'" . $flat . "',
'" . $ruralCouncilToAddress . "'";
    }
}
$stmt = sqlsrv_query($conn, $sql);
sqlsrv_close($conn);
?>