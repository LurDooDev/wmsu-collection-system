<div class="row g-2 mb-2">
    <div class="form-group col-12 col-sm-4 table-filter-option">
        <label for="student_fees">Type</label>
        <select name="student_fees" id="student_fees" class="form-select ms-md-2">
            <option value="">Status</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid</option>
            <option value="partial">Partial</option>
        </select>
    </div>
    <div class="form-group col-12 col-sm-3 table-filter-option">
        <label for="keyword">Search</label>
        <input type="text" name="keyword" id="keyword" placeholder="Enter Student Name Here" class="form-control ms-md-2">
    </div>
    <div class="col-sm-5">
        <a href="#addFeesModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fees</span></a>	
</div>
<table class="table table-hover col-12" id="table-fees">
    <thead>
        <tr>
            <th scope="col">Action</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Type of Fees</th>
            <th scope="col">Amount</th>
            <th scope="col">Year Level</th>
            <th scope="col">Description</th>
            <th scope="col">Colleges</th>
            </tr>
    </thead>
    <tbody>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>1</td>
            <td>Andre Que</td>
            <td>University</td>
            <td>200</td>
            <td>3rd Year College</td>
            <td>Mandatory University Fees</td>
            <td>Criminology</td>
        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>2</td>
            <td>Eunice SantaMaria</td>
            <td>Wmsu Palaro</td>
            <td>300</td>
            <td>4th Year College</td>
            <td>Fees</td>
            <td>Astronaut</td>
        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>3</td>
            <td>Joji SantaMaria</td>
            <td>University</td>
            <td>200</td>
            <td>1st Year College</td>
            <td>Fees</td>
            <td>Engineering</td>
        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>4</td>
            <td>Dunkit SantaMaria</td>
            <td>University</td>
            <td>150</td>
            <td>1st Year College</td>
            <td>Fees</td>
            <td>Nursing</td>
            <tr>
            <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>5</td>
            <td>imissyou SantaMaria</td>
            <td>University</td>
            <td>599</td>
            <td>1st Year College</td>
            <td>Fees</td>
            <td>Nursing</td>
        </tr>
        </tr>
    </tbody>
</table>
<div>
</div>
<div id="addFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Type of Fee</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="number" class="form-control" required>
					</div>			
					<div class="form-group">
						<label>School Year</label> 
						<input type="text" class="form-control" required> <!-- text muna kasi automatically default - mark -->
					</div>				
					<div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required><!-- text muna kasi automatically default - mark -->
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="editFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
                <div class="modal-body">					
					<div class="form-group">
						<label>Type of Fee</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="number" class="form-control" required>
					</div>			
					<div class="form-group">
						<label>School Year</label> 
						<input type="text" class="form-control" required> <!-- text muna kasi automatically default - mark -->
					</div>				
					<div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required><!-- text muna kasi automatically default - mark -->
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="deleteFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>
</html>
