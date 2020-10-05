<?
// функцию convertString($a, $b). Результат ее выполнение: если в строке $a содержится 2 и более подстроки $b, то во
//втором месте заменить подстроку $b на инвертированную подстроку.

// echo substr_count(4565123712389123868, $b); // 2
//$reg =  "#$b#";
// echo preg_replace($reg, '!', '4565123712389123868');

$a ="456 123g 51237 123g 89868 123g 123g ";
 function convertString($a, $b){
      preg_match_all("#$b#", $a, $matches,PREG_OFFSET_CAPTURE);//!!!PREG_OFFSET_CAPTURE
         //var_dump($matches);
         if($secStr = $matches[0][1]){
             echo $a . " - incoming string <br>" ;
             echo  substr_replace($a, strrev($secStr[0]), $secStr[1],strlen($b));
         }
      else {
         echo "2 и более подстроки не были найдены";
     }
 }
//- функию mySortForKey($a, $b). $a – двумерный массив вида [['a'=>2,'b'=>1],['a'=>1,'b'=>3]],
//$b – ключ вложенного массива. Результат ее выполнения: двумерном массива $a отсортированныйпо возрастанию значений
//для ключа $b. В случае отсутствия ключа $b в одном из вложенных массивов, выбросить ошибку класса Exception с индексом
//неправильного массива.

convertString($a,$b="123g");
$arr = [['a' => 2, 'b' => 1], ['a' => 1, 'b' => 3]];
$b = 0;
function mySortForKey($a, $b)
{ //var_dump($a);
    try {
        if (!array_key_exists($b, $a)) {
            throw new Exception("$b index does not exist ");
        } else {
            asort($a[$b]);
            var_dump($a);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}
//mySortForKey($arr, $b);





