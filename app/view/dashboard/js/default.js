$(function(){
    $('#account-form').submit(updateAccountData);
});

function updateAccountData(e)
{
    e.preventDefault();

    var $form = $(e.target);
    var url = $form.attr('action');
    var data = $form.serialize();

    $.post(url, data, onPostCompleted);

    return false;
}

function onPostCompleted(data)
{
    console.log(data);
}