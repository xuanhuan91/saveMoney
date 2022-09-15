@foreach($subcategories as $subcategory)
    <ul class="list-group">
        <li class="list-group-item">{{$subcategory->name}}</li>
        @if(count($subcategory->subcategory))
            @include('CategoryExpense.sub_category_list',['subcategories' => $subcategory->subcategory])
        @endif
    </ul>
@endforeach
