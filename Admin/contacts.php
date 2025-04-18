<?php
    $title = "Contacts";
    require("master/header.php");

    $admin = new Admin();
    $contact = $admin->getCompanyContacts();
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Company Contacts</h1>
    <div id="btnContiner" class="mb-1"></div>
    <table class="table" id="mytable">
        <thead>
            <th>ID</th>
            <th>Contact</th>
            <th>Type</th>
            <th>CreateAt</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                if(count($contact) > 0){
                    foreach ($contact as $cnt) {?>
                        <tr>
                            <td><?php echo $cnt->Id; ?></td>
                            <td><?php echo $cnt->contact; ?></td>
                            <td><?php echo $cnt->type; ?></td>
                            <td><?php echo $cnt->CreatedAt; ?></td>
                            <td><a class="btndelet text-danger" href="#" uid="<?php echo $cnt->Id; ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php }
                }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form" method="POST" action="../app/Controllers/admin.php">
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" id="contact" placeholder="Contact..." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="phone">Phone</option>
                                <option value="email">Email</option>
                            </select>
                        </div>
                        <input type="hidden" name="addcontact" id="addcontact" value="true">
                        <button type="submit" class="btn btn-primary btn-user">
                            <i class="fas fa-save"></i>
                            Save Changes
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
        $(document).on("click",".btndelet",function(e){
            e.preventDefault();
            var Id = $(this).attr("uid");
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
                            data: { deleteContact: 'TRUE', Id: Id},
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
            