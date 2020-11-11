<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("user_new");
?><?$APPLICATION->IncludeComponent(
	"customComponents:user.viewing",
	".default",
	Array(
		"CACHE_TIME" => "1200",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_FOLDER" => "/admin/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("users"=>"users/","user"=>"users/#CODE#/","userTree"=>"user-new/",),
		"SET_TITLE" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>