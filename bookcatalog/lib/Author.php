<?php

namespace BookCatalog;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator,
    BookCatalog\BookTable,
    Bitrix\Main\ORM\Fields\Relations\OneToMany,
    Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

/**
 * Class AuthorTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> FIO string(255) mandatory
 * <li> COUNTRY string(255) optional
 * <li> CREATED datetime optional default current datetime
 * </ul>
 *
 * @package BookCatalog
 **/
class AuthorTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'authors';
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
                'FIO',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateFio'],
                    'title' => Loc::getMessage('_ENTITY_FIO_FIELD')
                ]
            ),
            new StringField(
                'COUNTRY',
                [
                    'validation' => [__CLASS__, 'validateCountry'],
                    'title' => Loc::getMessage('_ENTITY_COUNTRY_FIELD')
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
            (new OneToMany('BOOKS', BookTable::class, 'AUTHOR'))->configureJoinType('inner')
        ];
    }

    /**
     * Returns validators for FIO field.
     *
     * @return array
     */
    public static function validateFio()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for COUNTRY field.
     *
     * @return array
     */
    public static function validateCountry()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}