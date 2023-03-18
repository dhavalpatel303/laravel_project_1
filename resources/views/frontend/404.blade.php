<!DOCTYPE html>
<html lang="en">
    @include('frontend.layout._top_bar')
    <body >
        {{-- @include('frontend.layout._header') --}}

        <section class="bg-white space" style="padding-top: 0px;padding-bottom:0px;">
            <div class="container">
                <div class="row mb-3 mb-xl-5">
                    <div class="col-xl-5">
                        <div class="mb-40 mb-xl-0"><img class="w-100" src="{{asset('front-assets/assets/img/team/team_details_1.png')}}" alt="team image" /></div>
                    </div>
                    <div class="col-xl-7 ps-3 ps-xl-5 align-self-center">
                        <div class="team-about">
                            <h2 class="team-about_title">Oops !</h2>
                            <h2 class="team-about_title"> Page Not Found</h2>
                            <p class="team-about_text">
                               Some Thing Wrong Please Try Again Later ! Click button Go To Home

                            </p>

                            <a href="{{route('home.index')}}" class="as-btn style-skew"><span class="btn-text">Home</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        {{-- @include('frontend.layout._footer') --}}

        <!-- Js Files End -->
    </body>


</html>
