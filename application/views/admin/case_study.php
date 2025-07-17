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
                        <h3 class="page-title">Case Study</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Case Study</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="CaseStudyForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                    <div class="text-danger" id="error_title"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="badge">Badge</label>
                                                    <input type="text" class="form-control" name="badge" id="badge" placeholder="e.g., Foods, Personal Care">
                                                    <div class="text-danger" id="error_badge"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    <div class="text-danger" id="error_image"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="main_image">Main Image</label>
                                                    <input type="file" class="form-control" name="main_image" id="main_image">
                                                    <div class="text-danger" id="error_main_image"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                                                    <div class="text-danger" id="error_description"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="link">Case Study Link</label>
                                                    <input type="text" class="form-control" name="link" id="link" placeholder="https://...">
                                                    <div class="text-danger" id="error_link"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date">Publish Date</label>
                                                    <input type="date" class="form-control" name="date" id="date">
                                                    <div class="text-danger" id="error_date"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tags">Tags</label>
                                                    <div><select multiple class="form-control chosen-select" name="tags[]" id="tags">
                                                    <?php
                                                    foreach ($tags as $tags_key => $tags_value) { ?>
                                                        <option value="<?= $tags_value['id']?>"><?= $tags_value['name']?></option>
                                                    <?php }
                                                    ?>
                                                    </select></div>
                                                    <div class="text-danger" id="error_tags"></div>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="video">Video</label>
                                                    <input type="file" class="form-control" name="video" id="video">
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
                                    <table id="CaseSṭudyTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Image</th>
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
                <form id="EditCaseStudyForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_previous_image" name="edit_previous_image">
                        <input type="hidden" id="edit_previous_video" name="edit_previous_video">
                        <input type="hidden" id="edit_previous_main_image" name="edit_previous_main_image" />
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_title">Title</label>
                                <input type="text" class="form-control" name="edit_title" id="edit_title">
                                <div class="text-danger" id="error_edit_title"></div>
                            </div>             
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_badge">Badge</label>
                                    <input type="text" class="form-control" name="edit_badge" id="edit_badge" placeholder="e.g., Foods, Personal Care">
                                    <div class="text-danger" id="error_edit_badge"></div>
                                </div>
                            </div>               
                            <div class="col-md-6">
                                <label for="edit_description">Description</label>
                                <input type="text" class="form-control" id="edit_description" name="edit_description">
                                <div class="text-danger" id="error_edit_description"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_link">Case Study Link</label>
                                <input type="text" class="form-control" id="edit_link" name="edit_link">
                                <div class="text-danger" id="error_edit_link"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_date">Publish Date</label>
                                <input type="date" class="form-control" name="edit_date" id="edit_date">
                                <div class="text-danger" id="error_edit_date"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_tags">Tags</label>
                                <select multiple class="form-control chosen-select" name="edit_tags[]" id="edit_tags">
                                    <?php
                                    foreach ($tags as $tags_key => $tags_value) { ?>
                                        <option value="<?= $tags_value['id']?>"><?= $tags_value['name']?></option>
                                    <?php }
                                    ?>
                                </select>
                                <div class="text-danger" id="error_edit_tags"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_image">Image</label>
                                <input type="file" class="form-control" id="edit_image" name="edit_image">
                                <div id="current_image" class="mt-2"></div>
                                <div class="text-danger" id="error_edit_image"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_image">MainImage</label>
                                <input type="file" name="edit_main_image" class="form-control" id="edit_main_image" />
                                
                                <div id="current_main_image" class="mt-2"></div>
                                <div class="text-danger" id="error_edit_main_image"></div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="edit_video">Video</label>
                                <input type="file" class="form-control" id="edit_video" name="edit_video">
                                <div id="current_video" class="mt-2"></div>
                                <div class="text-danger" id="error_edit_video"></div>
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
    <script src="<?= base_url()?>assets/view_js/case_study.js"></script>
</body>

</html>
