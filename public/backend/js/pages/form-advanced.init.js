$(document).ready(function() {
    $("#my_multi_select3").multiSelect({
        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        afterInit: function(t) {
            var e = this,
                n = e.$selectableUl.prev(),
                a = e.$selectionUl.prev(),
                s = "#" + e.$container.attr("id") + " .ms-elem-selectable:not(.ms-selected)",
                i = "#" + e.$container.attr("id") + " .ms-elem-selection.ms-selected";
            e.qs1 = n.quicksearch(s).on("keydown", function(t) {
                if (40 === t.which) return e.$selectableUl.focus(), !1
            }), e.qs2 = a.quicksearch(i).on("keydown", function(t) {
                if (40 == t.which) return e.$selectionUl.focus(), !1
            })
        },
        afterSelect: function() {
            this.qs1.cache(), this.qs2.cache()
        },
        afterDeselect: function() {
            this.qs1.cache(), this.qs2.cache()
        }
    }), $(".select2").select2(), $(".select2-limiting").select2({
        maximumSelectionLength: 2
    })
}), $('[data-plugin="switchery"]').each(function(t, e) {
    new Switchery($(this)[0], $(this).data())
}), $('[data-plugin="multiselect"]').multiSelect($(this).data()), $(".vertical-spin").TouchSpin({
    verticalbuttons: !0,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary",
    verticalupclass: "ion-plus-round",
    verticaldownclass: "ion-minus-round"
});
var vspinTrue = $(".vertical-spin").TouchSpin({
    verticalbuttons: !0
});
vspinTrue && $(".vertical-spin").prev(".bootstrap-touchspin-prefix").remove(), $("input[name='demo1']").TouchSpin({
    min: 0,
    max: 100,
    step: .1,
    decimals: 2,
    boostat: 5,
    maxboostedstep: 10,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary",
    postfix: "%"
}), $("input[name='demo2']").TouchSpin({
    min: -1e9,
    max: 1e9,
    stepinterval: 50,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary",
    maxboostedstep: 1e7,
    prefix: "$"
}), $("input[name='demo3']").TouchSpin({
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary"
}), $("input[name='demo3_21']").TouchSpin({
    initval: 40,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary"
}), $("input[name='demo3_22']").TouchSpin({
    initval: 40,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary"
}), $("input[name='demo5']").TouchSpin({
    prefix: "pre",
    postfix: "post",
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary"
}), $("input[name='demo0']").TouchSpin({
    buttondown_class: "btn btn-icon btn-info",
    buttonup_class: "btn btn-icon btn-info"
}), $(document).ready(function() {
    $('[data-toggle="input-mask"]').each(function(t, e) {
        var n = $(e).data("maskFormat"),
            a = $(e).data("reverse");
        null != a ? $(e).mask(n, {
            reverse: a
        }) : $(e).mask(n)
    })
});
$(document).ready(function(){
    $(".btn-operator").TouchSpin({
        min: 0,
        max: 10000,
        buttondown_class: "btn btn-icon btn-light",
        buttonup_class: "btn btn-icon btn-light"
    })
})

