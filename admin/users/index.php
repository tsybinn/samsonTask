<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользователи");
?><br>
 <?$APPLICATION->IncludeComponent(
	"customComponents:user.viewing", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_FOLDER" => "/admin/users/",
		"SEF_URL_TEMPLATES" => array(
			"users" => "admin/users/",
			"user" => "#CODE#/",
			"userTree" => "admin/user-new/",
		)
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>