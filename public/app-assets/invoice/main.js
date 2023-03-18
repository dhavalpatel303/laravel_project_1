!(function (e) {
    "use strict";
    e("#download_btn").on("click", function () {
        var t = e("#download_section"),
            n = t.width(),
            o = t.height(),
            d = n + 80,
            a = 1.5 * d + 80,
            i = n,
            c = o,
            r = Math.ceil(o / a) - 1;
        html2canvas(t[0], { allowTaint: !0 }).then(function (e) {
            e.getContext("2d");
            var t = e.toDataURL("image/jpeg", 1),
                n = new jsPDF("p", "pt", [d, a]);
            n.addImage(t, "JPG", 40, 40, i, c);
            for (var o = 1; o <= r; o++) n.addPage(d, a), n.addImage(t, "JPG", 40, -a * o + 0, i, c);
            n.save("as-invoice.pdf");
        });
    }),
        e(".print_btn").on("click", function (e) {
            window.print();
        }),
        window.addEventListener(
            "contextmenu",
            function (e) {
                e.preventDefault();
            },
            !1
        ),
        (document.onkeydown = function (e) {
            return (
                123 != event.keyCode &&
                (!e.ctrlKey || !e.shiftKey || e.keyCode != "I".charCodeAt(0)) &&
                (!e.ctrlKey || !e.shiftKey || e.keyCode != "C".charCodeAt(0)) &&
                (!e.ctrlKey || !e.shiftKey || e.keyCode != "J".charCodeAt(0)) &&
                (!e.ctrlKey || e.keyCode != "U".charCodeAt(0)) &&
                void 0
            );
        });
})(jQuery);
