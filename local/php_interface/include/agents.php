<?
function AgentCheckAddedUser()
{
    $s1 = strtotime("-24 hours");
    $s2 = strtotime("now");
    $filter = array(
        ">=DATE_REGISTER" => date('d.m.Y H:i:s', $s1),
        "<=DATE_REGISTER" => date('d.m.Y H:i:s', $s2),
    );
    $res = Bitrix\Main\UserTable::getList(array(
        "select" => array("ID", "DATE_REGISTER", "LOGIN", "EMAIL"),
        "filter" => $filter,
    ));

    while ($rsUser = $res->Fetch()) {
        $arEmailDate [] = array(
            $rsUser["EMAIL"],
            $rsUser["DATE_REGISTER"]->toString(),
            $rsUser[] = " / ",
        );
    }
    if ($arEmailDate !== null) {
        Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "ADD_NEW _USER24",
            "LID" => "s1",
            "C_FIELDS" => array(
                "EMAIL_DATE" => $arEmailDate,
            ),
        ));
    }
    return "AgentCheckAddedUser();";
}
