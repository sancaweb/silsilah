@extends('layouts.app')

@section('content')
<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <h5 class="widget-user-desc">{{ ucwords($user->roles->pluck('name')->first()) }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ $user->takeImage() }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $user->created_at->diffForHumans() }}</h5>
                                    <span class="description-text">Register</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div> <!-- ./end col-xx -->

            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>

                        <div class="card-tools">

                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <a id="linkFoto" href="<?= asset('images/no-image.png'); ?>" data-lightbox="image-foto" data-title="User Foto">
                                <img id="imageReview" src="<?= asset('images/no-image.png'); ?>" alt="Image Foto" style="width: 150px;height: 150px;" class="img-thumbnail img-fluid">
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
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
