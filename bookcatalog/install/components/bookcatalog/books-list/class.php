<?php

use \Bitrix\Main\Loader,
    \Bitrix\Main\Context,
    \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\UI\PageNavigation,
    \BookCatalog\BookTable;

class BooksList extends CBitrixComponent
{
    /**
     * @return bool
     * @throws Exception
     */
    protected function checkModules(): bool
    {
        if (!Loader::includeModule('bookcatalog')) {
            throw new \Exception(Loc::getMessage('BOOK_LIST_NOT_MODULE'));
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getListWithPagination(): array
    {
        $nav = new PageNavigation("book-list");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['COUNT_BOOK_ON_PAGE'])
            ->initFromUri();

        $list = [];

        $result = BookTable::getList(
            [
                'select' => ['TITLE', 'DESCRIPTION', 'YEAR', 'PRICE', 'FILES', 'AUTHOR.FIO', 'AUTHOR.COUNTRY'],
                'filter' => $this->getParamsForFilter(),
                'offset' => ($offset = $nav->getOffset()),
                'limit' => (($limit = $nav->getLimit()) > 0 ? $limit + 1 : 0),
            ]
        );

        $n = 0;
        while ($book = $result->fetchObject()) {
            $n++;
            if ($limit > 0 && $n > $limit) {
                break;
            }
            $list[] = $book;
        }

        $nav->setRecordCount($offset + $n);

        return [
            'LIST' => $list,
            'NAV' => $nav
        ];
    }

    /**
     * @return array
     */
    protected function getDataForFilter(): array
    {
        $years = [];
        $authors = [];

        $result = BookTable::getList(
            [
                'select' => ['YEAR', 'AUTHOR.ID', 'AUTHOR.FIO']
            ]
        )->fetchCollection();

        foreach ($result as $book) {

            $year = $book->get('YEAR');
            if (!empty($year) && !in_array($year, $years)) {
                $years[] = $year;
            }

            $author = $book->getAuthor();
            if (!empty($author) && !array_key_exists($author->get('ID'), $authors)) {
                $authors[$author->get('ID')] = $author->get('FIO');
            }
        }

        return [
            'YEARS' => $years,
            'AUTHORS' => $authors
        ];
    }

    /**
     * @return array
     */
    protected function getParamsForFilter(): array
    {
        $request = Context::getCurrent()->getRequest();
        $params = [];
        if (!empty($request->getQuery('year'))) {
            $params['YEAR'] = $request->getQuery('year');
        }
        if (!empty($request->getQuery('author'))) {
            $params['AUTHOR_ID'] = $request->getQuery('author');
        }
        return $params;
    }

    /**
     * @return mixed|void
     */
    public function executeComponent(): void
    {
        $this->checkModules();
        $this->arResult['BOOK_LIST'] = $this->getListWithPagination();
        $this->arResult['FILTER_DATA'] = $this->getDataForFilter();
        $this->includeComponentTemplate();
    }
}