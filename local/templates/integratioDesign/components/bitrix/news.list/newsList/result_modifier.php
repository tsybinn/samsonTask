<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//copy
function wordBreakdown(int $int, $string):array
{
    //вставка пробелов  после тегов
    $str = preg_replace('#(<[^>]+>)#u', ' $1 ', $string);
    // delete trims >1
    $str = preg_replace('#\s+#', ' ', $str);
    //строку в массив по пробелам
    $strAr = explode(' ', $str);
    $i = 1;
    foreach ($strAr as $key => $elem) {
        // если в элем не тэг
        if (strip_tags($elem) == true) {
            $i++;
        }
        if ($i > $int+1) {
            //   $int слово по счету без тегов
            $strValEnd = $key;
            break;
        }
    }
    // array to string and  added trim
    $arResult ['strStart'] = implode( " ",array_slice($strAr, 0,$strValEnd ));
     $arResult ['strAdded'] = implode(" ",array_slice($strAr, $strValEnd ));
    return $arResult;
}
foreach ($arResult['ITEMS'] as $key=>$item){

    if(!empty($item['FIELDS']['DETAIL_TEXT'])){
        $arResult['ITEMS']["$key"]['FIELDS']['DETAIL_TEXT'] = wordBreakdown(10,$item['FIELDS']['DETAIL_TEXT']);
    }

}

