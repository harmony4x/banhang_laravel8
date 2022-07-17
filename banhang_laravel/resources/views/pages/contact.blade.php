@extends('layouts.app')
@section('content')
    <style>
        .lienhe h6 {
            margin-left: 14px;
            color: red;
            font-size: 21px;
        }
        .tus tr td {
            padding: 5px 10px;
        }
        .tus img {
            width: 20px;
        }
        .nu img {
            width: 140px;
        }
        .form tr td {
            padding: 5px;
        }
        .form tr td input {
            width: 240px;
            height: 46px;
            padding: 15px;
        }
        .form tr td button {
            padding: 6px 101px;
            background-color: red;
            border: none;
            color: white;
            font-weight: 700;
        }
    </style>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6">
                <div class="lienhe">
                    <h6>THÔNG TIN LIÊN HỆ</h6>

                    <table class="tus">
                        <tbody><tr>
                            <td> <img src="{{asset('pages/img/a.png')}}" alt=""> </td>
                            <td>160b8 Nguyễn Văn Cừ - Ninh Kiều - Cần Thơ</td>
                        </tr>
                        <tr>
                            <td><img src="{{asset('pages/img/f.png')}}" alt=""></td>
                            <td>0917138144</td>
                        </tr>
                        <tr>
                            <td><img src="{{asset('pages/img/s.png')}}" alt=""></td>
                            <td>charlenee282@gmail.com</td>
                        </tr>
                        <tr>
                            <td><img src="{{asset('pages/img/d.png')}}" alt=""></td>
                            <td>tiny.com</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="nu"><img src="{{asset('pages/img/u.png')}}" alt=""></td>

                        </tr>
                        </tbody></table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form">
                    <table>
                        <tbody><tr>
                            <td><input type="text" placeholder="Họ và tên"></td>
                            <td><input type="text" placeholder="Email"></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Số điện thoại"></td>
                            <td><input type="text" placeholder="Địa chỉ"></td>
                        </tr>
                        <tr>

                            <td colspan="2"> <textarea name="" placeholder="Lời nhắn" id="" cols="56" rows="4"></textarea> </td>
                            <td></td>
                        </tr>
                        <tr>

                            <td> <button>GỬI</button> </td>
                            <td></td>
                        </tr>

                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 40px; margin-bottom: 40px">
        <div class="row">
            <div class="col-md-12">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d62864.95798336422!2d105.73041250318552!3d10.011913267733973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d9.9801365!2d105.74685389999999!4m5!1s0x31a0881370ff432f%3A0x72dd112785a8e2c!2zMTYwIE5ndXnhu4VuIFbEg24gQ-G7qywgUGjGsOG7nW5nIEFuIEtow6FuaCwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!3m2!1d10.0398818!2d105.76099789999999!5e0!3m2!1svi!2s!4v1650700784273!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
