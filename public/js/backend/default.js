$(document).ready(function()
{
    $("form").find("div.pristine-error").parents(".form-group").addClass("has-danger");

    $("input[type='checkbox'].chk-select-all").chkSelectAll();

    $(".select2").select2({
        placeHolder : "Please Select",
        theme : "bootstrap-5",
    });

    $("form.delete").submit(function()
    {
        var _form = $(this);

        var is_confirm = _form.attr("data-confirm");

        if (!is_confirm)
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#2ab57d",
                cancelButtonColor: "#fd625e",
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
        _form.find(':input').not(':button, :submit, :reset, :hidden').val('').prop('checked', false).prop('selected', false);
        _form.trigger("submit");
    });
});