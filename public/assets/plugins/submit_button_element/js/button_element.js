/*!
 * Button Element v0.10
 */
$("form").on("submit", function()
{
    if($(this).valid())
    {
        $('button[type="submit"]').addClass('submit_loader');
        $('input[type="submit"]').addClass('submit_loader');
    }
});