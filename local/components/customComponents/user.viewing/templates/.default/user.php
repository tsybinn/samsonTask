<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
    "customComponents:user.detail",
    "",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "LOGIN_USER" => $arResult["VARIABLES"]["CODE"],
        "SET_TITLE" => "Y"
    ),
    $component
);













