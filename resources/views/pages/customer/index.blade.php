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
                        <th class="no-sort">First Name</th>
                        <th class="no-sort">email</th>
                        <th class="no-sort">Company Name</th>
                        <th class="no-sort">Database Name</th>
                        <th class="no-sort">Database User</th>
                        <th class="no-sort">Database Password</th>
                        <th class="no-sort">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            loadDataTable({
                tableId: 'offerTable', url: '{{route('customer.index')}}', columns: [
                    {data: 'id',className:'text-center'},
                    {data: 'name',className:'text-center'},
                    {data: 'email',className:'text-center'},
                    {data: 'company_name',className:'text-center'},
                    {data: 'db_name',className:'text-center'},
                    {data: 'db_user',className:'text-center'},
                    {data: 'db_password',className:'text-center'},
                    {data: 'action',className:'text-center'},
                ], columnDefs: [
                    {
                        orderable: false,
                        targets:  "no-sort"
                    },
                    {
                        targets: 7,
                        createdCell: function (td, cellData, rowData) {
                            $(td).html(actions(rowData.action, 'offerTable'));
                        }
                    }
                ]
            })
        });
    </script>
@endsection
