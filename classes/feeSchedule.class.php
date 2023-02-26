<?php

require_once 'database.class.php';

class FeeSchedule {
    //attributes
    public $feeScheduleID;
    public $schoolYearID;
    public $semesterID;
    public $feeID;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function add() {
        $query = "INSERT INTO fee_schedule (fee_id, school_year_id, semester_id) VALUES (:fee_id, :school_year_id, :semester_id)";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':fee_id', $this->feeID);
        $stmt->bindParam(':school_year_id', $this->schoolYearID);
        $stmt->bindParam(':semester_id', $this->semesterID);
        $stmt->execute();
        return $this->db->connect()->lastInsertId();
    }

    //edit an existing fee schedule
    public function edit() {
        $sql = "UPDATE fee_schedule SET school_year_id=?, semester_id=?, fee_id=? WHERE fee_schedule_id=?";
        $stmt = $this->db->connect()->prepare($sql);
        return $stmt->execute([$this->schoolYearID, $this->semesterID, $this->feeID, $this->feeScheduleID]);
    }

    //delete an existing fee schedule
    public function delete() {
        $sql = "DELETE FROM fee_schedule WHERE fee_schedule_id=?";
        $stmt = $this->db->connect()->prepare($sql);
        return $stmt->execute([$this->feeScheduleID]);
    }

    //retrieve all fee schedules
    public function show() {
        $sql = "SELECT * FROM fee_schedule";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
