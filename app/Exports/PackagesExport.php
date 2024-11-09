<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PackagesExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * Get the query of the packages to be exported.
     */
    public function query()
    {
        return Package::query()->with('store', 'status', 'commune.wilaya', 'deliveryType');
    }

    /**
     * Define the column headings.
     */
    public function headings(): array
    {
        return [
            'Tracking Code',
            'Store Name',
            'Package Name',
            'Status',
            'Client Full Name',
            'Phone',
            'Wilaya',
            'Commune',
            'Delivery Type',
            'Status Name'
        ];
    }

    /**
     * Map each row to its data.
     */
    public function map($package): array
    {
        return [
            $package->tracking_code,
            $package->store ? $package->store->name : '',
            $package->name,
            $package->status ? $package->status->name : '',
            $package->client_first_name . ' ' . $package->client_last_name,
            $package->client_phone,
            $package->commune ? $package->commune->wilaya->name : '',
            $package->commune ? $package->commune->name : '',
            $package->deliveryType ? $package->deliveryType->name : '',
            $package->status ? $package->status->name : ''
        ];
    }
}
