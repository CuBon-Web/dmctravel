@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    {{ url('' . $banner[0]->image) }}
@endsection
@section('schema')
    <script type="application/ld+json">
{!! json_encode([
   '@context' => 'https://schema.org',
   '@type' => 'WebPage',
   'name' => $setting->company,
   'url' => url()->current(),
   'description' => $setting->webname,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('css')
    <style>
        .trv_hp5-slider .banner-desktop-only {
            display: block;
        }

        .trv_hp5-slider .banner-mobile-only {
            display: none;
        }

        @media (max-width: 767.98px) {
            .trv_hp5-slider .banner-desktop-only {
                display: none;
            }

            .trv_hp5-slider .banner-mobile-only {
                display: block;
            }
        }

        .trv-head-title.trv-head-title-star {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            text-align: center;
            line-height: 1.1;
            white-space: nowrap;
        }

        .trv-head-title-star .fav-top,
        .trv-head-title-star .fav-bottom {
            position: relative;
            z-index: 2;
            display: inline-block;
        }

        .trv-head-title-star .fav-star {
            position: relative;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #eef8f7;
            color: #FFAA0D;
            font-size: 15px;
            line-height: 1;
            box-shadow: 0 0 0 3px rgba(238, 248, 247, 0.95);
        }

        .trv-head-title-star .fav-star::before,
        .trv-head-title-star .fav-star::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 92px;
            height: 1px;
            transform: translateY(-50%);
            opacity: 0.7;
            pointer-events: none;
        }

        .trv-head-title-star .fav-star::before {
            right: calc(100% - 1px);
            background: linear-gradient(90deg, rgba(255, 170, 13, 0), rgba(255, 170, 13, 0.9), rgba(255, 170, 13, 0.35));
        }

        .trv-head-title-star .fav-star::after {
            left: calc(100% - 1px);
            background: linear-gradient(90deg, rgba(255, 170, 13, 0.35), rgba(255, 170, 13, 0.9), rgba(255, 170, 13, 0));
        }
    </style>
@endsection
@section('js')
    {{-- <script>
        $(function() {
            $(document).on('change', '.js-auto-filter', function() {
                $('#product-filter-form').submit();
            });
            $(document).on('click', '.trv-filter-btn[data-target]', function() {
                var target = $(this).attr('data-target');
                var $el = $('#' + target);
                if ($el.length) {
                    $el.slideToggle(150);
                }
            });
            $(document).on('click', '.js-reset-filter', function(e) {
                e.preventDefault();
                window.location.href = window.location.pathname;
            });
        });
    </script> --}}
@endsection
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">
        <div class="trv-hp5-bnr-wrap">
            <div class="trv-hp5-bnr-sec">
                <div class="swiper trv_hp5-slider">
                    <div class="swiper-wrapper">
                        @foreach ($banner as $item)
                        <div class="swiper-slide {{ (int) $item->status == 1 ? 'banner-desktop-only' : ((int) $item->status == 2 ? 'banner-mobile-only' : '') }}">
                            <div class="trv_d-slider-media">
                                <a href="{{$item->link}}">
                                    <img src="{{ url($item->image) }}" alt="Image">   
                                </a>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                
            </div>
        </div>
        <!-- Banner Style One -->
        
        <!-- Banner Style One End -->

        <!-- SEARCH BAR START-->
        <div class="trv-search-st1-wrap">
            <div class="trv-search-st1">
                <div class="trv-search-st1-bg">
                    <form id="product-filter-form" method="GET" action="{{ route('allProduct') }}">
                        <div class="trv-search-st1-column-wrap">
                            <div class="trv-search-st1-column">
                                <div class="form-group">
                                    <label><i><img loading="lazy" src="/frontend/images/icon1.png"
                                                alt="Image"></i>Địa điểm</label>
                                    <select class="form-select form-control js-auto-filter" aria-label="Default select example"
                                        name="cate_filter">
                                        <option value="">Tất cả</option>
                                        @foreach ($categoryhome as $item)
                                            <option value="{{ $item->slug }}" {{ request('cate_filter') == $item->slug ? 'selected' : '' }}>
                                                {{ languageName($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="trv-search-st1-column">
                                <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                    <label><i><img loading="lazy" src="/frontend/images/icon3.png"
                                                alt="Image"></i>Thời gian</label>
                                    <select class="form-select form-control js-auto-filter" aria-label="Default select example"
                                        name="duration_range">
                                        <option value="">Tất cả</option>
                                        <option value="1-3" {{ request('duration_range') == '1-3' ? 'selected' : '' }}>1-3 ngày</option>
                                        <option value="4-7" {{ request('duration_range') == '4-7' ? 'selected' : '' }}>4-7 ngày</option>
                                        <option value="8-11" {{ request('duration_range') == '8-11' ? 'selected' : '' }}>8-11 ngày</option>
                                        <option value="12-15" {{ request('duration_range') == '12-15' ? 'selected' : '' }}>12-15 ngày</option>
                                        <option value="16-20" {{ request('duration_range') == '16-20' ? 'selected' : '' }}>16-20 ngày</option>
                                        <option value="21-23" {{ request('duration_range') == '21-23' ? 'selected' : '' }}>21-23 ngày</option>
                                        <option value="24-27" {{ request('duration_range') == '24-27' ? 'selected' : '' }}>24-27 ngày</option>
                                        <option value="28-31" {{ request('duration_range') == '28-31' ? 'selected' : '' }}>28-31 ngày</option>
                                        <option value="32+" {{ request('duration_range') == '32+' ? 'selected' : '' }}>32+ ngày</option>
                                    </select>
                                </div>
                            </div>
                            @if (!empty($filter) && count($filter) > 0)
                                @foreach ($filter as $filterItem)
                                    @if (!empty($filterItem->tags) && count($filterItem->tags) > 0)
                                        <div class="trv-search-st1-column">
                                            <div class="form-group">
                                                <label><i><img loading="lazy" src="https://thewebmax.org/travlla/images/search-icon/icon2.png" alt="Image"></i>{{ languageName($filterItem->name) }}</label>
                                                <select class="form-select form-control js-auto-filter" aria-label="Default select example" name="fillter[]">
                                                    <option value="">Tất cả</option>
                                                    @foreach ($filterItem->tags as $tag)
                                                        <option value="{{ $tag->slug }}" {{ in_array($tag->slug, (array) request('fillter', [])) ? 'selected' : '' }}>
                                                            {{ languageName($tag->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
 
                            <div class="trv-search-st1-column-last">
                                <div class="trv-search-st1-search-btn">
                                    <button type="submit" class="srch-btn"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <!-- SEARCH BAR END-->

        <!--POPULAR DESTINATION SECTION START-->
        <div class="section-full p-t40 p-b40 trv-popular-destination tvr-hot-ballon-wrap"
            style="background-image: url(/frontend/images/Cloud-bg.png)">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head trv-head-title-wrap center-position">
                    <h2 class="trv-head-title trv-head-title-star">
                        <span class="fav-top site-text-yellow">Địa điểm </span>
                        <span class="fav-star" aria-hidden="true">&#9733;</span>
                        <span class="fav-bottom">nổi bật</span>
                    </h2>
                    <div class="trv-head-discription">Những điểm đến đáng để khám phá! Dưới đây là một vài địa điểm nổi tiếng.</div>
                    <div class="trv-head-title-image">
                        <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                    </div>
                </div>
                <!-- TITLE END-->

                <div class="section-content">

                    <div class="swiper trv-popular-destination-row trv-pop-des-st1-carousal swiper-nav-center-bottom">
                        <div class="swiper-wrapper">
                            @foreach ($categoryhome as $item)
                                <div class="swiper-slide">
                                    <div class="trv-destination-bx1">
                                        <div class="trv-media">
                                            <a href="{{route('allListProCate', ['danhmuc' => $item->slug])}}"><img loading="lazy" src="{{ $item->imagehome }}"
                                                    alt="Image"></a>
                                        </div>
                                        <div class="trv-content">
                                            <h3 class="trv-title"><a
                                                    href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                            </h3>
                                        </div>
                                        <div class="trv-on-hover">
                                            <img loading="lazy" src="/frontend/images/hotballon-right.png" alt="image">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>

            </div>


        </div>
        <!--POPULAR DESTINATION SECTION END-->
        <div class="section-full p-t60 p-b0 trv-tour-category-section" style="background-image: url(https://thewebmax.org/travlla/images/background/tour-bg.jpg);">
            <div class="container">
                <div class="trv-btm-title-section">
                    <span>DMC Service</span>
                    <h2 class="trv-btm-title-large">Dịch vụ tại DMC</h2>
                </div>
            </div>
            <div id="module">
                
                <div class="swiper trv-tr-cat-carousal">
                    <div class="swiper-wrapper">
                        @foreach ($servicecatehome as $item)
                        <div class="trv-cat-sld swiper-slide" data-title="{{languageName($item->name)}}">
                            <div class="trv-tr-cat-carousal-media">
                                <img src="{{$item->image}}" alt="Image">
                                <h3 class="trv-bx-title"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></h3>
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            

        </div>
        <div class="section-full trv-most-fav-tour-wrap">
         <div class="trv-most-fav-tour-mid">
             <div class="trv-most-fav-tour-top">
                 <div class="trv-most-fav-tour-t-left">
                     <div class="section-head trv-head-title-wrap left-position with-bg-dark">
                         <h2 class="trv-head-title"><span class="site-text-yellow">Địa điểm</span> nổi bật</h2>
                         <div class="trv-head-discription">Chọn địa điểm có thể làm bạn thích thú nhưng cũng có thể làm bạn băn khoăn với số lượng địa điểm tuyệt vời. Hãy đơn giản hóa việc chọn địa điểm bằng cách chọn địa điểm mà bạn muốn tham quan.</div>
                     </div>
                 </div>
                 <div class="trv-most-fav-title">
                     <span>Tour </span> 
                     nổi bật
                 </div>
             </div>

             <div class="trv-most-fav-tour-bot">
                 
                 <div class="trv-most-fav-tour-row">
                     <div class="swiper trv-mf-tour-carousal">
                         <div class="swiper-wrapper">
                           @foreach ($homePro as $item)
                           <div class="swiper-slide">
                               @include('layouts.product.item', ['pro' => $item])
                           </div>
                       @endforeach
                             
                         </div>
                         <div class="swiper-button-next"></div>
                         <div class="swiper-button-prev"></div>
                     </div> 
                 </div>

             </div>

             {{-- <div class="trv-most-fav-media">
                <img loading="lazy" src="/frontend/images/man-rock.png" alt="Image">
             </div> --}}
         </div>
     </div>
     {{-- {{dd($tagCate)}} --}}
     @foreach ($tagCate as $tagcate)
         @if (count($tagcate->product) > 0 && $tagcate->status == 1)
             <!--WE RECOMMEND SECTION START-->
        <div class="section-full p-t40 p-b0 trv-we-recommend">
         <div class="container-fluid">
             <!-- TITLE START-->
             <div class="section-head trv-head-title-wrap center-position">
                 <h2 class="trv-head-title"><span class="site-text-yellow"> {{($tagcate->name)}}</span> Tours!</h2>
                 <div class="trv-head-title-image">
                    <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                 </div>
             </div>
             <!-- TITLE END-->

             <div class="section-content">

                 <div class="swiper trv-popular-tours-row trv-tours-st1-carousal swiper-nav-center-bottom">
                     <div class="swiper-wrapper">
                         @foreach ($tagcate->product as $item)
                         {{-- {{dd($item->tags)}} --}}
                             <div class="swiper-slide">
                                 @include('layouts.product.item', ['pro' => $item, 'tagcateContext' => $tagcate])
                             </div>
                         @endforeach
                     </div>
                     <div class="swiper-button-next"></div>
                     <div class="swiper-button-prev"></div>
                 </div>

             </div>

         </div>

     </div>
     <!--WE RECOMMEND SECTION END-->
         @endif
     @endforeach
        

        <!-- CLIENT LOGO SECTION START -->
        <div class="section-full trv-client-section">
            <div class="trv-client-row">
                <div class="container">
                    <div class="section-content">
                        <div class="trv-client-carousel">
                            <div class="row">
                                <div class="col-xl-2 col-lg-12 col-md-12">
                                    <div class="trv-client-titlesection">
                                        <h2 class="trv-head-title"><span class="site-text-yellow">Đối tác
                                        </span> tin cậy</h2>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-12 col-md-12">
                                    <div class="owl-carousel home-client-carousel">
                                       @foreach ($partner as $item)
                                       <div class="item">
                                        <div class="ow-client-logo">
                                            <div class="client-logo client-logo-media">
                                                <a href="{{$item->link}}"><img loading="lazy" src="{{$item->image}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CLIENT LOGO  SECTION End -->


        <!--3 STEP SECTION START-->
        
        <!--3 STEP SECTION END-->

        <!--TESTIMONIAL SECTION START-->
        <div class="section-full trv-testimonial-st2-wrap tvr-hot-ballon-wrap">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head trv-head-title-wrap center-position">
                    <h2 class="trv-head-title"> <span class="site-text-yellow">Khách hàng </span>nói gì!</h2>
                    <div class="trv-head-discription">Một số đánh giá từ khách hàng gửi đến DMC , cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi.</div>
                    <div class="trv-head-title-image">
                        <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                    </div>
                </div>
                <!-- TITLE END-->
                <div class="section-content">
                    {{-- <div class="trv-gradi-text">
                        Testimonials
                        <img loading="lazy" src="/frontend/images/airplane-takeoff1.png" alt="Image">
                    </div> --}}
                    <div class="swiper trv-trv-t-monial-row trv-t-monial-carousal swiper-nav-center-bottom">
                        <div class="swiper-wrapper">
                            <!--BOX-1-->
                            @foreach ($ReviewCus as $item)
                            <div class="swiper-slide">
                                <div class="trv-testimo-bx1">
                                    {{-- <div class="media">
                                        <img src="{{$item->avatar}}" alt="image">

                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div> --}}
                                    <div class="info">
                                        <div class="trv-testimo-head">
                                            <div class="left-part">
                                                <h4 class="trv-testimonial-name">{{languageName($item->name)}}</h4>
                                                <span class="trv-testimonial-position">{{languageName($item->position) ?? 'Tourist'}}</span>
                                            </div>
                                            <div class="right-part">
                                                <img src="{{url('frontend/images/Quote.png')}}" alt="image">
                                            </div>
                                        </div>
                                        <p>
                                            {!!languageName($item->content)!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--TESTIMONIAL SECTION End-->

        <!--ALL BLOGS SECTION START-->
        <div class="trv-blog-all-style p-t40 p-b90">
            <div class="container">
                <!-- TITLE START-->
                <div class="row trv-column-style-head">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="section-head trv-head-title-wrap left-position">
                            <h2 class="trv-head-title">Tin tức<span class="site-text-yellow">  mới nhất</span></h2>
                        </div>
                    </div>
                </div>
                <!-- TITLE END-->

                <div class="section-content">

                    @php
                        $news = $hotnews->values();
                        $news1 = $news->get(0);
                        $news2 = $news->get(1);
                        $news3 = $news->get(2);
                        $news4 = $news->get(3);
                        $news5 = $news->get(4);
                        $news6 = $news->get(5);
                    @endphp
                    <div class="row d-flex justify-content-center">

                        <div class="col-xl-4 col-lg-6 col-md-6">
                            @if ($news1)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news1->slug]) }}"><img loading="lazy" src="{{ $news1->image }}"
                                                alt="{{ languageName($news1->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news1->created_at)->format('d') }}</span>{{ optional($news1->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news1->slug]) }}">{{ languageName($news1->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($news2)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news2->slug]) }}"><img loading="lazy" src="{{ $news2->image }}"
                                                alt="{{ languageName($news2->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news2->created_at)->format('d') }}</span>{{ optional($news2->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news2->slug]) }}">{{ languageName($news2->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($news3)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news3->slug]) }}"><img loading="lazy" src="{{ $news3->image }}"
                                                alt="{{ languageName($news3->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news3->created_at)->format('d') }}</span>{{ optional($news3->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news3->slug]) }}">{{ languageName($news3->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6">
                            @if ($news4)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news4->slug]) }}"><img loading="lazy" src="{{ $news4->image }}"
                                                alt="{{ languageName($news4->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news4->created_at)->format('d') }}</span>{{ optional($news4->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news4->slug]) }}">{{ languageName($news4->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if ($news5)
                                <div class="trv-blog-st2">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news5->slug]) }}"><img loading="lazy" src="{{ $news5->image }}"
                                                alt="{{ languageName($news5->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news5->created_at)->format('d') }}</span>{{ optional($news5->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news5->slug]) }}">{{ languageName($news5->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6">

                            @if ($news6)
                                <div class="trv-blog-st3">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news6->slug]) }}"><img loading="lazy" src="{{ $news6->image }}"
                                                alt="{{ languageName($news6->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news6->created_at)->format('d') }}</span>{{ optional($news6->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h3 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news6->slug]) }}">{{ languageName($news6->title) }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!--ALL BLOGS SECTION END-->


    </div>
    <!-- CONTENT END -->
@endsection
