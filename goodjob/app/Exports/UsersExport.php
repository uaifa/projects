<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('email',
            'profile_image',
            'user_type',
            'first_name',
            'last_name',
            'mobile_number',
            'phone_number',
            'house_number',
            'zip_code',
            'city',
            'country')->get();
    }

    public function headings(): array
    {
        return [
            'email',
            'profile_image',
            'user_type',
            'first_name',
            'last_name',
            'mobile_number',
            'phone_number',
            'house_number',
            'zip_code',
            'city',
            'country',
            ];
    }

}
