<?php

require_once 'database.class.php';

class LocalPending {
    public $id;
    public $studentid;
    public $localfeeid;
    public $pendingAmount;
    public $status;
    public $collegeID;

    public $db;

    function __construct() {
        $this->db = new Database();
    }

    function showAllFeesBystudentId($student_id) {
        $sql = "SELECT up.id, up.pending_amount, up.pending_status, uf.fee_type, s.first_name, s.last_name, uf.fee_name, ay.academic_name, ss.semester_name
        FROM local_pending up
        INNER JOIN students s ON up.student_id = s.id
        INNER JOIN local_fees uf ON up.local_fee_id = uf.id
        INNER JOIN academic_year ay ON uf.academic_year_id = ay.id
        INNER JOIN semesters ss ON uf.semester_id = ss.id
                WHERE up.student_id = :student_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    ?>