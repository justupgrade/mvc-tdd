var $form = $('#create-user-form');

$form.submit(createUserFormSubmited);

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
    console.log(data);
}