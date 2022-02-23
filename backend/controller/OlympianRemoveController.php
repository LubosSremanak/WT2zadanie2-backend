<?php

require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";
require_once "../database/model/ChromePhp.php";

class OlympianRemoveController
{

    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getOlympianId()
    {
        $olympianId = file_get_contents("php://input");
        return json_decode($olympianId);
    }

    public function removeOlympian()
    {
        $olympianId = $this->getOlympianId();
        $sqlQuery = "delete from osoby where id=$olympianId;";
        $this->databaseService->connect(new DatabaseConnectionProperties());
        $this->databaseService->removeData($sqlQuery);
        $this->databaseService->disconnect();
    }

}


$olympianRemove = new OlympianRemoveController();
$olympianRemove->removeOlympian();
