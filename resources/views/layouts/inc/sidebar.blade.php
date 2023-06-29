<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{ url('/home') }}" class="simple-text logo-normal">
            Mobile shop
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <p>Category</p>
            <li class="nav-item {{ Request::is('categories') ? 'active' : '' || Request::is('searchcategory') ? 'active': ''}} ">
                <a class="nav-link" href="{{ url('categories') }}">
                    <i class="material-icons">book</i>
                    <p>List Category</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-category') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-category') }}">
                    <i class="material-icons">add_box</i>
                    <p>Add Category</p>
                </a>
            </li>
            <p>Product</p>
            <li class="nav-item {{ Request::is('products') ? 'active' : '' || Request::is('searchproduct') ? 'active': ''}}  ">
                <a class="nav-link" href="{{ url('products') }}">
                    <i class="material-icons">content_paste</i>
                    <p>List Product</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-product') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-product') }}">
                    <i class="material-icons">add_circle_outline</i>
                    <p>Add Product</p>
                </a>
            </li>
            <p>Information</p>
            <li class="nav-item {{ Request::is('infor') ? 'active' : '' || Request::is('searchuser') ? 'active': ''}}">
                <a class="nav-link" href="{{url('infor')}}">
                    <i class="material-icons">person</i>
                    <p>List user</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('order') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('order')}}">
                    <i class="material-icons">format_list_numbered</i>
                    <p>List order</p>
                </a>
            </li>
        </ul>
    </div>
</div>
