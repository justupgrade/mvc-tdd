var $form = $('#create-user-form');

$form.submit(createUserFormSubmited);
$('#error-container').hide();

function createUserFormSubmited(e)
{
    e.preventDefault();

    var data = $form.serialize();
    var url = $form.attr('action');

    $.post(url, data, onPostCompleted);

    return false;
}

function onPostCompleted(data)
{
    data = JSON.parse(data);
    console.log(data);
    if(data['msg'] == 'Success') location.reload();
    else {
        $('#error-container').html(data['error']).show();
    }
}