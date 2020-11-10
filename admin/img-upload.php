<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("img_upload");
?><?$APPLICATION->IncludeComponent(
	"customComponents:img_upload",
	"customAjax",
	Array(
		"WEB_FORM_ID" => $_REQUEST[WEB_FORM_ID]
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>