<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Packfora Admin</title>
    <?php include('common/css_files.php');?>
</head>

<body>
    <div class="container-scroller">
        <?php include('common/nav_head.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include('common/sidebar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Case Study tags</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Case Study Tags</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="CaseSṭudyTagForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name">Name</label>
                                                    <input type="text" class="form-control" name="Name" id="Name" placeholder="Name">
                                                    <div class="text-danger" id="error_Name"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Category">Category</label>
                                                    <input type="text" class="form-control" name="Category" id="Category" placeholder="Category">
                                                    <div class="text-danger" id="error_Category"></div>
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
                                    <table id="CaseSṭudyTagTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('common/footer.php');?>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Edit Case Study</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="EditCaseSṭudyTagForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_previous_image" name="edit_previous_image">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_category">category</label>
                                <input type="text" class="form-control" name="edit_category" id="edit_category">
                                <div class="text-danger" id="error_edit_category"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_name">Name</label>
                                <input class="form-control" name="edit_name" id="edit_name">
                                <div class="text-danger" id="error_edit_name"></div>
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

    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/case_study_tags.js"></script>
</body>

</html>
