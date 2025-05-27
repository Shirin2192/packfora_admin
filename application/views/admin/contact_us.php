<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
                        <h3 class="page-title">Contact Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        placeholder="Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Contact No</label>
                                                    <input type="text" class="form-control" id="contact_no"
                                                        placeholder="Contact Number">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="designation">Designation</label>
                                                    <select class="form-select form-control" id="designation">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>File upload</label>
                                                    <input type="file" name="img" class="file-upload-default">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button
                                                                class="file-upload-browse btn btn-gradient-primary py-3"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
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
                                   <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Column 1</th>
                                                <th>Column 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Row 1 Data 1</td>
                                                <td>Row 1 Data 2</td>
                                            </tr>
                                            <tr>
                                                <td>Row 2 Data 1</td>
                                                <td>Row 2 Data 2</td>
                                            </tr>
                                        </tbody>
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
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('common/js_files.php');?>
    <!-- End custom js for this page -->
		 <script>
		$(document).ready(function() {
			$('#myTable').DataTable({
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true
			});
		});
		</script>
</body>

</html>
