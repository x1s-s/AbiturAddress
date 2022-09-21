<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>
    <button onclick="editInput('Show')">Нажми меня</button>
    <div class="dropdown">
        <div id="myDropdown" class="dropdown-content">
            <input type="text" id="myInput" onblur="endOut()" onfocus="startOut()" onkeyup="filterFunction()">
            <?php
            $array = array("Gomel", "Minsk", "Grodno", "Vitebsk", "Mogilev", "Brest");
            foreach ($array as $value) {
                echo "<a style=\"display: none\" onclick=\"editInput('" . $value . "')\">" . $value . "</a>";
            }
            ?>
        </div>
    </div>
    <script>
        function editInput(value) {
            document.getElementById("myInput").value = value;
        }
    </script>
    <script>
        function startOut() {
            var a = document.getElementById("myDropdown").getElementsByTagName("a");
            for (var i = 0; i < a.length; i++) {
                a[i].style.display = "block";
            }
        }
    </script>
    <script>
        function endOut() {
            setTimeout(function() {
                var a = document.getElementById("myDropdown").getElementsByTagName("a");
                for (var i = 0; i < a.length; i++) {
                    a[i].style.display = "none";
                }
            }, 250);
        }
    </script>
    <script>
        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
    </script>
    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
    </script>
</body>

</html>