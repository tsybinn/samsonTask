<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//
//$arResult=[];
//$arFilter = Array();
//if (CModule::IncludeModule("form")) {
//
//    $rsResults = CFormResult::GetList(2,
//        ($by="s_timestamp"),
//        ($order="desc"),
//        $arFilter,
//        $is_filtered,);
//    while ($arRes = $rsResults->Fetch()){
//        CForm::GetResultAnswerArray(2,
//            $arrColumns,
//            $arrAnswers,
//            $arrAnswersVarname,
//            array("RESULT_ID" => $arRes["ID"]));
//        $arrAnsw ['TITLE'] =  $arrAnswersVarname[$arRes["ID"]]['FIO'][0]['TITLE'];
//        $arrAnsw ['USER_TEXT'] =  $arrAnswersVarname[$arRes["ID"]]['FIO'][0]['USER_TEXT'];
//
//        $arResult [] =array(
//            "ID" =>   $arRes['ID'],
//            "STATUS_TITLE" =>   $arRes['STATUS_TITLE'],
//            "DATE_CREATE" =>   $arRes['DATE_CREATE'],
//            "ANSWERS" =>   $arrAnsw,
//        );
//    }
//    }

$this->IncludeComponentTemplate();

?>