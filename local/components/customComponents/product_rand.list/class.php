<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main,
  Bitrix\Main\SystemException;
class ProductRandList extends \CBitrixComponent{
    public function onPrepareComponentParams($arParams)
    {
        $arParams = array(
            'IBLOCK_TYPE' => trim($arParams['IBLOCK_TYPE']),
            'IBLOCK_ID' => intval($arParams['IBLOCK_ID']),
                    );
        return $arParams;
    }

    protected function checkModules()
    {
        if (Main\Loader::includeModule('iblock')){
            throw new SystemException("Error");
        }

    }

    protected function getResult()
    {
      $error =  new  \Bitrix\Main\Error ("nilhiol","ihihi");
     var_dump($error->getMessage());
        $arFilter = array(
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            "ACTIVE_DATE" => "Y",
            'ACTIVE' => 'Y'
        );

        $arProp =  array ("PROPERTY_SHOW_COUNTER");
        $arSelect = Array("ID", "IBLOCK_ID",  "PREVIEW_TEXT","DETAIL_PICTURE","DETAIL_TEXT", "NAME",);
        $arSelect = array_merge($arProp,$arSelect);
        $nPageSize = Array("nPageSize" => 10);
        $arSort = Array("RAND" => "ASC");



$res = CIBlockElement::GetList($arSort, $arFilter, false, $nPageSize, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if ($arFields["DETAIL_PICTURE"]) {
        //* достаем массив картинки по ее ID */
        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
    }
    //** Метод возвращает массив, набор кнопок для управления элементами эрмитаж */
//    $arButtons = CIBlock::GetPanelButtons(
//        $arFields["IBLOCK_ID"],
//        $arFields["ID"],
//        array("SECTION_BUTTONS" => false, "SESSID" => false)
//    );
    //var_dump($arButtons);
//    $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
//    $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
    //** собираем массив arResult */
    $this->arResult ["ITEMS"] [] = $arFields;

}

//var_dump($arResult);

    }

    public function executeComponent(){

       try{
           $this->checkModules();
           $this->getResult();
           $this->includeComponentTemplate();
       }catch (SystemException $exception)
       {
           echo $exception->getMessage();
       }
    }



}



//// тип инфоблока
//$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
//// идентификатор инфоблока
//$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
//if (!CModule::IncludeModule("iblock")) {
//
//    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
//    return;
//}
//$arResult = [];
////**  выборка элементов инфоблока */
//$nPageSize = Array("nPageSize" => 10);
//$arSort = Array("RAND" => "ASC");
//
//$arProp =  array ("PROPERTY_SHOW_COUNTER");
//$arSelect = Array("ID", "IBLOCK_ID", "DETAIL_PICTURE", "NAME", "DATE_ACTIVE_FROM");
//$arSelect = array_merge($arProp,$arSelect);
//
//$arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
//$res = CIBlockElement::GetList($arSort, $arFilter, false, $nPageSize, $arSelect);
//while ($ob = $res->GetNextElement()) {
//    $arFields = $ob->GetFields();
//    if ($arFields["DETAIL_PICTURE"]) {
//        //* достаем массив картинки по ее ID */
//        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
//    }
//    //** Метод возвращает массив, набор кнопок для управления элементами эрмитаж */
//    $arButtons = CIBlock::GetPanelButtons(
//        $arFields["IBLOCK_ID"],
//        $arFields["ID"],
//        array("SECTION_BUTTONS" => false, "SESSID" => false)
//    );
//    //var_dump($arButtons);
//    $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
//    $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
//    //** собираем массив arResult */
//    $arResult ["ITEMS"] [] = $arFields;
//}
//
////var_dump($arResult);
//
//
//$this->IncludeComponentTemplate();  //connection template

