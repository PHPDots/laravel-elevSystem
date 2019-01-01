$(document).ready(function () {
        $('#submit-form').submit(function () {
            if (true)
            {
                $('#submitBtn').attr('disabled',true);
                $('#AjaxLoaderDiv').fadeIn('slow');
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    {
                        $('#submitBtn').attr('disabled',false);
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success success-msg', delay: 4000});
                            window.location = $('#submit-form').attr('redirect-url');
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger error-msg', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#submitBtn').attr('disabled',false);
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger error-msg', delay: 4000});
                    }
                });
            }
            return false;
        });
    });