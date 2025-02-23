<?php
    $title = "Feedbacks";
    require("master/header.php");

    if(isset($_GET["feedback"]))
    {
        $feedbackID = $_GET["feedback"];
        $feedbackItem = $feedbackManager->getFeedbackById($feedbackID);
        // update this feedback and set to read
        $feedbackManager->updateFeedbackStatus('Read',$feedbackID);
    }else
    {
        $feedbackItem = $feedbackManager->getAllFeedback();
    }
    $feedbackData = $feedbackItem->fetchAll(PDO::FETCH_OBJ);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Company Feedbacks</h1>
    <div id="btnContiner" class="mb-1"></div>
    <table class="table" id="mytable">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
            <th>Status</th>
            <th>Rating</th>
            <th>Date</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                foreach ($feedbackData as $fdata) {
                    // Convert it to a DateTime object
                    $date = new DateTime($fdata->CreatedAt);
                    // Format it in a more official format
                    $fDate = $date->format('l, d F Y h:i A');?>
                    <tr>
                        <td><?php echo $fdata->FeedbackID; ?></td>
                        <td><?php echo $fdata->Name; ?></td>
                        <td><?php echo $fdata->Email; ?></td>
                        <td><?php echo $fdata->Feedback; ?></td>
                        <td><?php if($fdata->Status == 'New'){ echo "<span class='badge badge-primary'>$fdata->Status</span>";}else{echo $fdata->Status;}?></td>
                        <td><?php if($fdata->Rating == 5){echo "<span class='badge badge-primary'>$fdata->Rating</span>";}else if($fdata->Rating == 4){echo "<span class='badge badge-success'>$fdata->Rating</span>";}else{echo "<span class='badge badge-warning'>$fdata->Rating</span>";} ?></td>
                        <td><?php echo $fDate; ?></td>
                        <td><a class="btndelet text-danger" href="#" uid="<?php echo $fdata->FeedbackID; ?>"><i class="fas fa-trash"></i></a></td>
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
                            url: "../app/Controllers/feedback.php", // Change this to your actual login endpoint
                            type: "POST",
                            data: { deletefeedback: 'TRUE', ID: Id},
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