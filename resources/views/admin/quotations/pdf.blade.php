<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #3819e7; padding-bottom: 20px; }
        .company-name { font-size: 24px; font-weight: bold; color: #3819e7; margin-bottom: 5px; }
        .company-details { font-size: 12px; color: #666; }
        .quotation-title { text-align: center; font-size: 20px; font-weight: bold; margin: 20px 0; text-transform: uppercase; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; }
        .date { text-align: right; margin-bottom: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #3819e7; color: #fff; }
        .total-row td { font-weight: bold; background-color: #f8f9fa; }
        .signature-section { margin-top: 50px; text-align: right; }
        .signature-img { height: 60px; margin-bottom: 10px; }
        .md-name { font-weight: bold; font-size: 16px; }
        .md-title { color: #666; font-size: 14px; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    @php
        $total = 0;
    @endphp

    <div class="header">
        <div class="company-name">{{ $settings->site_title ?? 'Slope Medical Solution' }}</div>
        <div class="company-details">
            {{ $settings->address }}<br>
            Phone: {{ $settings->phone }} | Email: {{ $settings->email }}
        </div>
    </div>

    <div class="date">
        Date: {{ date('F d, Y') }}
    </div>

    <div class="quotation-title">
        Commercial Quotation
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">S/N</th>
                <th width="45%">Product Description</th>
                <th width="20%">Category</th>
                <th width="25%" style="text-align: right;">Unit Price (USD)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
                @php $total += $product->price; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $product->title }}</strong>
                        @if($product->specifications && is_array($product->specifications))
                            <br>
                            <span style="font-size: 11px; color: #555;">
                                @foreach(array_slice($product->specifications, 0, 3) as $key => $val)
                                    {{ $key }}: {{ $val }}<br>
                                @endforeach
                            </span>
                        @endif
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td style="text-align: right;">${{ number_format($product->price, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Estimated Total:</td>
                <td style="text-align: right;">${{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="font-size: 12px; color: #555; background: #fdfdfd; padding: 15px; border-left: 3px solid #3819e7;">
        <strong>Terms & Conditions:</strong><br>
        1. Validity: This quotation is valid for 30 days from the date of issue.<br>
        2. Payment Terms: 100% advance or as per agreement.<br>
        3. Delivery: Subject to stock availability.<br>
        4. Warranty: Standard manufacturer warranty applies unless stated otherwise.
    </div>

    <div class="signature-section">
        @if($settings->signature)
            <!-- Make sure to use public_path to fetch the physical file for dompdf -->
            <img src="{{ public_path('storage/' . $settings->signature) }}" class="signature-img" alt="Signature"><br>
        @endif
        <div class="md-name">{{ $settings->md_name ?? 'Managing Director' }}</div>
        <div class="md-title">Managing Director</div>
        <div class="md-title">{{ $settings->site_title ?? 'Slope Medical Solution' }}</div>
    </div>

    <div class="footer">
        {{ $settings->footer_text ?? '© ' . date('Y') . ' Slope Medical Solution. All rights reserved.' }}
    </div>
</body>
</html>
