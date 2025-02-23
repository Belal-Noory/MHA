<?php
    $title = "Emails";
    require("master/header.php");

    if(isset($_GET["email"]))
    {
        $MessageID = $_GET["email"];
        $messageItem = $contactManager->getMessageById($MessageID);
        // update this feedback and set to read
        $contactManager->updateMessageStatus($MessageID,'Read');
    }else
    {
        $messageItem = $contactManager->getAllMessages();
    }
    $messageData = $messageItem->fetchAll(PDO::FETCH_OBJ);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Company Emails</h1>
    <div id="btnContiner" class="mb-1"></div>
    <table class="table" id="mytable">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                foreach ($messageData as $mdata) {
                    // Convert it to a DateTime object
                    $date = new DateTime($mdata->CreatedAt);
                    // Format it in a more official format
                    $fDate = $date->format('l, d F Y h:i A');?>
                    <tr>
                        <td><?php echo $mdata->MessageID; ?></td>
                        <td><?php echo $mdata->Name; ?></td>
                        <td><?php echo $mdata->Email; ?></td>
                        <td><?php echo $mdata->Subject; ?></td>
                        <td><?php echo $mdata->Message; ?></td>
                        <td><?php if($mdata->Status == 'New'){ echo "<span class='badge badge-primary'>$mdata->Status</span>";}else{echo $mdata->Status;} ?></td>
                        <td><?php echo $fDate; ?></td>
                        <td><a class="btndelet text-danger" href="#" uid="<?php echo $mdata->MessageID; ?>"><i class="fas fa-trash"></i></a></td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>
</div>
          
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
                            url: "../app/Controllers/contact.php", // Change this to your actual login endpoint
                            type: "POST",
                            data: { deleteemail: 'TRUE', ID: Id},
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