<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['BOOK_LIST']['LIST'] as $book) {
    if (!empty($book->get('FILES'))) {
        $files = [];
        $ids = json_decode($book->get('FILES'));
        foreach ($ids->ids as $id) {
            $files[] = CFile::GetFileArray($id);
        }
        $arResult['BOOK_FILES'][$book->get('ID')] = $files;
    }
}