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

                            <h3 class="card-title"><i class="fas fa-filter"></i> &nbsp;Filter Log</h3>


                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body collapse">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="userAct" id="userAct" class="form-control form-control-lg">
                                        <option value="">-= Select User =-</option>
                                        @foreach ($userAct as $act)
                                        @if($act->causer_id === null)

                                        <option value="system">System</option>
                                        @else

                                        <option value="{{ $act->causer_id }}">{{ $act->causer->name }}</option>
                                        @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="logNameAct" id="logNameAct" class="form-control form-control-lg">
                                        <option value="">-= Select Log Name =-</option>
                                        @foreach ($logNameAct as $log)
                                        <option value="{{ $log->log_name }}">{{ $log->log_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <textarea class="form-control form-control-lg" name="descAct" id="descAct" placeholder="Description"></textarea>
                                </div>
                            </div>









                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" id="btn-resetFilter" class="btn btn-success btn-user btn-block">
                                            <i class="fas fa-sync"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" id="btn-filter" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
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