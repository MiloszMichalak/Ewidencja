$(document).on('click', '.delete-btn', function () {
    let row = $(this).closest('tr');
    let id = $(this).data('id');
    
    $.ajax({
        url: "../src/main/deleteEquipment.php",
        method: "POST",
        data: {
            id: id
        },
        success: function (response) {
            if (response === "success") {
                row.remove();
            }
        },
    });
});