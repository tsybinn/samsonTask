<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
use Bitrix\Main;
class TestInClass extends \CBitrixComponent
{
    public $IDFORM = 2;

 protected   function getResult($ID){

        if (Main\Loader::includeModule("form")) {
            $rsResults = CFormResult::GetList($ID,
                ($by="s_timestamp"),
                ($order="desc"),
                $arFilter,
                $is_filtered,);
            while ($arRes = $rsResults->Fetch()){
                CForm::GetResultAnswerArray($ID,
                    $arrColumns,
                    $arrAnswers,
                    $arrAnswersVarname,
                    array("RESULT_ID" => $arRes["ID"]));
                $arrAnsw ['TITLE'] =  $arrAnswersVarname[$arRes["ID"]]['FIO'][0]['TITLE'];
                $arrAnsw ['USER_TEXT'] =  $arrAnswersVarname[$arRes["ID"]]['FIO'][0]['USER_TEXT'];

                $arResult [] =array(
                    "ID" =>   $arRes['ID'],
                    "STATUS_TITLE" =>   $arRes['STATUS_TITLE'],
                    "DATE_CREATE" =>   $arRes['DATE_CREATE'],
                    "ANSWERS" =>   $arrAnsw,
                );
            }
        }
        return $arResult;
    }
    public function executeComponent(){
    $this->arResult  =  $this->getResult();
        $this->includeComponentTemplate();
    }
}


?>