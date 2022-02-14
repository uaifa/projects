<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
     
        $data['email'] = $row[0];
        $data['password'] = Hash::make($row[1]);
        $data['profile_image'] = $row[2];
        $data['user_type'] = $row[3];
        $data['first_name'] = $row[4];
        $data['last_name'] = $row[5];
        $data['mobile_number'] = $row[6];
        $data['phone_number'] = $row[7];
        $data['house_number'] = $row[8];
        $data['zip_code'] = $row[9];
        $data['city'] = $row[10];
        $data['country'] = $row[11];
        
        // dd($data);

        return new User($data);

    }
}
