@extends('layouts.app')

@section('content')
<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Anggota Keluarga</h3>
                        <div class="card-tools">
                            @if (auth()->user()->can('person create'))
                            <a href="{{ route('person.create') }}" type="button" class="btn btn-sm btn-flat btn-success">
                                <i class="fas fa-plus-square"></i> &nbsp; Tambah Keluarga
                            </a>
                            @endif

                            <a href="{{ route('person.show',auth()->user()->id) }}" type="button" class="btn btn-sm btn-flat btn-success">
                                <i class="fas fa-plus-square"></i> &nbsp; Profile Pribadi
                            </a>

                            <button type="button" class="btn btn-sm btn-flat btn-success">
                                <i class="fas fa-sync"></i> &nbsp; Reload
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="table-assignPermission" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Orang Tua</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div> <!-- ./end card -->
            </div>
        </div>
    </div>
</section>
@endsection
