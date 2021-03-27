<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;


$arComponentDescription = array(
    "NAME" => Loc::getMessage("ADD_BOOK_NAME"),
    "DESCRIPTION" => Loc::getMessage("ADD_BOOK_DESC"),
    "ICON" => "/images/icon.gif",
    "SORT" => 10,
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => Loc::getMessage("ADD_BOOK_ID"),
    ),
    "COMPLEX" => "N",
);

?>