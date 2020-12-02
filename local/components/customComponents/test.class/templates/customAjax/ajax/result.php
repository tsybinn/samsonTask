<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра

if (isset($_POST['DESCR']) && isset($_POST['FIO']) && isset($_FILES['FILE'])) {
    if (CModule::IncludeModule("form")) {
        $arr_file = array(
            "name" => $_FILES['FILE']['name'],
            "size" => $_FILES['FILE']['size'],
            "tmp_name" => $_FILES['FILE']['tmp_name'],
            "type" => $_FILES['FILE']['type'],
            "old_file" => "",
            "del" => "Y",
            "MODULE_ID" => "form");
        $fid = CFile::SaveFile($arr_file, "formAjaxAdd");
        //массив описывающий загруженную на сервер фотографию
        $arImage = CFile::MakeFileArray($fid);
// массив значений ответов
        $arValues = array(
            "form_textarea_5" => $_POST['FIO'],
            "form_text_6" => $_POST['DESCR'],
            "form_file_7" => $arImage,
        );
        //создадим новый результат
        if ($RESULT_ID = CFormResult::Add(2, $arValues)) {
            echo "<p class='resOk'>Результат  с ID " . $RESULT_ID . " успешно создан</p>";
        } else {
            global $strError;
            echo $strError;
        }
    }
} else  {
    echo "<p c>ответьте на все вопросы</p>";
}





