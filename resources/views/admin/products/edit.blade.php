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
                                <li class="breadcrumb-item active"> تعديل منتج
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل منتج </h4>
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
                                              action="{{route('admin.products.update',$product->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data"
                                        >
                                            @csrf
                                            <input name="id" value="{{$product -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{asset($product->photo)}}"
                                                        class="rounded-circle  height-150" alt="صورة القسم  ">
                                                </div>
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنتج </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتح</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="اسم المنتج"
                                                                   value="{{$product->name}}"
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
                                                <select name="category_id" class="select2 form-control">
                                                    <optgroup label="من فضلك أختر القسم الرئيسى">
                                                        @if(\App\Models\Category::ParentCategory()-> count() > 0 )
                                                            @foreach(\App\Models\Category::ParentCategory()->get() as $mainCategory)
                                                                <option @if($mainCategory->id==$product->category_id)  selected  @endif value="{{$mainCategory -> id}}"> {{$mainCategory ->name}} </option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="projectinput1"> القسم الفرعي </label>
                                                <select name="subcategory_id" class="select2 form-control">
                                                    <optgroup label="من فضلك أختر القسم الفرعي">
                                                        @if(\App\Models\Category::where('parent_id','!=','') -> count() > 0 )
                                                            @foreach(\App\Models\Category::where('parent_id','!=','')->get() as $subCategory)
                                                                <option @if($subCategory->id==$product->subcategory_id)  selected  @endif value="{{$subCategory -> id}}"> {{$subCategory -> name}} </option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="projectinput1">صفات المنتج</label>
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="صفات المنتج"
                                                       value="{{$product->attributes}}"
                                                       name="attributes">
                                                @error("attributes")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="projectinput1"> السعر السابق للمنتج</label>
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="السعر السابق للمنتج"
                                                       value="{{$product->previous_price}}"
                                                       name="previous_price">
                                                @error("previous_price")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="projectinput1"> سعر  المنتج</label>
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="سعر  المنتج"
                                                       value="{{$product->price}}"
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
                                                       value="{{$product->details}}"
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
                                                    <i class="la la-check-square-o"></i> تعديل
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
