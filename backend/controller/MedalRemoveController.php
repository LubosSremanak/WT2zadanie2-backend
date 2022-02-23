<?php

require_once "../database/service/DatabaseService.php";
require_once "../database/model/DatabaseConnectionProperties.php";
require_once "../config.php";
class MedalRemoveController
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    function getMedalId()
    {
        $medalId = file_get_contents("php://input");
        return json_decode($medalId);
    }

    public function removeMedal()
    {
        $medalId = $this->getMedalId();
        $sqlQuery = "delete from umiestnenia where id=$medalId;";
        $this->databaseService->connect(new DatabaseConnectionProperties());
        $this->databaseService->removeData($sqlQuery);
        $this->databaseService->disconnect();
    }

}

$medalRemove = new MedalRemoveController();
$medalRemove->removeMedal();
