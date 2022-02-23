<?php

require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";


class MedalAddController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getMedal()
    {
        $medal = file_get_contents("php://input");
        return json_decode($medal);
    }

    function bindValues($sqlPrepare, $medal)
    {
        $index = 1;
        foreach ($medal as $item) {
            if (!$item) {
                $sqlPrepare->bindValue($index, null, PDO::PARAM_NULL);
            } else
                $sqlPrepare->bindValue($index, $item);
            $index++;
        }
        return $sqlPrepare;
    }

    public function addMedal()
    {
        $medal = $this->getMedal();
        $sqlQuery = "insert into umiestnenia ( discipline,person_id,placing, oh_id)
                     values (?,?,?,?);";
        $connection = $this->databaseService->connect(new DatabaseConnectionProperties());
        $sqlPrepare = $connection->prepare($sqlQuery);
        $sqlPrepare = $this->bindValues($sqlPrepare, $medal);

        $this->databaseService->insertData($sqlPrepare);
        $this->databaseService->disconnect();

    }

}

$medalAdd = new MedalAddController();
$medalAdd->addMedal();
