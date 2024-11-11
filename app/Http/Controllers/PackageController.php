<?php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use App\Http\Requests\StorePackageRequest;
use App\Http\Resources\PackageResource;
use App\Http\Resources\UserResource;
use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use App\Models\User;
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
            $packages->where(function ($query) use ($search) {
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


        return inertia()->render('Packages/Index', [
            'packages' => PackageResource::collection(
                $packages
            ),
            'filters' => request()->all('search'),
        ]);


    }


    public function store(StorePackageRequest $request)
    {

        $data= $request->all();
        Package::create($data);
        return redirect()->route('package.index')->with([
            'message' => 'Package created with success',
            'status' => 201
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

    public function fetchCommunes()
    {
        return response()->json(['communes' => Commune::with('wilaya')->get()]);
    }
    public function fetchStores()
    {
        return response()->json(['stores' => Store::get()]);
    }

    public function fetchPackageStatus()
    {
        return response()->json(['package_status' => PackageStatus::get()]);
    }
    public function fetchDeliveryType()
    {
        return response()->json(['delivery_types' => DeliveryType::get()]);
    }

    public function fetchUser()
    {
        return UserResource::collection(User::all());
    }


    
}
