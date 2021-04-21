@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <div id="cardFormActivity" class="card card-outline card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Crypto Form</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body collapse">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Waktu Deposit:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6"></div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">


                                    <div class="form-group">
                                        <label>Crypto</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">DCT</option>
                                            <option>DCT2</option>
                                            <option>DCT3</option>
                                            <option>DCT4</option>
                                            <option>DCT5</option>
                                            <option>DCT6</option>
                                            <option>DCT7</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Topup</label>
                                        <input class="form-control" type="text" name="" id="" placeholder="topup" value="20.000.000">
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Referral</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->


                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Downline</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option disabled="disabled">California (disabled)</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">

                                    <button type="button" class="btn btn-block btn-primary btn-flat float-right">

                                        Save & Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Form -->


            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $pageTitle}}</h3>
                            <div class="card-tools">
                                <button id="btn-activityReload" type="button" class="btn btn-sm btn-primary">
                                    <i class="fas fa-sync"></i> &nbsp; Reload
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-activity" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>User</th>
                                        <th>Log Name</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                </tfoot>
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
        <!-- ./ .container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="detailAct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailActLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailActLabel">Detail Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txt_user">User Log</label>
                        <input readonly disabled type="text" class="form-control" id="txt_user" placeholder="Log Name">
                    </div>

                    <div class="form-group">
                        <label for="txt_logName">Log Name</label>
                        <input readonly disabled type="text" class="form-control" id="txt_logName" placeholder="Log Name">
                    </div>

                    <div class="form-group">
                        <label for="txt_desc">Keterangan</label>
                        <input readonly disabled type="text" class="form-control" id="txt_desc" placeholder="Keterangan">
                    </div>

                    <div class="form-group">
                        <label for="txt_data">Data</label>
                        <textarea readonly disabled id="txt_data" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txt_created">Created at</label>
                        <input readonly disabled type="text" class="form-control" id="txt_created" placeholder="Keterangan">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection