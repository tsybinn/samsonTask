<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--подкючаем fancybox-->
<?
$this->addExternalCss("/local/components/customComponents/form.result.list.Custom/templates/customAjax/fancybox/jquery.fancybox.css");
$this->addExternalJS("/local/components/customComponents/form.result.list.Custom/templates/customAjax/fancybox/jquery.fancybox.js");
?>
<style type="text/css">

</style>

<div id="feedback"><!-- hidden inline form -->
    <h2>Загрузить изображение</h2>
    <form id="f_contact" name="contact" enctype="multipart/form-data" method="post" action="#" method="post">



        <input type="file" id="FILE" name="FILE">
<br>
        <button id="f_send">Загрузить</button>
    </form>
</div>

<a href="#feedback" rel="nofollow" class="modalbox">Загрузить изображение</a>
<?
///var_dump($arResult);

//if($arResult) :?>
<!---->
<?//
//    echo "<table class='showAnswer'>
//  <tr>
//   <th>ID</th>
//    <th>STATUS</th>
//    <th>DATE_CREATE</th>
//   <th>ФИО</th>
//   <th>Изменить</th>
//  </tr>";?>
<!--    --><?//  foreach ($arResult as $key => $elem) {
//        echo "<tr>";
//        echo "<td>" . $elem['ID'] . "</td>";
//        echo "<td>" . $elem['STATUS_TITLE'] . "</td>";
//        echo "<td>" . $elem['DATE_CREATE'] . "</td>";
//        echo "<td>" . $elem['ANSWERS']["USER_TEXT"] . "</td>";
//        echo "<td>" . "<a data-id=$elem[ID] href='' class='editResult'>Ссылка</a>" . "</td>";
//        echo "</tr >";
//    }
//    echo "</table>";
//endif;
?>
