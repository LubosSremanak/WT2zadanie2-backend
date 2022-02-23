<?php
require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";


class OlympiansController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getOlympians()
    {
        $sqlQuery = "SELECT DISTINCT id, name, surname FROM osoby;";
        $this->databaseService->connect(new DatabaseConnectionProperties());
        $olympians = $this->databaseService->loadData($sqlQuery);
        $this->databaseService->disconnect();
        echo json_encode($olympians);
    }
}

$olympians = new OlympiansController();
$olympians->getOlympians();
