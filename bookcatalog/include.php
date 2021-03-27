<?php
Bitrix\Main\Loader::registerAutoloadClasses(
    "bookcatalog",
    [
        "BookCatalog\\AuthorTable" => "lib/Author.php",
        "BookCatalog\\BookTable" => "lib/Book.php",
    ]
);