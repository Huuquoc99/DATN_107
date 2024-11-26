@extends('client.layouts.master')

@section('content')
<main class="container">
    <h1 style="text-transform: uppercase;
    font-weight: 900;
    border-left: 10px solid #fec500;
    padding-left: 10px;
    margin: 30px 0">Voucher</h1>
    <div class="row list-vouchers">
        @foreach($vouchers as $voucher)
            <div class="col-6 col-md-6 col-lg-6 voucher">
                <div class="d-flex item">
                    <div class="col-3 col-md-3 col-lg-3 col-sm-3 col-xs-3 head">
                        <div class="left"></div>
                        <div class="voucher-logo"> {{number_format($voucher['discount']/1000)}}K</div>
                    </div>
                    <div class="col-9 col-md-9 col-lg-9 col-sm-9 col-xs-9 content">
                        <div class="redirect">
                        </div>
                        <div class="item-name">{{ $voucher['code'] }}</div>
                        <div>
                            <div class="progress" style="height:10px; background-color: #e1e1e1; margin: 17px 0;">
                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                                     aria-valuenow="{{floor($voucher['used_quantity']/$voucher['quantity']*100)}}" aria-valuemin="1" aria-valuemax="100" style="width: {{floor($voucher['used_quantity']/$voucher['quantity']*100)}}%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 col-md-9 col-lg-9 col-sm-9 col-xs-8  expire-date">
                                {{ (floor($voucher['used_quantity']/$voucher['quantity']*100) != 100) ? 'Đã dùng ' . floor($voucher['used_quantity']/$voucher['quantity']*100) . '%' : '' }}
                            </div>
                            <div class="expire-date">Hết hạn ngày: {{date('Y-m-d', strtotime($voucher['expiration_date']))}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
    <style>

        .list-vouchers {
            padding: 15px 0;
        }
        .list-vouchers button {
            border: none;
        }
        .list-vouchers .voucher {
            height: 120px;
            padding-right: 0;
            margin-bottom: 15px;
        }
        .list-vouchers .voucher .item {
            height: 100%;
            box-shadow: 0.125rem 0.125rem 0.3125rem rgba(0, 0, 0, 0.07);
        }
        .list-vouchers .voucher .head {
            background-color: #0975b4;
            position: relative;
        }
        .list-vouchers .voucher .head .voucher-logo {
            text-align: center;
            font-weight: bold;
            font-family: fantasy;
            color: white;
            position: absolute;
            font-size: 45px !important;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .list-vouchers .voucher .head .left {
            position: absolute;
            top: 0.3125rem;
            left: -4px;
            width: 0.25rem;
            height: calc(100% - 0.4375rem);
            background: radial-gradient(circle at 0 0.25rem, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, 0) 0.1875rem, #0975b4 0);
            background-size: 0.25rem 0.625rem;
            background-repeat: repeat-y;
        }
        .list-vouchers .voucher .head .left::before {
            content: "";
            top: -5px;
            position: absolute;
            width: 100%;
            height: 5px;
            background-color: #0975b4;
        }
        .list-vouchers .voucher .head .left::after {
            content: "";
            bottom: -2px;
            position: absolute;
            width: 100%;
            height: 4px;
            background-color: #0975b4;
        }
        .list-vouchers .voucher .content {
            border: 1px solid #cbcbcb;
            padding: 10px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            background-color: white;
        }
        .list-vouchers .voucher .content .redirect {
            text-align: end;
        }
        .list-vouchers .voucher .content .redirect a {
            color: #f26c4d;
        }
        .list-vouchers .voucher .content .item-name {
            font-size: 26px;
            font-weight: bold;
        }
        .list-vouchers .voucher .content .price-sale {
            padding: 10px 15px;
        }
        .list-vouchers .voucher .content .price-sale p {
            width: fit-content;
            border: 1px solid #f26c4d;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 13px;
            color: #f26c4d;
        }
        .list-vouchers .voucher .content .voucher-action {
            padding: 7px 15px;
            text-align: end;
        }
        .list-vouchers .voucher .content .voucher-action .save-voucher {
            min-width: 80px;
            line-height: 23px;
            background-color: #f26c4d;
            border-radius: 3px;
            color: white;
        }
        .list-vouchers .voucher .content .voucher-action a {
            width: fit-content;
            border: 1px solid #f26c4d;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 13px;
            color: #f26c4d;
        }
        .list-vouchers .voucher .content .expire-date {
            color: #f26c4d;
        }
        .list-vouchers .voucher .content .condition a {
            color: #00546f;
        }

        .voucher-wallet {
            max-width: 1000px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #voucher_detail .modal-dialog {
            width: 25rem;
            height: 40rem;
        }
        #voucher_detail .modal-dialog .modal-content {
            height: 100%;
            border-radius: 0;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body {
            height: 100%;
            padding: 0;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head {
            height: 20%;
            padding: 0 15px;
            background-image: url("../images_v2021/rainbow.jpg");
            position: relative;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head .voucher {
            padding-right: 15px;
            position: absolute;
            bottom: -45px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head .voucher .content {
            background-color: white;
            height: 100%;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head .voucher .content .item-name {
            font-size: 14px;
            height: 40%;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head .voucher .content .price-sale {
            height: 40%;
            padding: 10px 0;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-head .voucher .content .price-sale p {
            font-size: 10px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content {
            overflow: auto;
            height: 67%;
            margin-top: 30px;
            padding: 0 15px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content::-webkit-scrollbar {
            background-color: #F5F5F5;
            border-radius: 10px;
            width: 6px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.44, #cfd0d2), color-stop(0.72, #a4a8ac), color-stop(0.86, #848586));
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content label {
            font-size: 16px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content p {
            font-size: 14px;
            color: #8b8d8f;
            line-height: 20px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-content div {
            margin: 15px 0;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-foot {
            padding: 0 15px;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-foot button {
            width: 100%;
            line-height: 35px;
            background-color: #f26c4d;
            border: none;
            border-radius: 3px;
            color: white;
        }
        #voucher_detail .modal-dialog .modal-content .modal-body .voucher-foot button:hover {
            background-color: #e7674d;
        }

        .cart-voucher {
            bottom: -45px !important;
        }

        .unica-about-block-5 .custom-text, .unica-about-block-6 .custom-text {
            line-height: 25px;
            text-align: justify;
        }

        .box-about-bot {
            min-height: 360px !important;
        }

        @keyframes myfirst {
            0% {
                left: 10%;
                top: 85%;
            }
            100% {
                left: 80%;
                top: 85%;
            }
        }
        @font-face {
            font-family: certificateFullName;
            src: url(../../fonts/UTMFrenchVanilla.ttf);
        }
        @font-face {
            font-family: certificateCourseName;
            src: url(../../fonts/SVN-NEXABOLD.TTF);
        }
        @media (max-width: 992px) {
            .preview-certificate-full-name {
                top: 36%;
                font-size: 40px;
            }
            .preview-certificate-course-name {
                font-size: 15px;
            }
            .preview-certificate-number {
                font-size: 11px;
            }
        }
        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }
        }
        @media (min-width: 375px) {
            .list-vouchers .voucher {
                height: 150px;
            }
            .expire-date {
                font-size: 14px;
            }
        }
    </style>
@endsection