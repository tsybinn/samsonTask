<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра
?>
<?
if (isset($_FILES['FILE'])) {

    if (CFile::IsImage($_FILES['FILE']['name'], $_FILES['FILE']['type'])) {

        $arr_file = array(
            "name" => $_FILES['FILE']['name'],
            "size" => $_FILES['FILE']['size'],
            "tmp_name" => $_FILES['FILE']['tmp_name'],
            "type" => $_FILES['FILE']['type'],
            "old_file" => "",
            "del" => "Y",
            "MODULE_ID" => "main");
        $fid = CFile::SaveFile($arr_file, "formAjaxAdd");
        //массив описывающий загруженную на сервер фотографию
        echo "<p idImg='$fid'  class='uplOk' > изображение успешно загружено
 <a href='/local/components/customComponents/img_upload/templates/customAjax/ajax/seeImg.php?id=$fid'>Посмотреть</a></p>";
    } else {
        echo "<p class='error' >файл не является  картинкой</p>";
    }
} else {
    echo "<p class='error' >загрузите файл</p>";
}






