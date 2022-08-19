<option selected disabled>اختر القسم الفرعي الان</option>
@foreach($subcategories as $category )
    <option value="{{$category->id}}">{{$category->name}}</option>
@endforeach




