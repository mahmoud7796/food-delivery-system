@extends('layouts.admin')

@section('content')


    ﻿ <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الطلبات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الطلبات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع طلبات الموقع </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead>
                                            <tr>
                                                <th>اسم المستخدم</th>

                                                <th>اسم العميل</th>
                                                <th>  بريد العميل</th>
                                                <th>  اسم دولة العميل</th>

                                                <th> رقم العميل</th>
                                                <th>عنوان العميل</th>

                                                <th>  مدينة العميل</th>
                                                <th> ملاحظات الطلب</th>
                                                <th> حالة  الطلب</th>

                                                <th>  العمليات</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($orders)
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order ->user->name??''}} </td>

                                                        <td>{{$order ->customer_name}} </td>
                                                        <td>
                                                            {{$order->customer_email}}
                                                        </td>
                                                        <td>
                                                            {{$order->customer_country}}
                                                        </td>

                                                        <td>
                                                            <a href="tel:">{{$order->customer_phone}}</a>
                                                        </td>
                                                        <td>
                                                            {{$order->customer_address}}
                                                        </td>
                                                        <td>
                                                            {{$order->customer_city}}
                                                        </td>
                                                        <td>
                                                            {{$order->order_note}}
                                                        </td>
                                                        <td>

                                                            @if($order->status=='pending')

                                                            @elseif($order->status=='processing')


                                                            @elseif($order->status=='completed')


                                                            @elseif($order->status=='declined')



                                                            @elseif($order->status=='on delivery')


                                                            @endif


                                                        </td>
                                                        <td style="width: 40%">
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.orders.edit', $order -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                            </div>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.orders.delete', $order -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>





@endsection
