<?php
require_once __DIR__ . "/../database/service/DatabaseService.php";
require_once __DIR__ . "/../database/model/DatabaseConnectionProperties.php";
require_once __DIR__ . "/../config.php";

class OlympicWinnersTopTenController
{
    private DatabaseService $databaseService;

    /**
     * OlympicWinnersController constructor.
     */
    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    public function getTopTenWinners()
    {
        $sqlQuery = "SELECT DISTINCT  osoby.id AS id, name, surname, birth_place as birthPlace, COUNT(placing) as goldMedals
        from osoby
                 join umiestnenia on osoby.id = umiestnenia.person_id
                 join oh o on umiestnenia.oh_id = o.id
        WHERE placing = 1
        GROUP BY id, name, surname, birth_place;";

        $this->databaseService->connect(new DatabaseConnectionProperties());
        $persons = $this->databaseService->loadData($sqlQuery);
        $this->databaseService->disconnect();
        echo json_encode($persons);
    }


}

$olympicWinnersTopTen = new OlympicWinnersTopTenController();
$olympicWinnersTopTen->getTopTenWinners();
