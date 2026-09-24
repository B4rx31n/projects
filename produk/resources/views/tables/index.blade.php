@extends('layouts.app')

@section('title', 'Tables')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tables
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="{{ asset('Lumino/tables/data1.json') }}" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">Item ID</th>
                            <th data-field="id" data-sortable="true">Item ID</th>
                            <th data-field="name" data-sortable="true">Item Name</th>
                            <th data-field="price" data-sortable="true">Item Price</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('Lumino/css/bootstrap-table.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('Lumino/js/bootstrap-table.js') }}"></script>
@endpush
