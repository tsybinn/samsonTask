<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("user_new");
?><?$APPLICATION->IncludeComponent(
	"customComponents:user.viewing", 
	".default", 
	array(
		"CACHE_TIME" => "1200",
		"CACHE_TYPE" => "A",
		"SEF_FOLDER" => "/admin/",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_URL_TEMPLATES" => array(
			"users" => "users/",
			"user" => "users/#CODE#/",
			"userTree" => "user-new/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>