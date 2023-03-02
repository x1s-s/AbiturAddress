URL_PATH = "http://localhost:63342/AbiturAddress/exampleOfDirectory/"


function editInput(value, inputid) {
    document.getElementById(inputid).value = value;
}

function test() {
    $.ajax({
        url: URL_PATH + 'func.php',
        method: 'get',
        dataType: 'html',
        data: { BDtype: 'Области' },
        success: function (data) {
            alert(data);
        }
    });
}

function startOut(divid, BDtype, anketaform, previosInputID = null, BDprevios = null, foreiginKeyName = null) {
    $BDid = "ID";
    if(BDtype === 'Улицы') $BDid = "SOATO";
    if (previosInputID == null) {
        if (document.getElementById(divid).getElementsByTagName("a").length === 0) {
            $.ajax({
                url: URL_PATH + 'func.php',
                method: 'get',
                dataType: 'html',
                data: { BDtype: BDtype, anketa: anketaform },
                success: function (data) {
                    document.getElementById(divid).innerHTML += data;
                }
            });
            setTimeout(function () {
                document.getElementById(anketaform).focus();
            }, 300);
        } else {
            var array = document.getElementById(divid).getElementsByTagName("a");
            for (var i = 0; i < array.length && i < 7; i++) {
                array[i].style.display = "block";
            }
        }
    } else {
        if (document.getElementById(divid).getElementsByTagName("a").length == 0) {
            previosInput = document.getElementById(previosInputID).value;
            $.ajax({
                url: URL_PATH + 'funcRegion.php',         /* Куда отправить запрос */
                method: 'get',             /* Метод запроса (post или get) */
                dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                data: { BDtype: BDtype, anketa: anketaform, BDprevios: BDprevios, previosInput: previosInput, foreiginKeyName: foreiginKeyName, BDid: $BDid} ,     /* Данные передаваемые в массиве */
                success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
                    document.getElementById(divid).innerHTML += data; /* В переменной data содержится ответ от index.php. */
                }
            });
            setTimeout(function () {
                document.getElementById(anketaform).focus();
            }, 300);
        } else {
            var array = document.getElementById(divid).getElementsByTagName("a");
            for (var i = 0; i < array.length && i < 7; i++) {
                array[i].style.display = "block";
            }
        }
    }
}

    function endOut(divid) {
        setTimeout(function () {
            var array = document.getElementById(divid).getElementsByTagName("a");
            for (var i = 0; i < array.length; i++) {
                array[i].style.display = "none";
            }
        }, 250);
    }

    function filterFunction(divid, inputid) {
        var input, filter, a, i, count = 0;
        input = document.getElementById(inputid);
        filter = input.value.toUpperCase();
        div = document.getElementById(divid);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
                if(count++ >= 10) break;
            } else {
                a[i].style.display = "none";
            }
        }
    }

    function myFunction(divid) {
        document.getElementById(divid).classList.toggle("show");
    }

    function submitToBD(){
        var area = document.getElementById("anketaform-adres-area").value;
        var region = document.getElementById("anketaform-adres-town").value;
        var city = document.getElementById("anketaform-adres-pynkt").value;
        var street = document.getElementById("anketaform-adres-street").value;
        var house = document.getElementById("anketaform-adres-house-number").value;
        var postindex = document.getElementById("anketafrom-adres-postindex").value;
        var fullname = document.getElementById("anketa-fio").value;
        var passport = document.getElementById("anketa-pass").value;
        $.ajax({
            url: '/putToDatabase.php',
            method: 'post',          
            data: { area: area, region: region, city: city, street: street, house: house, postindex: postindex, fullname: fullname, passport: passport }, 
            success: function () {   
               alert("Submit success"); 
            }
        });
    } 
