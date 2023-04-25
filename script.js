const url = window.location.href;
//TODO: Сделать запись в новую таблицу
//TODO: Сделать дописку с сельсоветом

function getAddressDataFromLogin(){
    $.ajax(
        {
            url: url + "getDataFromLogin.php",
            type: "GET",
            data : {login: document.getElementById("login").value},
            success: function (data) {
                const obj = JSON.parse(data);
                console.log(obj);
                if(obj.length >= 1){
                    document.getElementById("postIndex").value = obj[0]['postIndex'];
                    document.getElementById("country").value = obj[0]['country'];
                    document.getElementById("area").value = obj[0]['area'];
                    document.getElementById("city").value = obj[0]['city'];
                    document.getElementById("settlementType").value = obj[0]['settlementType'];
                    if(obj[0]['settlementType'] === 'г.'){
                        document.getElementById('settlement').value = obj[0]['city'];
                        document.getElementById('settlement').disabled = true;
                        document.getElementById("settlementType").disabled = true;
                    } else {
                        document.getElementById('settlement').value = obj[0]['settlement'];
                    }
                    document.getElementById("streetType").value = obj[0]['streetType'];
                    document.getElementById("street").value = obj[0]['street'];
                    if(obj[0]['haveKorpus'] === 1){
                        document.getElementById('korpusOrBuilding').disabled = false;
                        document.getElementById('korpusOrBuilding').value = obj[0]['korpus'];
                    }
                    document.getElementById('house').value = obj[0]['house'];
                    document.getElementById('flat').value = obj[0]['flat'];
                }
            }
        }
    );
}
function startFromPostIndex() {
    const postIndex = document.getElementById("postIndex").value;
    if(postIndex.length !== 6)
        return;
    $.ajax(
        {
            url: url + "getByPostIndex.php",
            type: "GET",
            data: {postIndex: postIndex},
            success: function (data) {
                const obj = JSON.parse(data);
                if (obj.length === 1) {
                    document.getElementById("area").value = obj[0]['Region'];
                    document.getElementById("city").value = obj[0]['City'];
                    document.getElementById("settlement").value = obj[0]['Settlement'];
                    document.getElementById("settlementType").value = obj[0]['SettlementType'];
                }
                if(obj.length > 1){
                    $('#postIndexModal').modal('show');
                    const select = document.getElementById("postIndexVariants");
                    select.innerHTML = "<div class=\"row\">\n" +
                        "                        <div class=\"col-md-3\">Область</div>\n" +
                        "                        <div class=\"col-md-3\">Город</div>\n" +
                        "                        <div class=\"col-md-3\">Тип населенного пункта</div>\n" +
                        "                        <div class=\"col-md-3\">Населённый пункт</div>\n" +
                        "                    </div>";
                    for (let i = 0; i < obj.length; i++) {
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

function getSelectedByPostIndex(elementNumber) {
    const area = document.getElementById("col1" + elementNumber).innerText;
    const city = document.getElementById("col2" + elementNumber).innerText;
    const settlementType = document.getElementById("col3" + elementNumber).innerText;
    const settlement = document.getElementById("col4" + elementNumber).innerText;
    document.getElementById("area").value = area;
    document.getElementById("city").value = city;
    document.getElementById("settlement").value = settlement;
    document.getElementById("settlementType").value = settlementType;
    inputSettlement();
    $('#postIndexModal').modal('hide');
    $('#exampleModal').modal('show');
}

function loadData() {
    loadSettlementType();
    loadStreetType();
    loadArea();
    loadCountry();
    inputSettlement();
}

function loadSettlementType() {
    $.ajax(
        {
            url: url + "getSettlementType.php",
            type: "GET",
            success: function (data) {
                const obj = JSON.parse(data);
                const select = document.getElementById("settlementType");
                for (let i = 0; i < obj.length; i++) {
                    const option = document.createElement("option");
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
                const obj = JSON.parse(data);
                const select = document.getElementById("streetType");
                for (let i = 0; i < obj.length; i++) {
                    const option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    );
}

function loadCountry() {
    $.ajax(
        {
            url: url + "getCountry.php",
            type: "GET",
            success: function (data) {
                const obj = JSON.parse(data);
                const select = document.getElementById("countryData");
                for (let i = 0; i < obj.length; i++) {
                    const option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function loadArea() {
    $.ajax(
        {
            url: url + "getArea.php",
            type: "GET",
            success: function (data) {
                const obj = JSON.parse(data);
                const select = document.getElementById("areaData");
                for (let i = 0; i < obj.length; i++) {
                    const option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function getStreet(){
    const settlement = document.getElementById("settlement").value;
    const settlementType = document.getElementById("settlementType").value;
    const select = document.getElementById("streetData");
    select.innerHTML = "";
    if(settlement !== "" && settlementType !== ""){
        $.ajax(
            {
                url: url + "getStreet.php",
                type: "GET",
                data: {settlement: settlement, settlementType: settlementType},
                success: function (data) {
                    const obj = JSON.parse(data);
                    const select = document.getElementById("streetData");
                    for (let i = 0; i < obj.length; i++) {
                        const option = document.createElement("option");
                        option.value = obj[i]['name'];
                        option.innerHTML = obj[i]['name'];
                        select.appendChild(option);
                    }
                }
            }
        )
    }
}

function getSettlement(){
    const area = document.getElementById("area").value;
    const city = document.getElementById("city").value;
    const select = document.getElementById("settlementData");
    select.innerHTML = "";
    if(area !== "" && city !== ""){
        $.ajax(
            {
                url: url + "getSettlement.php",
                type: "GET",
                data: {area: area, city: city},
                success: function (data) {
                    const obj = JSON.parse(data);
                    const select = document.getElementById("settlementData");
                    for (let i = 0; i < obj.length; i++) {
                        const option = document.createElement("option");
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
    const postIndex = document.getElementById("postIndex").value;
    const settlement = document.getElementById("settlement").value;
    const settlementType = document.getElementById("settlementType").value;
    if(settlement !== "" && settlementType !== ""){
        $.ajax(
            {
                url: url + "checkPostIndex.php",
                type: "GET",
                data: {settlement: settlement, settlementType: settlementType},
                success: function (data) {
                    const obj = JSON.parse(data);
                    if(obj.length > 1){
                        var count = 0
                        for (let i = 0; i < obj.length; i++) {
                            if(obj[i]['postIndex'] === postIndex){
                                count++
                            }
                        }
                        if(count === 0 && postIndex !== ""){
                            alert("Почтовый индекс не соответствует выбранному населенному пункту. Пожалуйста, уточните адрес.");
                        }
                    }
                    if(obj.length === 1){
                        if(postIndex === ""){
                            document.getElementById("postIndex").value = obj[0]['postIndex'];
                        } else {
                            if(postIndex !== obj[0]['postIndex']) {
                                const select = document.getElementById("checkVariant");
                                select.innerHTML = "Данный населенный пункт имеет почтовый индекс <b id = \"postIndexCheckVariant\">" + obj[0]['postIndex'] + "</b>. Заменить его?";
                                $('#postIndexCheckModal').modal('show');
                            }
                        }
                    }
                }
            }
        )
    }
}

function checkSettlementInput(){
    checkPostIndex()
    checkSettlementType()
}

function editCheckedPostIndex(){
    document.getElementById("postIndex").value = document.getElementById("postIndexCheckVariant").innerText;
    $('#postIndexCheckModal').modal('hide');
}

function checkSettlementType(){
    const country = document.getElementById("country").value;
    if(country !== "Беларусь"){
        return;
    }
    const settlement = document.getElementById("settlement").value;
    const city = document.getElementById("city").value;
    if(city !== '' && settlement !== ''){
        $.ajax(
            {
                url: url + "checkSettlementType.php",
                type: "GET",
                data: {settlement: settlement, city: city},
                success: function (data) {
                    const obj = JSON.parse(data);
                    if(obj.length === 1){
                        document.getElementById("settlementType").value = obj[0]['name'];
                    } else {
                        const select = document.getElementById("settlementType");
                        select.innerHTML = "";
                        for (let i = 0; i < obj.length; i++) {
                            const option = document.createElement("option");
                            option.value = obj[i]['name'];
                            option.innerHTML = obj[i]['name'];
                            select.appendChild(option);
                        }
                    }
                }
            }
        )
    }


}

function getCity(){
    if (document.getElementById("country").value !== "Беларусь")
        return;
    const area = document.getElementById("area").value;
    if(area === "") {
        return;
    }
    const select = document.getElementById("cityData");
    select.innerHTML = "";
    $.ajax(
        {
            url: url + "getCity.php",
            type: "GET",
            data: {area: area},
            success: function (data) {
                const obj = JSON.parse(data);
                const select = document.getElementById("cityData");
                for (let i = 0; i < obj.length; i++) {
                    const option = document.createElement("option");
                    option.value = obj[i]['name'];
                    option.innerHTML = obj[i]['name'];
                    select.appendChild(option);
                }
            }
        }
    )
}

function enableInput(){
    document.getElementById("korpusOrBuilding").disabled = false;
}

function inputSettlement(){
    const city = document.getElementById("city").value.toString();
    const settlement = document.getElementById("settlement");
    const settlementType = document.getElementById("settlementType");
    const country = document.getElementById("country").value;
    if(city.substring(city.length - 4) !== 'р-он' && country === "Беларусь"){
        settlement.value = city;
        settlement.disabled = true;
        settlementType.value = "г.";
        settlementType.innerHTML = "<option value = \"г.\">г.</option>";
        settlementType.disabled = true;
    } else {
        settlement.disabled = false;
        settlementType.disabled = false;
        getSettlement();
    }
}

function putToDatabase(){
    const postIndex = document.getElementById("postIndex").value;
    const country = document.getElementById("country").value;
    const area = document.getElementById("area").value;
    const city = document.getElementById("city").value;
    const settlement = document.getElementById("settlement").value;
    const settlementType = document.getElementById("settlementType").value;
    const street = document.getElementById("street").value;
    const streetType = document.getElementById("streetType").value;
    let korpusOrBuilding = "";
    if(document.getElementById("korpus").value !== 0){
        korpusOrBuilding = "к. " + document.getElementById("korpusOrBuilding").value;
    }
    if(document.getElementById("building").value !== 0){
        korpusOrBuilding = "с. " + document.getElementById("korpusOrBuilding").value;
    }
    const house = document.getElementById("house").value;
    const flat = document.getElementById("flat").value;
    const fio = document.getElementById("fio").value;
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

function checkArea(){
    const country = document.getElementById("country").value;
    const area = document.getElementById("areaData");
    const city = document.getElementById("cityData");
    const settlement = document.getElementById("settlementData");
    area.innerHTML=""
    city.innerHTML=""
    settlement.innerHTML=""
    if(country === "Беларусь"){
        loadArea()
    }
}

