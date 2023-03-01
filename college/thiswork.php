<?php
    require_once '../classes/college.class.php';
    // check if college_id is set in GET parameter
    if (isset($_GET['id'])) {
        // fetch college data from database
        $college = new College();
        $collegeData = $college->get($_GET['id']);
        // check if college data is found
        if ($collegeData) {
?>
            <form action="editcollege.php" method="post">
                <input type="hidden" name="college_id" value="<?php echo $collegeData['college_id']; ?>">
                <div class="form-group">
                    <label for="collegeCode" class="col-form-label">College Code:</label>
                    <input type="text" class="form-control" id="collegeCode" name="collegeCode" value="<?php echo $collegeData['college_code']; ?>">
                </div>
                <div class="form-group">
                    <label for="collegeName" class="col-form-label">College Name:</label>
                    <input type="text" class="form-control" id="collegeName" name="collegeName" value="<?php echo $collegeData['college_name']; ?>">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="edit">
                    <button type="submit" class="btn btn-success" name="action" value="edit">Update</button>
                </div>
            </form>
<?php
        } else {
            echo "College not found.";
        }
    } else {
        echo "Invalid request.";
    }
?>