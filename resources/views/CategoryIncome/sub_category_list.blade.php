@foreach($subcategoryiD as $subcategory)
    <ul class="list-group">
        <li class="list-group-item">{{$subcategory->name}}</li>
        @if(count($subcategory->subcategory))
            @include('CategoryIncome.sub_category_list',['$subcategoryiD' => $subcategory->subcategory])
        @endif
    </ul>
@endforeach
