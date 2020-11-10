<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра?>

<?php
if (isset($_GET["id"]) ) {
    $ID = $_GET["id"];
    if ($USER->IsAuthorized()) {

        $path = CFile::GetPath($ID);
        echo $path;
        ?>
        <p><a href="<?=SITE_SERVER_NAME .$path?>">Открыть файл в браузере</a>
  <p><a href="<?=SITE_SERVER_NAME .$path?>" download>Скачать файл</a>
        <?
    } else {
        LocalRedirect("/404.php");
    }
}

?>