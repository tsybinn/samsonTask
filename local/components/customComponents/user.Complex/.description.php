<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    'NAME' => 'Пользователи', // название компонента
    'DESCRIPTION' => 'Универсальный компонент для информационного блока',
    'CACHE_PATH' => 'Y', // показывать кнопку очистки кеша
    'SORT' => 40, // порядок сортировки в визуальном редакторе
    'COMPLEX' => 'Y', // признак комплексного компонента
    "PATH" => array(
        "ID" => "customComp",
        "NAME" => GetMessage("Пользователи"),
    ),
);