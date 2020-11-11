<?
//return \Bitrix\Main\Localization\Loc::getMessage($name, $aReplace);
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("main", "OnBeforeUserRegister", "MyOnBeforeGroupUpdate");
use Bitrix\Main\EventManager;
$eventManager = EventManager::getInstance();

$eventManager->addEventHandlerCompatible("main", "OnBeforeUserRegister", function(&$fields) {

    preg_match_all('#@(.+)\.#', $fields['EMAIL'], $matches);
    var_dump($matches);
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
    CBitrixComponent::clearComponentCache('customComponents:userLastThree.list');
});
