<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Product Catalogue – {{ $settings->site_title ?? 'Slope Medical' }}</title>
<style>
    @page { margin: 1.2cm 1.5cm 2cm 1.5cm; }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; }
    .lh { width:100%; border-bottom:3px solid #c00; padding-bottom:6px; margin-bottom:12px; display:table; }
    .lh-logo { display:table-cell; width:120px; vertical-align:middle; }
    .lh-logo img { width:110px; height:auto; }
    .lh-co { display:table-cell; vertical-align:middle; text-align:right; }
    .lh-co .cn { font-size:20px; font-weight:bold; color:#1a3a8f; }
    .lh-co .ct { font-size:11px; color:#555; font-style:italic; }
    .cat-title { font-size:16px; font-weight:bold; color:#1a3a8f; border-bottom:2px solid #1a3a8f; padding-bottom:4px; margin:16px 0 10px; }
    .product-grid { width:100%; border-collapse:collapse; }
    .product-grid td { border:1px solid #ccc; padding:8px; vertical-align:top; width:50%; }
    .p-name { font-weight:bold; font-size:12px; margin-bottom:4px; color:#1a3a8f; }
    .p-img  { width:100%; max-height:120px; object-fit:contain; display:block; margin:6px auto; }
    .p-meta { font-size:10px; line-height:1.7; color:#333; }
    .p-meta span { font-weight:bold; }
    .pg-footer {
        position:fixed; bottom:0; left:0; right:0;
        border-top:3px solid #c00; padding-top:4px;
        font-size:9px; color:#333; text-align:center; background:#fff;
    }
    .pb { page-break-after:always; }
</style>
</head>
<body>

<div class="pg-footer">
    {{ $settings->address ?? '59/D-A, Darussalam Tower, Dhaka.' }}
    | Tel: {{ $settings->phone ?? '01730587330' }}
    | {{ $settings->email ?? 'slopemedical@gmail.com' }}
</div>

<div class="lh">
    <div class="lh-logo">
        @if($settings->logo)<img src="{{ public_path('storage/'.$settings->logo) }}" alt="Logo">@endif
    </div>
    <div class="lh-co">
        <div class="cn">{{ strtoupper($settings->site_title ?? 'SLOPE MEDICAL SOLUTION') }}</div>
        <div class="ct">Run for Rise – Product Catalogue {{ date('Y') }}</div>
    </div>
</div>

@php
    $byCategory = $products->groupBy(fn($p) => optional($p->category)->name ?? 'General');
@endphp

@foreach($byCategory as $catName => $catProducts)
    <div class="cat-title">{{ $catName }}</div>
    @php $chunks = $catProducts->chunk(2); @endphp
    @foreach($chunks as $pair)
    <table class="product-grid">
        <tr>
            @foreach($pair as $p)
            <td>
                <div class="p-name">{{ $p->title }}</div>
                @if($p->image)
                    @php $imgSrc = str_starts_with($p->image,'http') ? $p->image : public_path('storage/'.$p->image); @endphp
                    <img src="{{ $imgSrc }}" class="p-img" alt="{{ $p->title }}">
                @endif
                <div class="p-meta">
                    @if($p->brand)   <div><span>Brand:</span> {{ $p->brand }}</div>@endif
                    @if($p->model)   <div><span>Model:</span> {{ $p->model }}</div>@endif
                    @if($p->origin)  <div><span>Origin:</span> {{ $p->origin }}</div>@endif
                    @if($p->warranty)<div><span>Warranty:</span> {{ $p->warranty }}</div>@endif
                </div>
            </td>
            @endforeach
            {{-- Fill empty cell if odd count --}}
            @if($pair->count() < 2)<td></td>@endif
        </tr>
    </table>
    @endforeach
@endforeach

</body>
</html>
