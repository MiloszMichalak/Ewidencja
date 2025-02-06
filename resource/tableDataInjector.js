$(document).ready(function () {
    let table = $("#equipment-table").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [
            { orderable: false, targets: [12, 13] },
        ],
        ajax: {
            url: "../src/main/fetchData.php",
            type: "GET",
            dataSrc: ""
        },
        columns: [
            { data: "numerInwentaryzacyjny" },
            { data: "numerSeryjny" },
            { data: "urzadzenie_nazwa" },
            { data: "producent_nazwa" },
            { data: "model" },
            { data: "lokalizacja_nazwa" },
            {
                data: null,
                render: function (data) {
                    return data.dostawca_nazwa + '<br>' +
                        data.dostawca_adres + '<br>' +
                        data.dostawca_telefon + '<br>' +
                        data.dostawca_email;
                }
            },
            { data: null,
                render: function (data) {
                    return convertDate(data.dataZakupu);
                }
            },
            { data: null,
                render: function (data) {
                    return convertDate(data.dataGwarancji);
                }
            },
            { data: null,
                render: function (data) {
                    return convertDate(data.dataPrzegladu);
                }
            },
            { data: null,
                render: function (data) {
                    return data.wartoscBrutto.replaceAll(".", ",") + ' zł';
                }    
            },
            { data: "status_nazwa" },
            { data: "uwagi"},
            {
                data: null,
                render: function (data) {
                    return data.zdarzenie_opisZdarzenia + '<br>' +
                        data.zdarzenie_dataRozpoczecia + ' - ' +
                        data.zdarzenie_dataZakonczenia + '<br>' +
                        data.typ_zdarzenia + '<br>' +
                        '<a href="' + data.zdarzenie_zalacznik + '">Załącznik</a>';
                }
            },
            {
                data: null,
                render: function (data) {
                    return '<a href="../public/edit.php?id='+ data.idSprzetu +'">Edytuj</a>';
                }
            }
        ]
    });
    
    $("#equipment-table thead tr:eq(1) th").each(function (i) {
        $(".filter", this).on("keyup change", function () {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    table.search.fixed('range', function (searchStr, data) {
        let min = parseFloat($("#min-price").val()) || 0;
        let max = parseFloat($("#max-price").val()) || Infinity;

        let price = data[11].replaceAll(",", ".");

        return (isNaN(min) && isNaN(max)) ||
            (isNaN(min) && price <= max) ||
            (min <= price && isNaN(max)) ||
            (min <= price && price <= max);
    });
    
    $("#min-price, #max-price").on("keyup change", function (){
        table.draw();
    })

    function addDateRangeFilter(table, columnIndex, minInputId, maxInputId) {
        $.fn.dataTable.ext.search.push(function (settings, data) {
            let minDate = new Date($(minInputId).val()).getTime();
            let maxDate = new Date($(maxInputId).val()).getTime();
             
            let rowDate = new Date(reverse(data[columnIndex].replaceAll(".", "-"))).getTime();

            return (isNaN(minDate) && isNaN(maxDate)) ||
                (isNaN(minDate) && rowDate <= maxDate) ||
                (minDate <= rowDate && isNaN(maxDate)) ||
                (minDate <= rowDate && rowDate <= maxDate);
        });
        
        $(minInputId + ", " + maxInputId).on("keyup change", function () {
            table.draw();
        });
    }
    
    addDateRangeFilter(table, 7, "#min-date1", "#max-date1");
    addDateRangeFilter(table, 8, "#min-date2", "#max-date2"); 
    addDateRangeFilter(table, 9, "#min-date3", "#max-date3");

    function filterBySelect(id, columnIndex) {
        $(id).on("change", function () {
            table.column(columnIndex)
                .search(this.value)
                .draw();
        });
    }
    
    filterBySelect("#select-filter2", 5);
    filterBySelect("#select-filter3", 11);
    
    $("#select-filter1").on("change", function () {
        table.column(3)
            .search(this.value)
            .draw();

        table.column(4).search("").draw();
        $("#select-models").find("option:not(:first)").remove()
        if (this.value == "") {
            $.ajax({
                url: "../src/main/fetchModels.php",
                type: "GET",
                success: function (response) {
                    console.log(response);
                    let models = JSON.parse(response);

                    models.forEach(function (model) {
                        $("#select-models").append("<option value='" + model + "'>" + model + "</option>");
                    });

                },
                error: function (xhr, status, error) {
                    console.error("Błąd podczas pobierania modeli:", error);
                }
            });
        } else {
            $.ajax({
                url: "../src/main/fetchModelsByName.php?name=" + this.value,
                type: "GET",
                success: function (response) {
                    let models = JSON.parse(response);

                    models.forEach(function (model) {
                        $("#select-models").append("<option value='" + model + "'>" + model + "</option>");
                    });

                },
                error: function (xhr, status, error) {
                    console.error("Błąd podczas pobierania modeli:", error);
                }
            });
        }
    });

    $("#select-models").on("change", function () {
        const selectedModel = $(this).val();

        if (selectedModel) {
            // Filtruj dane w kolumnie 4 (model)
            table.column(4).search("^" + selectedModel + "$", true, false).draw();
        } else {
            // Resetuj filtr w kolumnie 4
            table.column(4).search("").draw();
        }
    });



    filterBySelect("#select-models", 4);
    
});

function reverse(s){
    let parts = s.split("-");
    return parts[2] + "-" + parts[1] + "-" + parts[0];
}

function convertDate(stringDate){
    let date = new Date(stringDate);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }

    return day + '.' + month + '.' + year;
}