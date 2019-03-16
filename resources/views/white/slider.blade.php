@if(isset($sliders) && $sliders)
    <div id="slider-flexslider" class="slider flexslider" style="width: 1200px; height: 400px;">
        <ul class="slides">
            @foreach($sliders as $slider)
                <li>
                    <img src="{{ asset(config('settings.theme')) }}/images/{{ $slider->img }}"
                         alt="{!! $slider->title !!}" title="{!! $slider->title !!}"/>
                    <div class="slider-caption caption-right">
                        <h2>{!! $slider->title !!}</h2>
                        <h4></h4>
                        <p>{!! $slider->desc !!}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#slider-flexslider.flexslider img.attachment-full').css('width', '1200px').css('height', '400px');

            var flex_caption_hide = function (slider) {
                var currSlideElement = slider;
                var caption_speed = 400;
                var width = parseInt($('.slider-caption', currSlideElement).outerWidth());
                var height = parseInt($('.slider-caption', currSlideElement).outerHeight());

                $('.caption-top', currSlideElement).animate({top: height * -1}, caption_speed);
                $('.caption-bottom', currSlideElement).animate({bottom: height * -1}, caption_speed);
                $('.caption-left', currSlideElement).animate({left: width * -1}, caption_speed);
                $('.caption-right', currSlideElement).animate({right: width * -1}, caption_speed);
            };

            var flex_caption_show = function (slider) {
                var nextSlideElement = slider;
                var caption_speed = 400;

                $('.caption-top', nextSlideElement).animate({top: 0}, caption_speed);
                $('.caption-bottom', nextSlideElement).animate({bottom: 0}, caption_speed);
                $('.caption-left', nextSlideElement).animate({left: 0}, caption_speed);
                $('.caption-right', nextSlideElement).animate({right: 0}, caption_speed);
            };

            $('#slider-flexslider.flexslider').flexslider({
                animation: 'fade',
                slideshowSpeed: 8000,
                animationSpeed: 800,
                pauseOnAction: false,
                controlNav: false,
                directionNav: true,
                touch: false,
                start: flex_caption_show,
                before: flex_caption_hide,
                after: flex_caption_show
            });
        });
    </script>
@endif