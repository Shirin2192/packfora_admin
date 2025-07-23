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
                        <h3 class="page-title">Blogs </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="BlogsForm" class="forms-sample" enctype="multipart/form-data">
                                        <div class="row">

                                            <!-- Title -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                    <div class="text-danger" id="error_title"></div>
                                                </div>
                                            </div>

                                            <!-- Slug (auto-generated) -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                                                    <div class="text-danger" id="error_slug"></div>
                                                </div>
                                            </div>

                                            <!-- Summary -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="summary">Summary</label>
                                                    <input type="text" class="form-control" name="summary" id="summary" placeholder="Summary">
                                                    <div class="text-danger" id="error_summary"></div>
                                                </div>
                                            </div>

                                            <!-- Read Time -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="read_time">Reading Time</label>
                                                    <input type="text" class="form-control" name="read_time" id="read_time" placeholder="e.g. 5 Minutes">
                                                    <div class="text-danger" id="error_read_time"></div>
                                                </div>
                                            </div>

                                            <!-- Publish Date -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="publish_date">Publish Date</label>
                                                    <input type="date" class="form-control" name="publish_date" id="publish_date">
                                                    <div class="text-danger" id="error_publish_date"></div>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="content">Content</label>
                                                    <textarea class="form-control" name="content" id="content" rows="6" placeholder="Write full blog content here..."></textarea>
                                                    <div class="text-danger" id="error_content"></div>
                                                </div>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image">
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
                                    <div class="table-responsive">
                                        <table id="BlogsTable" class="display">
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
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?php include('common/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- Modal -->
        <!-- Blog View Modal -->
        <div class="modal fade" id="viewBlogModal" tabindex="-1" role="dialog" aria-labelledby="viewBlogModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              
              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="viewBlogModalLabel">View Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="row">

                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                      <strong>Title:</strong>
                      <p id="view_title" class="mb-0 text-muted"></p>
                    </div>

                    <!-- Slug -->
                    <div class="col-md-6 mb-3">
                      <strong>Slug:</strong>
                      <p id="view_slug" class="mb-0 text-muted"></p>
                    </div>

                    <!-- Summary -->
                    <div class="col-md-6 mb-3">
                      <strong>Summary:</strong>
                      <p id="view_summary" class="mb-0 text-muted"></p>
                    </div>

                    <!-- Reading Time -->
                    <div class="col-md-6 mb-3">
                      <strong>Reading Time:</strong>
                      <p id="view_read_time" class="mb-0 text-muted"></p>
                    </div>

                    <!-- Publish Date -->
                    <div class="col-md-6 mb-3">
                      <strong>Publish Date:</strong>
                      <p id="view_publish_date" class="mb-0 text-muted"></p>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                      <strong>Image:</strong><br>
                      <div id="view_image" alt="Blog Image" class="img-thumbnail"></div>
                    </div>

                    <!-- Content -->
                    <div class="col-md-12 mb-3">
                      <strong>Content:</strong>
                      <div id="view_content" class="border p-3 rounded bg-light" style="min-height: 150px;"></div>
                    </div>

                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <!-- Modal Body -->
                  <div class="modal-body">
                    <form id="EditBlogForm" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="edit_id">
                      <input type="hidden" name="current_image" id="current_image">

                      <div class="container-fluid">
                        <div class="row">

                          <!-- Title -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Title</strong></label>
                            <input type="text" name="edit_title" id="edit_title" class="form-control" required>
                            <small class="text-danger" id="error_title"></small>
                          </div>

                          <!-- Slug -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Slug</strong></label>
                            <input type="text" name="edit_slug" id="edit_slug" class="form-control">
                            <small class="text-danger" id="error_slug"></small>
                          </div>

                          <!-- Summary -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Summary</strong></label>
                            <textarea name="edit_summary" id="edit_summary" class="form-control" rows="3"></textarea>
                            <small class="text-danger" id="error_summary"></small>
                          </div>

                          <!-- Reading Time -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Reading Time (in mins)</strong></label>
                            <input type="text" name="edit_read_time" id="edit_read_time" class="form-control" min="1">
                            <small class="text-danger" id="error_read_time"></small>
                          </div>

                          <!-- Publish Date -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Publish Date</strong></label>
                            <input type="date" name="edit_publish_date" id="edit_publish_date" class="form-control">
                            <small class="text-danger" id="error_publish_date"></small>
                          </div>

                          <!-- Image -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Image</strong></label><br>
                            <input type="file" name="edit_image" id="edit_image" class="form-control">
                            <div id="preview_edit_image" class="mt-2"></div>
                            <small class="text-danger" id="error_image"></small>
                          </div>

                          <!-- Content (CKEditor) -->
                          <div class="col-md-12 mb-3">
                            <label class="form-label"><strong>Content</strong></label>
                            <textarea name="edit_content" id="edit_content" class="form-control" rows="6"></textarea>
                            <small class="text-danger" id="error_edit_content"></small>
                          </div>

                        </div>
                      </div>

                      <!-- Modal Footer -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Blog</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/blogs.js"></script>
    <!-- End custom js for this page -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('keyup', function () {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });
    });
</script>

</body>

</html>