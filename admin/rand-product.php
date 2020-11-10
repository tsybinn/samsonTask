<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("rand_product");
?><?  /// добавление гновых эелементов в инфоблок



//if(CModule::IncludeModule("iblock")) {
//    $el = new CIBlockElement;
//
//    $params = array(
//        "max_len" => "100", // обрезает символьный код до 100 символов
//        "change_case" => "L", // буквы преобразуются к нижнему регистру
//        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
//        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
//        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
//        "use_google" => "false", // отключаем использование google
//    );
//
//
//    for ($i = 0; $i < 100; $i++) {
//        $PROP = array();
//        //$PROP['RAITING'] = "$i";  // свойству с кодом 12 присваиваем значение "Белый"
//        $name = "Product №" . $i;
//
//
//        $arLoadProductArray = array(
//            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
//            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
//            "IBLOCK_ID" => 5,
//            "PROPERTY_VALUES" => $PROP,
//            "NAME" => $name,
//            "CODE" => CUtil::translit($name, "ru", $params),
//            "ACTIVE" => "Y",            // активен
//            "PREVIEW_TEXT" => "текст для списка элементов текст для списка элементов текст для списка элементов текст для списка элементов ",
//            "DETAIL_TEXT" => "текст для детального просмотра текст для детального просмотра текст для детального просмотра текст для детального просмотра текст для детального просмотра ",
//            "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/Product.jpeg")
//        );
//
//        if ($PRODUCT_ID = $el->Add($arLoadProductArray))
//
//            echo "New ID: " . $PRODUCT_ID;
//        else
//            echo "Error: " . $el->LAST_ERROR;
//        // var_dump( $arLoadProductArray['DETAIL_PICTURE']);
//    }
//}
    ?><?$APPLICATION->IncludeComponent(
	"customComponents:product_rand.list", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "Y",
		"ELEMENT_COUNT" => "5",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "PRODUCT",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "templatesMy",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => "",
		"SEF_MODE" => "N",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "ASC",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>