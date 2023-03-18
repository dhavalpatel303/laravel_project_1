
    {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#pickupcity_id').prepend('<option value="" selected disabled>Select Pick City</option>');
        });
    </script> --}}


    {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#pickupcity_id').prepend('<option value="" selected disabled>Select Pickup City</option>');
        });
    </script> --}}
      {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#pickcity_id').prepend('<option value="" selected disabled>Select Pickup City</option>');
        });
    </script> --}}
         {{-- <script type="text/javascript">
            $( document ).ready(function() {
                $('#pickcity_id_roundtrip').prepend('<option value="" selected disabled>Select Pickup City</option>');
            });
        </script> --}}

     <script>
        $(function() {

            $('#local_content').hide();
            $('#round_content').hide();
            $('#round_details').hide();

            $('#local_dropcity').hide();
            $('#round_dropcity').hide();

            $('#local_cab').hide();
            $('#round_cab').hide();

            $('#local_gross').hide();
            $('#round_gross').hide();

            $('#local_dis').hide();
            $('#round_dis').hide();

            $('#local_total').hide();
            $('#round_total').hide();

            $('#local_extra').hide();
            $('#round_extra').hide();
            $('#journy').hide();



     });

    </script>
    <script>
        $("#pickupcity_id").change(function(){
            if($("#pickupcity_id").val()==null)
            {
                $("#pickcity").show();
            }
            else{
                $("#pickcity").hide();
            }

        });
        $("#pickcity_id").change(function(){
        if($("#pickcity_id").val()==null)
        {
            $("#pickcity_local").show();
        }
        else{
            $("#pickcity_local").hide();
        }

        });
        $("#pickcity_id_roundtrip").change(function(){
        if($("#pickcity_id_roundtrip").val()==null)
        {
            $("#pickcity_round").show();
        }
        else{
            $("#pickcity_round").hide();
        }

        });

     $("#dropcity_id").change(function(){
        if($("#dropcity_id").val()=='select_drop')
        {
            $("#dropcity_error").show();
        }
        else{
            $("#dropcity_error").hide();
        }
        // $("#dropcity_error").hide();
     });
     $("#package_id").change(function(){
        if($("#package_id").val()=='select_drop')
        {
            $("#dropcity_local").show();
        }
        else{
            $("#dropcity_local").hide();
        }
        // $("#dropcity_error").hide();
     });
     $("#journy_days").change(function(){
        if($("#journy_days").val()=='select_drop')
        {
            $("#j_days").show();
        }
        else{
            $("#j_days").hide();
        }
        // $("#dropcity_error").hide();
     });
     $("#travel_cities1").change(function(){
        if($("#travel_cities1").val()=='')
        {
            $("#travel_error").show();
        }
        else{
            $("#travel_error").hide();
        }
        // $("#dropcity_error").hide();
     });
     $("#cab_type").change(function(){
        if($("#cab_type").val()=='select_cab')
        {
            $("#cab").show();
        }
        else{
            $("#cab").hide();
        }
        // $("#cab").hide();
     });
     $("#localcab_type").change(function(){
        if($("#localcab_type").val()=='select_cab')
        {
            $("#local_cab_erorr").show();
        }
        else{
            $("#local_cab_erorr").hide();
        }
        // $("#cab").hide();
     });
     $("#roundcab_type").change(function(){
        if($("#roundcab_type").val()=='select_cab')
        {
            $("#round_cab_erorr").show();
        }
        else{
            $("#round_cab_erorr").hide();
        }
        // $("#cab").hide();
     });
     $("#pickup_date").change(function(){
        if($("#pickup_date").val()=='')
        {
            $("#date").show();
        }
        else{
            $("#date").hide();
        }
        // $("#date").hide();
     });
     $("#pickup_time").change(function(){
        if($("#pickup_time").val()=='')
        {
            $("#time").show();
        }
        else{
            $("#time").hide();
        }


     });
     $("#discount").change(function(){
        // $("#dis").hide();
        if($("#discount").val()=='')
        {
            $("#dis").show();
        }
        else{
            $("#dis").hide();
        }
     });
     $("#local_discount").change(function(){
        // $("#dis").hide();
        if($("#local_discount").val()=='')
        {
            $("#local_dis_error").show();
        }
        else{
            $("#local_dis_error").hide();
        }
     });
     $("#customer_mobile").change(function(){
        if($("#customer_mobile").val()=='')
        {
            $("#mobile").show();
        }
        else{
            $("#mobile").hide();
        }
        // $("#mobile").hide();
     });
     $("#customer_name").change(function(){
        if($("#customer_name").val()=='')
        {
            $("#name").show();
        }
        else{
            $("#name").hide();
        }
     });
     $("#customer_email").change(function(){
        if($("#customer_email").val()=='')
        {
            $("#email").show();
        }
        else{
            $("#email").hide();
        }
     });
     $("#pickup_location").change(function(){
        if($("#pickup_location").val()=='')
        {
            $("#pick_location").show();
        }
        else{
            $("#pick_location").hide();
        }
        // $("#").hide();
     });
     $("#drop_location").change(function(){
        if($("#drop_location").val()=='')
        {
            $("#drop_location_error").show();
        }
        else{
            $("#drop_location_error").hide();
        }
        // $("#drop_location_error").hide();
     });

    </script>

    <script>
      $("#hello_button").click(function(){


        let data= $("#booking_type").val();

                if(data == "Oneway"){
                    var pickcity = $("#pickupcity_id").val();

                    var dropcity = $("#dropcity_id").val();
                    var cab = $("#cab_type").val();
                    var pickup_date = $("#pickup_date").val();
                    var pickup_time = $("#pickup_time").val();
                    var discount = $("#discount").val();
                    var mobile = $("#customer_mobile").val();
                    var name = $("#customer_name").val();
                    var email = $("#customer_email").val();
                    var pick_location = $("#pickup_location").val();
                    var drop_location = $("#drop_location").val();
                        if( pickcity == null)
                        {
                            $("#pickcity").css({"color":"#ff0000"});
                          $("#pickcity").css({"font-weight":"700"});
                          $("#pickcity").html("Select Pickup City ");

                        }else if(dropcity == 'select_drop'){

                            $("#dropcity_error").css({"color":"#ff0000"});
                          $("#dropcity_error").css({"font-weight":"700"});
                          $("#dropcity_error").html("Select Drop City ");
                        }
                        else if(cab == 'select_cab'){
                            $("#cab").css({"color":"#ff0000"});
                          $("#cab").css({"font-weight":"700"});
                          $("#cab").html("Select Cab ");
                        }
                        else if(pickup_date == ''){
                            $("#date").css({"color":"#ff0000"});
                          $("#date").css({"font-weight":"700"});
                          $("#date").html("Select Pickup Date ");
                        }
                        else if(pickup_time == ''){
                            $("#time").css({"color":"#ff0000"});
                          $("#time").css({"font-weight":"700"});
                          $("#time").html("Select Pickup Time ");
                        }
                        // else if(discount == ''){
                        //     $("#dis").css({"color":"#ff0000"});
                        //   $("#dis").css({"font-weight":"700"});
                        //   $("#dis").html("Enter Discount ");
                        // }
                        else if(mobile == ''){
                            $("#mobile").css({"color":"#ff0000"});
                          $("#mobile").css({"font-weight":"700"});
                          $("#mobile").html("Enter Valid Mobile Number ");
                        }
                        else if(name == ''){
                            $("#name").css({"color":"#ff0000"});
                          $("#name").css({"font-weight":"700"});
                          $("#name").html("Enter Customer Name");
                        }
                        else if(email == ''){

                            $("#email").css({"color":"#ff0000"});
                          $("#email").css({"font-weight":"700"});
                          $("#email").html("Enter Valid Email Address ");
                        }
                        else if(pick_location == ''){
                            $("#pick_location").css({"color":"#ff0000"});
                          $("#pick_location").css({"font-weight":"700"});
                          $("#pick_location").html("Enter Pickup Location ");
                        }
                        else if(drop_location == ''){
                            $("#drop_location_error").css({"color":"#ff0000"});
                          $("#drop_location_error").css({"font-weight":"700"});
                          $("#drop_location_error").html("Enter Drop Location ");
                        }
                        else{

                            $("#multy_form").submit();
                        }
                 }else if(data == "Localpackage"){

                        var pickcity = $("#pickcity_id").val();

                        var dropcity = $("#package_id").val();

                        var cab = $("#localcab_type").val();

                        var pickup_date = $("#pickup_date").val();

                        var pickup_time = $("#pickup_time").val();
                        var discount = $("#local_discount").val();

                        var mobile = $("#customer_mobile").val();
                        var name = $("#customer_name").val();
                        var email = $("#customer_email").val();
                        var pick_location = $("#pickup_location").val();
                        var drop_location = $("#drop_location").val();
                        if( pickcity == null)
                        {
                            $("#pickcity_local").css({"color":"#ff0000"});
                          $("#pickcity_local").css({"font-weight":"700"});
                          $("#pickcity_local").html("Select Pickup City ");

                        }else if(dropcity == 'select_drop'){

                            $("#dropcity_local").css({"color":"#ff0000"});
                          $("#dropcity_local").css({"font-weight":"700"});
                          $("#dropcity_local").html("Select Local-Package ");
                        }
                        else if(cab == 'select_cab'){

                            $("#local_cab_erorr").css({"color":"#ff0000"});
                          $("#local_cab_erorr").css({"font-weight":"700"});
                          $("#local_cab_erorr").html("Select Cab ");
                        }
                        else if(pickup_date == ''){
                            $("#date").css({"color":"#ff0000"});
                          $("#date").css({"font-weight":"700"});
                          $("#date").html("Select Pickup Date ");
                        }
                        else if(pickup_time == ''){
                            $("#time").css({"color":"#ff0000"});
                          $("#time").css({"font-weight":"700"});
                          $("#time").html("Select Pickup Time ");
                        }
                        // else if(discount == ''){
                        //     $("#local_dis_error").css({"color":"#ff0000"});
                        //   $("#local_dis_error").css({"font-weight":"700"});
                        //   $("#local_dis_error").html("Enter Discount ");
                        // }
                        else if(mobile == ''){
                            $("#mobile").css({"color":"#ff0000"});
                          $("#mobile").css({"font-weight":"700"});
                          $("#mobile").html("Enter Valid Mobile Number ");
                        }
                        else if(name == ''){
                            $("#name").css({"color":"#ff0000"});
                          $("#name").css({"font-weight":"700"});
                          $("#name").html("Enter Customer Name");
                        }
                        else if(email == ''){
                            $("#email").css({"color":"#ff0000"});
                          $("#email").css({"font-weight":"700"});
                          $("#email").html("Enter Valid Email Address ");
                        }
                        else if(pick_location == ''){
                            $("#pick_location").css({"color":"#ff0000"});
                          $("#pick_location").css({"font-weight":"700"});
                          $("#pick_location").html("Enter Pickup Location ");
                        }
                        else if(drop_location == ''){
                            $("#drop_location_error").css({"color":"#ff0000"});
                          $("#drop_location_error").css({"font-weight":"700"});
                          $("#drop_location_error").html("Enter Drop Location ");
                        }
                        else{

                            $("#multy_form").submit();
                        }
                 }else if(data == "Round-Trip"){
                        var pickcity = $("#pickcity_id_roundtrip").val();

                        var cab = $("#roundcab_type").val();

                        var j_day = $("#journy_days").val();

                        var pickup_date = $("#pickup_date").val();

                        var pickup_time = $("#pickup_time").val();

                        var discount = $("#round_discount").val();

                        var mobile = $("#customer_mobile").val();
                        var name = $("#customer_name").val();
                        var email = $("#customer_email").val();
                        var pick_location = $("#pickup_location").val();
                        var drop_location = $("#drop_location").val();
                        var travel = $("#travel_cities1").val();

                        if( pickcity == null)
                        {
                            $("#pickcity_round").css({"color":"#ff0000"});
                          $("#pickcity_round").css({"font-weight":"700"});
                          $("#pickcity_round").html("Select Pickup City *");

                        }else if(j_day == ''){

                            $("#j_days").css({"color":"#ff0000"});
                          $("#j_days").css({"font-weight":"700"});
                          $("#j_days").html("Select Jounry Days *");
                        }
                        else if(travel == ''){

                            $("#travel_error").css({"color":"#ff0000"});
                            $("#travel_error").css({"font-weight":"700"});
                            $("#travel_error").html("Select Minimum One City *");
                            }
                        else if(cab == 'select_cab'){

                            $("#round_cab_erorr").css({"color":"#ff0000"});
                          $("#round_cab_erorr").css({"font-weight":"700"});
                          $("#round_cab_erorr").html("Select Cab *");
                        }
                        else if(pickup_date == ''){

                            $("#date").css({"color":"#ff0000"});
                          $("#date").css({"font-weight":"700"});
                          $("#date").html("Select Pickup Date ");
                        }
                        else if(pickup_time == ''){
                            $("#time").css({"color":"#ff0000"});
                          $("#time").css({"font-weight":"700"});
                          $("#time").html("Select Pickup Time ");
                        }
                        // else if(discount == ''){
                        //     $("#round_dis_error").css({"color":"#ff0000"});
                        //   $("#round_dis_error").css({"font-weight":"700"});
                        //   $("#round_dis_error").html("Enter Discount *");
                        // }
                        else if(mobile == ''){
                            $("#mobile").css({"color":"#ff0000"});
                          $("#mobile").css({"font-weight":"700"});
                          $("#mobile").html("Enter Valid Mobile Number *");
                        }
                        else if(name == ''){
                            $("#name").css({"color":"#ff0000"});
                          $("#name").css({"font-weight":"700"});
                          $("#name").html("Enter Customer Name*");
                        }
                        else if(email == ''){
                            $("#email").css({"color":"#ff0000"});
                          $("#email").css({"font-weight":"700"});
                          $("#email").html("Enter Valid Email Address *");
                        }
                        else if(pick_location == ''){
                            $("#pick_location").css({"color":"#ff0000"});
                          $("#pick_location").css({"font-weight":"700"});
                          $("#pick_location").html("Enter Pickup Location *");
                        }
                        else if(drop_location == ''){
                            $("#drop_location_error").css({"color":"#ff0000"});
                          $("#drop_location_error").css({"font-weight":"700"});
                          $("#drop_location_error").html("Enter Drop Location *");
                        }
                    else{

                        $("#multy_form").submit();
                    }
                 }
                 else{
                    alert("hello");
                 }
      });

    </script>
 <script>
    $(window).on("load", function () {



        let data = $("#booking_type").val();


        if(data == 'Oneway'){

            $('#oneway_content').show();
        $('#local_content').hide();
        $('#round_details').hide();
        $('#round_content').hide();


        $('#oneway_dropcity').show();
        $('#local_dropcity').hide();
        $('#round_dropcity').hide();

        $('#oneway_cab').show();
        $('#local_cab').hide();
        $('#round_cab').hide();

        $('#oneway_gross').show();
        $('#local_gross').hide();
        $('#round_gross').hide();

        $('#oneway_dis').show();
        $('#local_dis').hide();
        $('#round_dis').hide();

        $('#oneway_total').show();
        $('#local_total').hide();
        $('#round_total').hide();

        $('#oneway_extra').show();
        $('#local_extra').hide();
        $('#round_extra').hide();
        $('#journy').hide();


        }else if(data == 'Localpackage'){

            $('#oneway_content').hide();
        $('#local_content').show();
        $('#round_content').hide();

        $('#local_dropcity').show();
        $('#oneway_dropcity').hide();
        $('#round_dropcity').hide();

        $('#oneway_cab').hide();
        $('#local_cab').show();
        $('#round_cab').hide();

        $('#oneway_gross').hide();
        $('#local_gross').show();
        $('#round_gross').hide();

        $('#oneway_dis').hide();
        $('#local_dis').show();
        $('#round_dis').hide();

        $('#oneway_total').hide();
        $('#local_total').show();
        $('#round_total').hide();

        $('#oneway_extra').hide();
        $('#local_extra').show();
        $('#round_extra').hide();
        $('#round_details').hide();
        $('#journy').hide();

        }
        else if(data == 'Round-Trip'){

            $('#oneway_content').hide();
        $('#local_content').hide();
        $('#round_content').show();

        $('#round_dropcity').show();
        $('#oneway_dropcity').hide();
        $('#local_dropcity').hide();

        $('#oneway_cab').hide();
        $('#local_cab').hide();
        $('#round_cab').show();

        $('#oneway_gross').hide();
        $('#local_gross').hide();
        $('#round_gross').show();

        $('#oneway_dis').hide();
        $('#local_dis').hide();
        $('#round_dis').show();

        $('#oneway_total').hide();
        $('#local_total').hide();
        $('#round_total').show();

        $('#oneway_extra').hide();
        $('#local_extra').hide();
        $('#round_extra').show();

        $('#round_details').show();
        $('#journy').show();
        }
    });
