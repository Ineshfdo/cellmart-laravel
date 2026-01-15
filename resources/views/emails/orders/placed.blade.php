<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin: 0 0 10px;
            font-weight: 800;
        }
        p {
            color: #666;
            margin: 0;
            line-height: 1.6;
        }
        .order-details-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-col {
            flex: 1;
        }
        .info-label {
            font-size: 13px;
            color: #555;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-table th {
            text-align: left;
            font-size: 12px;
            color: #333;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .product-table td {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        .product-info {
            display: flex;
            align-items: center;
        }
        .total-row {
            background-color: #f9f9f9;
            padding: 15px 20px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 800;
            font-size: 18px;
        }
        .btn-primary {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 12px 20px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
        }
        .text-right {
            text-align: right;
        }
        /* Mobile responsive */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }
            .info-row {
                flex-direction: column;
            }
            .info-col {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been successfully placed. Here's a summary of your purchase:</p>
        </div>

        <div class="order-details-box">
            <div class="info-row">
                <div class="info-col">
                    <div class="info-label">Order ID</div>
                    <div class="info-value">#{{ $order->id }}</div>
                </div>
                <div class="info-col text-right" style="text-align: left;">
                    <div class="info-label">Order Date</div>
                    <div class="info-value">{{ $order->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-col">
                    <div class="info-label">Customer Information</div>
                    <div class="info-value">{{ $order->customer_name }}</div>
                    <div class="info-value"><a href="mailto:{{ $order->customer_email }}" style="color: #666; text-decoration: none;">{{ $order->customer_email }}</a></div>
                    <div class="info-value">{{ $order->customer_phone }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-col">
                    <div class="info-label">Delivery Address</div>
                    <div class="info-value">{{ $order->delivery_address }}</div>
                </div>
            </div>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th width="40%">Product</th>
                    <th width="20%">Price</th>
                    <th width="10%" style="text-align: center;">Quantity</th>
                    <th width="30%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>
                        <div class="product-info">
                            <span style="font-weight: 600; color: #333; font-size: 14px;">{{ $product['name'] }}</span>
                        </div>
                    </td>
                    <td style="font-size: 14px; color: #555;">{{ $order->currency }} {{ number_format($product['price']) }}</td>
                    <td style="text-align: center; font-size: 14px; color: #555;">{{ $product['quantity'] }}</td>
                    <td class="text-right" style="font-weight: 700; font-size: 14px; color: #333;">{{ $order->currency }} {{ number_format($product['subtotal']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-row">
            <span>Total:</span>
            <span>{{ $order->currency }} {{ number_format($order->total_amount) }}</span>
        </div>
    </div>
</body>
</html>
