<?php

require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";


class OlympicWinnerController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getResponseId()
    {
        $id = file_get_contents("php://input");
        return json_decode($id);
    }

    function getWinner()
    {
//        name birth dead place

        $id = $this->getResponseId();
        $sqlQueryOlympic = "SELECT DISTINCT name,
                        surname,
                        birth_day     as birthDay,
                        birth_place   as birthPlace,
                        birth_country as birthCountry,
                        death_day     as deathDay,
                        death_place   as deathPlace,
                        death_country as deathCountry
        FROM osoby
        where osoby.id =" . $id . ';';
        $sqlQueryPlacing = "SELECT DISTINCT umiestnenia.id as id, placing as medal, discipline, type, year, city, country
        FROM umiestnenia
                 join oh o on umiestnenia.oh_id = o.id
        where person_id =" . $id . ';';
        $this->databaseService->connect(new DatabaseConnectionProperties());
        $olympic = $this->databaseService->loadData($sqlQueryOlympic);
        $olympicPlacing = $this->databaseService->loadData($sqlQueryPlacing);
        $this->databaseService->disconnect();
        array_push($olympic[0], array('placing' => $olympicPlacing));
        echo json_encode($olympic);
    }
}

$olympicWinner = new OlympicWinnerController();
$olympicWinner->getWinner();
