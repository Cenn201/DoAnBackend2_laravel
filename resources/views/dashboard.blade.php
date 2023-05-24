 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
     <!-- JavaScript Bundle with Popper -->
     <link rel="stylesheet" href="{{ asset ('/css/dashboard.css') }}">
     <link rel="stylesheet" href="{{ asset ('/css/index.css') }}">
     <link rel="stylesheet" href="{{ asset ('/css/style_cart.css') }}">
     <link rel="stylesheet" href="{{ asset ('/css/style_register.css') }}">
     <link rel="stylesheet" href="{{ asset ('/css/detail_product.css') }}">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
 </head>

 <body>
     <!-- Navigation -->
     <div class="container-fluid bg-dark" style="padding: 0; ">
         <div class="container-fluid bg-light" style="padding: 0; position: sticky;top: 0;left: 0;right: 0;">
             <nav class="navbar navbar-expand-lg">
                 <div class="container-fluid">
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="container collapse navbar-collapse" id="navbarSupportedContent">
                         <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center" style="display: contents;">
                             <li class="nav-item">
                                 <a class="nav-link active" aria-current="page" href="{{ route('userproduct.index') }}"> <i class="fa-solid fa-house-chimney"></i> Home</a>
                             </li>
                             <li class="btn-menu nav-item">
                                 <div class="about__box-content dropdown">
                                     <a href="" class="nav-link">Danh Mục</a>
                                     <div class="dropdown-content">
                                         @foreach($productTypes as $productType)
                                         <a href="{{ route('usercategoryProduct.index',['id'=>$productType->id]) }}">{{ $productType->tenloaisanpham}}</a>
                                         @endforeach
                                     </div>
                                 </div>
                             </li>
                             @guest
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('showLogin') }}">Đăng Nhập</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('showRegister') }}">Đăng Ký</a>
                             </li>
                             @else
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('usercarts.index') }}" name="cart">
                                     <i class="fa-solid fa-cart-shopping"></i>
                                     Giỏ Hàng
                                 </a>
                             </li>
                 
                             @if(!empty($user))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.show', $user->id) }}" name="cart" > <i class="fa-regular fa-user fa-2xl" ></i></a>
                                    </li>
                                    @endif
                            
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                             </li>
                             @endguest
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
     </div>
     <!-- <div class="container top-home is-flex ">
        <div class="menu-category-content">
            <div class="menu-category">
                <div class="menu-tree">
                    @foreach($productTypes as $productType)
                    <a href="">{{ $productType->tenLoaiSanPham}}</a>
                    @endforeach
                </div>
            </div>
            <div class="introductions"></div>
        </div>
     </div> -->
     @yield('content')
     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
     <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <script src="./public/js/app.js">
     </script>
 </body>

 </html>