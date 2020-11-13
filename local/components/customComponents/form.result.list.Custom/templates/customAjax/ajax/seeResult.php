<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра?>

<style>
    p {
        padding: 0;
        margin: 0;
    }
</style>
<?
if (isset($_POST["ID"])) {
    $arResult = [];
    $arFilter = array();
    if (CModule::IncludeModule("form")) {
        $RESULT_ID = $_POST["ID"]; // ID результата
// получим данные по всем вопросам
        $arAnswer = CFormResult::GetDataByID(
            $RESULT_ID,
            array(),
            $arRes,
            $arAnswer2);
        $rsUser = CUser::GetByID($arRes['USER_ID']);
        $arUser = $rsUser->Fetch();
        $arResult ['ID'] = $arRes ['ID'];
        $arResult ['DATE_CREATE'] = $arRes['DATE_CREATE'];
        $arResult ['STATUS_TITLE'] = $arRes  ['STATUS_TITLE'];
        $arResult ['FORM_ID'] = $arRes  ['FORM_ID'];
        $arResult ['NAME'] = $arUser  ['NAME'];
        $arResult ['LAST_NAME'] = $arUser  ['LAST_NAME'];

        $newAr = [];
          //var_dump($arAnswer2);
        foreach ($arAnswer2 as $key => $elem) {
            foreach ($elem as $item) {
                if ($key == "comment") {
                    $arResult ['COMMENT'] ['FIELD_ID'] = $item["FIELD_ID"];
                    $arResult ['COMMENT'] ['TITLE'] = $item["TITLE"];
                    $arResult ['COMMENT'] ['USER_TEXT'] = $item["USER_TEXT"] ;
                }else{
                    if ($key !== "timeOfProcessing") {
                        $arResult ["ANSWER"] [$key] ["ANSWER_TEXT"] = $item["ANSWER_TEXT"];
                        $arResult ["ANSWER"]  [$key] ["ANSWER_ID"] = $item["ANSWER_ID"];
                        $arResult ["ANSWER"]  [$key] ["USER_TEXT"] = $item["USER_TEXT"];
                        if ($key == "FILE") {
                            $arResult ["ANSWER"]  [$key] ["USER_FILE_SRC"] = CFile::GetPath($item ['USER_FILE_ID']);
                        }
                    }
                }
            }
        }
    }
}
//var_dump($arResult);
$commentClass= "";
?>
<form id="seeResult" data_id="<?=$arResult["ID"]?>" data_create="<?=$arResult ['DATE_CREATE']?>" action="" enctype="text/plain">
    <label>Пользователь</label>
    <p><input id="user" name="a" value="<?= $arResult["NAME"] . " " . $arResult["LAST_NAME"] ?>"></p>
    <img src="<?=$arResult['ANSWER']['FILE']['USER_FILE_SRC']?>" width="50px" alt="logo">
    <? foreach ($arResult["ANSWER"] as $key => $elem): ?>

        <br>  <label><?= $elem["ANSWER_TEXT"] ?></label>
        <p><input id="<?= $elem['ANSWER_ID'] ?>" name="a" value="<?= $elem["USER_TEXT"] ?>"</p>
    <? endforeach; ?>
    <p><label>Статус</label></p>
    <select> <? if ($arResult['STATUS_TITLE'] == "Новый"): ?>
            <option value="2" selected="selected">Новый</option>
            <option value="3">Обработан</option>

        <? $commentClass = "commentOFF"; else : ?>

            <option value="3" selected="selected">Обработан</option>
        <? endif; ?>
    </select>

    <div class="<?=$commentClass?>"><label>COMMENT</label>
        <p><input id="comment" name="a" value="<?=$arResult['COMMENT']['USER_TEXT']?>"></p></div>
    <br>
    <? if ($arResult['STATUS_TITLE'] == "Новый"): ?>
    <button id="seeSend">Сохранить данные</button>
    <?endif;?>
</form>


