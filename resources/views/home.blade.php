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
                 @include('about')
             </section>
            
            <!-- Contact Us -->
            <section id="contact">
                 @include('contact')
            </section>
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