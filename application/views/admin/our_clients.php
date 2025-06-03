<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
                        <h3 class="page-title">Our Clients </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our Clients</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="OurClientForm" class="forms-sample" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>File upload</label>
                                                    <input type="file" name="img" class="file-upload-default">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button
                                                                class="file-upload-browse btn btn-gradient-primary py-3"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                    <!-- Add this for error display -->
                                                    <small id="error_img" class="text-danger d-block mt-1"
                                                        style="display:none;"></small>
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
                                    <div class="table-responsive">
                                        <table id="ClientImageTable" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ViewModalLabel">View Our Client </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="modalBodyContent">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="view_image">Image</label>
                                                <p id="view_image"></p>
                                            </div>                                           
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EditModalLabel">Edit Current Opening Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="EditCurrentOpeningForm">
                                        <div class="modal-body" id="modalBodyContent">
                                            <input type="hidden" id="edit_id" name="id">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="edit_title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="edit_title" name="title"
                                                        required>
                                                    <div class="text-danger" id="error_edit_title"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="edit_location" class="form-label">Location</label>
                                                    <input type="text" class="form-control" id="edit_location"
                                                        name="location" required>
                                                    <div class="text-danger" id="error_edit_location"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label for="edit_description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="edit_description"
                                                        name="description" rows="4" required></textarea>
                                                    <div class="text-danger" id="error_edit_description"></div>
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
        <script src="<?= base_url();?>assets/view_js/our_clients.js"></script>
</body>

</html>