@extends('backend.layouts.login')

@section('content')

<div class="auth-full-page-content d-flex p-sm-5 p-4">
    <div class="w-100">
        <div class="d-flex flex-column h-100">
            <div class="mb-4 mb-md-5 text-center">
                <a href="index.html" class="d-block auth-logo">
                    <img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Minia</span>
                </a>
            </div>
            <div class="auth-content my-auto">
                <div class="text-center">

                    <div class="avatar-lg mx-auto">
                        <div class="avatar-title rounded-circle bg-light">
                            <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                        </div>
                    </div>
                    <div class="p-2 mt-4">

                        <h4>Verify your email</h4>
                        <p class="mb-5">Please enter the 4 digit code sent to <span class="fw-bold">{{$user_email}}</span></p>

                        <form id="verify">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="digit1-input" class="visually-hidden">Dight 1</label>
                                        <input type="text" class="form-control form-control-lg text-center two-step" maxlength="1" data-value="1" id="digit1-input">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="digit2-input" class="visually-hidden">Dight 2</label>
                                        <input type="text" class="form-control form-control-lg text-center two-step" maxlength="1" data-value="2" id="digit2-input">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="digit3-input" class="visually-hidden">Dight 3</label>
                                        <input type="text" class="form-control form-control-lg text-center two-step" maxlength="1" data-value="3" id="digit3-input">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="digit4-input" class="visually-hidden">Dight 4</label>
                                        <input type="text" class="form-control form-control-lg text-center two-step" maxlength="1" data-value="4" id="digit4-input">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p class="text-muted mb-2">
                        OTP vaild for 15 Mintues Only
                    </p>

                    <p id="re-send-email-block" class="text-muted mb-0" style="display: none;">
                        Didn't receive an email ?
                        <a id="ajax_re_send_email" href="javascript:;" class="text-primary fw-semibold"> Resend </a>
                    </p>

                    <p id="wait-time-block" class="text-muted mb-0" style="display: none;">
                    </p>


                </div>
            </div>
            <div class="mt-4 mt-md-5 text-center">
                <p class="mb-0">© <script>
                        document.write(new Date().getFullYear())
                    </script>Minia . Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/pages/two-step-verification.init.js"></script>


<script>
    $(function() {

        function on_send_email() {
            $.sr.wait(60, function(s) {

                if (s == 60) {
                    $("#re-send-email-block").hide();
                    $("#wait-time-block").show();
                }

                $("#wait-time-block").html("Re-Send Link appears in " + s + " seconds");

            }, function() {

                $("#wait-time-block").hide();
                $("#re-send-email-block").show();
            });
        }

        on_send_email();

        $("#ajax_re_send_email").click(function() {
            $.loader.setInfo("Sending...").show();
            $.get("/backend/ajax_send_email_otp/{{$user_id}}", function(response) {
                if (typeof(response) == "string") {
                    response = response.trim();

                    if (response.length == 0) {
                        console.error("JSON Parse Error");

                        return false;
                    }

                    var responseJson = JSON.parse(response);
                } else {
                    responseJson = response
                }

                if (responseJson['status'] == 1) {
                    on_send_email();
                    $.loader.hide();
                }

                return false;
            }).fail(function (xhr, status, title) {  
                $.loader.hide();
                Swal.fire({
                    icon: "error",
                    showCloseButton: true,
                    title : title,
                    html: xhr.responseText,
                });
            });
        });

        $("#verify").submit(function(e) {

            e.preventDefault();

            var list = [];
            var result = true;
            $("input.two-step").each(function() {
                var v = $(this).val().trim();
                if (v) {
                    list.push(v);
                } else {
                    result = false;
                }
            });

            if (!result) {
                Swal.fire({
                    icon: "error",
                    showCloseButton: true,
                    html: "Please Enter all Digits",
                });

                return false;
            }

            var request = {
                _token : "<?= csrf_token() ?>",
                user_id : <?= $user_id ?>,
                otp : list.join("")
            };

            $.loader.setInfo("verifying...").show();

            $.post("/backend/ajax_email_otp_verify", request, function(response) {
                $.loader.hide();

                if (typeof response == "string") {
                    try {
                        response = JSON.parse(response);
                    } catch (e) {
                        Swal.fire({
                            icon: "error",
                            showCloseButton: true,
                            html: response,
                        });
                        return;
                    }
                }

                if (response["status"] == "1") {
                    Swal.fire({
                        icon: "success",
                        showCloseButton: true,
                        html: "Email Verify Successfully",
                    });

                    window.location.href = "<?= $redirect_to ?>"
                } 
                else {
                    Swal.fire({
                        icon: "warning",
                        showCloseButton: true,
                        html: response["msg"],
                    });
                }
            }).fail(function (xhr, status, title) {  
                $.loader.hide();
                Swal.fire({
                    icon: "error",
                    showCloseButton: true,
                    title : title,
                    html: xhr.responseText,
                });
            });

            return false;
        });
    });
</script>

@endsection