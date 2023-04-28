<?php
$settlement = $_GET['settlement'];
$settlementType = $_GET['settlementType'];
$ruralCouncil = $_GET['ruralCouncil'];
$area = $_GET['area'];
$args = include 'db.php';
$serverName = $args['dsn'];
$connectionInfo = array(
    'CharacterSet' => $args['charset'],
    "Database" => $args['database'],
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if($ruralCouncil == ''){
    $sql = "SELECT PostIndex FROM SOATO_ПочтовыеИндексы WHERE SOATO IN
                                               (SELECT SOATO FROM SOATO_НаселенныеПункты WHERE Name = '". $settlement ."' AND TypeNS = '". $settlementType ."') AND 
                                               КодОбласти = (select Id from SOATO_Области where Name = '".$area."') AND 
                                               Checked = 1";
} else {
    $sql = "SELECT PostIndex FROM SOATO_ПочтовыеИндексы WHERE SOATO IN
                                               (SELECT SOATO FROM SOATO_НаселенныеПункты WHERE Name = '". $settlement ."' AND SelSovet = '".$ruralCouncil."' AND TypeNS = '". $settlementType ."') AND 
                                               КодОбласти = (select Id from SOATO_Области where Name = '".$area."') AND
                                               Checked = 1";
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
            'postIndex' => $row['PostIndex']);
        $i++;
    }
}
sqlsrv_close($conn);
echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
?>
