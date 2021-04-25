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
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".q1">Question 1</button>
                            <button data-filter=".q2">Question 2</button>
                            <button data-filter=".q3">Question 3</button>
                            <button data-filter=".q4">Question 4</button>
                            <button data-filter=".q5">Question 5</button>
                        </div>
                    </div>
                    <div class="row special-list">
                        <div class='col-lg-12 col-md-6 special-grid q1 ' >
                            <h2 style="margin: auto; height: 50%; display: block; text-align: center;">What is Food O' Cycle?</h2>
                            <p style="display: block; text-align: center;">Food O' Cycle is an application that allows companies that have extra food that they will not be utilizing, to donate
                    it instead of throwing it out. This has been designed so that food banks can easily and efficiently
                    find what they are in need of as well as make it quick and efficient for companies to donate the
                    food.</p>
                        </div>
                        <div class='col-lg-12 col-md-6 special-grid q2' >
                        <h2 style="margin: auto; height: 50%; display: block; text-align: center;">How does the system work?</h2>
                            <p style="display: block; text-align: center;">Food donors can post items that they wish to donate and food banks can look for the items that they need. 
                            Once a food bank selects the desired items, the donor and food bank coordinate pickup. The donor also has the 
                            ability to download a reciept of estimated prices of items donated to easily claim these donations on their taxes.</p>
                        </div>
                        <div class='col-lg-12 col-md-6 special-grid q3' >
                        <h2 style="margin: auto; height: 50%; display: block; text-align: center;">Is Food O' Cycle for profit?</h2>
                            <p style="display: block; text-align: center;">No. We do not receive any payment for our services. We wish to provide a free and open-source solution to a 
                            glaring problem in the supply chain from food donors to food banks.</p>
                        </div>
                        <div class='col-lg-12 col-md-6 special-grid q4' >
                        <h2 style="margin: auto; height: 50%; display: block; text-align: center;">Why only food donations?</h2>
                            <p style="display: block; text-align: center;">We may open this up to other types of donations in the future, but we consider the mission of providing food 
                            to the needy as a very high priority. Food banks have a very hard time finding donors and businesses that are willing 
                            to donate do not have the time to find recipients or are unsure where to even start looking. This application solves 
                            both of these problems and incentivises businesses to donate.</p>
                        </div>
                        <div class='col-lg-12 col-md-6 special-grid q5'>
                        <h2 style="margin: auto; height: 50%; display: block; text-align: center;">I am ready to help the cause. Where do I start?<br></h2>
                            <p style="display: block; text-align: center;">You can always inquire by sending a contact request at our <a href="contact.php">Contact Us</a> page or by 
                            subscribing to our monthly newsletter!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Cant find an answer to your questions? <a href="contact.php">Contact Us </a></h1>
                        
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