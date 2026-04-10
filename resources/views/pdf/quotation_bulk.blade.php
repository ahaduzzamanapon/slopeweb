<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2457aa;
            margin: 0;
            text-transform: uppercase;
        }

        .company-tagline {
            font-size: 14px;
            font-style: italic;
            color: #666;
            margin: 0;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-row {
            margin-bottom: 3px;
        }

        .info-label {
            display: inline-block;
            width: 50px;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .price-col {
            text-align: right;
            font-weight: bold;
            width: 120px;
        }

        .remark-col {
            text-align: center;
            width: 80px;
        }

        .spec-list {
            margin: 5px 0;
            padding-left: 0;
            list-style: none;
        }

        .spec-list li {
            margin-bottom: 2px;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-box {
            width: 300px;
        }

        .terms-table {
            width: 100%;
            font-size: 12px;
        }

        .terms-table td {
            padding: 2px 4px;
            vertical-align: top;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <div class="company-name">{{ $settings->site_title ?? 'Slope Medical Solution' }}</div>
        <div class="company-tagline">Run for Rise</div>
    </div>

    <div class="title">Quotation</div>

    <div class="info-section">
        <div class="info-row"><span class="info-label">Date</span> : {{ date('d.m.Y') }}</div>
        <div class="info-row"><span class="info-label">Ref</span> : {{ $refId }}</div>
    </div>

    <div class="info-section">
        <strong>To,</strong><br>
        The Managing Director<br>
        {{ $client['name'] }}<br>
        {{ $client['address'] }}<br>
        {{ $client['phone'] }}
    </div>

    <div class="content-section">
        <p><strong>Subject: Price Proposal for Hospital and Diagnostic Equipment's.</strong></p>
        <p>Dear Sir,</p>
        <p>First and for most, on behalf of <strong>{{ $settings->site_title ?? 'Slope Medical Solution' }}</strong>. We would like to express our
            profound appreciation for giving us the opportunity to offer price quotation for diagnostic &amp; hospital items
            for your hospital or diagnostic.</p>
        <p>We hope you will find our proposal in line with your requirements. However, if you need any further
            clarification please let us know.</p>
        <p>We assure you our best services and closest attention at all times.</p>
        <p>Thanking You.</p>
    </div>

    {{-- Products Table --}}
    @php $grandTotal = 0; @endphp
    <table class="table">
        <thead>
            <tr>
                <th width="30">S/N</th>
                <th>Product Details</th>
                <th>Price</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            @php $grandTotal += $product->price; @endphp
            <tr>
                <td align="center">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <strong>{{ $product->title }}</strong><br>
                    <ul class="spec-list">
                        @if($product->brand)
                        <li>Brand : {{ $product->brand }}</li>
                        @endif
                        @if($product->model)
                        <li>Model : {{ $product->model }}</li>
                        @endif
                        @if($product->origin)
                        <li>Origin : {{ $product->origin }}</li>
                        @endif
                        @if($product->warranty)
                        <li>Warranty : {{ $product->warranty }}</li>
                        @endif
                    </ul>
                    @if($product->features)
                        <div style="margin-top: 8px;">
                            <strong>Features:</strong>
                            <div style="font-size: 11px;">{!! $product->features !!}</div>
                        </div>
                    @endif
                    @if($product->installation_charge > 0)
                        <div style="margin-top: 8px; font-weight: bold;">
                            Installation Charge {{ number_format($product->installation_charge, 0) }} TK Need To Pay By The Buyer
                        </div>
                    @endif
                </td>
                <td class="price-col">
                    @if($product->price > 0)
                        {{ number_format($product->price, 2) }}
                    @else
                        --
                    @endif
                </td>
                <td class="remark-col">{{ $product->stock_status == 'in_stock' ? 'Ready stock' : 'On order' }}</td>
            </tr>
            @endforeach

            {{-- Grand Total Row --}}
            @if($grandTotal > 0)
            <tr class="total-row">
                <td colspan="2" style="text-align: right; font-weight: bold;">Total Estimated Amount:</td>
                <td class="price-col">{{ number_format($grandTotal, 2) }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- Terms & Conditions --}}
    <div class="content-section">
        <p><strong>Terms and condition</strong></p>
        <table class="terms-table">
            <tr><td width="100">Price</td><td>: In BDT excluding all local Vat, taxes and charges. Any deduction will be added.</td></tr>
            <tr><td>Delivery</td><td>: 05 (Five) Days from the date of confirm order.</td></tr>
            <tr><td>Warranty</td><td>: 12 (Twelve) months from the date of successful installation.</td></tr>
            <tr><td>Installation</td><td>: By our Technical Personnel at free of cost.</td></tr>
            <tr><td>Training</td><td>: We will provide operational training to the Operator/End user up to their satisfaction.</td></tr>
            <tr><td>Spare Parts</td><td>: To be supplied on demand at mutually agreed prices.</td></tr>
            <tr><td>Validity</td><td>: 05 (Five) days from quoting date.</td></tr>
            <tr><td>Transport Cost</td><td>: Every type transport cost will pay by buyer.</td></tr>
        </table>
    </div>

    <div class="content-section">
        <p>Therefore, we hope, you will find our offer reasonable and look forward to your valued order as and when required. Thanking you for your kind support with best regards.</p>
        <p><strong>We assure you that of our best Engineering support at all time.</strong></p>
        <p>Thanking You.</p>
    </div>

    {{-- Signature --}}
    <div class="signature-section">
        <div class="signature-box">
            <p>Sincerely yours</p>
            <div style="height: 50px; margin-bottom: 5px;">
                @if($settings->signature)
                    <img src="{{ public_path('storage/' . $settings->signature) }}" style="max-height: 50px;">
                @endif
            </div>
            <strong>{{ $preparedBy }}</strong><br>
            Managing Director<br>
            Cell: {{ $settings->phone ?? '01717589756' }}<br>
            {{ $settings->site_title ?? 'Slope Medical Solution' }}<br>
            <span style="font-size: 11px;">{{ $settings->address ?? '59/D-A Darussalam Tower, Shop No-31(Ground Floor), Darussalam, Dhaka' }}</span>
        </div>
    </div>
</body>

</html>
