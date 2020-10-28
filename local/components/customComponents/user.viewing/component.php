<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$arDefaultUrlTemplates404 = array(
	"users" => "",
	"user" => "#CODE#/",
	);

if($arParams["SEF_MODE"] == "Y")
{
	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	
	$arVariables = array();
	
	$componentPage = CComponentEngine::ParseComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
		);
		
	if(!$componentPage)
	{
		$componentPage = "users";
	}
	
	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables);
	}
//var_dump($arResult);
$this->IncludeComponentTemplate($componentPage);
?>
