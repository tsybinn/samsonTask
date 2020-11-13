<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//** проверка на актуальный кеш */
if ($this->startResultCache()) {

    $arParams = array(
        "FIELDS" => array(
            "ID",
            "NAME",
            "LAST_NAME",
            "EMAIL",
            "LAST_LOGIN",
            "LOGIN",
        )
    );
    $rsUsers = CUser::GetList(($by = "last_login"), ($order = "DESC"), false, $arParams);
    while ($arItem = $rsUsers->GetNext()) {
        $arItem ['LAST_LOGIN_DATE'] = strtotime($arItem['LAST_LOGIN_DATE']);
              $arUsers [] = $arItem;
    }

    $arResult = $arUsers;
    // var_dump($arResult);
   $this->IncludeComponentTemplate();  //connection template

}