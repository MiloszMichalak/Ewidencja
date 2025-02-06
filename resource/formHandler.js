$(document).ready(function () {
        $("#registerForm").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: "../src/auth/registerFormLogic.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response === "success") {
                        window.location.href = "../public/main.php";
                    } else {
                        $("#errorMsg").text(response);
                    }
                },
                error: function () {
                    $("#errorMsg").html("Wystąpił błąd");
                }
            });
        });
});

$(document).ready(function () {
    $("#loginForm").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "../src/auth/loginFormLogic.php",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response === "success") {
                    window.location.href = "../public/main.php";
                } else {
                    $("#errorMsg").text(response);
                }
            },
            error: function () {
                $("#errorMsg").html("Wystąpił błąd");
            }
        });
    });
});
