<?php
session_start();
error_reporting(0);
include('include/config.php');
?>
<!doctype html>
<html lang="en">
<?php include 'include/header.php'; ?>

<body>
    <div id="page" class="page">
        <!-- ***site header html start*** -->
        <?php include 'include/navbar.php'; ?>
        <main id="content" class="site-main">
            <!-- Inner Banner html start-->
            <section class="confirm-inner-page">
                <!-- ***Inner Banner html start form here*** -->
                <div class="inner-banner-wrap">
                    <div class="inner-baner-container" style="background-image: url(assets/images/img7.jpg);">
                        <div class="container">
                            <div class="inner-banner-content">
                                <h1 class="page-title">Confirmation</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***Inner Banner html end here*** -->
                <div class="confirmation-outer">
                    <div class="container">
                        <?php
                           $bid = $_GET['bid'];
                           // echo $pkgid;
                           $sql = "SELECT * from booking where BookingId=$bid";
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           $cnt = 1;
                           if ($query->rowCount() > 0) {
                              foreach ($results as $result) {
                                 //   print_r($result); 
                           ?>
                        <?php }
                           } ?>
                        <div class="success-notify">
                            <div class="success-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="success-content">
                                <h3>SUCCESS!</h3>
                                <p>Thank you, your payment has been successful and your booking is now confirmed.A
                                    confirmation email has been sent to <?php echo htmlentities($result->Email); ?></p>
                            </div>
                        </div>
                        <div class="confirmation-inner">
                            <div class="row">
                                <div class="col-lg-8 right-sidebar" id="content">
                                    <div class="confirmation-details">
                                        <h3>BOOKING DETAILS</h3>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Booking id:</td>
                                                    <td>QSD-8DE-A<?php echo htmlentities($result->BookingId); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Full Name:</td>
                                                    <td><?php echo htmlentities($result->FirstName); ?></td>
                                                    <input value="<?php echo htmlentities($result->FirstName); ?>"
                                                        type="hidden" id="name">
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td><?php echo htmlentities($result->Email); ?></td>
                                                    <input value="<?php echo htmlentities($result->Email); ?>"
                                                        type="hidden" id="email">
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td><?php echo htmlentities($result->Phone); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Card number</td>
                                                    <td>XXX-XXXX-XXX-<?php echo substr($result->CardNumber, -4); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>City:</td>
                                                    <td><?php echo htmlentities($result->City); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>State:</td>
                                                    <td><?php echo htmlentities($result->State1); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Country:</td>
                                                    <td><?php echo htmlentities($result->Country); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pin Code</td>
                                                    <td><?php echo htmlentities($result->Pincode); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td><?php echo htmlentities($result->StreetLine1); ?>
                                                        <?php echo htmlentities($result->StreetLine2); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="details payment-details">
                                            <h3>PAYMENT</h3>
                                            <div class="details-desc">
                                                <p>Payment is successfull</p>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="price-table-summary">
                                        <h4 class="bg-title">Summary</h4>
                                        <?php
                                             $pid=$_GET['pkgid'];
                                             $sql = "SELECT * from tbltourpackages where PackageId=$pid";
                                             $query = $dbh->prepare($sql);
                                             $query->execute();
                                             $results = $query->fetchAll(PDO::FETCH_OBJ);
                                             $cnt = 1;
                                             if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                                   //   print_r($result); 
                                             ?>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Packages cost </strong>
                                                    </td>
                                                    <td class="text-right">₹
                                                        <?php echo $price = htmlentities($result->PackagePrice); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Dedicated tour guide</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        ₹
                                                        <?php echo $dtg = 500; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>tax</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $tax = 20; ?>%
                                                    </td>
                                                </tr>
                                                <tr class="total">
                                                    <td>
                                                        <strong>Total cost</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        <strong>
                                                            <?php
                                                $total = ($price + $dtg) + 20 / 100;
                                                echo $total;
                                                ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php }
                                          } ?>
                                    </div>
                                    <div class="widget-bg widget-support-wrap">
                                        <div class="icon">
                                            <i class="fas fa-phone-volume"></i>
                                        </div>
                                        <div class="support-content">
                                            <h5>HELP AND SUPPORT</h5>
                                            <a href="telto:12345678" class="phone">+91 8056658194</a>
                                            <small>Monday to Friday 9.00am - 7.30pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include 'include/footer.php'; ?>
        <a id="backTotop" href="#" class="to-top-icon">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- ***custom search field html*** -->
        <?php include 'include/custom_search.php'; ?>
        <!-- ***custom search field html*** -->
    </div>
    <!-- JavaScript -->
    <?php
   include 'include/javascript.php';
   ?>
</body>
<script>
$(document).ready(function() {
    var content = $('#content').clone();
    content.find('script').remove(); // Remove any script tags
    var styles = "";
    for (var i = 0; i < document.styleSheets.length; i++) {
        try {
            var rules = document.styleSheets[i].cssRules || document.styleSheets[i].rules;
            for (var j = 0; j < rules.length; j++) {
                styles += rules[j].cssText + "\n";
            }
        } catch (e) {
            console.error(e);
        }
    }

    var htmlContent = '<html><head><style>' + styles + '</style></head><body>' + content.html() +
        '</body></html>';
    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;
    $.ajax({
        url: `send_email.php?email=${email}&name=${name}`,
        type: 'POST',
        data: {
            htmlContent: htmlContent
        },
        success: function(response) {
            console.log('Email sent successfully!');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Failed to send email: ' + errorThrown);
        }
    });
});
</script>

</html>