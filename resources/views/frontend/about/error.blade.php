<!DOCTYPE html>
<html lang="en">
    @include('frontend.layout._top_bar')

    <body>


        <div class="four-not-four-section bg--gray ">
            
            <div class="four-not-four-item text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                <div class="four-not-four-thumb">
                    <a href="{{route('home.index')}}"><img src="{{asset('front-assets/assets/img/error.png')}}" alt="404" style="height:500px"></a>
                    
                </div>
                
            </div>
        </div>

    </body>


</html>
