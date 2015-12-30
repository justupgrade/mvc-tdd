var $form = $('#create-user-form');

$form.submit(createUserFormSubmited);
$('#error-container').hide();
$('.user-actions a:last-child').click(deleteUser);

//hide all edits:
$('.user-actions a:first-child').click(onSaveClick).hide();

$('.user-actions a:nth-child(2)').click(onEditClick);

var currentEditRow = null;

function onEditClick(e)
{
    e.preventDefault();

    var $actions = null;

    if(currentEditRow) {
        $actions = currentEditRow.children().last();
        $actions.children().first().hide();
        currentEditRow.children().first().next().children().first().prop("disabled", true);
        currentEditRow.children().first().next().next().children().first().prop("disabled", true);
        //$actions.children().first().next().show();
    }

    currentEditRow = $((e.currentTarget.parentNode).parentNode);
    $actions = currentEditRow.children().last();
    $actions.children().first().show();
    //$actions.children().first().next().hide();
    currentEditRow.children().first().next().children().first().prop("disabled", false);
    currentEditRow.children().first().next().next().children().first().prop("disabled", false);
}

function onSaveClick(e)
{
    e.preventDefault();
}

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