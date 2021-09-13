$('document').ready(function () {

    $('#link_user_logout').click(function () {
        Swal.fire({
            icon: 'question',
            showCancelButton: true,
            text: "Είστε σίγουρος πως θέλετε να αποσυνδεθείτε;",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Αποσύνδεση",
            cancelButtonText: "Ακύρωση"
        }).then((result) => {
            if (result.value === true) {
                window.location = '../../user/user_logout.php';
            }
        });
    });

});