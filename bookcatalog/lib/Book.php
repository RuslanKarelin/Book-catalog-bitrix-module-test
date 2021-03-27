<?php

namespace BookCatalog;


use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Fields\Relations\Reference,
    Bitrix\Main\ORM\Query\Join,
    BookCatalog\AuthorTable,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator,
    Bitrix\Main\ORM\Fields\Validators\RegExpValidator,
    Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

/**
 * Class BookTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TITLE string(255) mandatory
 * <li> DESCRIPTION string(255) optional
 * <li> FILES unknown optional
 * <li> YEAR int optional
 * <li> PRICE int optional
 * <li> AUTHOR_ID int optional
 * <li> CREATED datetime optional default current datetime
 * </ul>
 *
 * @package BookCatalog\
 **/
class BookTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'books';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => Loc::getMessage('_ENTITY_ID_FIELD')
                ]
            ),
            new StringField(
                'TITLE',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateTitle'],
                    'title' => Loc::getMessage('_ENTITY_TITLE_FIELD')
                ]
            ),
            new StringField(
                'DESCRIPTION',
                [
                    'validation' => [__CLASS__, 'validateDescription'],
                    'title' => Loc::getMessage('_ENTITY_DESCRIPTION_FIELD')
                ]
            ),
            new StringField(
                'FILES',
                [
                    'title' => Loc::getMessage('_ENTITY_FILES_FIELD')
                ]
            ),
            new IntegerField(
                'YEAR',
                [
                    'validation' => [__CLASS__, 'validateYear'],
                    'title' => Loc::getMessage('_ENTITY_YEAR_FIELD')
                ]
            ),
            new IntegerField(
                'PRICE',
                [
                    'validation' => [__CLASS__, 'validatePrice'],
                    'title' => Loc::getMessage('_ENTITY_PRICE_FIELD')
                ]
            ),
            new IntegerField(
                'AUTHOR_ID',
                [
                    'required' => true,
                    'title' => Loc::getMessage('_ENTITY_AUTHOR_ID_FIELD')
                ]
            ),
            new DatetimeField(
                'CREATED',
                [
                    'default' => function () {
                        return new DateTime();
                    },
                    'title' => Loc::getMessage('_ENTITY_CREATED_FIELD')
                ]
            ),
            (new Reference(
                'AUTHOR',
                AuthorTable::class,
                Join::on('this.AUTHOR_ID', 'ref.ID')
            ))->configureJoinType('inner'),
        ];
    }

    /**
     * Returns validators for TITLE field.
     *
     * @return array
     */
    public static function validateTitle()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for DESCRIPTION field.
     *
     * @return array
     */
    public static function validateDescription()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for YEAR field.
     *
     * @return array
     */
    public static function validateYear()
    {
        return [
            new RegExpValidator('/\d+/'),
        ];
    }

    /**
     * Returns validators for PRICE field.
     *
     * @return array
     */
    public static function validatePrice()
    {
        return [
            new RegExpValidator('/\d+/'),
        ];
    }
}