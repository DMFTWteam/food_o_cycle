<!-- COMPLETE -->

<?php
/**
 * About.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>, Adrian Camuti <cam6579@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
try {
    include 'inc/header.php';
    ?>
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>About Food O' Cycle</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">About</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="about-content">
                <p>Food O' Cycle started off with the simple idea of reducing waste,
                    while trying to reduce community hunger at the same time.<br><br>

                    Our mission is to help others who are in need by not letting food go to waste. We want to bring
                    people together and work as a community to support an important cause.<br><br>

                    We offer the ability for companies that have extra food that they will not be utilizing, to donate
                    it instead of throwing it out. This has been designed so that food banks can easily and efficiently
                    find what they are in need of as well as make it quick and efficient for companies to donate the
                    food. <br><br>

                    One of the founders of this company, Fred McGallahan, was a waiter at one of his local restaurants
                    in an
                    area of poverty. He saw first hand the amount of food that was being wasted on a daily basis as well
                    as the amount of people in the area in desperate need of food. Wishing he could do more to help the
                    community he grew up in, he came up with the idea to take food that was going to be thrown out by
                    the
                    restaurant to local shelters and food banks. Seeing how much that helped the shelters and food
                    banks,
                    he assumed that most other restaurants were doing the same with unused food and went around to
                    gather
                    the food from local restaurants. Every week, he was making deliveries to shelters and food banks.
                    The word
                    was spreading quickly about what Fred was doing and other people in the community wanted to help.
                    Other cities heard about what was happening and started doing the same thing. Once Fred realized how
                    much, not only his community, but communities all of the country needed this service, he helped
                    establish
                    a team together that would be able to create the service online to make it more convenient for
                    everyone
                    involved. <br><br>

                    To do so, our team had to come up with a way of connecting businesses that could donate, and
                    the organizations that could accept these donations and this is the result!<br><br>

                    We hope you enjoy!<br><br></p>
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
