<?php
    session_start();
	require_once '../functions/session.function.php';

	//prevent unauthorized access
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../financial-report/financial-report.php');
	} else if ($_SESSION['role'] != 'admin') {
		if ($_SESSION['role'] == 'officer') {
			header('location: admin.php');
		} else if ($_SESSION['role'] == 'collector') {
			header('location: collector.php');
		}
	}

  require_once '../classes/database.class.php';
  require_once "../classes/financialreport.class.php";
?>

<!doctype html>
<html lang="en" class="no-js">
  <html>
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--- links for bootstrap and css  --->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/financial.css" />
    <link rel="icon" type="image/jpg" href="../images/usc.png"/>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/4caf6a2b18.css" crossorigin="anonymous">
    <title>Wmsu Collection System</title>
    </head>
      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <!-- <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a> -->
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <a href="../college/new-college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                 <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <i class="fa fa-caret-down" style="margin-left: 115px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
                </div>
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Financial Report</a>
                <?php } ?>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="">
                <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                    <!-- <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Colleges</a></ul> -->
                </div>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
</div>
        </div>
        <div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
<nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0">Financial Report</h2>
    </div>
</nav>
<div class="container">
	<div class =" table-responsive" id="inner">
                <table class="table">
				<div class="row">
                <div class="ml-auto p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
                <a href="report.php" class="btn btn-success"> <i class="material-icons">&#xE147;</i> <span>Generated Report</span></a>
                        <div class="ml-7 p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
						<a href="#addReport" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Report</span></a>
</div>
					</div>
				</div>
			</div>

            <thead style="background-color:#95BDFE ;" class="text-white">
            <table class="table table-striped table-hover">
            <?php
$financialReport = new FinancialReportClass();
$reports = $financialReport->getAllReports();

foreach ($reports as $report) {
?>
<tr>
  <td><?php echo $report->ExpenseDetail; ?></td>
  <td><a href="#detailsModal" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="Details" data-expense-detail="<?php echo $report->ExpenseDetail; ?>" data-Fund="<?php echo $report->Fund; ?>" data-total-cost="<?php echo $report->TotalCost; ?>" data-date="<?php echo $report->Date; ?>" data-time="<?php echo $report->Time; ?>" data-sem="<?php echo $report->Sem; ?>" data-school-year="<?php echo $report->SchoolYear; ?>" data-summary-report="<?php echo $report->summary_report; ?>">View</a></td>
</tr>
<?php
}
?>
  </tbody>
            </thead>
<!-- New content here  -->
<div id="detailsModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Details</h4>
            </div>
            <div class="modal-body">
                <ul style="list-style-type: none;">
                    <li><label for="expenseDetail">Expense Details:</label><span id="expenseDetail"><?php echo htmlspecialchars($report->ExpenseDetail); ?></span></li>
                    <li><label for="Fund">Fund:</label><span id="Fund"><?php echo htmlspecialchars($report->Fund); ?></span></li>
                    <li><label for="totalCost">Total Cost:</label><span id="totalCost"><?php echo htmlspecialchars($report->TotalCost); ?></span></li>
                    <li><label for="date">Date:</label><span id="date"><?php echo htmlspecialchars($report->Date); ?></span></li>
                    <li><label for="time">Time:</label><span id="time"><?php echo htmlspecialchars($report->Time); ?></span></li>
                    <li><label for="semester">Semester:</label><span id="semester"><?php echo htmlspecialchars($report->Sem); ?></span></li>
                    <li><label for="schoolYear">School Year:</label><span id="schoolYear"><?php echo htmlspecialchars($report->SchoolYear); ?></span></li>
                    <li><label>Summary Report:</label></li>
                    <li><textarea class="comment" name="comments" id="comments_val" disabled><?php echo htmlspecialchars($report->summary_report); ?></textarea></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Add Report Modal -->
<div class="modal fade" id="addReport" tabindex="-1" role="dialog" aria-labelledby="addReportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="createfinancialreport.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportLabel">Add Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>   
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- <label for="projectID">Project ID:</label> -->
                                <input type="hidden" class="form-control" id="projectID" name="projectID" required>
                            </div>
                            <div class="form-group">
                                <label for="expenseDetail">Expense Detail:</label>
                                <input type="text" class="form-control" id="expenseDetail" name="expenseDetail" required>
                            </div>
                            <div class="form-group">
                                <label for="fund">Fund:</label>
                                <input type="number" class="form-control" id="Fund" name="Fund" required>
                            </div>
                            <div class="form-group">
                                <label for="totalCost">Total Cost:</label>
                                <input type="number" class="form-control" id="totalCost" name="totalCost" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="semester">Semester:</label>
                              <select class="form-control" id="semester" name="semester" required>
                                   <?php
                                     $semesters = array("Select Semester","1st Semester", "2nd Semester", "Summer");
                                      foreach ($semesters as $semester) {
                                          echo "<option value=\"$semester\">$semester</option>";
                                         }
                                     ?>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label for="schoolYear">School Year:</label>
                                <input type="text" class="form-control" id="schoolYear" name="schoolYear" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="summaryReport">Summary Report:</label>
                        <textarea class="form-control" id="summaryReport" name="summaryReport" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Script for dashboard hamburger         -->
        </body>       
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>