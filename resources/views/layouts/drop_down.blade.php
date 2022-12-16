<div class="tab-links">
    <a href="#"  onclick="display1(this,'category')" class="tab tab-active"><i>Thể loại</i></a>
    <a href="#"  onclick="display1(this,'year')" class="tab"><i>Năm</i></a>
    <a href="#" onclick="display1(this,'loc')" class="tab"><i>Lọc phim</i></a>
    <a href="#" onclick="display1(this,'category')" class="tab"><i>Phim lẻ</i></a>
</div>

@php 
$listCategory = listCategory(); 

@endphp
<div class="tab-content">
    <div class="tab-item" id="category">
        @foreach ($listCategory as $category)  
            <a href="{{ route('category_filmlist_film_category', ['id' => $category->category_id]) }}">{{ $category->category_name }}</a>
        @endforeach
    </div>
    
    <div class="tab-item un_active" id="year"> 
        <a href="">Nam sdfs</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
    </div>

    <div class="tab-item un_active" id="loc"> 
        <a href="">loc</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
        <a href="">Phim Nhat Ban</a>
    </div>
</div>