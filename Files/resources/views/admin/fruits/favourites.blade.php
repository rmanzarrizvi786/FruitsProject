@extends('admin.layouts.master')

@section('content')

<section class="content mainSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Favourites Fruits List (Maximum 10 Allowed)</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="fruits_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Carbohydrates</th>
                                    <th>Protein</th>
                                    <th>Fat</th>
                                    <th>Calories</th>
                                    <th>Sugar</th>
                                    <th>Total</th>
                                    <th style="text-align: center !important;">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Carbohydrates</th>
                                    <th>Protein</th>
                                    <th>Fat</th>
                                    <th>Calories</th>
                                    <th>Sugar</th>
                                    <th>Total</th>
                                    <th style="text-align: center !important;">Action</th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<script type="text/javascript">
    var CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).ready(function() {
        //alert('0000');
        fruitsTable = $('#fruits_table').DataTable({
            "language": {
                "processing": $('div#preloader').css("display", "block"),
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('fruits.get.favourites') }}",
            columns: [


                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'carbohydrates',
                    name: 'carbohydrates'
                },

                {
                    data: 'protein',
                    name: 'protein'
                },

                {
                    data: 'fat',
                    name: 'fat'
                },
                {
                    data: 'calories',
                    name: 'calories'
                },
                {
                    data: 'sugar',
                    name: 'sugar'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ],


            "order": [
                [0, 'asc']
            ]

        });
        // Delete record
        $('#fruits_table').on('click', '.deleteFruit', function() {
            var id = $(this).data('id');
            var deleteConfirm = confirm("Are you sure, you want to delete the record?");
            if (deleteConfirm == true) {
                // AJAX request
                $.ajax({
                    url: "{{ route('favourites.destroy') }}",
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            alert("Record deleted.");

                            // Reload DataTable
                            fruitsTable.ajax.reload();
                        } else {
                            alert("Invalid ID.");
                        }
                    }
                });
            }

        });


    });
</script>
<style>
    td {
        padding: 7px !important;
    }

    .action button {
        width: 100px;
    }
</style>
@endsection