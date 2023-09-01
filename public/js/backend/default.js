$(document).ready(function()
{
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
});