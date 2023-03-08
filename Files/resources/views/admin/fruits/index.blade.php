@extends('admin.layouts.master')

@section('content')

<section class="content mainSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <div class="col-6">
                            <h3 class="card-title">
                                All Fruits List
                            </h3>
                        </div>
                        <div class="col-6 float-right">
                            <button type="button" class="btn bg-gradient-primary float-right" data-toggle="modal" data-target="#add_record">Add New</button>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="fruits_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Genus</th>
                                    <th>Name</th>
                                    <th>Family</th>
                                    <th>Order</th>
                                    <th>Date</th>
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
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Genus</th>
                                    <th>Name</th>
                                    <th>Family</th>
                                    <th>Order</th>
                                    <th>Date</th>
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
<!-- Add New Record Modal -->
<div class="modal fade" id="add_record" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="form_add_record" id="form_add_record">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add new fruits details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="genus">Genus</label>
                                <input type="text" class="form-control" id="genus" name="genus" placeholder="Genus" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="family">Family</label>
                            <input type="text" class="form-control" id="family" name="family" placeholder="Family">
                        </div>
                        <div class="col-6">
                            <label for="Order">order</label>
                            <input type="text" class="form-control" id="order" name="order" placeholder="Enter order">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <label for="carbohydrates">Carbohydrates</label>
                            <input type="text" class="form-control" id="carbohydrates" name="carbohydrates" placeholder="">
                        </div>
                        <div class="col-6">
                            <label for="protein">Protein</label>
                            <input type="text" class="form-control" id="protein" name="protein" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="fat">Fat</label>
                            <input type="text" class="form-control" id="fat" name="fat" placeholder="">
                        </div>
                        <div class="col-6">
                            <label for="calories">Calories</label>
                            <input type="text" class="form-control" id="calories" name="calories" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="sugar">Sugar</label>
                            <input type="number" class="form-control" id="sugar" name="sugar" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6"></div>
                    </div>


                    <div class="form-group">

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="fruit_id" value="0">
                    <button type="submit" class="btn btn-success btn-sm" id="btn_save">Save</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit/Update Modal -->
<div class="modal fade" id="updateModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update fruits details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="genus">Genus</label>
                    <input type="text" class="form-control" id="genus" name="genus" placeholder="Genus" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee name" required>
                </div>
                <div class="form-group">
                    <label for="family">Family</label>
                    <input type="text" class="form-control" id="family" placeholder="Family">
                </div>

                <div class="form-group">
                    <label for="city">order</label>
                    <input type="text" class="form-control" id="order" placeholder="Enter order">
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="fruit_id" value="0">
                <button type="button" class="btn btn-success btn-sm" id="btn_update">Update</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="addFavourite" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update fruits details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="genus">Genus</label>
                    <input type="text" class="form-control" id="genus" name="genus" placeholder="Genus" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee name" required>
                </div>
                <div class="form-group">
                    <label for="family">Family</label>
                    <input type="text" class="form-control" id="family" placeholder="Family">
                </div>

                <div class="form-group">
                    <label for="city">order</label>
                    <input type="text" class="form-control" id="order" placeholder="Enter order">
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="fruit_id" value="0">
                <button type="button" class="btn btn-success btn-sm" id="btn_update">Update</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {
        //alert(66666);
        $("form#form_add_record").submit(function(e) {
            //alert(77777);
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('fruits.store') }}",
                data: $("form#form_add_record").serialize(), //new FormData($(this)[0]), //$("form#form_add_record"),
                success: function() {
                    alert('success');
                }
            });
        });
    });
</script>

<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).ready(function() {
        //alert('0000');
        var fruitsTable = $('#fruits_table').DataTable({
            "language": {
                "processing": $('div#preloader').css("display", "block"),
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('fruits.get') }}",
            columns: [

                {
                    data: 'genus',
                    name: 'genus'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'family',
                    name: 'family'
                },

                {
                    data: 'order',
                    name: 'order'
                },
                {
                    data: 'date',
                    name: 'date'
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
        // Edit record
        $('#fruits_table').on('click', '#updateFruit', function() {
            var id = $(this).data('id');
            //alert(id);

            $('#updateModal #fruit_id').val(id);

            // AJAX request
            $.ajax({
                url: "{{ route('fruits.show') }}",
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    if (response.success == 1) {

                        $('#updateModal #genus').val(response.genus);
                        $('#updateModal #name').val(response.name);
                        $('#updateModal #family').val(response.family);
                        $('#updateModal #order').val(response.order);

                        fruitsTable.ajax.reload();
                    } else {
                        alert("Invalid ID.");
                    }
                }
            });

        });
        //--- Add new record----

        // Update/Save record 
        $('#btn_update').click(function() {
            var id = $('#updateModal #fruit_id').val();
            //alert(id);
            var genus = $('#updateModal #genus').val().trim();
            var name = $('#updateModal #name').val().trim();
            var family = $('#updateModal #family').val().trim();
            var order = $('#updateModal #order').val().trim();

            if (genus != '' && name != '' && family != '' && order != '') {

                // AJAX request
                $.ajax({
                    url: "{{ route('fruits.update') }}",
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        genus: genus,
                        name: name,
                        family: family,
                        order: order
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == 1) {
                            alert(response.msg);

                            // Empty and reset the values
                            $('#updateModal #genus', '#updateModal #name', '#updateModal #family', '#updateModal #order').val('');

                            $('#fruit_id').val(0);

                            // Reload DataTable
                            fruitsTable.ajax.reload();

                            // Close modal
                            $('#updateModal').modal('toggle');
                        } else {
                            alert(response.msg);
                        }
                    }
                });

            } else {
                alert('Please fill all fields.');
            }
        });
        // Delete record
        $('#fruits_table').on('click', '.deleteFruit', function() {
            var id = $(this).data('id');
            var deleteConfirm = confirm("Are you sure, you want to delete the record?");
            if (deleteConfirm == true) {
                // AJAX request
                $.ajax({
                    url: "{{ route('fruits.destroy') }}",
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

        // Add to Favourites
        $('#fruits_table').on('click', '.farouriteFruit', function() {
            //alert('0000');
            var id = $(this).data('id');
            var addFavouriteConfirm = confirm("Are you sure, you want to add favourite?");
            if (addFavouriteConfirm == true) {
                // AJAX request
                $.ajax({
                    url: "{{ route('favourites.add') }}",
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(response) {
                        if (response == 'success') {
                            alert("Record added.");

                            // Reload DataTable
                            fruitsTable.ajax.reload();
                        } else {
                            alert(response); //alert("Invalid ID.");
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
</style>
@endsection