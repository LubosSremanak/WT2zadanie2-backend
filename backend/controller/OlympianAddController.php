<?php
require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";


class OlympianAddController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getOlympian()
    {
        $olympian = file_get_contents("php://input");
        return json_decode($olympian);
    }

    function bindValues($sqlPrepare, $olympian)
    {
        $index = 1;
        foreach ($olympian as $item) {
            if (!$item) {
                $sqlPrepare->bindValue($index, null, PDO::PARAM_NULL);
            } else
                $sqlPrepare->bindValue($index, $item);
            $index++;
        }
        return $sqlPrepare;
    }


    public function addOlympian()
    {

        $olympian = $this->getOlympian();
        $sqlQuery = "INSERT INTO osoby (name, surname, birth_day, birth_place, birth_country, death_day, death_place, death_country)
                    VALUES (?,?,?,?,?,?,?,?)";

        $connection = $this->databaseService->connect(new DatabaseConnectionProperties());
        $sqlPrepare = $connection->prepare($sqlQuery);
        $sqlPrepare = $this->bindValues($sqlPrepare, $olympian);

        $this->databaseService->insertData($sqlPrepare);
        $this->databaseService->disconnect();

    }

}


$olympianAdd = new OlympianAddController();
$olympianAdd->addOlympian();