</script>

    <script>
    jQuery(document).ready(function(){
        jQuery('#booking_type').change(function()
        {



            let data = $("#booking_type").val();


            if(data == 'Oneway'){
                $('#pickupcity_id').prepend('<option value="" selected disabled>Select Pick City</option>');
                $('#oneway_content').show();
            $('#local_content').hide();
            $('#round_details').hide();
            $('#round_content').hide();


            $('#oneway_dropcity').show();
            $('#local_dropcity').hide();
            $('#round_dropcity').hide();

            $('#oneway_cab').show();
            $('#local_cab').hide();
            $('#round_cab').hide();

            $('#oneway_gross').show();
            $('#local_gross').hide();
            $('#round_gross').hide();

            $('#oneway_dis').show();
            $('#local_dis').hide();
            $('#round_dis').hide();

            $('#oneway_total').show();
            $('#local_total').hide();
            $('#round_total').hide();

            $('#oneway_extra').show();
            $('#local_extra').hide();
            $('#round_extra').hide();
            $('#journy').hide();

            }else if(data == 'Localpackage'){
                $('#pickcity_id').prepend('<option value="" selected disabled>Select Pick City</option>');
                $('#oneway_content').hide();
            $('#local_content').show();
            $('#round_content').hide();

            $('#local_dropcity').show();
            $('#oneway_dropcity').hide();
            $('#round_dropcity').hide();

            $('#oneway_cab').hide();
            $('#local_cab').show();
            $('#round_cab').hide();

            $('#oneway_gross').hide();
            $('#local_gross').show();
            $('#round_gross').hide();

            $('#oneway_dis').hide();
            $('#local_dis').show();
            $('#round_dis').hide();

            $('#oneway_total').hide();
            $('#local_total').show();
            $('#round_total').hide();

            $('#oneway_extra').hide();
            $('#local_extra').show();
            $('#round_extra').hide();
            $('#round_details').hide();
            $('#journy').hide();
            }
            else if(data == 'Round-Trip'){
                $('#pickcity_id_roundtrip').prepend('<option value="" selected disabled>Select Pick City</option>');
                $('#oneway_content').hide();
            $('#local_content').hide();
            $('#round_content').show();

            $('#round_dropcity').show();
            $('#oneway_dropcity').hide();
            $('#local_dropcity').hide();

            $('#oneway_cab').hide();
            $('#local_cab').hide();
            $('#round_cab').show();

            $('#oneway_gross').hide();
            $('#local_gross').hide();
            $('#round_gross').show();

            $('#oneway_dis').hide();
            $('#local_dis').hide();
            $('#round_dis').show();

            $('#oneway_total').hide();
            $('#local_total').hide();
            $('#round_total').show();

            $('#oneway_extra').hide();
            $('#local_extra').hide();
            $('#round_extra').show();

            $('#round_details').show();
            $('#journy').show();
            }
        });
    });

    </script>
     <!-------------- Get Oneway Drop City -------------->
     <script>
        jQuery(document).ready(function(){
            jQuery('#pickupcity_id').change(function()

            {

                let pid=jQuery(this).val();


                jQuery.ajax({
                    url:"{{route('onewaybookings.getDropcity')}}",
                    type:'post',
                    data:'pid='+pid+
                    '&_token={{csrf_token()}}',
                    success:function(result){

                        if(result==0){
                            alert('select Other City')
                            window.location.reload();
                        }else{
                            jQuery('#dropcity_id').html(result)
                        }

                    }
                });
            });
        });
    </script>
     <!-------------- Get Local Package City -------------->
     <script>
        jQuery(document).ready(function(){
            jQuery('#pickcity_id').change(function()

            {

                let pid=jQuery(this).val();

                jQuery.ajax({
                    url:"{{route('home.getlocalPackage')}}",
                    type:'post',
                    data:'pickupid='+pid+
                    '&_token={{csrf_token()}}',
                    success:function(result){

                        if(result==0){
                            alert('select Other City')
                            window.location.reload();
                        }else{
                            jQuery('#package_id').html(result)
                        }

                    }
                });
            });
        });
    </script>

    <!-------------- Get cab_type -------------->
    <script>
        jQuery(document).ready(function(){
            jQuery('#dropcity_id').change(function()

            {

                var did   = $('#dropcity_id').val();
                var pid = $('#pickupcity_id').val();
                jQuery.ajax({
                    headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
              },
              type:'POST',
                    url:"{{route('onewaybookings.get_cab_type')}}",

                    data:{pid:pid,did: did},
                    success:function(result){

                        if(result==0){
                            alert('select Other City')
                            window.location.reload();
                        }else{
                            jQuery('#cab_type').html(result)
                        }

                        }

                    });
            });
        });

    </script>
    {{-- ************get Local Cab Type ************ --}}
    <script>
    jQuery(document).ready(function(){
        jQuery('#package_id').change(function()

        {

            let did=jQuery(this).val();


            jQuery.ajax({
                url:"{{route('localbookings.get_cab_type')}}",
                type:'post',
                data:'did='+did+
                '&_token={{csrf_token()}}',
                success:function(result){

                    if(result==0){
                        alert('select Other City')
                        // window.location.reload();
                    }else{
                        jQuery('#localcab_type').html(result)
                    }

                }
            });
        });
    });

    </script>
   <!----------------Get Oneway Gross Total ------------->
   <script>
    jQuery(document).ready(function(){
        jQuery('#cab_type').change(function()

        {

            var pid = $('#pickupcity_id').val();
            var did   = $('#dropcity_id').val();
            var cid   = jQuery(this).val();

            jQuery.ajax({
                headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type:'POST',
                url:"{{route('onewaybookings.get_gross_total')}}",
                dataType: "json",
                data:{pid:pid,did: did,cid:cid},
                success:function(data){

                    jQuery('#gross_total').val(data.gross_total)

                }
            });
        });
    });
    </script>
    <!----------------Get Local Gross Total ------------->
    <script>
    jQuery(document).ready(function(){
        jQuery('#localcab_type').change(function()

        {

            var pid = $('#pickcity_id').val();

            var did   = $('#package_id').val();

            var cid   = jQuery(this).val();


            jQuery.ajax({
                headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type:'POST',
                url:"{{route('localbookings.get_gross_total')}}",
                dataType: "json",
                data:{pid:pid,did: did,cid:cid},
                success:function(data){

                    jQuery('#localgross_total').val(data.gross_total)

                    }

            });
        });
    });
    </script>
    <!-----------------Discount ---------------------->
    <script>
    jQuery(document).ready(function()
    {
        var total = Math.round($('#total_amount').val()).toFixed(0);

          var discount = Math.round($('#discount').val());
          var num1 =$('#total_amount').val();
          var num2 = $('#extra_charge').val();

          jQuery('#discount').on('keyup', function()
                {
                    var total = Math.round($('#gross_total').val()).toFixed(0);
                    var discount = Math.round($('#discount').val());
                    if(total == '') {
                        alert('Please, Enter Valid Amount');
                    } else {
                    if(total > discount){
                    var total_amount = (total - discount);
                    $('#total_amount').val(total_amount);
                    }else{
                        var total_amount = (total - discount);
                    $('#total_amount').val(total_amount);
                    }
                }
            });


    });
    </script>
    <!-----------------Local Discount ---------------------->
    <script>
    jQuery(document).ready(function()
    {
        var total = Math.round($('#total_input').val()).toFixed(0);
          var discount = Math.round($('#local_discount').val());
          var num1 =$('#local_total_amount').val();
          var num2 = $('#local_extra_charge').val();

          jQuery('#local_discount').on('keyup', function()
         {
            var total = Math.round($('#localgross_total').val()).toFixed(0);
            var discount = Math.round($('#local_discount').val());
            if(total == '') {
                alert('Please, Enter Valid Amount');
            } else {
               if(total > discount){
              var total_amount = (total - discount);
              $('#local_total_amount').val(total_amount);
              }else{
                alert('Please, Enter Valid Amount');
                $('#local_discount').val();
                $('#local_discount').focus();
            }
        }
      });

    });
    </script>
    <!-----------------Multy Discount ----------------->
    <script>
    var total = Math.round($('#total_input').val()).toFixed(0);
    var discount = Math.round($('#round_discount').val());
    var num1 =$('#round_total_amount').val();
    var num2 = $('#round_extra_charge').val();
    $('#round_discount').on('keyup', function() {
      var total = Math.round($('#roundgross_total').val()).toFixed(0);
      var discount = Math.round($('#round_discount').val());
      if(total == '') {
        alert('Please, Enter Valid Amount');
      } else {
        if(total > discount){
          var total_amount = (total - discount);
          $('#round_total_amount').val(total_amount);
        }else{
          alert('Please, Enter Valid Amount');
          $('#round_discount').val();
          $('#round_discount').focus();
        }
      }
    });
    </script>

    <!---------------Extra Charge --------------------->


