<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogueDownload;
use Illuminate\Http\Request;

class CatalogueDownloadController extends Controller
{
    public function index()
    {
        $downloads = CatalogueDownload::with('product')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.catalogue-downloads.index', compact('downloads'));
    }

    public function destroy(CatalogueDownload $catalogueDownload)
    {
        $catalogueDownload->delete();
        return back()->with('success', 'Catalogue download entry deleted successfully.');
    }
}
