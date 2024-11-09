<?php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fetch()
    {
        $packages = Package::with('store', 'status', 'commune', 'deliveryType')
            ->paginate(10); // 10 packages per page

        return response()->json([
            'packages' => $packages->items(),
            'current_page' => $packages->currentPage(),
            'last_page' => $packages->lastPage(),
        ]);
    }

    public function index()
    {
        $packages = (new Package)->newQuery();

     
        if (request()->has('search')) {
            $search = strtolower(request()->input('search'));
            $packages->where(function($query) use ($search) {
                $query->whereRaw('LOWER(tracking_code) LIKE ?', ['%' . $search . '%'])
        
                      ->orWhereRaw('LOWER(address) LIKE ?', ['%' . $search . '%'])
                      ->orWhereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
            })
            // Recherche sur le champ 'designation' de la relation 'activite'
            ->orWhereHas('status', function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
            })
            ->orWhereHas('deliveryType', function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
            })
            ->orWhereHas('commune', function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
            })
            ->orWhereHas('store', function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
            });
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $packages->orderBy($attribute, $sort_order);
        } else {
            $packages->latest();
        }

        $packages = $packages->with('store', 'status', 'commune', 'deliveryType')->paginate(7)
                    ->onEachSide(2)
                    ->appends(request()->query());

        return Inertia::render('Packages/Index', [
            'packages' => $packages,
            'filters' => request()->all('search'),
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new PackagesExport, 'packages.xlsx');
    }
    public function exportCSV()
    {
        return Excel::download(new PackagesExport, 'packages.csv');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
