<div class="widget">
    <ul class="social_icons rounded_social">
        @foreach (\App\Models\social::all() as $social)
            <li><a href="{{ $social->link }}" target="_blank" class="sc_{{ $social->type }}"><i
                        class="fab fa-{{ $social->type }}"></i></a></li>
        @endforeach
    </ul>
</div>
