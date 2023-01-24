!(function (n) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        n(".select2").select2(),
            n(".select2-limiting").select2({ maximumSelectionLength: 2 }),
            n(".select2-search-disable").select2({
                minimumResultsForSearch: 1 / 0,
            }),
            n("#colorpicker-default").spectrum(),
            n("#colorpicker-showalpha").spectrum({ showAlpha: !0 }),
            n("#colorpicker-showpaletteonly").spectrum({
                showPaletteOnly: !0,
                showPalette: !0,
                color: "#34c38f",
                palette: [
                    [
                        "#556ee6",
                        "white",
                        "#34c38f",
                        "rgb(255, 128, 0);",
                        "#50a5f1",
                    ],
                    ["red", "yellow", "green", "blue", "violet"],
                ],
            }),
            n("#colorpicker-togglepaletteonly").spectrum({
                showPaletteOnly: !0,
                togglePaletteOnly: !0,
                togglePaletteMoreText: "more",
                togglePaletteLessText: "less",
                color: "#556ee6",
                palette: [
                    [
                        "#000",
                        "#444",
                        "#666",
                        "#999",
                        "#ccc",
                        "#eee",
                        "#f3f3f3",
                        "#fff",
                    ],
                    [
                        "#f00",
                        "#f90",
                        "#ff0",
                        "#0f0",
                        "#0ff",
                        "#00f",
                        "#90f",
                        "#f0f",
                    ],
                    [
                        "#f4cccc",
                        "#fce5cd",
                        "#fff2cc",
                        "#d9ead3",
                        "#d0e0e3",
                        "#cfe2f3",
                        "#d9d2e9",
                        "#ead1dc",
                    ],
                    [
                        "#ea9999",
                        "#f9cb9c",
                        "#ffe599",
                        "#b6d7a8",
                        "#a2c4c9",
                        "#9fc5e8",
                        "#b4a7d6",
                        "#d5a6bd",
                    ],
                    [
                        "#e06666",
                        "#f6b26b",
                        "#ffd966",
                        "#93c47d",
                        "#76a5af",
                        "#6fa8dc",
                        "#8e7cc3",
                        "#c27ba0",
                    ],
                    [
                        "#c00",
                        "#e69138",
                        "#f1c232",
                        "#6aa84f",
                        "#45818e",
                        "#3d85c6",
                        "#674ea7",
                        "#a64d79",
                    ],
                    [
                        "#900",
                        "#b45f06",
                        "#bf9000",
                        "#38761d",
                        "#134f5c",
                        "#0b5394",
                        "#351c75",
                        "#741b47",
                    ],
                    [
                        "#600",
                        "#783f04",
                        "#7f6000",
                        "#274e13",
                        "#0c343d",
                        "#073763",
                        "#20124d",
                        "#4c1130",
                    ],
                ],
            }),
            n("#colorpicker-showintial").spectrum({ showInitial: !0 }),
            n("#colorpicker-showinput-intial").spectrum({
                showInitial: !0,
                showInput: !0,
            });
        var c = {};
        n('[data-toggle="touchspin"]').each(function (e, a) {
            var t = n.extend({}, c, n(a).data());
            n(a).TouchSpin(t);
        }),
            n("input[name='demo3_21']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
            }),
            n("input[name='demo3_22']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
            }),
            n("input[name='demo_vertical']").TouchSpin({ verticalbuttons: !0 }),
            n("input#defaultconfig").maxlength({
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            }),
            n("input#thresholdconfig").maxlength({
                threshold: 20,
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            }),
            n("input#moreoptions").maxlength({
                alwaysShow: !0,
                warningClass: "badge bg-success",
                limitReachedClass: "badge bg-danger",
            }),
            n("input#alloptions").maxlength({
                alwaysShow: !0,
                warningClass: "badge bg-success",
                limitReachedClass: "badge bg-danger",
                separator: " out of ",
                preText: "You typed ",
                postText: " chars available.",
                validate: !0,
            }),
            n("textarea#textarea").maxlength({
                alwaysShow: !0,
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            }),
            n("input#placement").maxlength({
                alwaysShow: !0,
                placement: "top-left",
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            });
    }),
        (n.AdvancedForm = new e()),
        (n.AdvancedForm.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.AdvancedForm.init();
    })(),
    $(function () {
        "use strict";
        var i = $(".docs-date"),
            s = $(".docs-datepicker-container"),
            l = $(".docs-datepicker-trigger"),
            r = {
                show: function (e) {
                    console.log(e.type, e.namespace);
                },
                hide: function (e) {
                    console.log(e.type, e.namespace);
                },
                pick: function (e) {
                    console.log(e.type, e.namespace, e.view);
                },
            };
        i
            .on({
                "show.datepicker": function (e) {
                    console.log(e.type, e.namespace);
                },
                "hide.datepicker": function (e) {
                    console.log(e.type, e.namespace);
                },
                "pick.datepicker": function (e) {
                    console.log(e.type, e.namespace, e.view);
                },
            })
            .datepicker(r),
            $(".docs-options, .docs-toggles").on("change", function (e) {
                var a,
                    t = e.target,
                    c = $(t),
                    n = c.attr("name"),
                    o = "checkbox" === t.type ? t.checked : c.val();
                switch (n) {
                    case "container":
                        o ? (o = s).show() : s.hide();
                        break;
                    case "trigger":
                        o
                            ? (o = l).prop("disabled", !1)
                            : l.prop("disabled", !0);
                        break;
                    case "inline":
                        (a = $('input[name="container"]')).prop("checked") ||
                            a.click();
                        break;
                    case "language":
                        $('input[name="format"]').val(
                            $.fn.datepicker.languages[o].format
                        );
                }
                (r[n] = o),
                    i.datepicker("reset").datepicker("destroy").datepicker(r);
            }),
            $(".docs-actions").on("click", "button", function (e) {
                var a,
                    t = $(this).data(),
                    c = t.arguments || [];
                e.stopPropagation(),
                    t.method &&
                        (t.source
                            ? i.datepicker(t.method, $(t.source).val())
                            : (a = i.datepicker(t.method, c[0], c[1], c[2])) &&
                              t.target &&
                              $(t.target).val(a));
            });
    });
