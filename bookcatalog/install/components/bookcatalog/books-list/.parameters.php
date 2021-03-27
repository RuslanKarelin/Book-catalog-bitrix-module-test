<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "COUNT_BOOK_ON_PAGE" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("BOOK_LIST_COUNT_BOOK_ON_PAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => "1",
        ],
    ],
];
?>