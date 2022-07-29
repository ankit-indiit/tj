<form action="{{ route('search') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <div class="input-group-prepend main-div-serch">
            <select class="form-control form-control-lg" name="search_option">
                <option value="all">All</option>
                <option value="category">Category</option>
                <option value="product">Product</option>
                <option value="people">People</option>
            </select>
            <input value="" type="text" class="form-control" name="search" placeholder="Search Here.." autocomplete="off">
            <div class="input-group-append">
                <i class="uil-search-alt"></i>
            </div>
        </div>
    </div>
</form>