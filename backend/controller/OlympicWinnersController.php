<?php
require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";

class OlympicWinnersController
{
    private DatabaseService $databaseService;

    /**
     * OlympicWinnersController constructor.
     */
    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }


    public function getWinners()
    {
        $sqlQuery = "SELECT DISTINCT osoby.id AS id,
                name,
                surname,
                year,
                type     AS typeOfOlympics,
                city     AS place,
                discipline
        FROM   osoby
               JOIN umiestnenia
                 ON osoby.id = umiestnenia.person_id
               JOIN oh o
                 ON umiestnenia.oh_id = o.id
        WHERE  placing = 1; ";

        $this->databaseService->connect(new DatabaseConnectionProperties());
        $persons = $this->databaseService->loadData($sqlQuery);
        $this->databaseService->disconnect();
        echo json_encode($persons);
    }
}


$olympicWinners = new OlympicWinnersController();
$olympicWinners->getWinners();
