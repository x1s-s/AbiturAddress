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
<div style="margin-top: 15px">
    <input type="text" id="login" placeholder="Login">
    <button onclick="getAddressDataFromLogin()">Войти</button>
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        onclick="loadData()" style="margin-top: 15px">
    Launch demo modal
</button>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="insert">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ввод адресса</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="postIndex" placeholder="Почтовый адрес" onblur="startFromPostIndex()">
                <input type="text" id="country" placeholder="Страна" list="countryData" value="Беларусь"
                       onblur="checkArea()">
                <datalist id="countryData">
                </datalist>
                <input type="text" id="area" placeholder="Область" list="areaData" value="Гомельская">
                <datalist id="areaData">
                </datalist>
                <input type="text" id="city" placeholder="Город" list="cityData" value="Гомель" onfocus="getCity()" onblur="inputSettlement()">
                <datalist id="cityData">
                </datalist>
                <div>
                    <select id="settlementType">
                    </select>
                    <input type="text" id="settlement" placeholder="Населённый пункт" onblur="checkSettlementInput()" list="settlementData">
                    <datalist id="settlementData">
                    </datalist>
                </div>
                <select id="streetType">
                </select>
                <input type="text" id="street" placeholder="Улица" onfocus="getStreet()" list="streetData">
                <datalist id="streetData">
                </datalist>
                <div>
                    <input type="radio" id="korpus" name="contact" onclick="enableInput()">
                    <label for="korpus">Корпус</label>
                    <input type="radio" id="building" name="contact" onclick="enableInput()">
                    <label for="buldintOrKorpus">Строение</label>
                    <input type="text" id="korpusOrBuilding" disabled>
                </div>
                <input type="text" id="house" placeholder="Дом">
                <input type="text" id="flat" placeholder="Квартира">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="putToDatabase()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" data-bs-backdrop="static" id="postIndexModal" tabindex="-1" aria-labelledby="postIndexModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="insert">
            <div class="modal-header">
                <h5 class="modal-title" id="postIndexModalLabel">Выбор из предложенных вариантов</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="postIndexVariants">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="postIndexCheckModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="postIndexCheckModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="insert">
            <div class="modal-header">
                <h5 class="modal-title" id="postIndexCheckModalLabel">Проверьте почтовый адрес</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="checkVariant">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть без измениений</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="editCheckedPostIndex()">Изменить почтовый индекс
                </button>
            </div>
        </div>
    </div>
</div>
</body>

</html>