<script>
    jQuery(document).ready(function(){
        jQuery('#extra_charge').on('keyup', function() {
        var total = Math.round($('#gross_total').val()).toFixed(0);
        var discount_val = $('#discount').val();
                if(discount_val == ''){
                    var discount =0;
                }else{
                    var discount = discount_val
                }
                // alert(discount);
        var num1 =$('#total_amount').val();
        var num2 = $('#extra_charge').val();

          var answer = total;
        //   alert(answer);
          $('#total_amount').val(answer);


          if(parseInt(num1) > parseInt(num2)){
            var numBeR = parseInt(total) - parseInt(discount);
            var answer_2 = parseInt(numBeR) + parseInt(num2);

            $('#total_amount').val(answer_2);

          }else{
            var numBeR = parseInt(total) - parseInt(discount);
              alert('Please, Enter Valid Amount');
              $('#extra_charge').val();
              $('#extra_charge').focus();
              $('#total_amount').val(numBeR);
          }

      });
    });
</script>



    <!---------------Local Extra Charge --------------------->
    <script>
        jQuery(document).ready(function(){
            jQuery('#local_extra_charge').on('keyup', function() {
            var total = Math.round($('#localgross_total').val()).toFixed(0);
            var discount_val = $('#local_discount').val();
                    if(discount_val == ''){
                        var discount =0;
                    }else{
                        var discount = discount_val
                    }
                    // alert(discount);
            var num1 =$('#local_total_amount').val();
            var num2 = $('#local_extra_charge').val();

              var answer = total;
            //   alert(answer);
              $('#local_total_amount').val(answer);


              if(parseInt(num1) > parseInt(num2)){
                var numBeR = parseInt(total) - parseInt(discount);
                var answer_2 = parseInt(numBeR) + parseInt(num2);

                $('#local_total_amount').val(answer_2);

              }else{
                var numBeR = parseInt(total) - parseInt(discount);
                  alert('Please, Enter Valid Amount');
                  $('#local_extra_charge').val();
                  $('#local_extra_charge').focus();
                  $('#local_total_amount').val(numBeR);
              }

          });
        });
    </script>

    <!---------------Multy Extra Charge --------------------->
    <script>
        jQuery(document).ready(function(){
            jQuery('#round_extra_charge').on('keyup', function() {
            var total = Math.round($('#roundgross_total').val()).toFixed(0);
            var discount_val = $('#round_discount').val();
                    if(discount_val == ''){
                        var discount =0;
                    }else{
                        var discount = discount_val
                    }
                    // alert(discount);
            var num1 =$('#round_total_amount').val();
            var num2 = $('#round_extra_charge').val();

              var answer = total;
            //   alert(answer);
              $('#round_total_amount').val(answer);


              if(parseInt(num1) > parseInt(num2)){
                var numBeR = parseInt(total) - parseInt(discount);
                var answer_2 = parseInt(numBeR) + parseInt(num2);

                $('#round_total_amount').val(answer_2);

              }else{
                var numBeR = parseInt(total) - parseInt(discount);
                  alert('Please, Enter Valid Amount');
                  $('#round_extra_charge').val();
                  $('#round_extra_charge').focus();
                  $('#round_total_amount').val(numBeR);
              }

          });
        });
    </script>

     <!-------------- Get Customer Detail -------------->
     <script>
        jQuery(document).ready(function(){
            jQuery('#customer_mobile').on('keyup', function()
                {
                            var customer_mobile =jQuery('#customer_mobile').val();

                            jQuery.ajax({
                                type: "Post",
                                url: "{{route('user_check')}}",
                                data:  'customer_mobile='+customer_mobile+
                                '&_token={{csrf_token()}}',

                                success: function(result) {

                                if(result != 0) {
                                $('#user_id').val(result[0]);
                                $('#customer_name').val(result[1]);
                                $('#customer_email').val(result[2]);
                                $('#customer_name').attr('','');
                                $('#customer_email').attr('','');
                                }
                                else {
                                $('#user_id').val(0);
                                $('#customer_name').val('');
                                $('#customer_email').val('');
                                $('#customer_name').removeAttr('','');
                                $('#customer_email').removeAttr('','');
                                }
                            }
                        });
                    return false;
                });
        });
    </script>
    <script>
         $(window).on("load", function () {
            var dropcity = $('#round_dropcity_id').val();

var pcity_id         = $('#pickcity_id_roundtrip').val();

var pickup_date        = $('#pickup_date').val();

var pickup_time        = $('#pickup_time').val();

var jdays            = $('#journy_days').val();

var cab_type         = $('#roundcab_type').val();

var gross_total      = $('#roundgross_total').val();

var travel_cities1 = $('#travel_cities1').val();
if(pcity_id == '' || pickup_date == '' || pickup_time == '' ||  travel_cities1 == '')
{
    // alert('Requied All Fileds');

    $('#roundgross_total').val(0);
    $('#roundcab_type').val('');
    $('#travel_cities1').val('');
    $('#travel_cities2').val('');
}else{
    var city = $("input[name^='travel_cities']").map(function(){
    return this.value;

}).get();
var travel_cities = city.join("|");
$('#travel').val(travel_cities);
            $.ajax({
                headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
        type: "POST",
        url: "{{route('get_estimate')}}",
        dataType: "json",
        data:{travel_cities:travel_cities,pcity_id:pcity_id,pickup_date:pickup_date,pickup_time:pickup_time,jdays:jdays,cab_type:cab_type},
        success: function(data){
            if(data.value_null) {
            alert('Please Try Another Cab !');
            $('#roundgross_total').val(0);
            $('#submit_id').attr("disabled", 'disabled');
            } else {
            $('#ride_gst').val(data.ride_gst);
            if($('#dropcity').val(data.dropcity)) {
            $('#submit_id').removeAttr("disabled");
            }
            $('#perkm_rate').val(data.km_rate);
            $('#esti_kms').val(data.esti_kms);
            $('#total_kms').html(data.esti_kms);
            $('#km_rate').html(data.km_rate);
            $('#dl').html(data.driver_allowance);

            $('#roundgross_total').val(data.gross_total);
            }
        }
        });
}
         });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#roundcab_type').change(function()

            {
                var dropcity = $('#round_dropcity_id').val();

                var pcity_id         = $('#pickcity_id_roundtrip').val();

                var pickup_date        = $('#pickup_date').val();

                var pickup_time        = $('#pickup_time').val();

                var jdays            = $('#journy_days').val();

                var cab_type         = $('#roundcab_type').val();

                var gross_total      = $('#roundgross_total').val();

                var travel_cities1 = $('#travel_cities1').val();
                if(pcity_id == '' || pickup_date == '' || pickup_time == '' ||  travel_cities1 == '')
                {
                    alert('Requied All Fileds');

                    $('#roundgross_total').val(0);
                    $('#roundcab_type').val('');
                    $('#travel_cities1').val('');
                    $('#travel_cities2').val('');
                }else{
                    var city = $("input[name^='travel_cities']").map(function(){
                    return this.value;

                }).get();
                var travel_cities = city.join("|");
                $('#travel').val(travel_cities);
                            $.ajax({
                                headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                        type: "POST",
                        url: "{{route('get_estimate')}}",
                        dataType: "json",
                        data:{travel_cities:travel_cities,pcity_id:pcity_id,pickup_date:pickup_date,pickup_time:pickup_time,jdays:jdays,cab_type:cab_type},
                        success: function(data){
                            if(data.value_null) {
                            alert('Please Try Another Cab !');
                            $('#roundgross_total').val(0);
                            $('#submit_id').attr("disabled", 'disabled');
                            } else {
                            $('#ride_gst').val(data.ride_gst);
                            if($('#dropcity').val(data.dropcity)) {
                            $('#submit_id').removeAttr("disabled");
                            }
                            $('#perkm_rate').val(data.km_rate);
                            $('#esti_kms').val(data.esti_kms);
                            $('#total_kms').html(data.esti_kms);
                            $('#km_rate').html(data.km_rate);
                            $('#dl').html(data.driver_allowance);

                            $('#roundgross_total').val(data.gross_total);
                            }
                        }
                        });
                }



            });
        });
    </script>
    {{-- <script>
        var max_fields      = 4;
        var wrapper =  $(".input_fields_wrap");

       var remove_button   = $("#remove"); //Fields wrapper
       $("#remove").attr( "disabled", "disabled" );
       var add_button      = $("#add"); //Add button ID
       var x = 1; //initlal text box count

       $(add_button).click(function(e) { //on add input button click
           e.preventDefault();
           $("#remove").removeAttr( "disabled", "disabled" );
           var t_check 		= $('#travel_cities1').val();

           if(t_check == '') {
               alert('Please Select City First');
               return false;
           } else {
               if(x < max_fields){ //max input box allowed
                   x++; //text box increment
                   $('.extra_input').append(
                    '<div class="col-md-12"><div class="form-group" id="appendDiv_id'+x+'"><label id="lable-travel'+x+'" style="font-size:15px;"></label><input type="text" style="margin-top:10px"; class="mul_city form-control pac-target-input" id="travel_cities'+x+'" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div></div>');
                       set_code();
                   }
           }
       });
    </script>
    <script>
    $("#remove").click(function(event) {
           $("#remove").removeAttr( "disabled", "disabled" );

               var x1 = x++;
               var t_check 		= $('#travel_cities1').val();
               $('#travel_cities'+x+'').remove(); x--;
               $('#appendDiv_id'+x1+'').remove(); x--;
               if (x==1) {
                     $('#remove').attr("disabled", "disabled");
                   }
    });
    </script> --}}

    </div>
    {{-- <script type="text/javascript">
    window.onload = function()
    {
     initialize();
    }

    var autocomplete;
    function initialize()
    {
       var travel_cities = document.getElementById('travel_cities1');
       autocomplete1 = new google.maps.places.Autocomplete((travel_cities),{ types: ['geocode'],types: ['(cities)'],componentRestrictions: {country: 'in'} });
       google.maps.event.addListener(autocomplete1, 'place_changed', function() {
       });
    }
    function set_code()
    {
     var elms = document.querySelectorAll(".mul_city");
     for (var i = 1; i <= elms.length; i++) {
         var p = i+1;
         autocomplete1  = new google.maps.places.Autocomplete((document.getElementById('travel_cities'+p)),{ types: ['geocode'],componentRestrictions: {country: 'in'} });
           google.maps.event.addListener(autocomplete1, 'place_changed', function() {
           });
       }
    }
    </script> --}}
    {{-- <script>
        var max_fields      = 4;
        var wrapper =  $(".input_fields_wrap");

       var remove_button   = $("#remove_mobile"); //Fields wrapper
       $("#remove_mobile").attr( "disabled", "disabled" );
       var add_button      = $("#add_mobile"); //Add button ID
       var x = 1; //initlal text box count

       $(add_button).click(function(e) { //on add input button click
           e.preventDefault();
           $("#remove_mobile").removeAttr( "disabled", "disabled" );
           var t_check 		= $('#travel_cities1').val();

           if(t_check == '') {
               alert('Please Select City First');
               return false;
           } else {
               if(x < max_fields){ //max input box allowed
                   x++; //text box increment
                   $('.extra_input').append('<div class="col-md-12"><div class="form-group" id="appendDiv_id'+x+'"><label id="lable-travel'+x+'"  style="font-size:11px;"></label><input type="text" style="margin-top:10px;" class="mul_city form-control pac-target-input" id="travel_cities'+x+'" name="travel_cities[]" placeholder="Enter a Location" autocomplete="off"></div></div>');
                       set_code();
                   }
           }
       });
    </script> --}}
    {{-- <script>
    $("#remove_moble").click(function(event)
    {
           $("#remove_moble").removeAttr( "disabled", "disabled" );

               var x1 = x++;
               var t_check 		= $('#travel_cities1').val();
               $('#travel_cities'+x+'').remove(); x--;
               $('#appendDiv_id'+x1+'').remove(); x--;
               if (x==1) {
                     $('#remove_mobile').attr("disabled", "disabled");
                   }
    });
    </script> --}}
    </div>
    {{-- <script type="text/javascript">
    window.onload = function()
    {
     initialize();
    }

    var autocomplete;
    function initialize()
    {
       var travel_cities = document.getElementById('travel_cities1');
       autocomplete1 = new google.maps.places.Autocomplete((travel_cities),{ types: ['geocode'],types: ['(cities)'],componentRestrictions: {country: 'in'} });
       google.maps.event.addListener(autocomplete1, 'place_changed', function() {
       });
    }
    function set_code()
    {
     var elms = document.querySelectorAll(".mul_city");
     for (var i = 1; i <= elms.length; i++) {
         var p = i+1;
         autocomplete1  = new google.maps.places.Autocomplete((document.getElementById('travel_cities'+p)),{ types: ['geocode'],componentRestrictions: {country: 'in'} });
           google.maps.event.addListener(autocomplete1, 'place_changed', function() {
           });
       }
    }
    </script> --}}
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
    <script>
    const validateEmail = (email) => {
    return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
    };
    const validate = () => {
    const $result = $('#email_result');
    const email = $('#customer_email').val();
    $result.text('');

    if (validateEmail(email)) {
    $result.text(email + ' Email Address is valid :)');
    $result.css('color', 'green');
    $result.css('font-weight','900');
    $("#hello_button").show();

    } else {
    $result.text(email + ' Email Address  is not valid :(');
    $result.css('color', 'red');
    $result.css('font-weight','900');
    $("#hello_button").hide();
    // alert("Please Enter Valid Email Address");s


    }
    return false;
    }
    $('#customer_email').on('input', validate);
    </script>
    <script>
        // When the user clicks on div, open the popup
        function myFunction() {
          var popup = document.getElementById("myPopup");
          popup.classList.toggle("show");
        }
        </script>
    <style>
        @media (min-width: 768px){
            .c1{
                width: 50% !important;
            }
            .c2{
                width: 35% !important;
                padding:0px !important;
            }
            .btn-danger2{
                background: #ff5a5a !important;
                color: white !important;
                font-weight: 900 !important;
                border-color: red !important;
            }
            .btn-danger1{
                background: #0f5806 !important;
                color: white !important;
                font-weight: 900 !important;
                border-color: #0f5806 !important;
            }
        }
        .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #7367f0;
      color: #fff;
      font-weight: 900;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
    }

    </style>
