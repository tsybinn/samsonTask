<?
AddEventHandler("main", "OnBeforeUserRegister", "MyOnBeforeGroupUpdate");
use Bitrix\Main\EventManager;
use Bitrix\Main\Mail\Event;
$eventManager = EventManager::getInstance();
$eventManager->addEventHandlerCompatible("main", "OnBeforeUserRegister", function(&$fields) {

    preg_match_all('#@(.+)\.#', $fields['EMAIL'], $matches);
    if($matches[1][0]== "rambler" || $matches[1][0]=="list" ){
        $GLOBALS['APPLICATION']->throwException('rambler and list wrong!!! ');
        return false;
    }
    $res = Bitrix\Main\UserTable::getList(Array(
        "select"=>Array("ID","NAME"),
        "filter"=>array("EMAIL"=>$fields['EMAIL']),
    ));
    $row = $res->fetch();
    if($row){
        $GLOBALS['APPLICATION']->throwException('такой email существует');
        return false;
    };
    Event::send(array(
        "EVENT_NAME" => "ADD_NEW_USER",
        "LID" => "s1",
        "C_FIELDS" => array(
            "EMAIL" => $fields["EMAIL"],
            "DATE" => FormatDate('j F Yг. H:i'),
            "LOGIN" => $fields["LOGIN"],
            "USER_HOST" =>  !empty($_SESSION["LOCAL_REDIRECTS"]["R"]) ? $_SESSION["LOCAL_REDIRECTS"]["R"] : "Сторонний сайт",
        ),
    ));
    $fields ["TIME"] = FormatDate('j F Y г H:i');
    CBitrixComponent::clearComponentCache('customComponents:userLastThree.list');
});

$eventManager->addEventHandlerCompatible('main', 'OnBeforeEventAdd', "checkEmailUser");

function checkEmailUser(&$event, &$lid, &$arFields)
{
    if($event == "NEW_USER")
        preg_match_all('#@(.+)\.#', $arFields['EMAIL'], $matches);
    if($matches[1][0]== "yandex" ) {
        return false;
    }
}

