<?php
if(!isset($_SESSION['user']['u_email'])){
    header('Location: login.php');
    exit();
}
include 'inc/header.php';
?>

    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
					    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                        <div class="h5">@username_here</div>
                        <div class="h7 text-muted">Fullname : John Does Pizza</div>
                        <div class="h7">Location: User Location Here</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

				<!-- Zipcode Search Bar -->
				<div class="card gedf-card">
					<form action="" method="get">
						<div class="form-group col-md-2">
							<label for="inputZipCode">Search Zipcode</label>
							<input type="text" class="form-control" id="inputZipCode">
						</div>
					</form>
				</div>
				<!-- My Posted Items or Food View -->
				<div class="d-flex justify-content-center">
					<h1 class="user-post-head">Restaurants and Items Near Zipcode</h1>
				</div>
				
                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7"> <i class="fa fa-clock-o"></i>Posted 10 min ago
                        <a class="card-link" href="#">
                            <h5 class="card-title">This is the decription of the item
						</a>
						&emsp;
						<a href="#"
							<i class="fa fa-trash"></i>
						</a>
						</h5>
						</div>
                        <div class="text-muted h7"> <i class="fa fa-clock-o"></i>Posted 3 days ago
                        <a class="card-link" href="#">
                            <h5 class="card-title">This is the decription of the item
						</a>
						&emsp;
						<a href="#"
							<i class="fa fa-trash"></i>
						</a>
						</h5>
						</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                </div>
                <!-- Post /////-->
				
				<!-- Items requested from donor -->
				<div class="d-flex justify-content-center">
					<h1 class="user-post-head">My Cart</h1>
				</div>
				
                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">
                    </div>
				<form class="form-inline">
					<div class="request-box">
					This is a description of the item&emsp;
					<i class="fa fa-trash"></i>
					&emsp;
						<input class="form-check-input" type="checkbox" id="inlineFormCheck"> Confirm Pickup

					<button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</div>
				</form>
				
				<form class="form-inline">
					<div class="request-box">
					This is a description of the item&emsp;
					<i class="fa fa-trash"></i>
					&emsp;
						<input class="form-check-input" type="checkbox" id="inlineFormCheck"> Confirm Pickup

					<button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</div>
				</form>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                </div>
                <!-- Post /////-->
				<!-- Food Confirmed for Pickup -->
				<div class="d-flex justify-content-center">
					<h1 class="user-post-head">Food Confirmed for Pickup
				</div>
                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <a class="card-link" href="#">
                            <h5 class="card-title">This is the food to be picked up</h5>
						</a>
                        <a class="card-link" href="#">
                            <h5 class="card-title">This is the food to be picked up</h5>
						</a>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                </div>
                <!-- Post /////-->				
            </div>
            </div>
        </div>
    </div>
<?php
include 'inc/js_to_include.php';
include 'inc/footer.php';
?>