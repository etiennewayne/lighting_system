<?php
session_start();

if(isset($_SESSION['user'])){
    $user = json_decode( $_SESSION['user']);
    
}else{
    header('location: index.php');
}
    

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <script src="js/jquery-3.5.1.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Door Lock</title>

    <style>
     
    </style>
</head>
<body>

    <?php include_once 'includes/nav.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Schedule</h3>
                <hr>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        New Schedule
                    </button>
                </div>


                <table id="schedule" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Schedule</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Schedule</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Schedule Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="schedule_name">Schedule</label>
                            <input type="text" class="form-control" id="schedule_name" placeholder="Schedule">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="time_from">From</label>
                                <input type="text" class="form-control" id="time_from" placeholder="From">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time_to">To</label>
                                <input type="text" class="form-control" id="time_to" placeholder="To">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <script src="js/popper.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#schedule').DataTable({
                processing: true,
                ajax: {
                    url: 'php/ajax-schedule.php',
                    dataSrc: ''
                },
                columns: [
                    { data: 'schedule_id' },
                    { data: 'schedule_name' },
                    { data: 'datetime_from' },
                    { data: 'datetime_to' },
                    {
                        defaultContent: '<div class="action-container"> <button class="btn btn-warning btn-sm" id="edit">Edit</button>' +
                            '<button class="btn btn-danger btn-sm" id="delete">Delete</button></div>'
                    },
                ],
            });



            $('#categories tbody').on( 'click', '#edit', function () {
                let data = table.row( $(this).parents('tr') ).data();

                let id = data['category_id'];
                window.location = '/category/'+id+'/edit' ;

            });//criteria click edit

            $('#categories tbody').on( 'click', '#delete', function () {
                let data = table.row( $(this).parents('tr') ).data();

                let id = data['category_id'];
                let contentText = data['category'];

                let token = $("meta[name=csrf-token]").attr('content');
                let method = $("input[name=_method]").val();


                $.confirm({
                    title: 'Are you sure you want to delete '+ contentText +'?',
                    theme: 'material',
                    type : 'red',
                    draggable: true,
                    animationBounce: 1.5, // default is 1.2 whereas 1 is no bounce.
                    buttons: {
                        confirm: function () {

                            $.post('/category/'+ id,
                                {
                                    _token : token,
                                    _method : 'DELETE'
                                },

                                function(data, status){
                                    if(status=="success"){
                                        $('#categories').DataTable().ajax.reload();
                                        $.alert('Deleted successfully');
                                    }else{
                                        $.alert('An error occured. ERROR : ' +status);
                                    }

                                });
                        },
                        cancel: function () {

                        },

                    }
                });//confirm box
            });//criteria click delete


        });
    </script>
</body>
</html>
