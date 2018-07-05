$(function () {
    $('.popupModal').click(function (e) {
        e.preventDefault();
        $('#modal').modal('show').find('.modal-body')
            .load($(this).attr('href'));
    });
});