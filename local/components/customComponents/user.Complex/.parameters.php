<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}

$arSorts = array("ASC" => GetMessage("T_IBLOCK_DESC_ASC"), "DESC" => GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = array(
    "ID" => GetMessage("T_IBLOCK_DESC_FID"),
    "NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
    "ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
    "SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
    "TIMESTAMP_X" => GetMessage("T_IBLOCK_DESC_FTSAMP")
);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"]));
while ($arr = $rsProp->Fetch()) {
    $arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E"))) {
        $arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    }
}

$arUGroupsEx = array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while ($arUGroups = $dbUGroups->Fetch()) {
    $arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
}

$arComponentParameters = array(
    "GROUPS" => array(
        "REVIEW_SETTINGS" => array(
            "SORT" => 140,
            "NAME" => GetMessage("T_IBLOCK_DESC_REVIEW_SETTINGS"),
        ),


    ),
    "PARAMETERS" => array(
        "VARIABLE_ALIASES" => array(
            "section_id" => "ID раздела",
            "element_id" => "ID ролика",
            "load" => "Загрузка",
            "favorite" => "избранное",
            "search" => "поиск",

        ),
//        "SEF_MODE" => array(
//            "section" => array(
//                "NAME" => 'секция',
//                "DEFAULT" => "#section_id#/",
//                "VARIABLES" => array('section_id','section_code'),
//            ),
//            "element" => array(
//                "NAME" => 'Элемент',
//                "DEFAULT" => "#element_id#/",
//                "VARIABLES" => array('element_id','element_code'),
//            ),
//            "load" => array(
//                "NAME" => 'Загрузка',
//                "DEFAULT" => "load/",
//                "VARIABLES" => array(),
//            ),
//            "favorite" => array(
//                "NAME" => 'Избранные',
//                "DEFAULT" => "favorite/",
//                "VARIABLES" => array(),
//            ),
//
//            "search" => array(
//                "NAME" => 'Поиск',
//                "DEFAULT" => "search/",
//                "VARIABLES" => array(),
//            ),
//
//
//        ),
        "AJAX_MODE" => array(),
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "ADDITIONAL_VALUES" => "Y",
        ),
        "USE_REVIEW" => array(
            "PARENT" => "REVIEW_SETTINGS",
            "NAME" => GetMessage("T_IBLOCK_DESC_USE_REVIEW"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
        ),


        "DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),


        "SET_TITLE" => array(),


        "ADD_GROUP_PERMISSIONS" => array(
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("T_IBLOCK_DESC_GROUP_PERMISSIONS"),
            "TYPE" => "LIST",
            "VALUES" => $arUGroupsEx,
            "DEFAULT" => array(1),
            "MULTIPLE" => "Y",
        ),
        "CACHE_TIME" => array("DEFAULT" => 36000000),
    ),
);


if (!IsModuleInstalled("forum")) {
    unset($arComponentParameters["GROUPS"]["REVIEW_SETTINGS"]);
    unset($arComponentParameters["PARAMETERS"]["USE_REVIEW"]);
} elseif ($arCurrentValues["USE_REVIEW"] == "Y") {
    $arForumList = array();
    if (CModule::IncludeModule("forum")) {
        $rsForum = CForumNew::GetList();
        while ($arForum = $rsForum->Fetch())
            $arForumList[$arForum["ID"]] = $arForum["NAME"];
    }
    $arComponentParameters["PARAMETERS"]["MESSAGES_PER_PAGE"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_MESSAGES_PER_PAGE"),
        "TYPE" => "STRING",
        "DEFAULT" => intVal(COption::GetOptionString("forum", "MESSAGES_PER_PAGE", "10"))
    );
    $arComponentParameters["PARAMETERS"]["USE_CAPTCHA"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_USE_CAPTCHA"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y"
    );
    $arComponentParameters["PARAMETERS"]["REVIEW_AJAX_POST"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_REVIEW_AJAX_POST"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y"
    );
    $arComponentParameters["PARAMETERS"]["PATH_TO_SMILE"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_PATH_TO_SMILE"),
        "TYPE" => "STRING",
        "DEFAULT" => "/bitrix/images/forum/smile/",
    );
    $arComponentParameters["PARAMETERS"]["FORUM_ID"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_FORUM_ID"),
        "TYPE" => "LIST",
        "VALUES" => $arForumList,
        "DEFAULT" => "",
    );
    $arComponentParameters["PARAMETERS"]["URL_TEMPLATES_READ"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_READ_TEMPLATE"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    );
}
