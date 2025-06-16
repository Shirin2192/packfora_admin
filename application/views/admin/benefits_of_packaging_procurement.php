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
                        <h3 class="page-title">Discover the Benefits of Packaging Procurement </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Discover the Benefits of Packaging Procurement</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="DiscovertheBenefitsofPackagingProcurementForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="title">
                                                    <div class="text-danger" id="error_title"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                        id="description" placeholder="description">
                                                    <div class="text-danger" id="error_description"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        id="image" placeholder="image">
                                                    <div class="text-danger" id="error_image"></div>
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
                                    <table id="DiscovertheBenefitsofPackagingProcurementTable" class="display" >
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Title</th>                                                
                                                <th>Description</th>
                                                <th>Image</th>
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
                <!-- partial:../../partials/_footer.html -->
                <?php include('common/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ViewModalLabel">View Current Opening Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyContent">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="view_title">Title</label>
                                <p id="view_title"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="view_image">Image</label>
                                <div id="view_image"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="view_description">Description</label>
                                <p id="view_description"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLabel">Edit Current Opening Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="EditDiscovertheBenefitsofPackagingProcurementForm" enctype="multipart/form-data">
                        <div class="modal-body" id="modalBodyContent">
                            <input type="hidden" id="edit_id" name="id">
                            <input type="hidden" id="edit_previous_image" name="edit_previous_image">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="title">
                                    <div class="text-danger" id="error_edit_title"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="edit_description" name="description">
                                    <div class="text-danger" id="error_edit_description"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="edit_image" name="edit_image">
                                    <div id="current_image" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_image"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div id="edit_image_preview"></div>
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
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/benefits_of_packaging_Procurement.js"></script>
    <!-- End custom js for this page -->
</body>

</html>