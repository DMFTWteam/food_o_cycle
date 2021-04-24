<?php

try {
    include 'inc/header.php';
    
    session_start();
    $_SESSION['path'] = $_SERVER['PHP_SELF'];
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
                    <h2>Help</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Help</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <!-- Start FAQ  -->
    <!-- If the products box class works for this then keep it, if not update it -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Frequently Asked Questions</h1>
                        <p>The sections/links below will lead customers/users to their answers..</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Question 1</button>
                            <button data-filter=".top-featured">Question 2</button>
                            <button data-filter=".best-seller">Question 3</button>
                            <button data-filter=".top-featured">Question 4</button>
                            <button data-filter=".best-seller">Question 5</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Cant find an answer to your questions? <a href="contact.php">Contact Us </a></h1>
                        <p>The sections/links below will lead customers/users to their answers..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
    <?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
