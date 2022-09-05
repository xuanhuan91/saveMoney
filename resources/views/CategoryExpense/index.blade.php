@foreach($parentCategories as $parentCategory)
    <ul>
        <li><a href="{{ action('App\CategoryExpenseController@edit',$parentCategory->id) }}">{{$parentCategory->name}}</a></li>
        @if(count($parentCategory->subcategory))
            @include('CategoryExpense.sub_category_list',['subcategories' => $parentCategory->subcategory])
        @endif
    </ul>
@endforeach
