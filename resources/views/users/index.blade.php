@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form -->
            <div class="row">
                <div class="col-md-4 col-sm-4"></div><!-- ./end .col-md-4 roles -->
                <div class="col-md-8 col-sm-8">

                </div> <!-- ./end .col-md-8 roles -->
            </div> <!-- ./end .row roles -->
            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <div id="cardFormUser" class="card card-outline card-primary collapsed-card">
                        <div class="card-header">

                            <h3 class="card-title">User Form</h3>

                            <div class="card-tools">
                                <button id="openCard" type="button" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body collapse">
                            <form action="{{ route('user.store') }}" id="formUser">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Roles</label>
                                    <select class="form-control select2" name="role" id="role">
                                        @foreach ($roles as $key=>$role )
                                        <option value="{{ $role }}">{{ ucwords($role) }}</option>

                                        @endforeach

                                    </select>

                                </div>
                                <!-- /.form-group -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <button id="formReset" type="submit" class="btn btn-block btn-danger btn-flat float-right">
                                        Cancel
                                    </button>
                                </div>
                                <div class="col-md-6 col-sm-6">



                                    <button type="submit" class="btn btn-block btn-primary btn-flat float-left">

                                        Save
                                    </button>
                                </div>
                            </div>
                        </div> <!-- ./end .card-footer -->
                        </form>
                    </div><!-- ./end .card -->

                </div> <!-- ./end .col-md-4 -->

                <div class="col-md-8 col-sm-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data User</h3>
                            <div class="card-tools">
                                <button id="btn-userReload" type="button" class="btn btn-sm btn-primary">
                                    <i class="fas fa-sync"></i> &nbsp; Reload
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-user" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
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
                </div> <!-- ./end .col-md-8 -->
            </div>
            <!-- ./Form -->
        </div>
        <!-- ./ .container-fluid -->
    </section>
</div>

@endsection