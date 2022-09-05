@foreach($subcategories as $subcategory)
    <ul>
        <li>{{$subcategory->name}}</li>
        @if(count($subcategory->subcategory))
            @include('CategoryExpense.sub_category_list',['subcategories' => $subcategory->subcategory])
        @endif
    </ul>
@endforeach
