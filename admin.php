<?php
if(!session_id()){header('Location: https://foodocycle.com/login.php');
						exit();}
	include 'inc/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
	<body>
	<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Administration</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Administration</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
		<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Food Banks</th>
									<th>Food Donors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#">Sample Food Bank #1</a></td>
									<td><a href="#">Sample Food Donor #1</a></td>
                                </tr>
								<tr>
                                    <td><a href="#">Sample Food Bank #2</a></td>
									<td><a href="#">Sample Food Donor #2</a></td>
                                </tr>
								<tr>
                                    <td><a href="#">Sample Food Bank #3</a></td>
									<td><a href="#">Sample Food Donor #3</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Business Name</th>
									<th>Username</th>
									<th>Date/Time Accessed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sample</td>
									<td>Sample</td>
									<td>Sample</td>
                                </tr>
								<tr>
                                    <td>Sample</td>
									<td>Sample</td>
									<td>Sample</td>
                                </tr>
								<tr>
                                    <td>Sample</td>
									<td>Sample</td>
									<td>Sample</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-12">
					<button type="submit" class="btn hvr-hover"  style="margin-bottom: 10%;">Download Logs</button>
				</div>
			</div>
        </div>
				
	</body>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
	
?>