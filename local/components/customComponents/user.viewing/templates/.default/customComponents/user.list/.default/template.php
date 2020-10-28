<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//var_dump($arResult);
?>



<div class="search_box">
    <form action="">
        <input type="text" name="search" id="search" placeholder="Введите email">
        <input type="submit">
    </form>
    <div id="search_box-result"></div>
</div>


<?


if ($arResult) {


    echo "<table class='userList'>
  <tr>
   <th>ID</th>
    <th>NAME</th>
    <th>LAST_NAME</th>
   <th>EMAIL</th>
   <th class='LAST_LOGIN'><span class='arrow arrow-up' ></span> Last login</span>
    <span class='arrow arrow-down' ></th>
   <th>LOGIN</th>
   <th>MORE</th>
  </tr>"; ?>


    <?

    foreach ($arResult as $key => $elem) {

        echo "<tr>";

        echo "<td>" . $elem['ID'] . "</td>";
        echo "<td>" . $elem['NAME'] . "</td>";
        echo "<td>" . $elem['LAST_NAME'] . "</td>";
        echo "<td>" . $elem['EMAIL'] . "</td>";
        echo "<td data-name='sort' data-value='$elem[LAST_LOGIN_DATE]'   > " . $elem['LAST_LOGIN'] . "</td>";
        echo "<td>" . $elem['LOGIN'] . "</td>";
        $url = $elem['LOGIN'];
        echo "<td> <a href=" . $url . "/>more</a></td>";
        echo "</tr >";
    }
    echo "</table>";
}
?>


<script>




</script>
