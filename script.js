var url = window.location.href;

function createInput() {
    var elements = document.getElementsByClassName("hidden")
    if (elements[0].style.display === 'none') {
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'block';
        }
    } else {
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
}

function getFromDatabase() {
    var elements = document.getElementById("areaData")
    elements.innerHTML = "<option>Test</option>"
}

function tryByPostIndex() {
    var postIndex = document.getElementById("postIndex").value
    document.getElementById("country").value = 'Беларусь'
    $.ajax({
        type: "GET", url: url + "getArea.php", data: {postIndex: postIndex}, success: function (data) {
            document.getElementById("area").value = data
            var area = data
            $.ajax({
                type: "GET", url: url + "getCity.php", data: {area: area}, success: function (data) {
                    // console.log(data)
                    document.getElementById("cityData").innerHTML = data
                }
            })
        }
    })
    $.ajax({
        type: "GET", url: url + "getSettlement.php", data: {postIndex: postIndex}, success: function (data) {
            // console.log(data)
            document.getElementById("settlementData").innerHTML = data
        }
    })
    $.ajax({
        type: "GET", url: url + "getTypeSettlement.php", data: {postIndex: postIndex}, success: function (data) {
            document.getElementById("TypeSettlementData").innerHTML = data
        }
    })


}

function editCity() {
    var area = document.getElementById("area").value
    $.ajax({
        type: "GET", url: url + "getCity.php", data: {area: area}, success: function (data) {
            document.getElementById("cityData").innerHTML = data
        }
    })
}

function editStreet() {
    var settlement = document.getElementById("settlement").value
    var city = document.getElementById("city").value
    $.ajax({
        type: "GET", url: url + "getStreet.php", data: {settlement: settlement, city: city}, success: function (data) {
            document.getElementById("streetData").innerHTML = data
        }
    })
}

function putToDatabase() {
    var postIndex = document.getElementById("postIndex").value
    var country = document.getElementById("country").value
    var area = document.getElementById("area").value
    var city = document.getElementById("city").value
    var settlement = document.getElementById("settlement").value
    var typeSettlement = document.getElementById("TypeSettlement").value
    var street = document.getElementById("street").value
    var house = document.getElementById("house").value
    var flat = document.getElementById("flat").value
    var korpus = document.getElementById("korpus").checked
    var building = document.getElementById("building").checked
    var afterCheckbox = document.getElementById("textAfterCheckbox").value
    var fio = document.getElementById("fio").value
    // alert(postIndex + " " + country + " " + area + " " + city + " " + settlement + " " + typeSettlement + " " + street + " " + house + " " + flat + " " + korpus + " " + building + " " + afterCheckbox)
    $.ajax({
        type: "POST",
        url: url + "putToDatabase.php",
        data: {
            postIndex: postIndex,
            country: country,
            area: area,
            city: city,
            settlement: settlement,
            typeSettlement: typeSettlement,
            street: street,
            house: house,
            flat: flat,
            korpus: korpus,
            building: building,
            afterCheckbox: afterCheckbox,
            fio: fio
        },
        success: function (data) {
            alert(data)
        }
    })
}
