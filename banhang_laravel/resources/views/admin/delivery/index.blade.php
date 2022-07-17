@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Thêm phí vận chuyển
                </header>
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>{{session('message')}}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputPassword1">Thành phố</label>
                                <select class="form-control m-bot15 city choose" name="city" id="city">
                                    <option disabled selected >----Chọn tỉnh thành phố----</option>
                                    @foreach($city as $key => $cit)
                                    <option value="{{$cit->matp}}">{{$cit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="exampleInputPassword1">Quận</label>
                                <select class="form-control m-bot15 province choose" name="province" id="province">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phường</label>
                                <select class="form-control m-bot15 wards" name="wards" id="wards">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí vận chuyển</label>
                                <input type="text" class="form-control fee_ship"  placeholder="Phí vận chuyển..." value="{{old('fee_ship')}}" name="fee_ship" >
                            </div>

                            <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>


    </div>
    <div id="load_delivery">

    </div>
@endsection
