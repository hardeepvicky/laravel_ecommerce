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
