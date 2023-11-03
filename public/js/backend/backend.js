/**
 * @author : Hardeep
 * this file only for backend
 */

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
};


$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    cache: false,
});

$(document).ajaxError(function (event, xhr, settings, errorString) {    
    if (xhr.status == 403) {
        $.events.onAjaxError(errorString, "Session is expired. Please Login");
    } else if (
        typeof xhr.responseText == "string" &&
        xhr.responseText.length > 0
    ) {
        $.events.onAjaxError(errorString, xhr.responseText, {
            url: settings.url,
        });
    }
});

function ajaxHandleResponse(url, response, callback) {

    var responseJson = {};
    if (typeof response == "object") {
        responseJson = response;
    } else {
        try {

            if (typeof(response) == "string")
            {
                response = response.trim();

                if (response.length == 0)
                {
                    $.events.onAjaxError("JSON Parse Error", "Empty Response", {
                        url: url,
                    });

                    return false;
                }

                var responseJson = JSON.parse(response);
            }
        } catch (e) {
            $.events.onAjaxError("JSON Parse Error", response, {
                url: url,
            });
            return false;
        }
    }

    if (typeof responseJson["status"] == "undefined") {
        $.events.onAjaxError("Missing", "Response JSON Should have status", {
            url: url,
        });
        return;
    }

    if (responseJson["status"] == "1" || responseJson["status"] == true) {
        if (typeof callback == "function") {
            callback(responseJson);
        }
    } else if (typeof responseJson["msg"] != "undefined") {
        $.events.onUserError(responseJson["msg"]);
    } else {
        $.events.onAjaxError("Missing", "Response JSON Should have msg", {
            url: url,
        });
    }
}


function confirmDialog(text, onYes) {
    Swal.fire({
        title: "Are you sure?",
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: constants.swal.button.confirm_color,
        cancelButtonColor: constants.swal.button.cancel_color,
    }).then(function (e) {
        if (e.value) {
            if (typeof onYes == "function") {
                onYes();
            }
        }
    });
}

$(document).ready(function()
{
    $.loader.init();

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

    $(".i-data-table").idataTable();

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


