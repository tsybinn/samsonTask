<?
//Реализовать функцию findSimple ($a, $b). $a и $b – целые положительные числа. Результат ее выполнение:
// массив простых чисел от $a до $b.
function findSimple($a, $b)
{
    $arr = [];
    if (is_int($a) && $a >= 0 && is_int($b) && $b >= 0 && $a < $b) { //проверка входных данных
        for ($i = $a; $i <= $b; $i++) {
            $flag = "";
            for ($z = 2; $z < $i; $z++) { // циклом находим все делители
                if ($i % $z == 0) { // если остаток от деления равен 0 то  число не непростое, ставим флаг
                    $flag = $i;
                }
            }
            if (!$flag && $i !== 1) { //если нет флага пишем чило в результирующий массив
                $arr [] .= $i;
            }
        }
        echo "function result findSimple() ";
        var_dump($arr);
        echo "<hr>";
    } else {
        echo "целые положительные числа";
    }
}

//findSimple(1,100);


//Реализовать функцию createTrapeze($a). $a – массив положительных чисел, количество элементов кратно 3. Результат ее
//выполнение: двумерный массив (массив состоящий из ассоциативных массива с ключами a, b, c).
//Пример для входных массива [1, 2, 3, 4, 5, 6] результат [[‘a’=>1,’b’=>2,’с’=>3],[‘a’=>4,’b’=>5 ,’c’=>6]].

$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

function createTrapeze($a)
{
    if (count($a) % 3 == 0) {
        $arr = array();
        $arrKey = array("a", "b", "c");
        $j = 0; // с какого ключа начианть отбор значений в массиве
        for ($i = 0; $i < count($a) / 3; $i++) { // запускаем цикл
            $arrVal = array_slice($a, $j, 3); // выбираем  3 значение массива
            $arr [$i] = array_combine($arrKey, $arrVal); // добавляем массив, используя один массив в качестве ключей, а другой для его значений
            $j += 3;
        }
        echo "function result createTrapeze() ";
        var_dump($arr);
        echo "<hr>";
        return $arr;

    } else {
        echo "массив не кратен 3";
    }
}

//createTrapeze($a);
//Реализовать функцию squareTrapeze($a). $a – массив результата выполнения функции createTrapeze(). Результат ее
//выполнение: в исходный массив для каждой тройки чисел добавляется дополнительный ключ s, содержащий результат расчета
//площади трапеции со сторонами a и b, и высотой c.
function squareTrapeze($a)
{
    foreach ($a as $key => $elem) {
        $s = (($elem["a"] + $elem["b"]) * $elem["c"]) / 2;
        $a[$key]["s"] = (int)round($s); // округляем, результат в массив
    }
    echo "function result squareTrapeze() ";
    var_dump($a);
    echo "<hr>";
    return $a;
}

//squareTrapeze(createTrapeze($a));

//Реализовать функцию getMin($a). $a – массив чисел. Результат ее выполнения: минимальное числа в массиве
//(не используя функцию min, ключи массив может быть ассоциативный).

function getMin($a)
{
    $minAr = null; // для простого массива
    foreach ($a as $key => $elem) {
        $min = null;
        $i = 0;
        if (is_array($elem)) { // проверка на ассоциативный массив
            while ($i < count($elem)) {
                if ($elem[$i] < $min or $min === null) {
                    $min = $elem[$i];
                }
                $i++;
            }
            $arrMin[$key] = $min; // пишем минимальное число каждого блока  в массив
        } else { // если простой
            if ($elem < $minAr or $minAr === null) {
                $minAr = $elem;
            }
            $arrMin = $minAr; // пишем минимальное число в переменную
        }
    }
    echo "function result getMin() <br> ";
    if (is_array($arrMin) ) {
        echo " min numbers for associative array";
        foreach ($arrMin as $key => $elem) {
            echo " for key:" . $key . "-" . $elem;
        }
    } else {
        echo " min number for simple  array-" . $arrMin;
    }
    echo "<hr>";
}
$arr = [012, 2, 182, 5, 8];
$arrAs = ["a" => [3, 2, 3, 4, 5, 6, 8], "b" => [10, 5, 10, 7, 8, 57]];
//getMin($arr);

//Реализовать функцию getSizeForLimit($a, $b). $a – массив результата выполнения функции squareTrapeze(),
//$b – максимальная площадь. Результат ее выполнение: массив размеров трапеции с максимальной площадью,
//но меньше или равной $b.

function getSizeForLimit($a, $b)
{
    $arrS = array();
    foreach ($a as $elem) {
        if ($elem["s"] <= $b) {
            $arrS [] .= $elem["s"];
        }
    }
    echo "function result getSizeForLimit() ";
    echo max($arrS) . "<hr>";


}

//getSizeForLimit(squareTrapeze(createTrapeze($a)),100);
//Реализовать функцию printTrapeze($a). $a – массив результата выполнения функции squareTrapeze().
//Результат ее выполнение: вывод таблицы с размерами трапеций, строки с нечетной площадью трапеции отметить
// любым способом.
?>
<style>
    TABLE {
        width: 300px;
        border-collapse: collapse;
    }
    TD, TH, tr {
        padding: 3px;
        border: 1px solid black;
        text-align: center;
    }
    TH {
        background: #b0e0e6;
    } </style>
<?

function printTrapeze($a)
{
    echo "<table>
  <tr>
   <th>id</th>
    <th>a</th>
    <th>b</th>
   <th>c</th>
   <th>s</th>
  </tr>";
    foreach ($a as $key => $elem) {
        $stylCol = '';
        if ($elem['s'] % 2 !== 0) {
            $stylCol = "style='color:red'";
        }
        echo "<tr $stylCol >";
        echo "<td>" . $key . "</td>";
        echo "<td>" . $elem['a'] . "</td>";
        echo "<td>" . $elem['b'] . "</td>";
        echo "<td>" . $elem['c'] . "</td>";
        echo "<td>" . $elem['s'] . "</td>";
        echo "</tr >";
    }
    echo "</table>";
}

//printTrapeze(squareTrapeze(createTrapeze($a)));

abstract class BaseMath
{
    public $a;
    public $b;
    public $c;

    function exp1($a, $b, $c)
    {
        return $a * ($b ^ $c);
    }

    function exp2($a, $b, $c)
    {
        return ($a / $b) ^ $c;
    }

    abstract function getValue();
}

class F1 extends BaseMath
{
    public function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    function getValue()
    {
        echo "exp1-" . $this->exp1($this->a, $this->b, $this->c) . "<br>" . "exp2-" . $this->exp2($this->a, $this->b, $this->c)
            . "<br>" . "lastСalc-" . $this->lastСalc($this->a, $this->b, $this->c);
    }

    function lastСalc($a, $b, $c)
    {
        return ($a * ($b ^ $c) + ((($a / $c) ^ $b) % 3) ^ $this->minInt());
    }

    private function minInt()
    {
        return min(array($this->a, $this->b, $this->c));
    }
}

//$F1 = new F1(4, 100, 9);
//$F1->getValue();

?>

<h3><a href="https://tsybin.h1n.ru/">мои самописные компоненты</a></h3>
<p>логин: admin</p>
<p>пароль: 555555</p>

