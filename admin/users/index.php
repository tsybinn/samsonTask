<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользователи");
?><?$APPLICATION->IncludeComponent(
	"customComponents:user.Complex",
	".default",
	Array(
		"ADD_GROUP_PERMISSIONS" => array(0=>"1",),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"DATE_FORMAT" => "d.m.Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"IBLOCK_ID" => "",
		"IBLOCK_TYPE" => "news",
		"SEF_FOLDER" => "/admin/users/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("section"=>"#section_id#/","element"=>"#element_id#/","load"=>"load/","favorite"=>"favorite/","search"=>"search/",),
		"SET_TITLE" => "Y",
		"USE_REVIEW" => "N",
		"USE_SHARE" => "N"
	)
);?>&nbsp;<br>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>