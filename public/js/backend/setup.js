$.console = {
    log: function (title, data) {
        console.log(title, data);

        console.trace();
    },
};

$.events = {
    onAjaxError: function (title, responseHtml, extra) {
        var config = {
            title: title,
            message: responseHtml,
            size: "extra-large",
        };

        bootbox.alert(config);
    },
    onUserError: function (html, extra) {
        var config = {
            icon: "error",
            showCloseButton: true,
            html: html,
        };

        if (typeof extra == "object") {
            if (typeof extra.width == "string") {
                config.width = extra.width;
            }
        }

        Swal.fire(config);
    },
};

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    cache: false,
});

$(document).ajaxStart(function () {
    $("body").trigger("sr-loader.show");
});

//Ajax complete
$(document).ajaxComplete(function () {
    $("body").trigger("sr-loader.hide");
});

$(document).ajaxError(function (event, xhr, settings, errorString) {
    $("body").trigger("sr-loader.hide");

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
