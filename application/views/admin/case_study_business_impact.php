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
                        <h3 class="page-title">Case Study Business Impact</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Case Study Business Impact</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="CaseStudyBusinessImpactForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">
                                            <!-- Case Study Dropdown -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="case_study_id">Case Study</label>
                                                    <select class="form-control chosen-select" name="case_study_id" id="case_study_id">
                                                        <option value=""></option>
                                                        <?php foreach ($data as $data_key => $data_value): ?>
                                                            <option value="<?= $data_value['id'] ?>"><?= $data_value['title'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="text-danger" id="error_case_study_id"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Title</label>
                                                <input type="text" name="card_title" class="form-control" placeholder="Card Title">
                                                <div class="text-danger card_title_error"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Description</label>
                                                <input type="text" name="card_description" class="form-control" placeholder="Card Description">
                                                <div class="text-danger card_description_error"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Image</label>
                                                <input type="file" name="card_image" class="form-control">
                                                <div class="text-danger card_image_error"></div>
                                            </div>
                                          
                                        </div>    
                                              <br>                         
                                        <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                        <div class="text-success mt-3" id="success_msg"></div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <table id="CaseSṭudyBusinessImpactTable" class="display">
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
                <?php include('common/footer.php');?>
            </div>
        </div>
    </div>
    <!-- View Modal -->
    <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ViewModalLabel">View Case Study Business Impact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="view_title">Title</label>
                            <p id="view_title"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="view_description">Description</label>
                            <p id="view_description"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="view_image">Image</label>
                            <div id="view_image"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Edit Case Study Business Impact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="EditCaseStudyBusinessImpactForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_previous_image" name="edit_previous_image">                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_title">Title</label>
                                <input type="text" class="form-control" name="edit_title" id="edit_title">
                                <div class="text-danger" id="error_edit_title"></div>
                            </div>             
                                  
                            <div class="col-md-6">
                                <label for="edit_description">Description</label>
                                <input type="text" class="form-control" id="edit_description" name="edit_description">
                                <div class="text-danger" id="error_edit_description"></div>
                            </div>                           
                            <div class="col-md-6">
                                <label for="edit_image">Image</label>
                                <input type="file" class="form-control" id="edit_image" name="edit_image">
                                <div id="current_image" class="mt-2"></div>
                                <div class="text-danger" id="error_edit_image"></div>
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
    <script src="<?= base_url()?>assets/view_js/case_study_business_impact.js"></script>
</body>

</html>
