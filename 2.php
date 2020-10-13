<?php



// функцию convertString($a, $b). Результат ее выполнение: если в строке $a содержится 2 и более подстроки $b, то во
//втором месте заменить подстроку $b на инвертированную подстроку.

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


function exportXml($a, $b)
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

    // список категории вместе с ее детьми
    $sql = "SELECT t1.name_categ AS lev1, t2.name_categ as lev2, t3.name_categ as lev3, t4.name_categ as lev4
FROM list_category AS t1
         LEFT JOIN list_category AS t2 ON t2.parent_id = t1.id
         LEFT JOIN list_category AS t3 ON t3.parent_id = t2.id
         LEFT JOIN list_category AS t4 ON t4.parent_id = t3.id   
         WHERE t1.name_categ = '$b' ";
       $dbArtists = $db->prepare($sql);
    $dbArtists->execute();
    $arCatLDb = $dbArtists->fetchAll(PDO::FETCH_ASSOC);
   // var_dump($arCatLDb);
    if($arCatLDb){

        foreach ($arCatLDb as $key => $elem) {
            foreach ($elem as $elem1) {
                if ($elem1 != null) {
                    $arCat [] = $elem1;
                }
            }
        }
        //добавляем в sql запрос категорию и ее вложенные категории
        $arCat = array_unique($arCat);
        $sqlAdded = "WHERE cat.name = '$b'";
        foreach ($arCat as $key => $elem) {
            if($key != 0){
                $sqlAdded .= " OR cat.name ='$elem' ";
            }
        }

        //select property product
        $sql = "SELECT a_p.name, a_p.id, a_p.code_prod From a_product a_p
 JOIN a_category cat on a_p.id = cat.id_prod $sqlAdded ";
        $dbArtists = $db->prepare($sql);
        $dbArtists->execute();
        if($arDb = $dbArtists->fetchAll(PDO::FETCH_ASSOC)){
        }else{
            echo  "нет элементов категории $b или категории ";
        }
        $arResult = array(); // резултатирующий массив
        foreach ($arDb as $key => $elem) {
            $arResult[$elem['id']]["Название"] = $elem['name'];
            $arResult[$elem['id']] ["Код"] = $elem['code_prod'];
            $arResult[$elem['id']] ["id"] = $elem['id'];
        }

//select property
        $sql = "SELECT a_pr.value_prop, a_pr.id_prod, a_pr.type_prop From a_property a_pr
join a_category cat on a_pr.id_prod = cat.id_prod $sqlAdded";
        $dbArtists = $db->prepare($sql);
        $dbArtists->execute();
        $arDb = $dbArtists->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arDb as $key => $elem) {
            if ($arResult[$elem['id_prod']]["id"] === $elem ["id_prod"]) {
                $arResult[$elem['id_prod']]['Cвойства'] [$elem['type_prop']] = $elem['value_prop'];
            }
        }
        //select property price
        $sql = "SELECT a_pri.id_prod,a_pri.type_price,a_pri.value_price,cat.name as catName    From a_price a_pri
join a_category cat on a_pri.id_prod = cat.id_prod $sqlAdded";
        $dbArtists = $db->prepare($sql);
        $dbArtists->execute();
        $arDb = $dbArtists->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arDb as $key => $elem) {
            // var_dump($elem);
            if ($arResult[$elem['id_prod']]["id"] == $elem ["id_prod"]) {
                $arResult[$elem['id_prod']]['Цена'] [$elem['type_price']] = preg_replace('#\.00#', '', $elem['value_price']) ;
            }
        }
        //select category
        $sql = "SELECT id_prod,name From a_category cat $sqlAdded ";
//    if($b =="Принтеры" OR $b =="МФУ"  ){
//        $sqlAdded = "WHERE name='Принтеры' or name= 'МФУ'";
//    }
//    $sql = "SELECT * From a_category cat $sqlAdded ";
        $dbArtists = $db->prepare($sql);
        $dbArtists->execute();
        $arDb = $dbArtists->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arDb as $key => $elem) {
            if ($arResult[$elem['id_prod']]["id"] == $elem ["id_prod"]) {
                $arResult[$elem['id_prod']]['Разделы']  [] = $elem['name'];
            }
        }

        // формированиe xml файла при помощи API XMLWriter.
        $xw = new XMLWriter();
        $xw->openMemory();
        $xw->startDocument("1.0", "windows-1251");
        $xw->startElement("Товары");
        foreach ($arResult as $elem) {
            $xw->startElement("Товар");
            $xw->writeAttribute('Код', $elem['Код']);
            $xw->writeAttribute('Название', $elem['Название']);
            foreach ($elem['Цена'] as $key => $elem1) {
                $xw->startElement('Цена');
                $xw->writeAttribute("Тип", $key);
                $xw->text("$elem1");
                $xw->endElement();
            }
            $xw->startElement("свойства");
            foreach ($elem['Cвойства'] as $key => $elem1) {
                $xw->startElement(preg_replace('#[0-1]#', '', $key));
                if ($key == "Белизна") {
                    $xw->writeAttribute("ЕдИзм", '%');
                }
                $xw->text("$elem1");
                $xw->endElement();
            }
            $xw->endElement();
            $xw->startElement('Разделы');
        //    var_dump($elem['Разделы']);
            foreach ($elem['Разделы'] as $key => $elem) {
                // var_dump($elem );
                if($elem =='Принтеры' ){
                    $xw->startElement("Раздел");
                    $xw->text("МФУ");
                    $xw->endElement();
                }
                if($elem =='МФУ' ){
                    $xw->startElement("Раздел");
                    $xw->text("МФУ");
                    $xw->endElement("Принтеры");
                }
                $xw->startElement("Раздел");
                $xw->text("$elem");
                $xw->endElement();
            }
            $xw->endElement();
            $xw->endElement();
        }
        $xw->endElement();
        $file = $xw->outputMemory();
        // сохрагнения  в фалу путь $a
        if(file_put_contents($a, $file)){
            // rules
            chmod($a, 0777);
            echo "export completed";
        }



    }else{
        echo " в рубрикие $b нет елементов или ее несуществует ";
}


}


//$b ="Бумага";
//$b = "Картон";
$b = "Принтеры";
//$b = "Картон";
//$b = "Картон цветной";

$path = "files/export.xml";

exportXml( $path,$b);

?>













