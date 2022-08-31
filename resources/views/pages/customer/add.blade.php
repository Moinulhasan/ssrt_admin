@extends('layouts.base_layout',['pageTitle'=>'Customer', 'subTitle' => ['Customer','Add Customer List']])

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-header">
            <h3 class="mb-0 card-title">Add Offers</h3>
        </div>
        <div class="card-body">
            <form action="#" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">First Name</label>
                            <input name="name" id="name" placeholder="First name" type="text"
                                   class="form-control" value="{{old('name')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'name'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Surname</label>
                            <input name="surname" id="name" placeholder="Enter surname" type="text"
                                   class="form-control" value="{{old('surname')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'surname'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Email</label>
                            <input name="email" id="name" placeholder="Enter email" type="text"
                                   class="form-control" value="{{old('email')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'email'])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Company Name</label>
                            <input name="company" id="name" placeholder="Enter company name" type="text"
                                   class="form-control" value="{{old('surname')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'company'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Phone</label>
                            <input name="phone" id="name" placeholder="Enter phone" type="text"
                                   class="form-control" value="{{old('phone')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'phone'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Fax</label>
                            <input name="fax" id="name" placeholder="Enter phone" type="text"
                                   class="form-control" value="{{old('fax')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'fax'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Address</label>
                            <textarea name="address" id="" cols="15" rows="5"
                                      class="form-control">{{old('address')}}</textarea>
                            @include('components.utils.form_field_alert', ['name' => 'address'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="expire_from" class="">Start Subscription</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <div class="">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" name="start_sub"
                                   placeholder="MM-DD-YYYY" type="text" value="{{old('start_sub')}}"
                                   autocomplete="off">
                        </div>
                        @include('components.utils.form_field_alert', ['name' => 'start_sub'])
                    </div>
                    <div class="col-md-4">
                        <label for="expire_from" class="">End Subscription</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <div class="">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" name="end_sub"
                                   placeholder="MM-DD-YYYY" type="text" value="{{old('end_sub')}}"
                                   autocomplete="off">
                        </div>
                        @include('components.utils.form_field_alert', ['name' => 'end_sub'])
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Grace Period</label>
                            <input name="grace" id="name" placeholder="Enter grace period" type="text"
                                   class="form-control" value="{{old('grace')}}">
                            @include('components.utils.form_field_alert', ['name' => 'grace'])
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="examplePassword" class="">No Of Poss</label>
                        <div id="req_input">
                            <div
                                class="position-relative form-group d-flex justify-content-between denominations gap-2">
                                <input name="denomination[no][]" placeholder="Poss Number" type="number"
                                       class="form-control" required>
                                @include('components.utils.form_field_alert', ['name' => 'denomination.no.0'])

                                <input name="denomination[name][]" placeholder="Pos Name"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="denomination[id][]" placeholder="Hardware id"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="denomination[code][]" placeholder="Activation Code"
                                       type="text"
                                       class="form-control mx-3" required>
                                @include('components.utils.form_field_alert', ['name' => 'denomination.item.0'])

                                <a href="javascript:void(0)" id="addmore" class="btn btn-primary ml-3 w-100">Add
                                    more</a>
                            </div>
                            @include('components.utils.form_field_alert', ['name' => 'denomination_check'])
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#addmore").click(function () {
            let totalDenom = $('.denominations').length

            $("#req_input").append(`
                <div class="position-relative form-group d-flex justify-content-between denominations gap-2" id="denomination_${totalDenom}">
                       <input name="denomination[no][]" placeholder="Poss Number" type="number"
                                       class="form-control" required>
                     <input name="denomination[name][]" placeholder="Pos Name"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="denomination[id][]" placeholder="Hardware id"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="denomination[code][]" placeholder="Activation Code"
                                       type="text"
                                       class="form-control mx-3" required>
                    <input type="button" id="inputRemove" class="btn btn-danger ml-3 w-100" value="Remove" onclick="fnRemoveDenomination(${totalDenom})"/></div>
                </div>
            `);
        });
        function fnRemoveDenomination(row) {
            $('#denomination_' + row).remove();
        }
    </script>
@endsection
