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

        .page-break {
            page-break-after: always;
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
            text-decoration: none;
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
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-bottom: 1px solid #000;
        }

        .table th {
            border: 1px solid #000;
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            vertical-align: top;
        }

        .table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-top: none;
            border-bottom: none;
            padding: 8px;
            vertical-align: top;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-box {
            width: 300px;
        }

        .footer-info {
            font-size: 11px;
            margin-top: 10px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
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

        .feature-list {
            padding-left: 20px;
            margin-top: 5px;
        }

        .feature-list li {
            margin-bottom: 2px;
        }
        .flist { margin-left:0px; }
        .flist ul {
            list-style-type: disc !important;
            margin: 5px 0 5px 20px !important;
            padding-left: 0 !important;
        }
        .flist ol {
            list-style-type: decimal !important;
            margin: 5px 0 5px 20px !important;
            padding-left: 0 !important;
        }
        .flist li {
            margin-bottom: 3px !important;
            font-size:11px;
            line-height:1.5;
            display: list-item !important;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">Slope Medical Solution</div>
        <div class="company-tagline">Run for Rise</div>
    </div>

    <div class="title">Quotation</div>

    <div class="info-section">
        <div class="info-row"><span class="info-label">Date</span> : {{ date('d.m.Y') }}</div>
        <div class="info-row"><span class="info-label">Ref</span> :
            Quotation-Slope/MD-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}/{{ date('Y') }}</div>
    </div>

    <div class="info-section">
        <strong>To,</strong><br>
        The Managing Director<br>
        [Client Hospital/Center Name]<br>
        [Client Address]<br>
        [Client Phone]
    </div>

    <div class="content-section">
        <p><strong>Subject: Price Proposal for Hospital and Diagnostic Equipment’s.</strong></p>

        <p>Dear Sir,</p>
        <p>First and for most, on behalf of <strong>Slope Medical Solution</strong>. We would like to express our
            profound appreciation for giving us the opportunity to offer price quotation for diagnostic & hospital items
            for your hospital or diagnostic.</p>
        <p>We hope you will find our proposal in line with your requirements. However, if you need any further
            clarification please let us know.</p>
        <p>We assure you our best services and closest attention at all times.</p>
        <p>Thanking You.</p>
    </div>

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
            <tr>
                <td align="center">01</td>
                <td>
                    <strong>{{ $product->title }}</strong><br>
                    <ul class="spec-list">
                        @if($product->brand)
                        <li>Brand :{{ $product->brand }}</li> @endif
                        @if($product->model)
                        <li>Model :{{ $product->model }}</li> @endif
                        @if($product->origin)
                        <li>Origin :{{ $product->origin }}</li> @endif
                        @if($product->warranty)
                        <li>Warranty :{{ $product->warranty }}</li> @endif
                    </ul>
                </td>
                <td class="price-col">
                    @if($product->price > 0)
                        {{ number_format($product->price, 2) }}
                    @else
                        --
                    @endif
                </td>
                <td class="remark-col">
                    {{ $product->stock_status == 'in_stock' ? 'Ready stock' : 'On order' }}
                </td>
            </tr>

            @if($product->features)
            <tr>
                <td></td>
                <td>
                    <strong>Special Features:</strong>
                    <div class="flist">
                        {!! $product->features !!}
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @if($product->short_description)
            <tr>
                <td></td>
                <td>
                    <strong>Technical Description:</strong>
                    <div class="flist">
                        {!! $product->short_description !!}
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @if($product->description)
            <tr>
                <td></td>
                <td>
                    <strong>Product Description:</strong>
                    <div class="flist">
                        {!! $product->description !!}
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @if($product->installation_charge > 0)
            <tr>
                <td></td>
                <td>
                    <div style="font-weight: bold;">
                        Installation Charge {{ number_format($product->installation_charge, 0) }} TK Need To Pay By The Buyer
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="content-section">
        <p><strong>Terms and condition</strong></p>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td width="100">Price</td>
                <td>: In BDT excluding all local Vat, taxes and charges. Any deduction will be added.</td>
            </tr>
            <tr>
                <td>Delivery</td>
                <td>: 05 (Five) Days from the date of confirm order.</td>
            </tr>
            <tr>
                <td>Warranty</td>
                <td>: 12 (Twelve) months from the date of successful installation.</td>
            </tr>
            <tr>
                <td>Installation</td>
                <td>: By our Technical Personnel at free of cost.</td>
            </tr>
            <tr>
                <td>Training</td>
                <td>: We will provide operational training to the Operator/End user up to their satisfaction.</td>
            </tr>
            <tr>
                <td>Spare Parts</td>
                <td>: To be supplied on demand at mutually agreed prices.</td>
            </tr>
            <tr>
                <td>Validity</td>
                <td>: 05 (Five) days from quoting date.</td>
            </tr>
            <tr>
                <td>Transport Cost</td>
                <td>: Every type transport cost will pay by byer.</td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <p>Therefore, we hope, you will find our offer reasonable and look forward to your valued order as and when
            required. Thanking you for your kind support with best regards.</p>
        <p><strong>We assure you that of our best Engineering support at all time.</strong></p>
        <p>Thanking You.</p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Sincerely yours</p>
            <div style="height: 50px; margin-bottom: 5px;">
                @if($settings->signature)
                    <img src="{{ public_path('storage/' . $settings->signature) }}" style="max-height: 50px;">
                @endif
            </div>
            <strong>{{ $settings->md_name ?? 'Md.Saidul Islam (Sobuj)' }}</strong><br>
            Managing Director<br>
            Cell: {{ $settings->phone ?? '01717589756' }}<br>
            Slope Medical Solution<br>
            <span
                style="font-size: 11px;">{{ $settings->address ?? '59/D-A Darussalam Tower, Shop No-31(Ground Floor), Darussalam, Dhaka' }}</span>
        </div>
    </div>
</body>

</html>