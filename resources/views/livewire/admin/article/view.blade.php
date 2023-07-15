<div>
    @section('title',' نمایش مقاله')
    <div>
        <div class="main-content bg-white">
            <p> تاریخ ایجاد:{{ jdate($article->created_at)->format('%Y/%m/%d') }}</p>
            <br>
            <hr>
            <p> آخرین بروزرسانی:{{jdate( $article->updated_at)->format('%Y/%m/%d') }}</p>
            <br>
            <hr>
            عنوان مقاله :<h1>{{ $article->title }}</h1>
            <br>
            <hr>
            عکس مقاله:
            <br>
            <hr>
            <img src="/uploads/{{ $article->img }}" alt="" width="300px">
            <br>
            <hr>
            <div>
                متن مقاله:
                {!! $article->body !!}
            </div>
            <br>
            <hr>
            توضیح متا:
            {{ $article->description }}
            <br>
            <hr>
            کلمه کلیدی:
            {{ $article->keyword }}
        </div>
    </div>

</div>
