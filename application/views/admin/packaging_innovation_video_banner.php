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
                        <h3 class="page-title">Video Banner </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Video Banner</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="PackagingInnovationVideoBannerForm" class="forms-sample"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Title">
                                                    <div class="text-danger" id="error_title"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sub_title">Sub Title</label>
                                                    <input type="text" class="form-control" name="sub_title"
                                                        id="sub_title" placeholder="Sub Title">
                                                    <div class="text-danger" id="error_sub_title"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea type="text" class="form-control" name="description"
                                                        id="description" placeholder="Description"></textarea>
                                                    <div class="text-danger" id="error_description"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="video">Upload Video</label>
                                                    <input type="file" class="form-control" name="video" id="video"
                                                        placeholder="Upload Video">
                                                    <div class="text-danger" id="error_video"></div>
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
                                    <table id="PackagingInnovationVideoBannerTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Description</th>
                                                <th>Video</th>
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
                        <h5 class="modal-title" id="ViewModalLabel">View Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyContent">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="view_title">Title</label>
                                <div id="view_title"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="view_sub_title">Sub Title</label>
                                <div id="view_sub_title"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="view_description">Description</label>
                                <div id="view_description"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="view_image">Video</label>
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
                        <h5 class="modal-title" id="EditModalLabel">Edit Video Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="EditPackagingInnovationVideoBannerForm" enctype="multipart/form-data">
                        <div class="modal-body" id="modalBodyContent">
                            <input type="hidden" id="edit_id" name="id">
                            <input type="hidden" id="edit_previous_video" name="edit_previous_video">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="edit_title">
                                    <div id="current_video" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_title"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_sub_title" class="form-label">Sub Title</label>
                                    <input type="text" class="form-control" id="edit_sub_title" name="edit_sub_title">
                                    <div id="current_video" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_sub_title"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="edit_description" name="edit_description">
                                    <div id="current_video" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_description"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_video" class="form-label">Upload Video</label>
                                    <input type="file" class="form-control" id="edit_video" name="edit_video">
                                    <div id="current_video" class="mt-2"></div>
                                    <div class="text-danger" id="error_edit_video"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div id="edit_video_preview"></div>
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
    <script src="<?= base_url()?>assets/view_js/packaging_innovation_video_banner.js"></script>
    <!-- End custom js for this page -->
    <script>

    </script>
</body>

</html>