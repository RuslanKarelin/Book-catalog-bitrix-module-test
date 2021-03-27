<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

?>
<div class="book-list__wrapper">
    <div class="book-list__list-title"><?php echo Loc::getMessage('BOOK_LIST_BOOK_LIST'); ?></div>
    <form id="book-filter-form">
        <select class="book-select" name="year">
            <option value=""><?php echo Loc::getMessage('BOOK_LIST_CHOOSE_YEAR'); ?></option>
            <?php foreach ($arResult['FILTER_DATA']['YEARS'] as $year): ?>
                <option <?php if ($_GET['year'] == $year): ?> selected <?php endif; ?>
                        value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>

        <select class="book-select" name="author">
            <option value=""><?php echo Loc::getMessage('BOOK_LIST_CHOOSE_AUTHOR'); ?></option>
            <?php foreach ($arResult['FILTER_DATA']['AUTHORS'] as $authorId => $author): ?>
                <option <?php if ($_GET['author'] == $authorId): ?> selected <?php endif; ?>
                        value="<?php echo $authorId; ?>"><?php echo $author; ?></option>
            <?php endforeach; ?>
        </select>
    </form>

    <ul class="book-list">
        <?php foreach ($arResult['BOOK_LIST']['LIST'] as $book): ?>
            <li class="book-list__item">
                <span class="book-list__title"><?php echo Loc::getMessage('BOOK_LIST_TITLE'); ?>: <?php echo $book->get('TITLE'); ?></span><br>
                <span class="book-list__description"><?php echo Loc::getMessage('BOOK_LIST_DESC'); ?>: <?php echo $book->get('DESCRIPTION'); ?></span><br>
                <span class="book-list__year"><?php echo Loc::getMessage('BOOK_LIST_YEAR'); ?>: <?php echo $book->get('YEAR'); ?></span><br>
                <?php
                $author = $book->getAuthor();
                if ($author) :
                    ?>
                    <span class="book-list__author"><?php echo Loc::getMessage('BOOK_LIST_AUTHOR'); ?>: <?php echo $author->get('FIO'); ?></span>
                    <br>
                    <span class="book-list__country"><?php echo Loc::getMessage('BOOK_LIST_COUNTRY'); ?>: <?php echo $author->get('COUNTRY'); ?></span>
                    <br>
                <?php endif; ?>
                <span class="book-list__price"><?php echo Loc::getMessage('BOOK_LIST_PRICE'); ?>: <?php echo $book->get('PRICE'); ?> руб.</span><br>
                <?php if (!empty($arResult['BOOK_FILES']) && array_key_exists($book->get('ID'), $arResult['BOOK_FILES'])): ?>
                    <span class="book-list__files"><?php echo Loc::getMessage('BOOK_LIST_FILES'); ?>:</span><br>
                    <ul class="book-list__file-list">
                        <?php foreach ($arResult['BOOK_FILES'][$book->get('ID')] as $file): ?>
                            <li class="book-list__file-list-item"><a href="<?php echo $file['SRC']; ?>"
                                                                     download><?php echo $file['ORIGINAL_NAME']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        array(
            "NAV_OBJECT" => $arResult['BOOK_LIST']['NAV'],
            "SEF_MODE" => "N",
            "SHOW_COUNT" => "N",
        ),
        false
    );
    ?>
</div>