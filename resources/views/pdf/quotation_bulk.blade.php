<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Quotation - {{ $refId }}</title>
<style>
    @page { margin: 3cm 0cm 3.5cm 0cm; }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#000; line-height:1.5; padding: 0 40px; }

    /* ── LETTERHEAD ─────────────────────────────── */
    .lh { width:100%; border-bottom:4px solid #1a3a8f; padding-bottom:8px; margin-bottom:16px; text-align:center; }
    .lh img { max-width:100%; height:auto; }

    /* ── FOOTER (fixed) ──────────────────────────── */
    .pg-footer {
        position:fixed; bottom:0.8cm; left:0; right:0;
        border-top:3px solid #1a3a8f; padding-top:4px;
        font-size:9px; color:#333; text-align:center; background:#fff;
    }

    /* ── PAGE BREAK ──────────────────────────────── */
    .pb { page-break-after:always; }

    /* ── COVER LETTER ────────────────────────────── */
    .cov-title { text-align:center; font-size:17px; font-weight:bold; text-decoration:underline; font-style:italic; margin:14px 0; }
    .dr-tbl { width:auto; margin-bottom:14px; }
    .dr-tbl td { padding:2px 6px 2px 0; font-size:12px; }
    .dr-tbl .lbl { font-weight:bold; width:40px; }
    .to-blk { margin-bottom:16px; line-height:1.8; }
    .subj { font-weight:bold; margin-bottom:14px; }
    .body-txt { line-height:1.9; margin-bottom:14px; text-align:justify; }
    .sig { margin-top:30px; }
    .sig img { height:50px; display:block; margin-bottom:4px; }
    .sig .sn { font-weight:bold; font-size:13px; }
    .sig .sd { font-size:11px; line-height:1.7; }

    /* ── PRODUCT TABLE ───────────────────────────── */
    .ptbl { width:100%; border-collapse:collapse; }
    .ptbl th { background:#1a3a8f; color:#fff; border:1px solid #333; padding:6px 8px; font-size:12px; text-align:center; }
    .ptbl td { border-left:1px solid #555; border-right:1px solid #555; border-top:none; border-bottom:none; padding:6px 8px; vertical-align:top; }
    .ptbl .sn { text-align:center; font-weight:bold; width:38px; }
    .ptbl .pr { text-align:right; width:110px; font-weight:bold; }
    .ptbl .rm { text-align:center; width:80px; }
    .pname { font-weight:bold; text-decoration:underline; font-size:13px; }
    .pmeta { font-size:11px; line-height:1.9; margin-top:5px; }
    .pmeta span { display:inline-block; width:68px; font-weight:bold; }
    .pimg  { max-width:180px; max-height:140px; display:block; margin:8px auto; }
    .fhd   { font-weight:bold; text-decoration:underline; margin-top:8px; margin-bottom:3px; font-size:12px; }
    .flist { margin-left:0; }
    .flist ul {
        list-style-type: disc;
        padding-left: 18px;
        margin: 4px 0;
    }
    .flist ol {
        list-style-type: decimal;
        padding-left: 18px;
        margin: 4px 0;
    }
    .flist li {
        display: list-item;
        margin-bottom: 3px;
        font-size:11px;
        line-height:1.6;
    }
    .inst-note { font-weight:bold; margin-top:6px; font-size:12px; }
    .spec-tbl  { width:100%; font-size:11px; }
    .spec-tbl td { border:none; padding:1px 4px 1px 0; }
    .spec-tbl td:first-child { width:170px; }

    /* ── T&C PAGE ─────────────────────────────────── */
    .tc-title { text-align:center; font-size:16px; font-weight:bold; text-decoration:underline; font-style:italic; margin:14px 0 18px; }
    .tc-tbl   { width:100%; }
    .tc-tbl td { padding:4px 0; vertical-align:top; line-height:1.7; }
    .tc-tbl td:first-child { font-weight:bold; white-space:nowrap; padding-right:8px; width:130px; }
    .tc-closing { margin-top:16px; font-weight:bold; line-height:1.8; text-align:justify; }
    .tc-assur   { font-size:14px; margin-top:10px; }
</style>
</head>
<body>

{{-- Fixed footer every page --}}
<div class="pg-footer">
    {{ $settings->address ?? '59/D-A, Darussalam Tower, Shop no-31(Ground Floor), Darussalam, Mirpur, Dhaka-1216.' }}
    &nbsp;|&nbsp; Hotline: {{ $settings->phone ?? '01730587330' }}
    &nbsp;|&nbsp; E-mail: {{ $settings->email ?? 'slopemedical@gmail.com' }}
    &nbsp;|&nbsp; Website: {{ $settings->website ?? 'www.slope.com.bd' }}
</div>

{{-- ══════════════════════════════════════════════════
     PAGE 1 — COVER LETTER
══════════════════════════════════════════════════ --}}
<div class="lh">
    <img src="{{ public_path('q_header_image.png') }}" alt="Slope Medical Solution">
</div>

<div class="cov-title"><u><i>Quotation</i></u></div>

<table class="dr-tbl">
    <tr><td class="lbl">Date</td><td>:&nbsp;<strong>{{ date('d.m.Y') }}</strong></td></tr>
    <tr><td class="lbl">Ref</td> <td>:&nbsp;<strong>Quotation-{{ $refId }}</strong></td></tr>
</table>

<div class="to-blk">
    <p>To,</p>
    <p><strong>{{ $client['designation'] ?? 'The Managing Director' }}</strong></p>
    <p><strong>{{ $client['name'] ?? '' }}</strong></p>
    <p>{{ $client['address'] ?? '' }}</p>
    <p>{{ $client['phone'] ?? '' }}</p>
</div>

<p class="subj">Subject: Price Proposal for Hospital and Diagnostic Equipment's.</p>

<div class="body-txt">
    <p>Dear Sir,</p>
    <p>First and for most, on behalf of <strong>{{ $settings->site_title ?? 'Slope Medical Solution' }}</strong>. We would like to express our profound appreciation for giving us the opportunity to offer price quotation for <strong>diagnostic &amp; hospital</strong> items&nbsp; for your hospital or diagnostic.<br>
    We hope you will find our proposal in line with your requirements. However, if you need any further clarification please let us know.</p>
    <br>
    <p>We assure you our best services and closest attention at all times.</p>
</div>

<p style="font-weight:bold;margin-bottom:30px;">Thanking You.</p>
<br><br>

<div class="sig">
    <p>Sincerely yours</p>
    @if($settings->signature)
        <img src="{{ public_path('storage/'.$settings->signature) }}" alt="Signature">
    @else
        <br><br><br>
    @endif
    <p class="sn">{{ $settings->md_name ?? $preparedBy }}</p>
    <div class="sd">
        Managing Director<br>
        @if(!empty($settings->phone))Cell: {{ $settings->phone }}<br>@endif
        <strong>{{ $settings->site_title ?? 'Slope Medical Solution' }}</strong><br>
        {{ $settings->address ?? '' }}
    </div>
</div>

<div class="pb"></div>

{{-- ══════════════════════════════════════════════════
     PAGES 2+ — ONE PRODUCT PER PAGE
══════════════════════════════════════════════════ --}}
@foreach($products as $i => $product)
<div class="{{ !$loop->last ? 'pb' : '' }}">

    <div class="lh">
        <img src="{{ public_path('q_header_image.png') }}" alt="Slope Medical Solution">
    </div>

    <table class="ptbl">
        <thead>
            <tr>
                <th class="sn">S/N</th>
                <th>Product Details</th>
                <th class="pr">Price</th>
                <th class="rm">Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="sn" style="font-size:14px;">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <div class="pname">{{ $product->title }}</div>
                    <div class="pmeta">
                        @if($product->brand)   <div><span>Brand</span>    :&nbsp;{{ $product->brand }}</div>@endif
                        @if($product->model)   <div><span>Model</span>    :&nbsp;{{ $product->model }}</div>@endif
                        @if($product->origin)  <div><span>Origin</span>   :&nbsp;{{ $product->origin }}</div>@endif
                        @if($product->warranty)<div><span>Warranty</span> :&nbsp;{{ $product->warranty }}</div>@endif
                        @if($product->assembly)<div><span>Assembly</span> :&nbsp;{{ $product->assembly }}</div>@endif
                    </div>
                </td>
                <td class="pr">
                    @php $price = $product->custom_price ?? $product->price; @endphp
                    @if($price > 0) {{ number_format($price * ($product->custom_quantity ?? 1), 2) }} @else — @endif
                </td>
                <td class="rm">
                    {{ ($product->stock_status === 'in_stock' || !$product->stock_status) ? 'Ready stock' : ucfirst(str_replace('_',' ',$product->stock_status)) }}
                </td>
            </tr>

            @if($product->image)
            <tr>
                <td></td>
                <td>
                    @php $imgSrc = str_starts_with($product->image,'http') ? $product->image : public_path('storage/'.$product->image); @endphp
                    <img src="{{ $imgSrc }}" class="pimg" alt="{{ $product->title }}">
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @if($product->features)
            <tr>
                <td></td>
                <td>
                    <div class="fhd">Special Features:</div>
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
                    <div class="fhd">Technical Description:</div>
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
                    <div class="fhd">Product Description:</div>
                    <div class="flist">
                        {!! $product->description !!}
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif
 
            @if(!$product->features && !$product->short_description && !$product->description && $product->specifications && is_array($product->specifications) && count($product->specifications))
            <tr>
                <td></td>
                <td>
                    <div class="fhd">Technical Specification</div>
                    <table class="spec-tbl">
                        @foreach($product->specifications as $k => $v)
                            <tr><td>{{ $k }}</td><td>: {{ $v }}</td></tr>
                        @endforeach
                    </table>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @if(!empty($product->installation_charge) && $product->installation_charge > 0)
            <tr>
                <td></td>
                <td>
                    <p class="inst-note">Installation Charge &nbsp; {{ number_format($product->installation_charge, 0) }} TK Need To Pay By The Buyer</p>
                </td>
                <td></td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>
    <div style="background:#555; height:1px; width:100%; font-size:0; line-height:0;"></div>
</div>
@endforeach

<div class="pb"></div>

{{-- ══════════════════════════════════════════════════
     LAST PAGE — TERMS & CONDITIONS
══════════════════════════════════════════════════ --}}
<div class="lh">
    <img src="{{ public_path('q_header_image.png') }}" alt="Slope Medical Solution">
</div>

<div class="tc-title"><u><i>Terms and condition</i></u></div>

@if(isset($termConditions) && $termConditions->count() > 0)
<table class="tc-tbl">
    @foreach($termConditions as $tc)
    <tr>
        <td>{{ $tc->title }}</td>
        <td>: {!! nl2br(e($tc->content)) !!}</td>
    </tr>
    @endforeach
</table>
@else
<table class="tc-tbl">
    <tr><td>Price</td>          <td>: In BDT excluding all local Vat, taxes and charges. Any deduction will be added.</td></tr>
    <tr><td>Delivery</td>       <td>: 05 (Five) Days from the date of confirm order.</td></tr>
    <tr><td>Warranty</td>       <td>: 12 (Twelve) months from the date of successful installation.</td></tr>
    <tr><td>Installation</td>   <td>: By our Technical Personnel at free of cost.</td></tr>
    <tr><td>Training</td>       <td>: We will provide operational training to the Operator/End user up to their satisfaction.</td></tr>
    <tr><td>Spare Parts</td>    <td>: To be supplied on demand at mutually agreed prices.</td></tr>
    <tr><td>Validity</td>       <td>: 05 (Five) days from quoting date.</td></tr>
    <tr><td>Transport Cost</td> <td>: Every type transport cost will pay by byer.</td></tr>
</table>
@endif

<div class="tc-closing">
    Therefore, we hope, you will find our offer reasonable and look forward to your valued order as and when required.
    Thanking you for your kind support with best regards.
</div>
<p class="tc-assur">We assure you that of our best Engineering support at all time.</p>
<p style="font-weight:bold;margin-top:10px;">Thanking You.</p>
<br><br><br>

<div class="sig">
    <p>Sincerely yours</p>
    @if($settings->signature)
        <img src="{{ public_path('storage/'.$settings->signature) }}" alt="Signature">
    @else
        <br><br><br>
    @endif
    <p class="sn">{{ $settings->md_name ?? $preparedBy }}</p>
    <div class="sd">
        Managing Director<br>
        @if(!empty($settings->phone))Cell: {{ $settings->phone }}<br>@endif
        <strong>{{ $settings->site_title ?? 'Slope Medical Solution' }}</strong><br>
        {{ $settings->address ?? '' }}
    </div>
</div>

</body>
</html>
