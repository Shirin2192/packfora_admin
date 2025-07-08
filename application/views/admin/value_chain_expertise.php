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
                        <h3 class="page-title">Holistic Model Value </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Holistic Model Value</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="ValueChainForm" method="post">
                                        <!-- Section: Main Title & Description -->
                                        <h4 class="mb-3">Value Chain - Main Section</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Main Title</label>
                                                <input type="text" class="form-control" name="main_title" id="main_title" placeholder="e.g. End-to-End Value Chain Expertise">
                                                <div class="text-danger" id="error_main_title"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mt-md-0">
                                                <label>Main Description</label>
                                                <textarea class="form-control" name="main_description" id="main_description" rows="4" placeholder="e.g. Packaging decisions impact every part of the value chain..."></textarea>
                                                <div class="text-danger" id="error_main_description"></div>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Section: Expertise Blocks -->
                                        <h4 class="mb-3">Value Chain Expertise Blocks</h4>
                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h6>Expertise Block <?= $i + 1 ?></h6>
                                                    <div class="mb-3">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control" name="expertise[<?= $i ?>][title]" placeholder="e.g. Consumer">
                                                        <div class="text-danger" id="error_title_<?= $i ?>"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="expertise[<?= $i ?>][description]" rows="3" placeholder="e.g. We enable packaging choices that enhance product experience..."></textarea>
                                                        <div class="text-danger" id="error_description_<?= $i ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>

                                        <button type="submit" class="btn btn-gradient-primary">Save Value Chain Section</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="ValueChain" class="display">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Value Chain Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" id="modalBodyContent">
                        <!-- Main Title & Description -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Main Title</strong></label>
                                <p id="view_main_title" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Main Description</strong></label>
                                <p id="view_main_description" class="mb-0"></p>
                            </div>
                        </div>

                        <hr>

                        <!-- Expertise Blocks -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6><strong>Expertise Areas</strong></h6>
                                <div class="row" id="view_expertise_blocks">
                                    <!-- Each expertise block will be dynamically inserted here -->
                                    <!-- Example block:
                                    <div class="col-md-6 mb-3">
                                        <div class="border p-3 rounded bg-light">
                                            <h6 class="mb-1">Consumer</h6>
                                            <p class="mb-0">We enable packaging choices...</p>
                                        </div>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


      <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLabel">Edit Value Chain</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="EditValueChainForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">

                            <!-- Title & Description -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_main_title" class="form-label">Main Title</label>
                                    <input type="text" class="form-control" id="edit_main_title" name="edit_main_title" placeholder="e.g. End-to-End Value Chain Expertise">
                                    <div class="text-danger" id="error_edit_main_title"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_main_description" class="form-label">Main Description</label>
                                    <textarea class="form-control" id="edit_main_description" name="edit_main_description" rows="3" placeholder="e.g. Packaging decisions impact..."></textarea>
                                    <div class="text-danger" id="error_edit_main_description"></div>
                                </div>
                            </div>

                            <!-- Expertise Blocks -->
                            <hr>
                            <h5 class="mb-3">Value Chain Expertise Blocks</h5>
                            <div id="editExpertiseContainer">
                                <?php for ($i = 0; $i < 4; $i++): ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6>Expertise Block <?= $i + 1 ?></h6>
                                            <div class="mb-3">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="edit_expertise[<?= $i ?>][title]" id="edit_expertise_title_<?= $i ?>" placeholder="e.g. Consumer">
                                                <div class="text-danger" id="error_edit_expertise_title_<?= $i ?>"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Description</label>
                                                <textarea class="form-control" name="edit_expertise[<?= $i ?>][description]" id="edit_expertise_description_<?= $i ?>" rows="3" placeholder="e.g. We enable packaging choices..."></textarea>
                                                <div class="text-danger" id="error_edit_expertise_description_<?= $i ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Modal Footer -->
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
    <script src="<?= base_url()?>assets/view_js/value_chain.js"></script>
    <!-- End custom js for this page -->
    <script>

    </script>
</body>

</html>