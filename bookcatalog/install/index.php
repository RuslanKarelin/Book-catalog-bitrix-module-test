<?

IncludeModuleLangFile(__FILE__);

use \Bitrix\Main\ModuleManager;

Class BookCatalog extends CModule
{

    var $MODULE_ID = "bookcatalog";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $errors;

    function __construct()
    {
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "27.03.2021";
        $this->MODULE_NAME = "Каталог книг";
        $this->MODULE_DESCRIPTION = "";
    }

    function DoInstall()
    {
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
        \Bitrix\Main\ModuleManager::RegisterModule("bookcatalog");
        return true;
    }

    function DoUninstall()
    {
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();
        \Bitrix\Main\ModuleManager::UnRegisterModule("bookcatalog");
        return true;
    }

    function InstallDB()
    {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/bookcatalog/install/db/install.sql");
        if (!$this->errors) {

            return true;
        } else
            return $this->errors;
    }

    function UnInstallDB()
    {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/bookcatalog/install/db/uninstall.sql");
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"] . "/local/modules/bookcatalog/install/components",
            $_SERVER["DOCUMENT_ROOT"] . "/local/components",
            true,
            true
        );
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx("/local/components/bookcatalog");
        DeleteDirFilesEx("/upload/bookcatalog");
        return true;
    }
}