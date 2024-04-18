<div>
    <div class="d-flex justify-content-center align-items-center ">
        <a href="{{ env('FACEBOOK') }}" class="icon mx-3">
            <i style="font-size: 60px;" class="fab fa-facebook"></i>
        </a>

        <a href="{{ env('TWITTER') }}" class="icon mx-3">
            <i style="font-size: 60px;" class="fab fa-twitter"></i>
        </a>

        <a href="{{ env('LINKEDIN') }}" class="icon mx-3">
            <i style="font-size: 60px;" class="fab fa-linkedin"></i>
        </a>

        <a href="{{ env('YOUTUBE') }}" class="icon mx-3">
            <i style="font-size: 60px;" class="fab fa-youtube"></i>
        </a>

        <a href="{{ env('INSTAGRAM') }}" class="icon mx-3">
            <i style="font-size: 60px;" class="fab fa-instagram"></i>
        </a>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center ">
    {{ config('app.address') }}
</div>
