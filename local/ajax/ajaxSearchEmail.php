<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); // --- подключаем пролог ядра

if (!empty($_POST['search'])) {
    $search = trim($_POST['search']);
    $search = $search."%";
    $by="ID";
    $filter =    ['EMAIL' => $search];
    $cUser = $USER::GetList($by, $order="desc",$filter);
    while ($arUser = $cUser->Fetch()) {
        $result[] = $arUser;
    }
    if ($result) {
        ?>
        <div class="search_result">
            <table>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td class="search_result-name">
                            <a href="/admin/users/<?=$row['LOGIN']?>/"><?php echo $row['NAME'] . " ". $row['LAST_NAME']; ?></a>
                        </td>
<!--                        <td class="search_result-btn">-->
<!--                            <a href="/admin/users/--><?//=$row['LOGIN']?><!--/">Перейти</a>-->
<!--                        </td>-->
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php
    }
}
