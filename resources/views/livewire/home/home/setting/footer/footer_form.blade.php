<div class="widget" id="footer">
    @php
        if(isset(\App\Models\FooterlinkTitle::get()[3]))
        $footer_link_title = \App\Models\FooterlinkTitle::get()[3]
    @endphp
{{--    <h6 class="widget_title">{{ $footer_link_title->page->title }}--}}
{{--    </h6>--}}
    @php
    if(isset(\App\Models\footerTitle::get()[3]))
    $footer_title = \App\Models\footerTitle::get()[3]
    @endphp
{{--    <p>{{ $footer_title->title }}--}}
{{--    </p>--}}
    <div class="newsletter_form rounded_input">
        <form action="{{ route('post.newletter') }}" method="POST">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="ادرس ایمیل را وارد کن" required>
            <button type="submit" class="btn-send" name="submit" value="Submit"><i class="icon-envelope-letter"></i></button>
        </form>
    </div>
</div>

