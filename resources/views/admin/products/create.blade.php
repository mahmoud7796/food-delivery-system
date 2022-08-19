@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة منتج </h4>
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
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.products.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data"
                                        >
                                            @csrf
                                            <input name="id" value="" type="hidden">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنتج </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتح</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="اسم المنتج"
                                                                   value="{{old('name')}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label> صوره المنتج </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label><br>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="projectinput1"> القسم الرئيسي </label>
                                                <select name="category_id" id="category_id" class="select2 form-control">
                                                    <optgroup label="من فضلك أختر القسم الرئيسى">
                                                        @if(\App\Models\Category::ParentCategory()-> count() > 0 )
                                                            @foreach(\App\Models\Category::ParentCategory()->get() as $mainCategory)
                                                                <option value="{{$mainCategory -> id}}"> {{$mainCategory ->name}} </option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="projectinput1"> القسم الفرعي </label>
                                                <select name="subcategory_id" id="subcategory_id"  class="select2 form-control">

                                                    <option selected disabled>اختر القسم الرئيسي اولا</option>

                                                </select>
                                            </div>


{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">صفات المنتج</label>--}}
{{--                                                <input type="text"--}}
{{--                                                       class="form-control"--}}
{{--                                                       placeholder="صفات المنتج"--}}
{{--                                                       value="{{old('attributes')}}"--}}
{{--                                                       name="attributes">--}}
{{--                                                @error("attributes")--}}
{{--                                                <span class="text-danger"> {{$message}}</span>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}


                                            <div class="form-group">
                                                <label for="projectinput1"> السعر السابق للمنتج</label>
                                                <input type="number"
                                                       class="form-control"
                                                       placeholder="السعر السابق للمنتج"
                                                       value="{{old('previous_price')}}"
                                                       name="previous_price">
                                                @error("previous_price")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="projectinput1"> سعر  المنتج</label>
                                                <input type="number"
                                                       class="form-control"
                                                       placeholder="سعر  المنتج"
                                                       value="{{old('price')}}"
                                                       name="price">
                                                @error("price")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="projectinput1">  التفاصيل</label>
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder=" التفاصيل"
                                                       value="{{old('details')}}"
                                                       name="details">
                                                @error("details")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> إضافة
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </section>
        <!-- // Basic form layout section end -->
    </div>
    </div>
    </div>

@endsection


@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    $('#category_id').change(function (){

         var id=$(this).val();
        $.ajax({
            type:'GET',
            url:"{{route('admin.getSubCategoryFromMain')}}",
            data:{
                id:id,
            },

            success:function(res){
                if(res['status']==true)
                {
                    console.log(res['html']);
               $('#subcategory_id').html(res['html']);
                }
                else if(res['status']==false)
                {

                    swal("  ", " يرجي اختيار قسم رئيسي اخر", "warning", {button: "حسناً",});

                }
            },
            error: function(data){
              location.reload();            }
        });


    });


    </script>


@endsection
