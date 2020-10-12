<?php



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

//convertString($a,$b="123g");
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


///** Реализовать функцию importXml($a). $a – путь к xml файлу (структура файла приведена ниже).
// * Результат ее выполнения: прочитать файл $a и импортировать его в созданную БД.
// */

function importXml($a)
{
    $host = "127.0.0.1";
    $dbname = "test_samson";
    $user = "tsybin";
    $password = "ts21bs24";

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->exec("set names utf8");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if (file_exists($a)) {

        $xml = simplexml_load_file($a);
    } else {
        exit('Не удалось открыть файл goods.xml.');
    }
//From object to normal array
    $arrXml = json_decode(json_encode($xml), true);
    $arrXml = $arrXml['Товар'];

//adjusting the incoming array
    foreach ($arrXml as $key => $elem) {
        if ($elem['@attributes']) { // delete @ in @attributes
            $arrXml[$key]['attributes'] = $elem['@attributes'];
            unset($arrXml[$key]['@attributes']);
        }
// from an associative array to a simple)
        if (isset($elem['Свойства']['Формат']) && is_array($elem['Свойства']['Формат'])) {
            //var_dump($elem['Свойства']);
            foreach ($elem['Свойства']['Формат'] as $key1 => $elem1) {
                $format = "Формат" . $key1;
                $arrXml["$key"]['Свойства'] [$format] = $elem1;
                unset($arrXml["$key"]['Свойства']['Формат']);
            }
        }
        //added type price
        if (isset($elem['Цена'])) {

            $arrXml["$key"]['Цена'] = array_combine(array('Базовая', 'Москва'), array_values($elem['Цена']));
        }
        if (isset($elem['Разделы']) && is_array($elem['Разделы']['Раздел'])) {

            $count = count($elem['Разделы']['Раздел']);
            for ($i = 0; $i < $count; $i++) {
                $arrXml["$key"]['Разделы'][] .= $elem['Разделы']['Раздел'][$i];    //$elem['Свойства']['Формат'][$i];
            }
            unset($arrXml["$key"]['Разделы']['Раздел']);
        }
    }

    foreach ($arrXml as $key => $elem) {

        //*  insert table product
        $sql = "INSERT INTO a_product (code_prod, name) VALUES (:code_prod, :name)";
        $query = $db->prepare($sql);
        $query->execute(array(
            ':code_prod' => $arrXml[$key]['attributes']['Код'],
            ':name' => $arrXml[$key]['attributes']['Название'],
        ));
        $query = $db->query("SELECT * FROM a_product ORDER BY  id  DESC  LIMIT 1");
        $idLast = $query->fetchColumn();
        if ($elem['Разделы']) {
            // var_dump($elem['Разделы']);
            $arrValProp = array_values($elem['Разделы']);
            //var_dump($arrValProp);
            for ($i = 0; $i < count($arrValProp); $i++) {
                $sql = "SELECT id FROM list_category  WHERE name_categ = '$arrValProp[$i]'";// select id category
                $get_row = $db->prepare($sql);
                $get_row->execute();
                $row = $get_row->fetch();
                $sql = "INSERT INTO a_category ( code_prod,name,id_prod,id_list_categ  )
                        VALUES (:code_prod,:name,:id_prod,:id_list_categ)";
                $query = $db->prepare($sql);
                $arrValue = array(
                    ':code_prod' => $arrXml[$key]['attributes']['Код'],
                    ':id_prod' => $idLast,
                    ':name' => $arrValProp[$i],
                    ':id_list_categ' => $row['id']
                );
                $query->execute($arrValue);
            }
        }
//---- for insert  table property
        if ($elem['Свойства']) {
            // var_dump($arrValProp);
            $type_prop = array_keys($elem['Свойства']);
            $arrValProp = array_values($elem['Свойства']);
            for ($i = 0; $i < count($elem["Свойства"]); $i++) {
                $sql = "INSERT INTO a_property ( id_prod, value_prop,type_prop  ) VALUES (:id_prod,:value_prop,:type_prop)";
                $query = $db->prepare($sql);
                $arrValue = array(
                    ':id_prod' => $idLast,
                    ':value_prop' => $arrValProp[$i],
                    ':type_prop' => $type_prop[$i]
                );
                $query->execute($arrValue);
            }
        }
//----   insert for  table price
        if ($elem["Цена"]) {
            $arrPriceType = array_keys($elem['Цена']);
            $arrPriceValue = array_values($elem['Цена']);
            for ($i = 0; $i < count($elem["Цена"]); $i++) {
                $sql = "INSERT INTO a_price ( id_prod,type_price,value_price ) VALUES (:id_prod,:type_price, :value_price)";
                $query = $db->prepare($sql);
                $arrValue = array(
                    ':id_prod' => $idLast,
                    ':type_price' => $arrPriceType[$i],
                    ':value_price' => $arrPriceValue[$i]
                );
                $query->execute($arrValue);
            }
        }
    }
    echo "import completed";
}

$path = "files/goods2.xml";
//importXml($path);
//--------------------------------------------------------------------------------------

//Реализовать функцию exportXml($a, $b). $a – путь к xml файлу вида (структура файла приведена ниже),
// $b – код рубрики. Результат ее выполнения: выбрать из БД товары (и их характеристики, необходимые для
// формирования файла) выходящие в рубрику $b или в любую из всех вложенных в нее рубрик, сохранить результат в файл $a.

