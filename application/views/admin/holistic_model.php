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
                                    <form id="HolisticValueForm" enctype="multipart/form-data" method="post">
                                        <!-- Section: Intro -->
                                        <h4 class="mb-3">Intro Section</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Main Title</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="e.g. Holistic Value Model">
                                                <div class="text-danger" id="error_title"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="e.g. A proven framework for business impact..."></textarea>
                                                <div class="text-danger" id="error_description"></div>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Section: Strategies -->
                                        <h4 class="mb-3">Technology & Procurement Strategies</h4>
                                        <?php
                                        $sections = ['Technology', 'Procurement'];
                                        $pillars = ['Reduce', 'Replace', 'Redesign'];
                                        foreach ($sections as $section_type):
                                        ?>
                                        <div class="card mb-4">
                                            <div class="card-header bg-light"><strong><?= $section_type ?></strong></div>
                                            <div class="card-body">
                                                <?php foreach ($pillars as $pillar): 
                                                    $field_key = "strategy[$section_type][$pillar]";
                                                    $safe_id = str_replace(['[', ']'], ['_', ''], $field_key); // to generate a safe HTML id
                                                ?>
                                                <div class="mb-3">
                                                    <label><?= $pillar ?> Items</label>
                                                    <input type="text" class="form-control"
                                                           name="<?= $field_key ?>"
                                                           id="<?= $safe_id ?>"
                                                           placeholder="Comma-separated values like Waste, Complexity Reduction">
                                                    <div class="text-danger" id="error_<?= $safe_id ?>"></div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                        <hr class="my-4">

                                        <!-- Section: Levers -->
                                        <h4 class="mb-3">Levers We Activate</h4>
                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                        <div class="mb-3">
                                            <label>Lever <?= $i + 1 ?></label>
                                            <input type="text" class="form-control" name="levers[]" id="levers_<?= $i ?>" placeholder="e.g. Reduce waste and system complexity">
                                            <div class="text-danger" id="error_levers_<?= $i ?>"></div>
                                        </div>
                                        <?php endfor; ?>

                                        <button type="submit" class="btn btn-gradient-primary mt-3">Save All</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="HolisticValue" class="display">
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
                        <h5 class="modal-title">View Holistic Value Model</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body" id="modalBodyContent">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Title</strong></label>
                                <p id="view_title"></p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Description</strong></label>
                                <p id="view_description"></p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6><strong>Technology & Procurement Strategies</strong></h6>
                                <div class="row" id="view_strategies"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6><strong>Levers We Activate</strong></h6>
                                <ul id="view_levers"></ul>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLabel">Edit Holistic Value Model</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="EditHolisticValueForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">

                            <!-- Title & Description -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="edit_title">
                                    <div class="text-danger" id="error_edit_title"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="edit_description" name="edit_description" rows="3"></textarea>
                                    <div class="text-danger" id="error_edit_description"></div>
                                </div>
                            </div>

                            <!-- Strategies Section -->
                            <hr>
                            <h5 class="mb-2">Technology & Procurement Strategies</h5>

                            <!-- Technology Strategies -->
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold">Technology</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Reduce Items</label>
                                            <input type="text" class="form-control" id="edit_tech_reduce" name="edit_strategy[Technology][Reduce]">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Replace Items</label>
                                            <input type="text" class="form-control" id="edit_tech_replace" name="edit_strategy[Technology][Replace]">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Redesign Items</label>
                                            <input type="text" class="form-control" id="edit_tech_redesign" name="edit_strategy[Technology][Redesign]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Procurement Strategies -->
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold">Procurement</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Supplier Strategy Items</label>
                                            <input type="text" class="form-control" id="edit_proc_supplier" name="edit_strategy[Procurement][Supplier Strategy]">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Should Cost Items</label>
                                            <input type="text" class="form-control" id="edit_proc_should_cost" name="edit_strategy[Procurement][Should Cost]">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Future Proofing Items</label>
                                            <input type="text" class="form-control" id="edit_proc_future" name="edit_strategy[Procurement][Future Proofing]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Levers Section -->
                            <hr>
                            <h5 class="mb-2">Levers We Activate</h5>
                            <div id="editLeversContainer">
                                <div class="row">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <div class="col-md-6 mb-3">
                                        <label>Lever <?= $i ?></label>
                                        <input type="text" class="form-control edit_lever_input" name="edit_levers[]" id="edit_lever_<?= $i ?>" placeholder="e.g. Reduce waste and system complexity">
                                    </div>
                                    <?php endfor; ?>
                                </div>
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
    <script src="<?= base_url()?>assets/view_js/holistic_model.js"></script>
    <!-- End custom js for this page -->
    <script>

    </script>
</body>

</html>