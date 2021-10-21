<?php
session_start();
date_default_timezone_set('Europe/Moscow');
$hit = 0;
$max_length = 8;
$saves = array();
function check_hit($x, $y, $r)
{
    global $hit;
    if ($x >= 0 and $y <= 0) {
        if ($x <= $r and $y >= -$r / 2) {
            $hit = 1;
        } else {
            $hit = 0;
        }
    } else if ($x <= 0 and $y <= 0) {
        if ($x + $y <= $r / 2) {
            $hit = 1;
        } else {
            $hit = 0;
        }
    } else if ($x <= 0 and $y >= 0) {
        if ($x * $x + $y * $y <= $r * $r) {
            $hit = 1;
        } else {
            $hit = 0;
        }
    } else $hit = 0;
}

$validated = 0;
function validate($x, $y, $r)
{
    global $validated;
    if (is_numeric($x) and is_numeric($y) and is_numeric($r) and
        ($x === -4.0 or $x === -3.0 or $x === -2.0 or $x === -1.0 or (float)$x === 0.0 or
            $x === 1.0 or $x === 2.0 or $x === 3.0 or $x === 4.0)
        and
        -5.000 < (float)$y and (float)$y < 5.000
        and
        ($r === 1.0 or $r === 1.5 or $r === 2.0 or $r == 2.5 or $r == 3.0)
    ) {
        $validated = 1;
    } else {
        $validated = 0;
    }
}


function pushResult($x, $y, $r){
    validate($x, $y, $r);
    global $saves, $validated;
    $saves = array();
    if (isset($_SESSION["saves"])) {
        $saves = unserialize($_SESSION["saves"]);
    } else {
        $saves = array();
    }
    if ($validated) {
        global $hit, $x, $y, $r;
        check_hit($x, $y, $r);
        $is_hit = $hit;
        $curr = array(
            "x" => $x,
            "y" => $y,
            "r" => $r,
            "is_hit" => $is_hit
        );
        array_push($saves, $curr);
        $_SESSION["saves"] = serialize($saves);

    } else echo '<label class="error">
                Неверные входные значения
            </label>';

}


if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(400);
    exit;
}

$start = microtime(true); // Время начала работы скрипта


// Парсинг аргументов GET-запроса

$X = $_GET["X"];
$x = -999.0;
$y = $_GET["yValue"];
$r = $_GET["rValue"];

if (isset($x) and is_numeric($x) and
    isset($y) and is_numeric($y) and
    isset($r) and is_numeric($r)) {
    global $x, $X, $y, $r;
    $y = str_replace(',', '.', $y);
    $r = str_replace(',', '.', $r);

    if (strlen($y) > $max_length) {
        $y = substr($y, 0, $max_length);
    }

    if (strlen($r) > $max_length) {
        $r = substr($r, 0, $max_length);
    }
    $y = (float)$y;
    $r = (float)$r;
    foreach ($X as $element) {
        if (is_numeric($element) and trim($element) !== "" and (
                (float)($element) == -4 or (float)($element) == -3 or
                (float)($element) == -2 or (float)($element) == -1 or
                (float)($element) == 0 or (float)($element) == 1 or
                (float)($element) == 2 or (float)($element) == 3 or
                (float)($element) == 4)) {
            $x = str_replace(',', '.', $element);
            $x = (float)$element;
            pushResult($x, $y, $r);
        }
        else {
            echo '<label class="error">
                Неверные входные значения
            </label>';
            break;
        }
    }

}

echo '
    <!DOCTYPE html>
    <html lang="ru">
        <head>
            <meta charset="utf-8">
            <meta name="author" content="Dmitrii Zalevskii">
            <title>Дмитрий Залевский</title>
            <link href="styles.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <header class="header">
                Дмитрий Залевский P3212 Вариант: 12008
            </header>';
echo "
    <br>
    <br>
    <table class='interactive_part input_part'>
        <tr>
            <th>X</th>
            <th>Y</th>
            <th>R</th>
            <th>Наличие попадания</th>
        </tr>
";
if ($saves == array()){
    if (isset($_SESSION["saves"])) {
        $saves = unserialize($_SESSION["saves"]);
    } else {
        $saves = array();
    }
}
foreach ($saves as $element) {
    echo "
        <tr>
            <td>" . $element["x"] . "</td>
            <td>" . $element["y"] . "</td>
            <td>" . $element["r"] . "</td>
            <td>" . ($element["is_hit"] ? "да" : "нет") . "</td>
        </tr>";
}
echo "</table>";

echo "<table>";
echo "<tr>";
echo "<td class='input_part'>";
echo "Текущая дата: " . date("d M Y, H:i:s") . "<br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='input_part'>";
echo "Время работы скрипта: " . (microtime(true) - $start) . " мс";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='input_part'>";
echo "<a href='https://se.ifmo.ru/~s309584/'>Вернуться на главную</a>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo '
    </body>
</html>
';
?>
