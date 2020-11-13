<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра?>


<?
if (isset($_POST["ID"])) {
    $ignoId =  $_POST["ID"];
    if (CModule::IncludeModule("iblock")) {
        $nPageSize = array("nPageSize" => 10);
        $arSort = array("RAND" => "ASC");
        $arFilter = array("!ID" => $ignoId, "IBLOCK_ID" => 5, "ACTIVE" => "Y");
        $res = CIBlockElement::GetList($arSort, $arFilter, false, $nPageSize, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $arFields['PROPERTIES'] = $ob->GetProperties();
            // получаем значения пользовательских свойств в удобном для отображения виде
            //var_dump($arFields['PROPERTIES'] );
            foreach ($arFields['PROPERTIES'] as $code => $data) {
                $arFields['DISPLAY_PROPERTIES'][$code] = CIBlockFormatProperties::GetDisplayValue($arFields, $data, '');
            }
            if ($arFields["DETAIL_PICTURE"]) {
                //* достаем массив картинки по ее ID */
                $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
            }
            $arResult["ITEMS"] [] =$arFields;
        }
    }
?>
<?foreach($arResult["ITEMS"] as $arItem):?>

    <div class="news-item" id-ignor=<?=$arItem['ID']?> ">


                <p href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                            class="preview_picture"
                            border="0"
                            src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"
                            width="100"
                            height="100"
                            alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"
                            style="float:left"
                    /></p>

        <?if( $arItem["NAME"]):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <p href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></p><br />
            <?else:?>
                <b><?echo $arItem["NAME"]?></b><br />
            <?endif;?>
        <?endif;?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
            <?echo $arItem["PREVIEW_TEXT"];?>
        <?endif;?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["DETAIL_PICTURE"])):?>
            <div style="clear:both"></div>
        <?endif?>
        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
            <small>
                <?=$arProperty["NAME"]?>:&nbsp;


                <span class="voitingRes"><?=$arProperty["DISPLAY_VALUE"];?></span>


            </small><br />
        <?endforeach;?>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == "Y"):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
    </div>


<?
}
