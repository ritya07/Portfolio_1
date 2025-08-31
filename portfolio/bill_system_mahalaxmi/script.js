$(document).ready(function () {
    // Initialize autocomplete for the first row
    initializeAutocomplete($(".cloth_name"));
});

function initializeAutocomplete(input) {
    input.autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "fetch_cloth_names.php",
                type: "GET",
                data: { term: request.term },
                dataType: "json",
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            const row = $(this).closest("tr");
            row.find(".cloth_name").val(ui.item.value);
            fetchPrice(row, ui.item.value);
        }
    });
}

function fetchPrice(row, clothName) {
    if (clothName) {
        fetch(`fetch_price.php?cloth_name=${clothName}`)
            .then(response => response.json())
            .then(data => {
                row.find(".cloth_price").val(data.price_per_meter);
                calculateRowTotal(row.find(".cloth_meter"));
            });
    }
}

function calculateRowTotal(input) {
    const row = $(input).closest("tr");
    const price = parseFloat(row.find(".cloth_price").val()) || 0;
    const meter = parseFloat(row.find(".cloth_meter").val()) || 0;
    const total = price * meter;
    row.find(".row_total_price").val(total.toFixed(2));
    calculateGrandTotal();
}

function calculateGrandTotal() {
    let grandTotal = 0;
    $(".row_total_price").each(function () {
        grandTotal += parseFloat($(this).val()) || 0;
    });
    $("#grand_total").val(grandTotal.toFixed(2));
}

function addRow() {
    const newRow = `
        <tr>
            <td>
                <input type="text" class="cloth_name" name="cloth_name[]" required>
            </td>
            <td>
                <input type="text" class="cloth_price" name="cloth_price[]" readonly>
            </td>
            <td>
                <input type="number" class="cloth_meter" name="cloth_meter[]" min="1" oninput="calculateRowTotal(this)" required>
            </td>
            <td>
                <input type="text" class="row_total_price" name="row_total_price[]" readonly>
            </td>
            <td>
                <button type="button" onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
    `;
    $("#cloth-table tbody").append(newRow);
    initializeAutocomplete($("#cloth-table tbody tr:last .cloth_name"));
}

function removeRow(button) {
    $(button).closest("tr").remove();
    calculateGrandTotal();
}
