<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!empty($arParams["LOGIN_USER"] )){
    $userLogin = $arParams["LOGIN_USER"];
}

    $rsUser = CUser::GetByLogin($userLogin);
    $arUser = $rsUser->Fetch();
    $arResult =$arUser;

//var_dump($arParams);
if ($arParams["SET_TITLE"] === 'Y')
{
        $APPLICATION->SetPageProperty("title", $arResult["NAME"]);
}
$APPLICATION->AddChainItem($arResult["NAME"]);

   $this->IncludeComponentTemplate();  //connection template
?>
