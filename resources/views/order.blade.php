@extends('template') 

@section('content') 
<div class="container order-page">
    <h1>Order Your Custom Cake</h1>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('order.store') }}">
        @csrf
        <!-- Cake Type Section -->
        <div class="mb-4">
            <h5 class="mb-3">Select Cake Type:</h5>
            <div class="row">
                @foreach ($cakes as $cake)
                    <div class="col-md-4 mb-4">
                        <div 
                            class="card h-100 cake-card" 
                            style="cursor: pointer;" 
                            onclick="selectCard('cake{{ $cake->cake_id }}', 'cake-card')">
                            <div class="card-body text-center">
                                <!-- Cake Name -->
                                <h5 class="card-title">{{ $cake->name }}</h5>
                                <!-- Cake Description -->
                                <h6 class="card-subtitle mb-2 text-muted">{{ $cake->description }}</h6>
                                <!-- Cake Price -->
                                <p class="card-text mt-3">IDR {{ number_format($cake->base_price) }}</p>
                                <!-- Hidden Radio Input -->
                                <div class="form-check d-none">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="cake_id"
                                        id="cake{{ $cake->cake_id }}"
                                        value="{{ $cake->cake_id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Customization Level Section -->
        <div class="mb-4">
            <h5 class="mb-3">Customization Level:</h5>
            <div class="row">
                @foreach ($levels as $level)
                    <div class="col-md-4 mb-4">
                        <div 
                            class="card h-100 level-card" 
                            style="cursor: pointer;" 
                            onclick="selectCard('level{{ $level->level_id }}', 'level-card')">
                            <div class="card-body text-center">
                                <!-- Level Name -->
                                <h5 class="card-title">{{ $level->name }}</h5>
                                <!-- Level Description -->
                                <h6 class="card-subtitle mb-2 text-muted">{{ $level->description }}</h6>
                                <!-- Level Price -->
                                <p class="card-text mt-3">+ IDR {{ number_format($level->price) }}</p>
                                <!-- Hidden Radio Input -->
                                <div class="form-check d-none">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="level_id"
                                        id="level{{ $level->level_id }}"
                                        value="{{ $level->level_id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        @auth
            <!-- Button is enabled for logged-in users -->
            <button type="submit" class="customize_button">Order Now</button>
        @endauth

        @guest
            <!-- Button is disabled and shows a login prompt for guests -->
            <a href="{{ route('login') }}" type="submit" class="customize_button">
                Log in to Order
            </a>
        @endguest
    </form>
</div>

<script>
    // JavaScript to manage selection state for cards
    function selectCard(inputId, cardClass) {
        // Clear previous selection
        document.querySelectorAll(`.${cardClass}`).forEach(card => {
            card.classList.remove('selected');
        });

        // Mark the selected card
        document.getElementById(inputId).checked = true;
        document.querySelector(`#${inputId}`).closest('.card').classList.add('selected');
    }
</script>
@endsection