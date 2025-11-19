@extends('layouts.app')

@section('title', $title)

@section('content')
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
                            <a href="{{ route('videos.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-tables table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Thumbnail Image</th>
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Thumbnail Image</th>
                                        <th>Video</th>
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

@endsection

@section('script')
<script>
    var videoColumns = [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'category_name', name: 'category_name' },
        { data: 'image_display', name: 'image_display', orderable: false, searchable: false },
        { data: 'video_display', name: 'video_display', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('videos.index') }}", videoColumns);
</script>
@endsection
