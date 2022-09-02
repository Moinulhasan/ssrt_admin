@extends('layouts.base_layout',['pageTitle'=>'Customer', 'subTitle' => ['Customer','Add Customer List']])

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-header">
            <h3 class="mb-0 card-title">Add Customer</h3>
        </div>
        <div class="card-body">
            <form action="{{route('customer.update',encrypt($content->id))}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">First Name</label>
                            <input name="name" id="name" placeholder="First name" type="text"
                                   class="form-control" value="{{$content->first_name,old('name')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'name'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Surname</label>
                            <input name="surname" id="name" placeholder="Enter surname" type="text"
                                   class="form-control" value="{{$content->surname,old('surname')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'surname'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Email</label>
                            <input name="email" id="name" placeholder="Enter password" type="text"
                                   class="form-control" value="{{$content->email,old('email')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'email'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Database Password</label>
                            <input name="password" id="name" placeholder="Enter email" type="password"
                                   class="form-control" value="{{$content->database_password,old('password')}}"
                                   required>
                            @include('components.utils.form_field_alert', ['name' => 'password'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Company Name</label>
                            <input name="company_name" id="name" placeholder="Enter company name" type="text"
                                   class="form-control" value="{{$content->company_name,old('company_name')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'company_name'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">ABN</label>
                            <input name="abn" id="name" placeholder="Enter ABN" type="text"
                                   class="form-control" value="{{$content->details->abn,old('abn')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'abn'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Phone</label>
                            <input name="phone" id="name" placeholder="Enter phone" type="text"
                                   class="form-control" value="{{$content->details->phone,old('phone')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'phone'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Fax</label>
                            <input name="fax" id="name" placeholder="Enter phone" type="text"
                                   class="form-control" value="{{$content->details->fax,old('fax')}}" required>
                            @include('components.utils.form_field_alert', ['name' => 'fax'])
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="expire_from" class="">Start Subscription</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <div class="">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" name="start_subscription"
                                   placeholder="MM-DD-YYYY" type="text"
                                   value="{{\Illuminate\Support\Carbon::parse($content->details->start_subscription)->format('d-m-Y'),old('start_subscription')}}"
                                   autocomplete="off">
                        </div>
                        @include('components.utils.form_field_alert', ['name' => 'start_subscription'])
                    </div>
                    <div class="col-md-4">
                        <label for="expire_from" class="">End Subscription</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <div class="">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" name="end_subscription"
                                   placeholder="MM-DD-YYYY" type="text"
                                   value="{{\Illuminate\Support\Carbon::parse($content->details->end_subscription)->format('d-m-Y'),old('end_subscription')}}"
                                   autocomplete="off">
                        </div>
                        @include('components.utils.form_field_alert', ['name' => 'end_subscription'])
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Grace Period</label>
                            <input name="grace" id="name" placeholder="Enter grace period" type="number"
                                   class="form-control" value="{{$content->details->grace,old('grace')}}" step="1"
                                   oninput="format(this)">
                            @include('components.utils.form_field_alert', ['name' => 'grace'])
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="font-weight-bold">Address</h5>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Line One</label>
                            <input name="line_one" id="name" placeholder="Enter level 1" type="text"
                                   class="form-control" value="{{$content->details->line_one,old('line_one')}}">
                            @include('components.utils.form_field_alert', ['name' => 'line_one'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Line Two</label>
                            <input name="line_two" id="name" placeholder="Enter level 2" type="text"
                                   class="form-control" value="{{$content->details->line_two,old('line_two')}}">
                            @include('components.utils.form_field_alert', ['name' => 'line_two'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Subrub</label>
                            <input name="subrub" id="name" placeholder="Enter subrub" type="text"
                                   class="form-control" value="{{$content->details->subrub,old('subrub')}}">
                            @include('components.utils.form_field_alert', ['name' => 'subrub'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">State</label>
                            <input name="state" id="name" placeholder="Enter state" type="text"
                                   class="form-control" value="{{$content->details->state,old('state')}}">
                            @include('components.utils.form_field_alert', ['name' => 'state'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="name" class="">Postcode</label>
                            <input name="postcode" id="name" placeholder="Enter postcode" type="text"
                                   class="form-control" value="{{$content->details->postcode,old('postcode')}}">
                            @include('components.utils.form_field_alert', ['name' => 'postcode'])
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="examplePassword" class="">No Of POS</label>
                        <div id="req_input">
                            @if(count($content->details->pos) > 0)
                                @foreach($content->details->pos as $pos)
                                   <div class="position-relative form-group d-flex justify-content-between denominations
                                    gap-2">
                                    <input name="pos[main][{{$loop->index }}][no]" placeholder="POS Number" type="number"
                                           class="form-control" value="{{$pos->	pos_no}}">
                                    @include('components.utils.form_field_alert', ['name' => 'pos.no.0'])

                                    <input name="pos[main][{{$loop->index }}][name]" placeholder="POS Name"
                                           type="text"
                                           class="form-control mx-3" value="{{$pos->pos_name}}">
                                    <input name="pos[main][{{$loop->index }}][id]" placeholder="Hardware id"
                                           type="text"
                                           class="form-control mx-3"  value="{{$pos->hardware_id}}">
                                    <input name="pos[main][{{$loop->index }}][code]" placeholder="Activation Code"
                                           type="text"
                                           class="form-control mx-3" value="{{$pos->activation_code}}">
                                    @include('components.utils.form_field_alert', ['name' => 'pos.code.0'])

                                    <a href="javascript:void(0)" id="addmore" class="btn btn-primary ml-3 w-100">Add
                                        more</a>
                        </div>
                        @endforeach
                        @else
                            <div
                                class="position-relative form-group d-flex justify-content-between denominations gap-2">
                                <input name="pos[main][0][no]" placeholder="POS Number" type="number"
                                       class="form-control">
                                @include('components.utils.form_field_alert', ['name' => 'pos.no.0'])

                                <input name="pos[main][0][name]" placeholder="POS Name"
                                       type="text"
                                       class="form-control mx-3">
                                <input name="pos[main][0][id]" placeholder="Hardware id"
                                       type="text"
                                       class="form-control mx-3">
                                <input name="pos[main][0][code]" placeholder="Activation Code"
                                       type="text"
                                       class="form-control mx-3">
                                @include('components.utils.form_field_alert', ['name' => 'pos.code.0'])

                                <a href="javascript:void(0)" id="addmore" class="btn btn-primary ml-3 w-100">Add
                                    more</a>
                            </div>
                        @endif
                        @include('components.utils.form_field_alert', ['name' => 'pos'])
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="name" class="">Note: </label>
                        <textarea name="note" id="" cols="15" rows="5"
                                  class="form-control">{{$content->note,old('note')}}</textarea>
                        @include('components.utils.form_field_alert', ['name' => 'note'])
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center mt-5">
                    <button class="btn btn-primary btn-block w-50">Save</button>
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
                       <input name="pos[main][${totalDenom}][no]" placeholder="POS Number" type="number"
                                       class="form-control" required>
                     <input name="pos[main][${totalDenom}][name]" placeholder="POS Name"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="pos[main][${totalDenom}][id]" placeholder="Hardware id"
                                       type="text"
                                       class="form-control mx-3" required>
                                <input name="pos[main][${totalDenom}][code]" placeholder="Activation Code"
                                       type="text"
                                       class="form-control mx-3" required>
                    <input type="button" id="inputRemove" class="btn btn-danger ml-3 w-100" value="Remove" onclick="fnRemoveDenomination(${totalDenom})"/></div>
                </div>
            `);
        });

        function fnRemoveDenomination(row) {
            $('#denomination_' + row).remove();
        }

        function format(input) {
            if (input.value < 0) input.value = Math.abs(input.value);
            if (input.value.length > 2) input.value = input.value.slice(0, 2);
            $(input).blur(function () {
                // if(input.value.length == 1) input.value=0+input.value;
                // if(input.value.length == 0) input.value='01';
                //* if you want to allow insert only 2 digits *//
            });
        }
    </script>
@endsection
