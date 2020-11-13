<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?$APPLICATION->IncludeComponent(
    "customComponents:userLastThree.list",
    "",
    Array(
        "CACHE_TIME" => "1200",
        "CACHE_TYPE" => "A",
        "SET_TITLE" => "Y"
    ), $component
);?>












