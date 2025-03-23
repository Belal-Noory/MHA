<?php
    $title = "Slidshow";
    require("master/header.php");

    $imageFolder = "../assets/img/slidshow/"; // Ensure the trailing slash
    $images = glob($imageFolder . "*.{jpg,png,jpeg,gif}", GLOB_BRACE);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Company Posts</h1>
    <div id="btnContiner" class="mb-1"></div>
    <table class="table" id="mytable">
        <thead>
            <th>Img</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                foreach ($images as $image) {
                    echo '<tr>
                            <td><img src="' . $image . '" style="max-width:120px" alt="Slideshow Image"></td>
                            <td><a class="btndeletImage text-danger" href="#" uid="' . $image . '"><i class="fas fa-trash"></i></a></td>
                          </tr>';
                }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Slidshow Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form class="form" action="../app/Controllers/admin.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" id="images" class="form-control-file" multiple required>
                </div>
                <button type="submit" name="addimages" class="btn btn-primary btn-user">
                    <i class="fas fa-save"></i> Add Images
                </button>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
                
<?php
require("master/footer.php")
?>
<script>
    $(document).ready(function(){
        let table = new DataTable('#mytable');

        new DataTable.Buttons(table, {
            buttons: [
                {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i>'
                },{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                },
                {
                    text: '<i class="fas fa-plus"></i>',
                    className:'btn btn-info text-white',
                    action: function (e, dt, node, config) {
                        $('#exampleModalCenter').modal('show');
                    }
                }
            ]
        });
        table.buttons().container().appendTo('#btnContiner');

        // Delete
        $(document).on("click",".btndeletImage",function(e){
            e.preventDefault();
            var Name = $(this).attr("uid");
            Swal.fire({
                title: "Are you sure?",
                text: "You really want to delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request for login
                        $.ajax({
                            url: "../app/Controllers/admin.php", // Change this to your actual login endpoint
                            type: "POST",
                            data: { deleteImage: 'TRUE', Name: Name},
                            dataType: "json",
                            cache: false,
                            success: function (response) {
                                window.location.reload();
                            },
                            error: function (e) {
                                Swal.fire({
                                    title: "Error",
                                    text: e.responseText,
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
        })
    });
</script>