$(document).ready(function () {
    $("#addEventForm").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "../src/main/addNewEvent.php",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response === "success") {
                    console.log(localStorage.getItem('id'));
                    window.location.href = "../public/edit.php?id=" + localStorage.getItem('id');
                } else {
                    $("#errorMsg").html(response);
                }
            },
            error: function () {
                $("#errorMsg").html("Wystąpił błąd");
            }
        });
    });
});