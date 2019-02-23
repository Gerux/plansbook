<?php

namespace App\Models;

use PDO;

class Routine extends \Core\Model
{
    private $routine_date;
    private $workout = 0;
    private $study = 0;
    private $finance = 0;
    private $family = 0;

    public function __construct($data=[]){
        $this->routine_date = date("d/m/y");

        if (isset($data['workout'])) {
            $this->workout = $data['workout'];
        }
        if (isset($data['study'])) {
            $this->study = $data['study'];
        }
        if (isset($data['finance'])) {
            $this->finance = $data['finance'];
        }
        if (isset($data['family'])) {
            $this->family = $data['family'];
        }
    }

    public function store()
    {
        $sql = "INSERT INTO daily_routine (routine_date, workout, study, finance, family)
        VALUES (:routine_date, :workout, :study, :finance, :family)";

        $db = static::getDb();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':routine_date', $this->routine_date, PDO::PARAM_STR);
        $stmt->bindValue(':workout', $this->workout, PDO::PARAM_STR);
        $stmt->bindValue(':study', $this->study, PDO::PARAM_STR);
        $stmt->bindValue(':finance', $this->finance, PDO::PARAM_STR);
        $stmt->bindValue(':family', $this->family, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getData()
    {
        $sql = "SELECT * FROM daily_routine ORDER BY routine_date desc";
        $db = static::getDb();
        $data = $db->query($sql);

        return $data;
    }

    public function getDate(){
        return $this->date;
    }

    public function getWorkout(){
        return $this->workout;
    }

    public function getStudy(){
        return $this->study;
    }

    public function getFinance(){
        return $this->finance;
    }

    public function getFamily(){
        return $this->family;
    }
}