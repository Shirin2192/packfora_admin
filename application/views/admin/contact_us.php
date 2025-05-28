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
                        <h3 class="page-title">Contact Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="contactUsForm" class="forms-sample">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Name">
                                                    <div class="text-danger" id="error_name"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Email">
                                                    <div class="text-danger" id="error_email"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Contact No</label>
                                                    <input type="text" class="form-control" id="contact_no"
                                                        name="contact_no" placeholder="Contact Number">
                                                    <div class="text-danger" id="error_contact_no"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="designation">Designation</label>
                                                    <select class="form-select form-control" id="designation"
                                                        name="designation">
                                                        <option value="" selected disabled>Select Designation</option>
                                                        <option value="Marketing & Communications">Marketing &
                                                            Communications</option>
                                                        <option value="Inquiries & Partnership Opportunities">Inquiries
                                                            & Partnership Opportunities</option>
                                                        <option value="Human Resources">Human Resources</option>
                                                        <option value="General Inquires">General Inquires</option>
                                                    </select>
                                                    <div class="text-danger" id="error_designation"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>File upload</label>
                                                    <input type="file" name="img" class="file-upload-default" id="img">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button
                                                                class="file-upload-browse btn btn-gradient-primary py-3"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                    <div class="text-danger" id="error_img"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <table id="ContactUsTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- content-wrapper ends -->
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
                                        <label for="view_name">Name</label>
                                        <p id="view_name"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="view_email">Email</label>
                                        <p id="view_email"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="view_contact_no">Contact No</label>
                                        <p id="view_contact_no"></p>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="view_designation">Designation</label>
                                        <p id="view_designation"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="EditModalLabel">Edit Contct Us Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="EditContactUsForm">
                                <div class="modal-body" id="modalBodyContent">
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="edit_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name">
                                            <div class="text-danger" id="error_edit_name"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="edit_email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="edit_email" name="edit_email">
                                            <div class="text-danger" id="error_edit_email"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="edit_contact_no" class="form-label">Contact No</label>
                                            <input class="form-control" id="edit_contact_no" name="edit_contact_no">
                                            <div class="text-danger" id="error_edit_contact_no"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="edit_designation">Designation</label>
                                                <select class="form-select form-control" id="edit_designation"
                                                    name="edit_designation">
                                                    <option value="" selected disabled>Select Designation</option>
                                                    <option value="Marketing & Communications">Marketing &
                                                        Communications</option>
                                                    <option value="Inquiries & Partnership Opportunities">Inquiries
                                                        & Partnership Opportunities</option>
                                                    <option value="Human Resources">Human Resources</option>
                                                    <option value="General Inquires">General Inquires</option>
                                                </select>
                                                <div class="text-danger" id="error_edit_designation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="<?= base_url()?>assets/view_js/contact_us.js"></script>
</body>

</html>