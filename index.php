<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="script.js"></script>
</head>

<body>
    <div class="dropdown">
        <div id="myDropdown" class="dropdown-content">
            <h4>ФИО</h4>
            <input type="text"  id="anketa-fio" maxlength="90" class="help-text form-control" help-text="fullname">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdown" class="dropdown-content">
            <h4>Номер паспорта</h4>
            <input type="text" id="anketa-pass" maxlength="90" class="help-text form-control" help-text="fullname">
        </div>
    </div>
    <div style="margin-left:500px">
        <button class="btn btn-success" onclick="submitToBD()">Отправить</button>
    </div>
    <div class="AddressInput" style="margin-top:50px">
    <div class="dropdown">
        <div id="myDropdownArea" class="dropdown-content">
            <h4>Область</h4>
            <input type="text" id="anketaform-adres-area" class="help-text form-control" name="AnketaFormArea" maxlength="90" help-text="Adres" onblur="endOut('myDropdownArea')" onfocus="startOut('myDropdownArea', 'Области', 'anketaform-adres-area')" onkeyup="filterFunction('myDropdownArea', 'anketaform-adres-area')">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdownTown" class="dropdown-content">
            <h4>Города Районы</h4>
            <input type="text" id="anketaform-adres-town" class="help-text form-control" name="AnketaFormTown" maxlength="90" help-text="Adres" onblur="endOut('myDropdownTown')" onfocus="startOut('myDropdownTown', 'ГородаРайоны', 'anketaform-adres-town', 'anketaform-adres-area', 'Области', 'IdOblast')" onkeyup="filterFunction('myDropdownTown', 'anketaform-adres-town')">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdownPynkt" class="dropdown-content">
            <h4>Населённый пункт</h4>
            <input type="text" id="anketaform-adres-pynkt" class="help-text form-control" name="AnketaFormPynkt" maxlength="90" help-text="Adres" onblur="endOut('myDropdownPynkt')" onfocus="startOut('myDropdownPynkt', 'НаселенныеПункты', 'anketaform-adres-pynkt', 'anketaform-adres-area', 'Области', 'IdOblast')" onkeyup="filterFunction('myDropdownPynkt', 'anketaform-adres-pynkt')">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdownStreet" class="dropdown-content">
            <h4>Улицы</h4>
            <input type="text" id="anketaform-adres-street" class="help-text form-control" name="AnketaFormStreet" maxlength="90" help-text="Adres" onblur="endOut('myDropdownStreet')" onfocus="startOut('myDropdownStreet', 'Улицы', 'anketaform-adres-street', 'anketaform-adres-pynkt', 'НаселенныеПункты', 'SOATO')" onkeyup="filterFunction('myDropdownStreet', 'anketaform-adres-street')">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdownStreetNumber" class="dropdown-content">
            <h4>Номер дома</h4>
            <input type="text" id="anketaform-adres-house-number" class="help-text form-control" name="AnketaFormNumber" maxlength="90" help-text="Adres">
        </div>
    </div>
    <div class="dropdown" style="margin-left: 250px;">
        <div id="myDropdownPostIndex" class="dropdown-content">
            <h4>Почтовый индекс</h4>
            <input type="text" id="anketafrom-adres-postindex" maxlength="90" class="help-text form-control" help-text="postIndex">
        </div>
    </div>
</body>

</html>