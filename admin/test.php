<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?



?> <? //$APPLICATION->IncludeComponent(
//	"bitrix:main.register",
//	".default",
//	array(
//		"AUTH" => "N",
//		"REQUIRED_FIELDS" => array(
//		),
//		"SET_TITLE" => "Y",
//		"SHOW_FIELDS" => array(
//		),
//		"SUCCESS_PAGE" => "",
//		"USER_PROPERTY" => array(
//		),
//		"USER_PROPERTY_NAME" => "",
//		"USE_BACKURL" => "N",
//		"COMPONENT_TEMPLATE" => ".default"
//	),
//	false
//);?><br>
 <?$APPLICATION->IncludeComponent(
	"customComponents:test.class", 
	"customAjax", 
	array(
		"COMPONENT_TEMPLATE" => "customAjax",
		"WEB_FORM_ID" => "2"
	),
	false
);?><br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>