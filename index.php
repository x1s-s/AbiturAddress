<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="script.js"></script>
</head>

<body>


<button onclick="createInput()">toggle</button>
<div class="hidden">
    <input type="text" id="postIndex" placeholder="Почтовый адрес" onblur="tryByPostIndex()">
    <input type="text" id="country" placeholder="Страна" list="countryData">
    <datalist id="countryData">
        <?php
        $args = include 'db.php';
        $serverName = $args['dsn'];
        $connectionInfo = array(
            'CharacterSet' => $args['charset'],
            "Database" => $args['database'],
        );
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_Страны] WHERE [Name] != 'РБ'";
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
            echo "<option value=\"" . $value . "\">" . $value . "</option>";
        }
        ?>
        </datalist>

    <input type="text" id="area" placeholder="Область" list="areaData" onblur="editCity()">
    <datalist id="areaData">
        <?php
        $args = include 'db.php';
        $serverName = $args['dsn'];
        $connectionInfo = array(
            'CharacterSet' => $args['charset'],
            "Database" => $args['database'],
        );
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_Области]";
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
            echo "<option value=\"" . $value . "\">" . $value . "</option>";
        }
        ?>
    </datalist>

    <input type="text" id="city" placeholder="Город" list="cityData">
    <datalist id="cityData">
    </datalist>

    <input type="text" id="TypeSettlement" placeholder="Тип населенного пункта" list="TypeSettlementData">
    <datalist id="TypeSettlementData">
        <?php
        $args = include 'db.php';
        $serverName = $args['dsn'];
        $connectionInfo = array(
            'CharacterSet' => $args['charset'],
            "Database" => $args['database'],
        );
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "SELECT DISTINCT [CodeSOATO] FROM [AbiturSOATO].[dbo].[SOATO_ТипыНаселенныхПунктов]";
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
            echo "<option value=\"" . $value . "\">" . $value . "</option>";
        }
        ?>
    </datalist>

    <input type="text" id="settlement" placeholder="Населённый пункт" list="settlementData">
    <datalist id="settlementData">
    </datalist>

    <input type="text" id="streetType" placeholder="Тип улицы" list="streetTypeData" onblur="editStreet()">
    <datalist id="streetTypeData">
        <?php
        $args = include 'db.php';
        $serverName = $args['dsn'];
        $connectionInfo = array(
            'CharacterSet' => $args['charset'],
            "Database" => $args['database'],
        );
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "SELECT DISTINCT [Name] FROM [AbiturSOATO].[dbo].[SOATO_ТипыУлиц]";
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
            if($value != "---другое---")
            echo "<option value=\"" . $value . "\">" . $value . "</option>";
        }
        ?>
    </datalist>

    <input type="text" id="street" placeholder="Улица" list="streetData">
    <datalist id="streetData">
    </datalist>

    <input type="text" id="house" placeholder="Дом">
    <label>Корпус</label>
    <input type="checkbox" id="korpus" placeholder="Корпус">
    <label>Строение</label>
    <input type="checkbox" id="building" placeholder="строение">
    <input type="text" id="textAfterCheckbox">
    <input type="text" id="flat" placeholder="Квартира">
    <input type="text" id="fio" placeholder="ФИО">

    <button onclick="putToDatabase()">Put to Database</button>
</div>
</body>

</html>