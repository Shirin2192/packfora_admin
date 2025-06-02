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
                        <h3 class="page-title">Student Talent Economy </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Student Talent Economy</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="StudentTalentEconomyForm" class="forms-sample"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name="id" id="id"
                                                value="<?= isset($data['id']) ? $data['id'] : '' ?>">
                                            <input type="hidden" name="edit_previous_image" id="edit_previous_image"
                                                value="<?= isset($data['image']) ? $data['image'] : '' ?>">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Title"
                                                        value="<?= isset($data['title']) ? $data['title'] : '' ?>">
                                                    <div class="text-danger" id="error_title"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    <?php if (!empty($data['image'])): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url($data['image']) ?>" alt="Current Image"
                                                            style="max-height: 100px;">
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="text-danger" id="error_image"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" name="description" id="description"
                                                        placeholder="Description"><?= isset($data['description']) ? $data['description'] : '' ?></textarea>
                                                    <div class="text-danger" id="error_description"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    </form>

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
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <script src="<?= base_url()?>assets/view_js/student_talent_economy.js"></script>
    <!-- End custom js for this page -->
    <script>

    </script>
</body>

</html>