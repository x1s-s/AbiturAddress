<?php
$BDtype = $_GET['BDtype'];
$anketa = $_GET['anketa'];
$foreiginKeyName = $_GET['foreiginKeyName'];
$previosInput = $_GET['previosInput'];
$BDprevios  = $_GET['BDprevios'];
$BDid = $_GET['BDid'];
$serverName = "F1L1N\SQLExpress";
$connectionInfo = array(
    'CharacterSet' => 'UTF-8',
    "Database" => "AbiturSOATO"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_" . $BDtype ."] WHERE ".$foreiginKeyName." IN(select ".$BDid." from [AbiturSOATO].[dbo].[SOATO_" . $BDprevios ."] where Name = '".$previosInput."')";
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
    if($value != 1)
        echo "<a style=\"display: none\" onclick=\"editInput('" . $value . "', '". $anketa ."')\">" . $value . "</a>";
    else
        echo "<a style=\"display: block\">No Results</a>";
}
?>