<?php

use \Bitrix\Main\Context,
    \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Application,
    \Bitrix\Main\UI\PageNavigation,
    \BookCatalog\AuthorTable,
    \BookCatalog\BookTable;

class AddBook extends CBitrixComponent
{
    protected $session;

    /**
     * @return bool
     * @throws Exception
     */
    protected function checkModules(): bool
    {
        if (!Loader::includeModule('bookcatalog')) {
            throw new \Exception(Loc::getMessage('ADD_BOOK_NOT_MODULE'));
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getAuthorList(): array
    {
        return AuthorTable::getList(
            [
                'select' => ['ID', 'FIO']
            ]
        )->fetchCollection()->getAll();
    }

    /**
     * @param $request
     * @return array
     */
    protected function clearRequest($request): array
    {
        $requestArrayValues = $request->getPostList()->getValues();
        foreach ($requestArrayValues as $key => $value) {
            $requestArrayValues[$key] = (is_string($value)) ? htmlspecialchars($value) : $value;
        }
        return $requestArrayValues;
    }

    /**
     * @param $request
     */
    protected function createBook($request): void
    {
        if (empty($request->get('spm'))) {
            $requestArrayValues = $this->clearRequest($request);
            $requestArrayValues['FILES'] = json_encode([
                'ids' => $requestArrayValues['FILES'] ?? []
            ]);
            $result = BookTable::add($requestArrayValues);

            if (!$result->isSuccess()) {
                $this->session->set('errors', $result->getErrorMessages());
            } else {
                $this->session->set('success', Loc::getMessage('ADD_BOOK_SUCCESS'));
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            }
        }
    }

    public function executeComponent(): void
    {
        $this->checkModules();
        $this->session = Application::getInstance()->getSession();
        $request = Context::getCurrent()->getRequest();
        if ($request->isPost()) {
            $this->createBook($request);
        }
        $this->arResult['AUTHOR_LIST'] = $this->getAuthorList();
        $this->includeComponentTemplate();
        $this->session->remove('errors');
        $this->session->remove('success');
    }
}