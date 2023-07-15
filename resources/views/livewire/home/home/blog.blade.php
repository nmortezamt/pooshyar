        <!-- START SECTION BLOG -->
        <div class="section pb_20">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="heading_s1 text-center">
                            <h2>آخرین مقاله ها</h2>
                        </div>
                        <p class="leads text-center">متن تست .</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @forelse (\App\Models\article::where('status',1)->latest()->take(3)->get() as $article)
                    <div wire:key="{{ $article->id }}" class="col-lg-4 col-md-6">
                        <div class="blog_post blog_style2 box_shadow1">
                            <div class="blog_img">
                                <a href="{{route('article.single.index',$article->link)}}">
                                    <img src="/uploads/{{ $article->img }}" alt="{{ $article->title }}" class="resize_image">
                                </a>
                            </div>
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h5 class="blog_title"><a href="{{route('article.single.index',$article->link)}}">{{ $article->title }}</a></h5>
                                    <ul class="list_none blog_meta">
                                        <li><a><i class="ti-calendar"></i> {{\App\Models\persianNumber::translate( jdate($article->created_at)->format('%B %d ,%Y')) }}</a></li>
                                        <li><a><i class="ti-comments"></i>دیدگاه ({{ \App\Models\commentArticle::where([['status',1],['article_id',$article->id]])->count()}})</a></li>
                                    </ul>
                                    <div>
                                        {!! Str::limit($article->body, 100, '...') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
        <!-- END SECTION BLOG -->
