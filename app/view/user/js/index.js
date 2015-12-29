var $form = $('#create-user-form');

$form.submit(createUserFormSubmited);
$('#error-container').hide();
$('.user-actions a:last-child').click(deleteUser);

function deleteUser(e)
{
    e.preventDefault();
    var parent = $((e.currentTarget).parentNode);
    var userId = (parent.attr('id')).split('-')[1];

    var url = 'http://' + document.domain + '/user/delete/' + userId;

    $.post(url, onDeletePostCompleted);

    return false;
}

function onDeletePostCompleted(data)
{
    data = JSON.parse(data);
    if(data['msg'] == 'Success') location.reload();
    else console.log(data['error']);
}

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
    if(data['msg'] == 'Success') location.reload();
    else {
        $('#error-container').html(data['error']).show();
    }
}