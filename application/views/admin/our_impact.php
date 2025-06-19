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
                        <h3 class="page-title">Our Impact</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our Impact</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="OurImpactForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image" placeholder="Image">
                                                    <div class="text-danger" id="error_image"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="heading">Heading</label>
                                                    <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading">
                                                    <div class="text-danger" id="error_heading"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sub_text">Sub Text</label>
                                                    <input type="text" class="form-control" name="sub_text" id="sub_text" placeholder="Sub Text">
                                                    <div class="text-danger" id="error_sub_text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="value1_title">Title 1</label>
                                                    <input type="text" class="form-control" name="value1_title" id="value1_title" placeholder="e.g., 5Bn.US$">
                                                    <div class="text-danger" id="error_value1_title"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="value1_description">Title 1 Description</label>
                                                    <input type="text" class="form-control" name="value1_description" id="value1_description" placeholder="e.g., Brand Value Covered">
                                                    <div class="text-danger" id="error_value1_description"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="value2_title">Title 2</label>
                                                    <input type="text" class="form-control" name="value2_title" id="value2_title" placeholder="e.g., 12">
                                                    <div class="text-danger" id="error_value2_title"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="value2_description">Title 2 Description</label>
                                                    <input type="text" class="form-control" name="value2_description" id="value2_description" placeholder="e.g., Innovations Delivered">
                                                    <div class="text-danger" id="error_value2_description"></div>
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
                                    <table id="OurImpactTable" class="display" >
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Heading</th>                                
                                                <th>Sub Text</th>
                                                <th>Title 1</th>
                                                <th>Title1 Description</th>
                                                <th>Title 2</th>
                                                <th>Title2 Description</th>
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
                <h5 class="modal-title" id="ViewModalLabel">View Section Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyContent">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Heading</label>
                        <p id="view_heading"></p>
                    </div>
                    <div class="col-md-6">
                        <label>Sub Text</label>
                        <p id="view_sub_text"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Value 1</label>
                        <p id="view_value1_title"></p>
                    </div>
                    <div class="col-md-6">
                        <label>Value 1 Description</label>
                        <p id="view_value1_description"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Value 2</label>
                        <p id="view_value2_title"></p>
                    </div>
                    <div class="col-md-6">
                        <label>Value 2 Description</label>
                        <p id="view_value2_description"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label>Image</label>
                        <div id="view_image"></div>
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
                        <h5 class="modal-title" id="EditModalLabel">Edit Section Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="EditOurImpactForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <input type="hidden" id="edit_previous_image" name="edit_previous_image">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_heading" class="form-label">Heading</label>
                                    <input type="text" class="form-control" id="edit_heading" name="edit_heading">
                                    <div class="text-danger" id="error_edit_heading"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_sub_text" class="form-label">Sub Text</label>
                                    <input type="text" class="form-control" id="edit_sub_text" name="edit_sub_text">
                                    <div class="text-danger" id="error_edit_sub_text"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_value1_title" class="form-label">Value 1 Title</label>
                                    <input type="text" class="form-control" id="edit_value1_title" name="edit_value1_title">
                                    <div class="text-danger" id="error_edit_value1_title"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_value1_description" class="form-label">Value 1 Description</label>
                                    <input type="text" class="form-control" id="edit_value1_description" name="edit_value1_description">
                                    <div class="text-danger" id="error_edit_value1_description"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_value2_title" class="form-label">Value 2 Title</label>
                                    <input type="text" class="form-control" id="edit_value2_title" name="edit_value2_title">
                                    <div class="text-danger" id="error_edit_value2_title"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_value2_description" class="form-label">Value 2 Description</label>
                                    <input type="text" class="form-control" id="edit_value2_description" name="edit_value2_description">
                                    <div class="text-danger" id="error_edit_value2_description"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="edit_image" name="edit_image">
                                    <div id="current_image" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_image"></div>
                                </div>
                                <div class="col-md-6" id="edit_image_preview"></div>
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
    <script src="<?= base_url()?>assets/view_js/our_impact.js"></script>
    <!-- End custom js for this page -->
    <script>

    </script>
</body>

</html>