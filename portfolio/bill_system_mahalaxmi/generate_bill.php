<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cloth_names = $_POST['cloth_name'];
    $cloth_prices = $_POST['cloth_price'];
    $cloth_meters = $_POST['cloth_meter'];
    $row_totals = $_POST['row_total_price'];
    $grand_total = $_POST['grand_total'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Bill</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .receipt {
                width: 300px; /* Adjust for thermal printer paper width */
                margin: 0 auto;
                padding: 10px;
                border: 1px dashed #000;
            }
            .receipt-header, .receipt-footer {
                text-align: center;
                margin-bottom: 10px;
            }
            .receipt-header h1, .receipt-footer h3 {
                margin: 0;
                font-size: 16px;
            }
            .receipt-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }
            .receipt-table th, .receipt-table td {
                border-bottom: 1px solid #ddd;
                padding: 5px;
                text-align: left;
            }
            .receipt-footer {
                margin-top: 20px;
                font-size: 14px;
            }
            .print-button {
                display: block;
                text-align: center;
                margin-top: 20px;
            }
            @media print {
                .print-button {
                    display: none;
                }
                .receipt {
                    border: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="receipt">
            <div class="receipt-header">
                <h1>Mahalaxmi Cloth Store</h1>
                <p>Address: Rajarampuri 7th Lane</p>
                <p>Phone: 9404954212</p>
            </div>
            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>Cloth</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cloth_names as $index => $name) { ?>
                        <tr>
                            <td><?php echo $name; ?></td>
                            <td>₹<?php echo $cloth_prices[$index]; ?></td>
                            <td><?php echo $cloth_meters[$index]; ?></td>
                            <td>₹<?php echo $row_totals[$index]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
            <div class="receipt-footer">
                <p><strong>Grand Total: ₹<?php echo $grand_total; ?></strong></p>
                <h3>Thank You! Visit Again</h3>
            </div>
            <div class="print-button">
                <button onclick="window.print()">Print Bill</button>
            </div>
        </div>
    </body>
    </html>
<?php
}
?>
