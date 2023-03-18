$(".at-pricing-range").each(function(){
    var priceInput = $(this).find(".price-input");

    var min_price = $(this).find(".min_price");
    var max_price = $(this).find(".max_price");

    priceInput.on("change", function(){

        var min_price = $(this).parents(".at-pricing-range").find(".min_price");
        var max_price = $(this).parents(".at-pricing-range").find(".max_price");

        var min_price_range = parseInt(min_price.val());

        var max_price_range = parseInt(max_price.val());

        if (min_price_range > max_price_range) {
            max_price.val(min_price_range);
        }

        var price_filter_range = $(this).parents(".at-pricing-range").find(".price-filter-range");

        price_filter_range.slider({
            values: [min_price_range, max_price_range]
        });
    });

    priceInput.on("paste keyup", function(){

        var min_price = $(this).parents(".at-pricing-range").find(".min_price");
        var max_price = $(this).parents(".at-pricing-range").find(".max_price");

        var min_price_range = parseInt(min_price.val());

        var max_price_range = parseInt(max_price.val());

        if(min_price_range == max_price_range) {
            max_price_range = min_price_range + 100;

            min_price.val(min_price_range);
            max_price.val(max_price_range);
        }

        var price_filter_range = $(this).parents(".at-pricing-range").find(".price-filter-range");

        price_filter_range.slider({
            values: [min_price_range, max_price_range]
        });

    }); 

    var price_filter_range = $(this).find(".price-filter-range");
    price_filter_range.slider({
        range: true,
        orientation: "horizontal", 
        min: 0, 
        max: 10000, 
        values: [0, 10000], 
        step: 100, 

        slide: function(event, ui) {
            if(ui.values[0] == ui.values[1]) {
                return false;
            }

            min_price.val(ui.values[0]); 
            max_price.val(ui.values[1]);
        }
    });

    min_price.val(price_filter_range.slider("values", 0)); 
    max_price.val(price_filter_range.slider("values", 1));
});