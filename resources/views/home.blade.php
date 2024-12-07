@extends('template')

@section('content') 
<div class="container-fluid p-0">
    <div class="row"> 
        <div class="col">
            <!-- Background image -->
            <div class="container-1 d-flex align-items-center" style="
                background: linear-gradient(159deg, #DC2C7B -3.07%, #40240F 79.35%);
                width: 100%;
                height: 700px;">
                <div class="container text-white d-flex justify-content-between">
                    <!-- Left Column (Text Content) -->
                    <div class="col-md-5 d-flex align-items-center">
                        <div>
                            <h1 class="custom-h1">Order your favorite cake only at Cakey Wakey!</h1>
                            <p class="custom-p">Cakey Wakey provides all your favorite kinds of cakes. You can customize your own dream cake here!</p>
                            <button class="customize-button" onclick="location.href='/order'">Customize</button>
                        </div>
                    </div>

                    <!-- Right Column (Image) -->
                    <div class="col-md-6">
                        <img src="{{ asset('img/choco-cake-1.png') }}" alt="Cakes" class="img-fluid rounded">
                    </div>
                </div>
            </div>
            <!-- Background image -->


            <!-- Our Product -->
            <div class="container-1 d-flex align-items-center" style="background: #F39BC3; width: 100%; padding: 20px; padding-top: 80px; padding-bottom: 50px; align-self: center;">
                <div class="col">
                    <h1 class="our-product-h1">Our Products</h1>
                    <p class="custom-p" style="text-align: center;">
                        Indulge in the artistry and flavor of our cakes, crafted with care and passion. <br>
                        Each cake is made from the finest ingredients, ensuring every bite is a perfect blend of taste and texture.
                    </p>
                    <div class="gallery">
                        @foreach ($cakes as $cake)
                            <div class="card">
                                <img class="card-img-top" src="{{ $cake->image }}" alt="{{ $cake->name }}">
                                <div class="card-body">
                                    <div class="text-black">
                                        <h5 class="card-title">{{ $cake->name }}</h5>
                                        <p class="card-text">{{ number_format($cake->base_price, 2) }}</p>

                                        <!-- Add to Cart or Login Link -->
                                        @auth
                                            <form method="POST" action="{{ route('cart.addToCart') }}">
                                                @csrf
                                                <input type="hidden" name="cake_id" value="{{ $cake->cake_id }}">
                                                <button type="submit" class="btn btn-light">Add to Cart</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-light">Add to Cart</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Our Product -->

            <!-- About us -->
             <section id="about">
                 <div class="container-1 d-flex align-items-center" style="
                     background: #FCDDEC;
                     width: 100%;
                     padding: 20px;
                     padding-top: 80px;
                     padding-bottom: 50px;
                     align-self: center;">
                     <section id="about" class="py-2 py-md-5 overflow-hidden">
                         <div class="container">
                             <div class="row">
                                 <div class="col-md-7">
                                     <figure data-aos="slide-right" class="mt-5">
                                         <img src="{{ asset('img/highlight-1.jpg') }}" class="img-fluid" alt="Cakey Wakey Bakery">
                                     </figure>
                                 </div>
                                 <div class="col-md-5">
                                     <div class="m-2 p-2 m-md-5 p-md-5" data-aos="slide-left">
                                         <h2 class="display-5">Welcome to Cakey Wakey</h2>
                                         <p>At Cakey Wakey, we bring joy to every occasion with our fresh, delicious, and beautifully crafted cakes and treats. Our bakery is built on a passion for quality ingredients, attention to detail, and a love for creating smiles. Whether you're celebrating a birthday, wedding, or just want to treat yourself, Cakey Wakey has something for everyone.</p>
                                         <p>Step into our cozy bakery to experience the delightful aroma of freshly baked goodies and explore a world of flavors. Our team is here to make sure each visit is special, offering a wide range of cakes, cupcakes, cookies, and custom orders designed just for you.</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </section>
                 </div>
                 <!-- About us -->
             </section>
            
            <!-- Contact Us -->
            <div class="container-1 d-flex align-items-center" style="
                background: #FCDDEC;
                width: 100%;
                padding: 20px;
                padding-top: 80px;
                padding-bottom: 50px;
                align-self: center;">
                
            </div>
        </div> 
    </div> 
</div> 

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection