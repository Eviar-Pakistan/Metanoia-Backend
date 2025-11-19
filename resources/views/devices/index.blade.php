@extends('layouts.app')
@section('content')
@section('title', $title)

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        {{-- <div>
                            <a href="{{ route('devices.create') }}" class="btn btn-primary">Create</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-tables table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Ip Address</th>
                                        <th>Mac Address</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Ip Address</th>
                                        <th>Mac Address</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    var deviceColumns = [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'ip_address', name: 'ip_address' },
        { data: 'mac_address', name: 'mac_address' },
        { data: 'username', name: 'username' },
        { data: 'status_display', name: 'status_display' },
        { data: 'action', name: 'action', orderable: true, searchable: true },
    ];
    initializeDataTable("{{ route('devices.index') }}", deviceColumns);
</script>
@endsection

@endsection
