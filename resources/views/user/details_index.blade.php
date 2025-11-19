@extends('layouts.app')
@section('content')
@section('title' , $title)

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div>
                            <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-tables table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Video</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Video</th>
                                        <th>Username</th>
                                        <th>Status</th>
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
    var userColumns = [
        { data: 'video_display', name: 'video_display' },
        { data: 'username', name: 'username' },
        { data: 'status_display', name: 'status_display', orderable: true, searchable: true },
    ];

    var userId = "{{ $user_id }}";
    var url = "/users/details/"+userId;
    initializeDataTable(url, userColumns);
</script>
@endsection

@endsection
