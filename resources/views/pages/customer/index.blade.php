@extends('layouts.base_layout',['pageTitle'=>'Customer', 'subTitle' => ['Customer','Customer List']])

@section('content')
    <div>
        <div class="main-card mb-3 card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title ">Customers   List</h3>
                <div class=" float-end text-end">
                    <a class="btn btn-success" href="{{route('customer.add-page')}}"><i
                            class="fe fe-plus me-2"></i>Add New</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table style="width: 100%;" id="offerTable" class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Address</th>
                        <th>Is Database</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
