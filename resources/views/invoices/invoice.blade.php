<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $booking->booking_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin: auto;
        }

        .header {
            text-align: center;
        }

        .details,
        .items,
        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details td,
        .items td,
        .items th,
        .summary td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .items th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Invoice #{{ $booking->booking_id }}</h2>
            <p>{{ now()->format('d M Y') }}</p>
        </div>

        <table class="details">
            <tr>
                <td><strong>Start Date:</strong> {{ $booking->start_date->format('d M Y, H:i') }}</td>
                <td><strong>End Date:</strong> {{ $booking->end_date->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td><strong>Duration:</strong> {{ $totalDays }} days</td>
                <td><strong>Total Price:</strong> Rp{{ number_format($booking->price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <table class="items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price per day</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking->products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>Rp{{ number_format($product->pivot->price / $totalDays, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary">
            <tr>
                <td class="text-right"><strong>Grand Total:</strong></td>
                <td class="text-right"><strong>Rp{{ number_format($booking->price, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
