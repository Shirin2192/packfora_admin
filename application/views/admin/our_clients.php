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
                                            <!-- Image Upload -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload Client Logo</label>
                                                    <input type="file" name="img" class="file-upload-default">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                    <!-- Error message -->
                                                    <small id="error_img" class="text-danger d-block mt-1" style="display: none;"></small>
                                                </div>
                                            </div>

                                            <!-- Show On Options -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Display Options</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1">
                                                        <label class="form-check-label" for="show_on_homepage">Show on Homepage</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="show_on_clients_page" id="show_on_clients_page" value="1" checked>
                                                        <label class="form-check-label" for="show_on_clients_page">Show on Clients Page</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    </form>
                                </div>
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
                                                    <th>Show on Homepage</th>       <!-- ✅ New Column -->
                                                    <th>Show on Clients Page</th>   <!-- ✅ New Column -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EditModalLabel">Edit Client Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form id="EditOurClientForm" enctype="multipart/form-data">
                                        <div class="modal-body" id="modalBodyContent">
                                            <input type="hidden" id="edit_id" name="id">
                                            <input type="hidden" id="edit_previous_image" name="previous_image">

                                            <div class="row align-items-center">
                                                <!-- Left: Image Upload -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit_image" class="form-label">Upload Client Logo</label>
                                                    <input type="file" class="form-control" id="edit_image" name="edit_image">
                                                    <small id="error_edit_image" class="text-danger d-block mt-1" style="display: none;"></small>
                                                    <div id="edit_image_preview" class="mt-3"></div>
                                                </div>

                                                <!-- Right: Checkboxes -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label d-block">Display Options</label>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="edit_show_on_homepage" name="show_on_homepage" value="1">
                                                        <label class="form-check-label" for="edit_show_on_homepage">Show on Homepage</label>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" class="form-check-input" id="edit_show_on_clients_page" name="show_on_clients_page" value="1" >
                                                        <label class="form-check-label" for="edit_show_on_clients_page">Show on Clients Page</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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