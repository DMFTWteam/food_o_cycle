<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<body>


    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Site Support Hours</h3>
                            <ul class="list-time">
                                <li>Monday - Friday: 08.00am to 05.00pm</li>
                                <li>Saturday: 10.00am to 08.00pm</li>
                                <li>Sunday: <span>Closed</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Subscribe to our Newsletter!</h3>
                            <form class="newsletter-box" action="../php/send_email.php" method="post">
                                <div class="form-group">
                                    <input class="" type="text" name="Name" placeholder="Full Name*" />
                                   
                                </div>
                                <div class="form-group">
                                    <input class="" type="email" name="Email" placeholder="Email Address*" />
                                    
                                </div>
                                <button class="btn hvr-hover" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Food O' Cycle</h4>
                            Food O' Cycle started off with the simple idea of reducing waste,
                            while trying to reduce community hunger at the same time.<br><br>

                            We offer the ability for companies that have extra food that they will not be utilizing, to
                            donate
                            it instead of throwing it out. This has been designed so that food banks can easily
                            find what they are in need of as well as make it quick and efficient for companies to donate
                            the
                            food. </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="help.php">Customer Service</a></li>
                                <li><a
                                        href="php/pdf_server.php?file=<?php echo urlencode("../docs/terms_and_conditions.pdf"); ?>">Terms
                                        &amp; Conditions</a></li>
                                <li><a
                                        href="php/pdf_server.php?file=<?php echo urlencode("../docs/privacy_policy.pdf"); ?>">Privacy
                                        Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: <a
                                            href="https://goo.gl/maps/uaWuAhrxJonjdKsX6" target="_blank">Food O' Cycle
                                            <br>301 3rd Avenue <br>Pittsburgh, PA 15222 </a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-9655552658">(965)
                                            555-2658</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a
                                            href="mailto:support@foodocycle.com">support@foodocycle.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2021 <a href="#">Food O' Cycle</a> Design By :
            <a href="https://github.com/DMFTWteam/food_o_cycle">CIS 492 team DMFTW</a>
        </p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>

</html>
