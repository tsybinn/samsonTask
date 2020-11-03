<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра?>


<?php
//include in  init.php
 function clear($value)
{
    $value = trim($value);
    $value = htmlspecialchars($value);
    $value = strip_tags($value);
     return $value;
};




if (isset($_POST['DESCR']) && isset($_POST['FIO'])  &&  isset($_POST['ID'] )) {


 //ID результата
    $RESULT_ID = intval($_POST["ID"]);
    $FIO = clear($_POST["FIO"]);
    $DESCR = clear($_POST["DESCR"]);
    $ID_STATUS = intval($_POST["TITLE"]);
    $COMMENT = clear($_POST["COMMENT"]);
     $dateAddit = '';
    $timeOfProc = '';
    if (CModule::IncludeModule("form")) {

        if($ID_STATUS == 3 && !empty($COMMENT) ){

            $origin = new DateTime($_POST["DATA_CREATE"]);
            $target = new DateTime();
            $interval = $origin->diff($target);
            $timeOfProc = $interval->format('%dд. %hч. %iмин.');
            $STATUS_ID = 3; // ID статуса "Обработано"
// установим новый статус для результата

            if (CFormResult::SetStatus($RESULT_ID, $STATUS_ID))
            {
                echo "Статус 'Обработан' для результата #".$RESULT_ID." успешно установлен.";
                $dateAddit = $COMMENT;

            }
            else // ошибка
            {
                echo "<p>ошибка статус не обновлен</p>";
            }
        }
        // массив значений ответов и полей веб-формы
        $arValues = array(
            'form_textarea_ADDITIONAL_3' => $timeOfProc, // date  treatment
            'form_textarea_ADDITIONAL_4' => $dateAddit, //comment treament
            'form_textarea_5' => $FIO, // fio
            'form_text_6' => $DESCR, //description
            //'form_file_7' => '1996',
        );
        if (CFormResult::Update($RESULT_ID, $arValues, "Y")) {
            echo "Результат" . $RESULT_ID . "успешно обновлен.";
        } else {
            echo "ошибка рузультат  не обновлен";
        }
    }
}// isset



?>