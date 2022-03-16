@extends('layouts.app')

@section('content')
<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">username</h3>
                        <h5 class="widget-user-desc">user descriptions</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('images/no-image.png') }}" alt="User Avatar" style="width: 100px;height: 100px;object-fit:cover;object-position:center;">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">created_at</h5>
                                    <span class="description-text">Register</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">ANAK</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">CUCU</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="col-sm-4">Name</th>
                                    <td class="col-sm-8"><a href="http://127.0.0.1:8001/users/0b3eec36-1d07-4ca9-be25-563b517587fa">hery hermawan</a></td>
                                </tr>
                                <tr>
                                    <th>Nickname</th>
                                    <td>hery</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>M</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>1986-04-19</td>
                                </tr>
                                <tr>
                                    <th>Birth Order</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td>
                                        <div title="35 years, 3 months, 3 weeks, 5 days, 1 hour, 6 minutes, 58 seconds">35 years</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>sanca.snake@gmail.com</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- ./end col-xx -->

            <div class="col-lg-8 col-md-8 col-sm-8">
                <form action="#" method="post" id="formProfile" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Profile Anggota Keluarga</h3>

                            <div class="card-tools">

                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <a id="linkFoto" href="{{ asset('images/no-image.png') }}" data-lightbox="image-foto" data-title="User Foto">
                                    <img id="imageReview" src="{{ asset('images/no-image.png') }}" alt="Image Foto" style="width: 150px;height: 150px;" class="img-thumbnail img-fluid">
                                </a>
                            </div>

                            <div class="form-group">
                                <label for="inputFoto">Foto User</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="foto" class="custom-file-input" id="inputFoto">
                                        <label class="custom-file-label" for="inputFoto">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="" required>
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
                                <input type="text" class="form-control" value="" disabled>

                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;Update</button>
                        </div>
                    </div> <!-- ./card -->
                </form>
            </div>
        </div>
    </div>

</section>
@endsection
