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
                        <div>
                            <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-tables table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Subscriptions</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Subscriptions</th>
                                        <th>Image</th>
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
    var categoryColumns = [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'subscriptions', name: 'subscriptions' },
        { data: 'image_display', name: 'image_display', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('category.index') }}", categoryColumns);
</script>
@endsection

@endsection
