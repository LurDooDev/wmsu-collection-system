
<?php
require_once 'database.class.php';

$report = new FinancialReportClass();
$report->deleteReport(1); // deletes the record with FinancialReportID = 1

class FinancialReportClass {
    //attributes
    public $FinancialReportID;
    public $ProjectID;
    public $ExpenseDetail;
    public $Fund;
    public $TotalCost;
    public $Date;
    public $Time;
    public $Sem;
    public $SchoolYear;
    public $summary_report;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function addReport() {
        $query = "INSERT INTO financialreport (project_id, ExpenseDetail, Fund, TotalCost, Date, Time, Sem, SchoolYear, summary_report)
        VALUES (:project_id, :ExpenseDetail, :Fund, :TotalCost, :Date, :Time, :Sem, :SchoolYear, :summary_report)";


        $stmt = $this->db->connect()->prepare($query);

        $stmt->bindParam(':project_id', $this->ProjectID);
        $stmt->bindParam(':ExpenseDetail', $this->ExpenseDetail);
        $stmt->bindParam(':Fund', $this->Fund);
        $stmt->bindParam(':TotalCost', $this->TotalCost);
        $stmt->bindParam(':Date', $this->Date);
        $stmt->bindParam(':Time', $this->Time);
        $stmt->bindParam(':Sem', $this->Sem);
        $stmt->bindParam(':SchoolYear', $this->SchoolYear);
        $stmt->bindParam(':summary_report', $this->summary_report);

        try {
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function deleteReport($FinancialReportID) {
        $query = "DELETE FROM financialreport WHERE FinancialReportID = :FinancialReportID";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':FinancialReportID', $FinancialReportID);
    
        try {
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }    

    function getAllReports() {  
        $query = "SELECT * FROM financialreport";
        $stmt = $this->db->connect()->prepare($query);
        try {
            if ($stmt->execute()) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $reports = array();
                foreach ($rows as $row) {
                    $report = new stdClass();
                    $report->ExpenseDetail = $row['ExpenseDetail'];
                    $report->Fund = $row['Fund'];
                    $report->TotalCost = $row['TotalCost'];
                    $report->Date = $row['Date'];
                    $report->Time = $row['Time'];
                    $report->Sem = $row['Sem'];
                    $report->SchoolYear = $row['SchoolYear'];
                    $report->summary_report = $row['summary_report'];
                    $reports[] = $report;
                }
                return $reports;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
