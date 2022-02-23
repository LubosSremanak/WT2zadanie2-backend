<?php

require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";

class OlympicGamesController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getOlympicGames()
    {
        $sqlQuery = "SELECT DISTINCT id, type, city as place, country, year FROM oh;";
        $this->databaseService->connect(new DatabaseConnectionProperties());
        $olympicGames = $this->databaseService->loadData($sqlQuery);
        $this->databaseService->disconnect();
        echo json_encode($olympicGames);
    }
}

$olympians = new OlympicGamesController();
$olympians->getOlympicGames();
