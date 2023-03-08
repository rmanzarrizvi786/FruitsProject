@extends('admin.layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard
                    @if(session('message') !='')<span class="btn btn-success">{{ session('message') }}</span>@endif
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('fruits.sync.post') }}" class="btn bg-gradient-primary float-right">Sync Now</a>
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ totalLocalDB() }}</h3>

                        <p>Total Fruits(Local DB)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ totalFavourites() }}/10</h3>

                        <p>Favourites</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>1</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>5</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
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


<style>
    td {
        padding: 7px !important;
    }
</style>
@endsection