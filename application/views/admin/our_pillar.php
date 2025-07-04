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
                        <h3 class="page-title">Our Pillar </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our Pillar</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="PillarsFullForm" enctype="multipart/form-data" method="post">
                                        <h4 class="mb-3">Intro Section</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Main Title</label>
                                                <input type="text" class="form-control" name="main_title" id="main_title" placeholder="e.g. Our Pillars of Impact Enablement">
                                                <div class="text-danger" id="error_main_title"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Subtitle</label>
                                                <textarea class="form-control" name="subtitle" id="subtitle"></textarea>
                                                <div class="text-danger" id="error_subtitle"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Sub Heading</label>
                                                <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="e.g. Science-Backed Approach">
                                                <div class="text-danger" id="error_sub_heading"></div>
                                            </div>
                                        </div>

                                        <hr class="my-4">
                                        <h4 class="mb-3">Science-Backed Titles</h4>
                                        <div class="row">
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                            <div class="col-md-4">
                                                <label>Point <?= $i ?></label>
                                                <input type="text" class="form-control" name="science_title_<?= $i ?>" id="science_title_<?= $i ?>">
                                                <div class="text-danger" id="error_science_title_<?= $i ?>"></div>
                                            </div>
                                            <?php endfor; ?>
                                        </div>

                                        <hr class="my-4">
                                        <h4 class="mb-3">Optimize Packaging Points</h4>
                                        <?php for ($i = 1; $i <= 3; $i++): ?>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>Icon <?= $i ?></label>
                                                <input type="file" class="form-control" name="optimize_icon_<?= $i ?>" id="optimize_icon_<?= $i ?>">
                                                <div class="text-danger" id="error_optimize_icon_<?= $i ?>"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Description <?= $i ?></label>
                                                <input type="text" class="form-control" name="optimize_desc_<?= $i ?>" id="optimize_desc_<?= $i ?>">
                                                <div class="text-danger" id="error_optimize_desc_<?= $i ?>"></div>
                                            </div>
                                        </div>
                                        <?php endfor; ?>

                                        <hr class="my-4">
                                        <h4 class="mb-3">Right Side Image</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>Right Side Image</label>
                                                <input type="file" class="form-control" name="right_image" id="right_image">
                                                <div class="text-danger" id="error_right_image"></div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary">Save All</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <table id="pillarsTable" class="display" >
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Main Title</th>                        
                                                <th>Sub Title</th>
                                                <th>Sub Heading</th>
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
                        <h5 class="modal-title" id="ViewModalLabel">View Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyContent">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label>Main Title</label>
                                <p id="view_main_title"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Subtitle</label>
                                <p id="view_subtitle"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Sub Heading</label>
                                <p id="view_sub_heading"></p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label>Science Title 1</label>
                                <p id="view_science_title_1"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Science Title 2</label>
                                <p id="view_science_title_2"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Science Title 3</label>
                                <p id="view_science_title_3"></p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label>Optimize Point 1</label>
                                <div id="opt_icon_1" class="mb-1"></div>
                                <p id="opt_desc_1"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Optimize Point 2</label>
                                <div id="opt_icon_2" class="mb-1"></div>
                                <p id="opt_desc_2"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Optimize Point 3</label>
                                <div id="opt_icon_3" class="mb-1"></div>
                                <p id="opt_desc_3"></p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label>Right Image</label>
                                <div id="right_image_preview"></div>
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
                <h5 class="modal-title" id="EditModalLabel">Edit Pillar Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="EditDiscovertheBenefitsofDesignValueForm" enctype="multipart/form-data">
                <div class="modal-body" id="modalBodyContent">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="edit_previous_image" name="edit_previous_image">

                    <!-- Intro Section -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="edit_main_title" class="form-label">Main Title</label>
                            <input type="text" class="form-control" id="edit_main_title" name="main_title">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="edit_subtitle" name="subtitle">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_sub_heading" class="form-label">Sub Heading</label>
                            <input type="text" class="form-control" id="edit_sub_heading" name="sub_heading">
                        </div>
                    </div>

                    <!-- Science Titles -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="edit_science_title_1" class="form-label">Science Title 1</label>
                            <input type="text" class="form-control" id="edit_science_title_1" name="science_title_1">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_science_title_2" class="form-label">Science Title 2</label>
                            <input type="text" class="form-control" id="edit_science_title_2" name="science_title_2">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_science_title_3" class="form-label">Science Title 3</label>
                            <input type="text" class="form-control" id="edit_science_title_3" name="science_title_3">
                        </div>
                    </div>

                    <!-- Optimize Points (Descriptions and Icons) -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="edit_opt_desc_1" class="form-label">Optimize Description 1</label>
                            <input type="text" class="form-control" id="edit_opt_desc_1" name="opt_desc_1">
                            <div id="edit_opt_icon_1" class="mt-2"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_opt_desc_2" class="form-label">Optimize Description 2</label>
                            <input type="text" class="form-control" id="edit_opt_desc_2" name="opt_desc_2">
                            <div id="edit_opt_icon_2" class="mt-2"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_opt_desc_3" class="form-label">Optimize Description 3</label>
                            <input type="text" class="form-control" id="edit_opt_desc_3" name="opt_desc_3">
                            <div id="edit_opt_icon_3" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Right Side Image -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_image" class="form-label">Right Side Image</label>
                            <input type="file" class="form-control" id="edit_image" name="edit_image">
                            <div id="edit_right_image_preview" class="mt-2"></div>
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

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/our_pillar.js"></script>
    <!-- End custom js for this page -->
</body>

</html>