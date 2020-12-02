<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
use Bitrix\Main;
class TestInClass extends \CBitrixComponent
{
 public $idForm = 2;
 protected   function getResult($id){

        if (Main\Loader::includeModule("form")) {

            $rsResults = CFormResult::GetList($id,
                ($by="s_timestamp"),
                ($order="desc"),
                $arFilter,
                $is_filtered);
            while ($arRes = $rsResults->Fetch()){
                CForm::GetResultAnswerArray($id,
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
    $this->arResult  =  $this->getResult($this->idForm);
        $this->includeComponentTemplate();
    }
}


?>