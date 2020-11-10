<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(

	"PARAMETERS" => array(
		"SEF_MODE" => Array(
			"users" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS"),
				"DEFAULT" => "/admin/users/",
				"VARIABLES" => array(),
			),
			"user" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS_DETAIL"),
				"DEFAULT" => "#CODE#/",
				"VARIABLES" => "",
			),
			"userTree" => array(
				"NAME" => "3 последние регистрации",
				"DEFAULT" => "admin/user-new/",
				"VARIABLES" => "",
			),
		),
		"SET_TITLE" => Array(),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
			),
);


?>
