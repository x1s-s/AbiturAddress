var url = window.location.href;

function startFromPostIndex() {
    var postIndex = document.getElementById("postIndex").value;
    if(postIndex.length !== 6)
        return;
    $.ajax(
        {
            url: url + "getByPostIndex.php",
            type: "GET",
            data: {postIndex: postIndex},
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.length === 1) {
                    document.getElementById("area").value = obj[0]['Region'];
                    document.getElementById("city").value = obj[0]['City'];
                    document.getElementById("settlement").value = obj[0]['Settlement'];
                    document.getElementById("settlementType").value = obj[0]['SettlementType'];
                }
                if(obj.length > 1){
                    alert("Найдено несколько совпадений. Пожалуйста, уточните адрес.");
                    $('#postIndexModal').modal('show');
                    var select = document.getElementById("postIndexVariants");
                    for (var i = 0; i < obj.length; i++) {
                        select.innerHTML +=
                            "<div class='row'>" +
                            "<button class='btn-group' onclick='getSelectedByPostIndex(" + i + ")'>" +
                            "<div class='col-md-3' id='col1" + i + "'>" + obj[i]['Region'] + "</div>" +
                            "<div class='col-md-3' id='col2" + i + "'>" + obj[i]['City'] + "</div>" +
                            "<div class='col-md-3' id='col3" + i + "'>" + obj[i]['SettlementType'] + "</div>" +
                            "<div class='col-md-3' id='col4" + i + "'>" + obj[i]['Settlement'] + "</div>" +
                            "</button></div>";
                    }
                }
            }
        }
    )
}

function getSelectedByPostIndex(elementNumer) {
    var area = document.getElementById("col1" + elementNumer).innerText;
    var city = document.getElementById("col2" + elementNumer).innerText;
    var settlementType = document.getElementById("col3" + elementNumer).innerText;
    var settlement = document.getElementById("col4" + elementNumer).innerText;
    document.getElementById("area").value = area;
    document.getElementById("city").value = city;
    document.getElementById("settlement").value = settlement;
    document.getElementById("settlementType").value = settlementType;
    $('#postIndexModal').modal('hide');
    $('#exampleModal').modal('show');
}

function loadData() {
    loadSettlementType();
    loadStreetType();
    loadArea();
}

function loadSettlementType() {
    $.ajax(
        {
            url: url + "getSettlementType.php",
            type: "GET",
            success: function (data) {
                var obj = JSON.parse(data);
                var select = document.getElementById("settlementTypeData");
                for (var i = 0; i < obj.length; i++) {
                    var option = document.createElement("option");
                    option.value = obj[i]['CodeSOATO'];
                    option.innerHTML = obj[i]['CodeSOATO'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function loadStreetType() {
    $.ajax(
        {
            url: url + "getStreetType.php",
            type: "GET",
            success: function (data) {
                var obj = JSON.parse(data);
                var select = document.getElementById("streetTypeData");
                for (var i = 0; i < obj.length; i++) {
                    var option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    );
}

function loadArea() {
    $.ajax(
        {
            url: url + "getArea.php",
            type: "GET",
            success: function (data) {
                var obj = JSON.parse(data);
                var select = document.getElementById("areaData");
                for (var i = 0; i < obj.length; i++) {
                    var option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function getStreet(){
    var settlement = document.getElementById("settlement").value;
    var settlementType = document.getElementById("settlementType").value;
    var select = document.getElementById("streetData");
    select.innerHTML = "";
    if(settlement !== "" && settlementType !== ""){
        $.ajax(
            {
                url: url + "getStreet.php",
                type: "GET",
                data: {settlement: settlement, settlementType: settlementType},
                success: function (data) {
                    var obj = JSON.parse(data);
                    var select = document.getElementById("streetData");
                    for (var i = 0; i < obj.length; i++) {
                        var option = document.createElement("option");
                        option.value = obj[i]['name'];
                        option.innerHTML = obj[i]['name'];
                        select.appendChild(option);
                    }
                }
            }
        )
    }
}

function checkPostIndex(){
    var postIndex = document.getElementById("postIndex").value;
    var settlement = document.getElementById("settlement").value;
    var settlementType = document.getElementById("settlementType").value;
    if(settlement !== "" && settlementType !== ""){
        $.ajax(
            {
                url: url + "checkPostIndex.php",
                type: "GET",
                data: {settlement: settlement, settlementType: settlementType},
                success: function (data) {
                    var obj = JSON.parse(data);
                    if(obj.length > 1){
                        var count = 0
                        for (let i = 0; i < obj.length; i++) {
                            if(obj[i]['postIndex'] === postIndex){
                                count++
                            }
                        }
                        if(count === 0){
                            alert("Почтовый индекс не соответствует выбранному населенному пункту. Пожалуйста, уточните адрес.");
                        }
                    }
                    if(obj.length === 1){
                        if(postIndex === ""){
                            document.getElementById("postIndex").value = obj[0]['postIndex'];
                        } else {
                            var select = document.getElementById("checkVariant");
                            select.innerHTML = "Данный населенный пункт имеет почтовый индекс <b id = \"postIndexCheckVariant\">" + obj[0]['postIndex'] + "</b>. Заменить его?";
                            $('#postIndexCheckModal').modal('show');
                        }
                    }
                }
            }
        )
    }
}

function editCheckedPostIndex(){
    var postIndex = document.getElementById("postIndexCheckVariant").innerText;
    document.getElementById("postIndex").value = postIndex;
    console.log(postIndex)
    $('#postIndexCheckModal').modal('hide');
}

function getCity(){
    if (document.getElementById("country").value !== "Беларусь")
        return;
    var area = document.getElementById("area").value;
    if(area === "") {
        return;
    }
    var select = document.getElementById("cityData");
    if(select.children.length !== 0)
        return;
    select.innerHTML = "";
    $.ajax(
        {
            url: url + "getCity.php",
            type: "GET",
            data: {area: area},
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj)
                var select = document.getElementById("cityData");
                for (var i = 0; i < obj.length; i++) {
                    var option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function putToDatabase(){
    var postIndex = document.getElementById("postIndex").value;
    var country = document.getElementById("country").value;
    var area = document.getElementById("area").value;
    var city = document.getElementById("city").value;
    var settlement = document.getElementById("settlement").value;
    var settlementType = document.getElementById("settlementType").value;
    var street = document.getElementById("street").value;
    var streetType = document.getElementById("streetType").value;
    var korpusOrBuilding = "";
    if(document.getElementById("korpus").value !== 0){
        korpusOrBuilding = "к. " + document.getElementById("korpusOrBuilding").value;
    }
    if(document.getElementById("building").value !== 0){
        korpusOrBuilding = "с. " + document.getElementById("korpusOrBuilding").value;
    }
    var house = document.getElementById("house").value;
    var flat = document.getElementById("flat").value;
    var fio = document.getElementById("fio").value;
    $.ajax(
        {
            url: url + "putToDatabase.php",
            type: "POST",
            data: {postIndex: postIndex,country: country, area: area, city: city, settlement: settlement, settlementType: settlementType, street: street, streetType: streetType, korpusOrBuilding: korpusOrBuilding, house: house, flat: flat, fio: fio},
            success: function (data) {
                alert("Данные успешно добавлены в базу данных.");
            }
        }
    )
}


