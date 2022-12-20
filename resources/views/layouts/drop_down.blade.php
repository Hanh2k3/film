@php
    $listCategory = listCategory();
    $listYear = listYear();
    
@endphp

<div class="search-bar">
    <form action="{{ route('search_film') }}">
        <button><i class="ti-search"></i></button>
        <input type="text" name="key" id="" class="" placeholder="Search..." required>
    </form>
</div>
<div class="tab-links">
    <a href="#" onclick="display1(this,'category')" class="tab tab-active"><i>Thể loại</i></a>
    <a href="#" onclick="display1(this,'year')" class="tab"><i>Năm</i></a>
    <a href="#" onclick="display1(this,'loc')" class="tab"><i>Lọc phim</i></a>
    <a href="{{ route('category_filmlist_film_category', ['id' => 12]) }}" onclick="display1(this,'category')"
        class="tab"><i>Phim lẻ</i></a>
</div>


<div class="tab-content">
    <div class="tab-item" id="category">
        @foreach ($listCategory as $category)
            <a
                href="{{ route('category_filmlist_film_category', ['id' => $category->category_id]) }}">{{ $category->category_name }}</a>
        @endforeach
    </div>

    <div class="tab-item un_active" id="year">
        @foreach ($listYear as $item)
            <a href="{{ route('filter_by_year', ['year' => $item]) }}">{{ $item }} </a>
        @endforeach


    </div>

    <div class="tab-item un_active" id="loc">

    </div>
</div>
