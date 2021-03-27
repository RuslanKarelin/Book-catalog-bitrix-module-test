<?php
Bitrix\Main\Loader::registerAutoloadClasses(
    "bookcatalog",
    array(
        "BookCatalog\\AuthorTable" => "lib/Author.php",
        "BookCatalog\\BookTable" => "lib/Book.php",
    )
);