<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

?>

<form id="add-book-form" method='post' enctype="multipart/form-data">
    <?php
    $session = \Bitrix\Main\Application::getInstance()->getSession();
    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    if ($session->has('errors')) : ?>
        <ul class="add-book__errors">
            <?php foreach ($session['errors'] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php if ($session->has('success')) : ?>
        <p class="add-book__success"><?php echo $session['success']; ?></p>
    <?php endif; ?>
    <div class="add-book__form-title"><?php echo Loc::getMessage('ADD_BOOK_FORM'); ?></div>
    <div class="form-group">
        <label class="add-book__label" for="AUTHOR_ID"><?php echo Loc::getMessage('ADD_BOOK_AUTHOR'); ?></label>
        <select class="add-book__item" name="AUTHOR_ID">
            <?php foreach ($arResult['AUTHOR_LIST'] as $author): ?>
                <option <?php if (!empty($request->get('AUTHOR_ID')) && $request->get('AUTHOR_ID') == $author->get('ID')): ?> selected <?php endif; ?>
                        value="<?php echo $author->get('ID'); ?>"><?php echo $author->get('FIO'); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="add-book__label" for="TITLE"><?php echo Loc::getMessage('ADD_BOOK_TITLE'); ?></label>
        <input class="add-book__item" type="text" name="TITLE"
               value="<?php echo (!empty($request->get('TITLE'))) ? $request->get('TITLE') : ''; ?>">
    </div>
    <div class="form-group">
        <label class="add-book__label" for="DESCRIPTION"><?php echo Loc::getMessage('ADD_BOOK_DESC'); ?></label>
        <textarea class="add-book__item"
                  name="DESCRIPTION"><?php echo (!empty($request->get('DESCRIPTION'))) ? $request->get('DESCRIPTION') : ''; ?></textarea>
    </div>
    <div class="form-group">
        <label class="add-book__label" for="YEAR"><?php echo Loc::getMessage('ADD_BOOK_YEAR'); ?></label>
        <input class="add-book__item" type="text" name="YEAR"
               value="<?php echo (!empty($request->get('YEAR'))) ? $request->get('YEAR') : ''; ?>">
    </div>
    <div class="form-group">
        <label class="add-book__label" for="PRICE"><?php echo Loc::getMessage('ADD_BOOK_PRICE'); ?></label>
        <input class="add-book__item" type="text" name="PRICE"
               value="<?php echo (!empty($request->get('PRICE'))) ? $request->get('PRICE') : ''; ?>">
    </div>
    <div class="form-group">
        <? $APPLICATION->IncludeComponent("bitrix:main.file.input", "",
            array(
                "INPUT_NAME" => "FILES",
                "MULTIPLE" => "Y",
                "MODULE_ID" => "bookcatalog",
                "MAX_FILE_SIZE" => "7340032",
                "ALLOW_UPLOAD" => "F",
                "ALLOW_UPLOAD_EXT" => "jpg, jpeg, png, pdf, doc, docx, excel, rtf"
            ),
            false
        ); ?>
    </div>
    <div class="form-group check-spm">
        <input type="text" name="spm">
    </div>
    <div class="form-group">
        <input class="add-book__item" type="submit" value="<?php echo Loc::getMessage('ADD_BOOK_ADD'); ?>"
               name="submit">
    </div>
</form>