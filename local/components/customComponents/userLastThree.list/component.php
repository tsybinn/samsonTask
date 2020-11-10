<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//** проверка на актуальный кеш */
if ($this->startResultCache($arParams['CACHE_TIME'])) {

    $by = "last_login";
    $order = "ASC";
    $arParams = array(
        "FIELDS" => array(
            "ID",
            "NAME",
            "LAST_NAME",
            "EMAIL",
            "LAST_LOGIN",
            "LOGIN",
            "DATE_REGISTER"
        ),
       "NAV_PARAMS" =>array('nTopCount' => 3),
    );
    $rsUsers = CUser::GetList($by, $order, false, $arParams);
    while ($arItem = $rsUsers->GetNext()) {
        $arItem ['LAST_LOGIN_DATE'] = strtotime($arItem['LAST_LOGIN_DATE']);
              $arUsers [] = $arItem;
    }
    $arResult = $arUsers;
     //var_dump($arResult);
   $this->IncludeComponentTemplate();  //connection template

}