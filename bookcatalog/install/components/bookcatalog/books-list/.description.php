<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;


$arComponentDescription = array(
    "NAME" => Loc::getMessage("BOOK_LIST_NAME"),
    "DESCRIPTION" => Loc::getMessage("BOOK_LIST_DESC"),
    "ICON" => "/images/icon.gif",
    "SORT" => 10,
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => Loc::getMessage("BOOK_LIST_ID"),
    ),
    "COMPLEX" => "N",
);

?>