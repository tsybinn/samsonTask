<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
    "customComponents:user.list",
    "",
    Array(
        "CACHE_TIME" => "180",
        "CACHE_TYPE" => "A",
        "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
        "IBLOCK_ID" => $_REQUEST["ID"],
        "IBLOCK_TYPE" => "news",
        "IBLOCK_URL" => "IBLOCK_URL",
        "PROPERTY_CODE" => array(),
        "SET_BROWSER_TITLE" => "Y",
        "SET_TITLE" => "Y",
    ),$component
);?>