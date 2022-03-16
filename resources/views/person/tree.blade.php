@extends('layouts.app')

@section('content')
<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Assigned Roles to Permissions</h3>
                        <div class="card-tools">
                            <button id="btn-assignPermissionReload" type="button" class="btn btn-sm btn-flat btn-success">
                                <i class="fas fa-sync"></i> &nbsp; Reload
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="tree">
                            <ul>
                                <li>
                                    <a href="#">Parent</a>
                                    <ul>
                                        <li>
                                            <a href="#">Child</a>
                                            <ul>
                                                <li>
                                                    <a href="#">Grand Child</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Child</a>
                                            <ul>
                                                <li><a href="#">Grand Child</a></li>
                                                <li>
                                                    <a href="#">Grand Child</a>
                                                    <ul>
                                                        <li>
                                                            <a href="#">Great Grand Child</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Great Grand Child</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Great Grand Child</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Grand Child</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div> <!-- ./end card -->
            </div>
        </div>
    </div>
</section>
@endsection
