$(document).ready(function () {
    $("#add-equipment-form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "../src/main/addEquipment.php",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response === "success") {
                    window.location.href = "../public/index.php";
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