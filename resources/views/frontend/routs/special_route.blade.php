<!DOCTYPE html>
<html lang="en">


    @include('frontend.layout._top_bar')
    <body>
        @include('frontend.layout._header')
        <main class="main">
            <div class="wrap">
                <div class="row">
                    <div class="full-width">
                        <?php for($i=0;$i<count($oneway_detail_uniq);$i++) {?>
                            <?php for($j=0;$j<count($pickupcity_id);$j++) {?>

                                 <?php if($oneway_detail_uniq[$i]['pcity_id'] == $pickupcity_id[$j]['id'])   {?>
                        <header class="s-title">
                                <h2>Cab From <span style="color: #5fc8c2"><?=$pickupcity_id[$j]['pick_city']?></span></h2>
                        </header>

                        <div class="destinations">
                            <div class="row">
                                <?php for($m=0;$m<count($oneway_detail_uniq_all);$m++) {?>


                                    <?php  if($oneway_detail_uniq_all[$m]['pcity_id'] == $pickupcity_id[$j]['id']){?>
                                <article class="one-fourth">
                                    <figure><a href="#" title=""><img src="images/uploads/paris.jpg" alt=""></a></figure>
                                    <div class="details" style="padding: 5px 12px 15px;">

                                        <h3 style="padding: 0 0px 5px 0;font-size:16px;"><?=$oneway_detail_uniq_all[$m]['pick_city']?> To <?=$oneway_detail_uniq_all[$m]['drop_city']?> Cab</h3>

                                        <span class="count" style="font-size: 18px;font-weight:900">Rs.{{$oneway_detail_uniq_all[$m]['total_amount']}}/-</span>

                                        <a href={{ route('cab_result.routes', ['pick_city' => $oneway_detail_uniq_all[$m]['pick_city'],'drop_city'=>$oneway_detail_uniq_all[$m]['drop_city']]) }}  type = "submit" title="View all" class="gradient-button root_button mt-30" style="margin-top:-20px;"><span style="font-size: 12px;">Book Now</span></a>
                                    </div>
                                </article>

                                <?php }} ?>

                            </div>
                        </div>
                        <?php }}}?>
                        <!--//top destinations-->
                    </div>
                </div>
            </div>
        </main>
        @include('frontend.layout._footer')

        <!-- Js Files End -->
    </body>


</html>
