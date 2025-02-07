$(document).ready(function () {
    $("#editForm").on("submit", function (e) {
        e.preventDefault(); 
        
        let formData = {
            idSprzetu: $("input[name='idSprzetu']").val(),
            dataPrzegladu: $("#dataPrzegladu").val(),
            wartoscBrutto: $("#wartoscBrutto").val(),
            lokalizacja: $("#lokalizacja").val(),
            status: $("#status").val(),
            uwagi: $("#uwagi").val(),
            zdarzenia: $("input[name='zdarzenia']:checked")
                .map(function () {
                    return $(this).val();
                })
                .get(), 
        };
        
        $.ajax({
            url: "../src/main/updateEquipment.php", 
            type: "POST",
            data: formData,
            success: function (response) {
                window.location.href = "../public/index.php"; 
            },
            error: function () {
                alert("Wystąpił błąd podczas aktualizacji.");
            },
        });
    });
});
