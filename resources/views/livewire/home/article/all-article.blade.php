<div>
<!-- START HEADER -->
@include('livewire.home.home.header')
<!-- END HEADER -->
<div class="main_content">
    <!-- START SECTION BLOG -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($articles as $article)
                        <div wire:key="{{ $article->id }}" class="col-xl-4 col-md-6">
                            <div class="blog_post blog_style2 box_shadow1">
                                <div class="blog_img">
                                    <a href="{{ route('article.single.index' , $article->link )}}">
                                        <img src="/uploads/{{ $article->img }}" alt="{{ $article->title }}" class="resize_image">
                                    </a>
                                </div>
                                <div class="blog_content bg-white">
                                    <div class="blog_text">
                                        <h6 class="blog_title"><a href="{{ route('article.single.index' , $article->link) }}">{{ $article->title }}</a></h6>
                                        <ul class="list_none blog_meta">
                                            <li><a><i class="ti-calendar"></i>{{\App\Models\persianNumber::translate( jdate($article->created_at)->format('%B %d , %Y')) }}</a></li>
                                            <li><a><i class="ti-comments"></i>{{ \App\Models\persianNumber::translate(\App\Models\commentArticle::where([['status',1],['article_id',$article->id]])->count())}}</a></li>
                                        </ul>
                                        <p>{!! Str::limit($article->body, 100, '...') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                    {{ $articles->links('livewire.home.paginate') }}
                </div>
                <div class="col-lg-3 mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">
                        {{-- <div class="widget">
                            <div class="search_form">
                                <form>
                                    <input required="" class="form-control" placeholder="Search..." type="text">
                                    <button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
                                        <i class="ion-ios-search-strong"></i>
                                    </button>
                                </form>
                            </div>
                        </div> --}}
                        <div class="widget">
                            <h5 class="widget_title">دسته بندی مقالات</h5>
                            <ul class="widget_archive">

                                @foreach (\App\Models\categoryArticle::where('status',1)->get() as $category)
                                @if($category->article)
                                <li><a href="{{ route('article.category.index', $category->link)}}">{{ $category->title }}</a></li>
                                @endif
                                @endforeach

                            </ul>
                        </div>
                        @php
                        $banner=\App\Models\specialDiscount::first();
                        @endphp
                        @if (isset($banner) && $banner->status ==1)
                        <div class="widget">
                            <div class="shop_banner">
                                <div class="banner_img overlay_bg_20">
                                    <img src="/uploads/{{ $banner->img }}" alt="{{ $banner->title }}">
                                </div>
                                <div class="shop_bn_content2 text_white">
                                    <h5 class="text-uppercase shop_subtitle">تخفیف ویژه</h5>
                                    <h3 class="text-uppercase shop_title">{{ $banner->title }}</h3>
                                    <a href="{{ $banner->link }}" class="btn btn-white rounded-0 btn-sm text-uppercase">خرید</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BLOG -->
    </div>
</div>