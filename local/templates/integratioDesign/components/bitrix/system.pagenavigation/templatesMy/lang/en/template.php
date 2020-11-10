<?
$MESS ['nav_of'] = "of";
$MESS ['nav_begin'] = "First";
$MESS ['nav_prev'] = "Prev.";
$MESS ['nav_next'] = "Next";
$MESS ['nav_end'] = "Last";
$MESS ['nav_paged'] = "Paged";
$MESS ['nav_all'] = "All";
$MESS ['nav_to'] = "-";




//// тип инфоблока
//$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
//// идентификатор инфоблока
//$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
//// количество элементов на страницу
//$arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
//// учитывать права доступа при кешировании?
//$arParams['CACHE_GROUPS'] = $arParams['CACHE_GROUPS']=='Y';
//
////** проверка на актуальный кеш */
//if (!CModule::IncludeModule("iblock")) {
//
//    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
//    return;
//}
//$arResult = [];
////**  выборка элементов инфоблока */
//$nPageSize = Array("nPageSize" => 10);
//$arSort = Array("RAND" => "ASC");
//$arSelect = array(
//    "ID",
//    "NAME",
//    "DETAIL_PICTURE",
//    "PREVIEW_TEXT",
//    "DETAIL_PAGE_URL",
//    'IBLOCK_ID',  // это поле обязательно
//);
//$bGetProperty = count($arParams["PROPERTY_CODE"])>0;
//if($bGetProperty)
//    $arSelect[]="PROPERTY_*"; // пользовательские свойства
////var_dump($arSelect);
////var_dump($arParams["PROPERTY_CODE"]);
//$arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
//$res = CIBlockElement::GetList($arSort, $arFilter, false, $nPageSize, $arSelect);
//while ($ob = $res->GetNextElement()) {
//    // получаем поля текущего элемента
//    $arFields = $ob->GetFields();
//    // пользовательские свойства текущего элеиента
//    $arFields['PROPERTIES'] = $ob->GetProperties();
//    // получаем значения пользовательских свойств в удобном для отображения виде
//    //var_dump($arFields['PROPERTIES'] );
//    foreach ($arFields['PROPERTIES'] as $code => $data) {
//        $arFields['DISPLAY_PROPERTIES'][$code] = CIBlockFormatProperties::GetDisplayValue($arFields, $data, '');
//    }
//
//    if ($arFields["DETAIL_PICTURE"]) {
//        //* достаем массив картинки по ее ID */
//        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
//    }
//
//    //** Метод возвращает массив, набор кнопок для управления элементами эрмитаж */
//    $arButtons = CIBlock::GetPanelButtons(
//        $arFields["IBLOCK_ID"],
//        $arFields["ID"],
//        array("SECTION_BUTTONS" => false, "SESSID" => false)
//    );
//    //var_dump($arButtons);
//    $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
//    $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
//    //** собираем массив arResult */
//    $arResult ["ITEMS"] [] = $arFields;
//}
//
////var_dump($arResult);
//
//
//$this->IncludeComponentTemplate();  //connection template
//








?>