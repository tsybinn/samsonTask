<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<style>
    TABLE {
        width: 600px;
        border-collapse: collapse;
    }
    TD, TH, tr {
        padding: 3px;
        border: 1px solid black;
        text-align: center;
    }
    TH {
        background: #b0e0e6;
    } </style>





<?if($arResult) {

    echo "<table>
  <tr>
   <th>ID</th>
    <th>NAME</th>
    <th>LAST_NAME</th>
   <th>EMAIL</th>
   <th>DATE REGISTER</th>
   <th>LAST_LOGIN</th>
   <th>LOGIN</th>
   <th>MORE</th>
  </tr>";?>

    <a href=''>sort</a>
  <?  foreach ($arResult as $key => $elem) {

        echo "<tr>";

        echo "<td>" . $elem['ID'] . "</td>";
        echo "<td>" . $elem['NAME'] . "</td>";
        echo "<td>" . $elem['LAST_NAME'] . "</td>";
        echo "<td>" . $elem['EMAIL'] . "</td>";
        echo "<td>" . $elem['DATE_REGISTER'] . "</td>";
        echo "<td class='lastLogin'  > " . $elem['LAST_LOGIN'] . "</td>";
        echo "<td>" . $elem['LOGIN'] . "</td>";
        echo "<td> <a href=" .$elem['NAME'].">more</a></td>";

        echo "</tr >";

    }

        echo "</table>";
    }


?>

<script>

    $(document).ready( function () {
        $elems = $('lastLogin');
        console.log($elems);
    })
</script>