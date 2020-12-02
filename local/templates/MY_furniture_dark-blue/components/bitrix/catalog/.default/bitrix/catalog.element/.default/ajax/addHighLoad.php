<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); // --
var_dump($_POST);

use Bitrix\Main\Loader,
    Bitrix\Highloadblock as HL,
    Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

//added user
$UserLowPrice = HL\HighloadBlockTable::getById(3)->fetch(); //где ID - id highloadblock блока в который будем добавлять элементы
$entity = HL\HighloadBlockTable::compileEntity($UserLowPrice);
//var_dump($entity);
$entity_data_class = $entity->getDataClass();

//check users in base
$rsData = $entity_data_class::getList(array(
    'select' => array('ID'),
    "filter" => array('UF_PERSONAL_MOBILE' => $_POST['PERSONAL_MOBILE'])
));
$el = $rsData->fetch();

var_dump($el);
//added user
if ($el == false) {
    $data = array(
        'UF_LAST_NAME' => $_POST['LAST_NAME'],
        'UF_NAME' => $_POST['NAME'],
        'UF_SECOND_NAME' => $_POST['SECOND_NAME'],
        'UF_PERSONAL_MOBILE' => $_POST['PERSONAL_MOBILE'],
        'UF_USER_ID' => $_POST['USER_ID'],
    );

    $result = $entity_data_class::add($data);

    if ($result->isSuccess()) {
        echo ' user успешно добавлен';
        $ID_UserLowPrice = $result->getID();

    } else {
        echo 'Ошибка: ' . implode(', ', $result->getErrors()) . "";
    }
    $ID_UserLowPrice = $result->getID();
} else {
    $ID_UserLowPrice = $el["ID"];
}

//added ProductLowPrice
$ProductLowPrice = HL\HighloadBlockTable::getById(4)->fetch(); //где ID - id highloadblock блока в который будем добавлять элементы
$ProductLowPriceEntity = HL\HighloadBlockTable::compileEntity($ProductLowPrice);
//var_dump($entity);
$ProductLowPriceEntity_data = $ProductLowPriceEntity->getDataClass();

//check elem in base
$rsData = $ProductLowPriceEntity_data::getList(array(
    'select' => array('ID'),
    "filter" => array('UF_ARTNUMBER' => $_POST['ARTNUMBER'])
));
$rsCheck = $rsData->fetch();

var_dump($rsCheck);

if ($rsCheck == false) {

    $data = array(
        'UF_NAME_PROD' => $_POST["NAME_PROD"],
        'UF_ARTNUMBER' => $_POST["ARTNUMBER"],
        'UF_DETAIL_URL' => $_POST["DETAIL_URL"],
        'UF_PRISE' => mb_eregi_replace('[^0-9]', '', $_POST["PRICE"]),
    );
    $result = $ProductLowPriceEntity_data::add($data);

    if ($result->isSuccess()) {
        echo ' product успешно добавлен';
        $ID_PROD = $result->getID();
        var_dump($ID_PROD);

    } else {
        echo 'Ошибка: ' . implode(', ', $result->getErrors()) . "";
    }

} else {
    $ID_PROD = $rsCheck["ID"];
}
//added LowPrice
$LowPrice = HL\HighloadBlockTable::getById(2)->fetch(); //где ID - id highloadblock блока в который будем добавлять элементы
$entity1 = HL\HighloadBlockTable::compileEntity($LowPrice);
$entity_data_class1 = $entity1->getDataClass();

$data = array(
    'UF_ID_PROD' => $ID_PROD,
    'UF_LAST_NAME' => $_POST["LAST_NAME"],
    'UF_SECOND_NAME' => $_POST["SECOND_NAME"],
    'UF_USER_ID' => $ID_UserLowPrice,
    'UF_DES_PRICE' => $_POST["WANT_PRICE"],
    'UF_DATE' => new \Bitrix\Main\Type\DateTime,
);

$result1 = $entity_data_class1::add($data);

if ($result1->isSuccess()) {
    echo ' Заявка успешно добавлен';
} else {
    echo 'Ошибка: ' . implode(', ', $result1->getErrors()) . "";
}

