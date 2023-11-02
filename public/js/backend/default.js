$(document).ready(function()
{
    $("form").find("div.pristine-error").parents(".form-group").addClass("has-danger");

    $("input[type='checkbox'].chk-select-all").chkSelectAll();

    $(".select2").select2({
        placeHolder : "Please Select",
        theme : "bootstrap-5",
    });

    $(".fancybox").fancybox();

    $(".date-picker").datepickerExtend();

    $(".date-month-picker").datepickerExtend({
        format: "M-yyyy",
        viewMode: "months",
        minViewMode: "months"
    });

    $(".date-time-picker").datetimepickerExtend();

    // $('.time-picker').timepicker({
    //     defaultTime: ""
    // });

    $("form.summary-delete-form").submit(function()
    {
        var _form = $(this);

        var is_confirm = _form.attr("data-confirm");

        if (!is_confirm)
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: constants.swal.button.confirm_color,
                cancelButtonColor: constants.swal.button.cancel_color,
                confirmButtonText: "Yes, delete it!"
            }).then(function(e) {
                if (e.value)
                {
                    _form.attr("data-confirm", 1);
                    _form.trigger("submit");
                }
            });

            return false;
        }
    });


    $(".clear_form_search_conditions").click(function()
    {
        var _form = $(this).closest("form");
        
        _form.clearForm();
        
        _form.trigger("submit");
    });
});



$.blackdrop = {
    obj : null,
    events : [],
    init : function ()
    {
        var _this = this;
        _this.obj = $("body").find(".black_drop_container:first");

        if (this.obj.length == 0)
        {
            var html = '<div class="black_drop_container" style="display:none;"></div>';
            $("body").prepend(html);
            _this.obj = $("body").find(".black_drop_container:first");
        }

        _this.obj.click(function(){
            _this.hide();
        });
    },
    onClick : function(fn)
    {
        if (typeof fn != "function")
        {
            console.error("blackDrop -> onClick() : argument should be function type");
        }

        this.obj.click(fn);
    },
    show : function()
    {   
        this.obj.show();
    },
    hide : function ()
    {
        this.obj.hide();
    }
}