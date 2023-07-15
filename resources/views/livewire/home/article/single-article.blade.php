<div>
<!-- START HEADER -->
@include('livewire.home.home.header')
<!-- END HEADER -->
<div class="main_content">
    @section('title','جزئیات')
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="single_post">
                            <h1 class="blog_title">{{ $article->title }}</h1>
                            <ul class="list_none blog_meta">
                                <li><a><i class="ti-calendar"></i> {{\App\Models\persianNumber::translate( jdate($article->created_at)->format('%B %d , %Y'))}}</a></li>
                                <li><a href="#comment"><i class="ti-comments"></i> نظرات ({{\App\Models\persianNumber::translate( $comments )}})</a></li>
                            </ul>
                            <div class="blog_img">
                                <img src="/uploads/{{ $article->img }}" alt="{{ $article->title }}">
                            </div>
                            <div class="blog_content">
                                <div class="blog_text">
                                    {!! $article->body !!}
                                    <div class="blog_post_footer">
                                        <div class="row justify-content-between align-items-center">
                                            {{-- <div class="col-md-8 mb-3 mb-md-0">
                                                <div class="tags">
                                                    <a href="#">General</a>
                                                    <a href="#">Design</a>
                                                    <a href="#">jQuery</a>
                                                    <a href="#">Branding</a>
                                                    <a href="#">Modern</a>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <ul class="social_icons text-md-right">

                                                    <li><a href="https://telegram.me/share/url?url={{ route('article.single.index',$article->link) }}" class="sc_telegram"><i
                                                    class="fab fa-telegram"></i></a></li>

                                                    <li><a href="https://www.instagram.com/?url={{ route('article.single.index',$article->link) }}" class="sc_instagram"><i
                                                    class="fab fa-instagram"></i></a></li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post_navigation bg_gray">
                            <div class="row align-items-center justify-content-between p-4">
                                <div class="col-5">
                                    <a wire:click='nextPost({{ $article->id }})'>
                                        <div class="post_nav post_nav_prev">
                                            <i class="ti-arrow-left"></i>
                                            <span>پست بعدی</span>
                                        </div>

                                    </a>

                                </div>
                                {{-- <div class="col-2">
                                    <a href="#" class="post_nav_home">
                                        <i class="ti-layout-grid2"></i>
                                    </a>
                                </div> --}}
                                <div class="col-5">
                                    <a wire:click='previousPost({{ $article->id }})'>
                                        <div class="post_nav post_nav_next">
                                            <i class="ti-arrow-right"></i>
                                            <span>پست قبلی</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card post_author">
                            <div class="card-body">
                                <div class="author_img">
                                    <img src="assets/images/user1.jpg" alt="user1">
                                </div>
                                <div class="author_info">
                                    <h6 class="author_name"><a href="#" class="mb-1 d-inline-block">Maria Redwood</a>
                                    </h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                        <br>
                        <div class="related_post">
                            <div class="content_title">
                                <h5>پست های مرتبط</h5>
                            </div>
                            <div class="row">
                                @forelse (\App\Models\article::where('category_article_id',$category->id)->where('id','!=',$article->id)->where('status',1)->take(4)->get() as $related)
                                <div wire:key="{{ $related->id }}" class="col-md-6">
                                    <div class="blog_post blog_style2 box_shadow1">
                                        <div class="blog_img">
                                            <a href="{{ route('article.single.index' , $related->link )}}">
                                                <img src="/uploads/{{ $related->img }}" alt="{{ $related->title }}" class="resize_image">
                                            </a>
                                        </div>
                                        <div class="blog_content bg-white">
                                            <div class="blog_text">
                                                <h5 class="blog_title"><a href="{{ route('article.single.index' ,$related->link )}}">{{ $related->title }}</a></h5>
                                                <ul class="list_none blog_meta">
                                                    <li><a><i class="ti-calendar"></i>{{ jdate($related->created_at)->format('%B %d ,%Y') }}</a>
                                                    </li>
                                                    <li><a><i class="ti-comments"></i>نظرات ({{ $comments}}) </a></li>
                                                </ul>
                                                <p>{{ Str::limit($related->description, 50, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty

                                @endforelse

                                {{-- <div class="col-md-6">
                                    <div class="blog_post blog_style2 box_shadow1">
                                        <div class="blog_img">
                                            <a href="blog-single.html">
                                                <img src="assets/images/blog_small_img3.jpg" alt="blog_small_img3">
                                            </a>
                                        </div>
                                        <div class="blog_content bg-white">
                                            <div class="blog_text">
                                                <h5 class="blog_title"><a href="blog-single.html">Why is a ticket to Lagos
                                                        so expensive?</a></h5>
                                                <ul class="list_none blog_meta">
                                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a>
                                                    </li>
                                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                                </ul>
                                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure
                                                    there isn't anything embarrassing hidden in the middle of text</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @include('livewire.home.article.content.comment')
                    </div>
                    @include('livewire.home.article.content.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
