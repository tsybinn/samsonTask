<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// запрещаем сохранение в сессии номера последней страницы
// при стандартной постраничной навигации
CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');
if (!CModule::IncludeModule('iblock')) {
    ShowError('Модуль «Информационные блоки» не установлен');
    return;
}


//var_dump($arParams);
// запрещаем сохранение в сессии номера последней страницы
// при стандартной постраничной навигации
CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');

if (!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 180;
}

// тип инфоблока
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
// идентификатор инфоблока
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams["IBLOCK_URL"] = trim($arParams["IBLOCK_URL"]);

// показывать ссылку «Все элементы», с помощью которой можно показать все элементы списка?
//$arParams['PAGER_SHOW_ALL'] = $arParams['PAGER_SHOW_ALL']=='Y';


//** проверка на актуальный кеш */
if ($this->startResultCache()) {
    if (!CModule::IncludeModule("iblock")) {
        $this->AbortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }
    $arResult = [];

    /*
 * Получаем информацию о разделе инфоблока
 */

    //** параметры сортировки */
    $arOrder = array($arParams["SORT_BY1"] => $arParams["SORT_ORDER1"]);
    // какие поля раздела инфоблока выбираем
    $arSelect = array();
    // условия выборки раздела инфоблока
    $arFilter = array('IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'], 'GLOBAL_ACTIVE' => 'Y',);
    // выполняем запрос к базе данных


    //var_dump($arResult);


    //**  выборка элементов инфоблока */
    $arSelect = array(
        "ID",
        "NAME",
        "DETAIL_PICTURE",
        "DETAIL_TEXT",
        "IBLOCK_ID",
      );

    //var_dump($arParams["PROPERTY_CODE"]);
    $arFilter["ID"] = intval($arParams["ELEMENT_ID"]);
    $arFilter["IBLOCK_ID"] = $arParams['IBLOCK_ID'];

    $rsElement = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, $arSelect);

    //$arFilterProperty =  Array("CODE"=>"PROP3","PROP2");
    if ($obElement = $rsElement->GetNextElement()) {
        // получаем поля текущего элемента
        $arResult = $obElement->GetFields();

// получаем значения пользовательских свойств в удобном для отображения виде
        if (!empty($arParams ['PROPERTY_CODE'])) {
            $arProperty["PROPERTIES"] = $obElement->GetProperties();

            foreach ($arProperty['PROPERTIES'] as $code => $data) {
                $arResult['DISPLAY_PROPERTIES'][$code] = CIBlockFormatProperties::GetDisplayValue($arProperty, $data, '');
            }
        }

    }
    //* достаем массив картинки по ее ID */
    if ($arResult["DETAIL_PICTURE"]) {
        $arResult["DETAIL_PICTURE"] = CFile::GetFileArray($arResult["DETAIL_PICTURE"]);
    }

    //** Метод возвращает массив, набор кнопок для управления элементами эрмитаж */
    $arButtons = CIBlock::GetPanelButtons(
        $arResult["IBLOCK_ID"],
        $arResult["ID"],
        array("SECTION_BUTTONS" => false, "SESSID" => false)
    );
    $arResult["IBLOCK_URL"] = $arParams["IBLOCK_URL"];
    $arResult["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $arResult["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];



    //list of similar news

    $str = preg_replace('#\s+#', ' ', $arResult["NAME"]);
    $arName = explode(" ", $str);
    foreach ($arName as  $key => $value){
        if (   mb_strlen($value)> 4  ){
            $arNameRes [] = "%".$value."%";
        }
    }
    $strMask = implode ("||",$arNameRes);

    $arSelect = array("ID","NAME");
    $arFilter = array(
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
        "ACTIVE_DATE" => "Y", "ACTIVE" => "Y",
        "?NAME" => $strMask,
        "!ID" => $arResult["ID"] // все id кроме указанного

    );
    $res = CIBlockElement::GetList(array(), $arFilter, false,array("nPageSize" => 5), $arSelect);
    while ($ob = $res->GetNextElement()) {

       $arFields = $ob->GetFields();
// ссылка на детальный просмотр из настрек компонента news.list
    $arFields ['DETAIL_PAGE_URL'] ="/admin/infobloki/detail.php/?ELEMENT_ID=".$arFields['ID'];
    $arLinks [] = $arFields;
    }

   $arResult [LIST_ELEMENT_SIMILAR]  = $arLinks;

    if ($arParams["SET_BROWSER_TITLE"] === 'Y')
    {
        if ($arResult["META_TAGS"]["BROWSER_TITLE"] !== '')
            $APPLICATION->SetPageProperty("title", $arResult["NAME"], $arTitleOptions);
    }
   // var_dump($rResult);
    $this->IncludeComponentTemplate();  //connection template
}
// для корректной работы эрмитажа для случаев, когда кеш уже собран
if (
    $arResult["LAST_ITEM_IBLOCK_ID"] > 0
    && $USER->IsAuthorized()
    && $APPLICATION->GetShowIncludeAreas()
    && CModule::IncludeModule("iblock")
) {
    $arButtons = CIBlock::GetPanelButtons($arResult["LAST_ITEM_IBLOCK_ID"], 0, 0, array("SECTION_BUTTONS" => false));
    $this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
}

