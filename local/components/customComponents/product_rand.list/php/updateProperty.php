<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); //connect Api bitrix
/*
 * код для обновления свойства рейтинга в базе данных пользователем
 */
    if(CModule::IncludeModule("iblock")) {
        foreach ($_POST as $key => $elem) { // run the request ajax in a loop
            $el = new CIBlockElement;
            $PROP = array();
            $PROP['RAITING'] = $elem;  // свойству с кодом COUNTVOTING присваиваем значение $elem
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                "PROPERTY_VALUES"=> $PROP,  // array property
            );
            $PRODUCT_ID = $key;  // изменяем элемент с  (ID)
            $res = $el->Update($PRODUCT_ID, $arLoadProductArray); //update property
        }
    }

?>



