<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Packfora Admin</title>
    <!-- plugins:css -->
    <?php include('common/css_files.php');?>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php include('common/nav_head.php');?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php include('common/sidebar.php');?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Carrier Enquiry Details </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Carrier Enquiry Details</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="CarrerFormTable" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>Position</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ViewContactModal" tabindex="-1" aria-labelledby="ViewModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ViewModalLabel">View Contact Us Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalBodyContent">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="view_inquiry_type">Inquiry Type</label>
                                            <p id="view_inquiry_type"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="view_full_name">Full Name</label>
                                            <p id="view_full_name"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="view_company_name">Company Name</label>
                                            <p id="view_company_name"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="view_email">Email</label>
                                            <p id="view_email"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="view_phone_number">Phone Number</label>
                                            <p id="view_phone_number"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="view_message">Message</label>
                                            <p id="view_message"></p>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="view_hear_about_us">How did you hear about us?</label>
                                            <p id="view_hear_about_us"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?php include('common/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/carrer_form.js"></script>
    <!-- End custom js for this page -->
</body>

</html>