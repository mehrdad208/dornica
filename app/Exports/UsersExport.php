<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery
{
    use Exportable;

    public function forProvince(int $province)
    {
        $this->province = $province;
        
        return $this;
    }
    public function forSmallProvince(int $smallProvince)
    {
        $this->smallProvince = $smallProvince;
        
        return $this;
    }
    public function forSexuality(int $sexuality)
    {
        $this->sexuality = $sexuality;
        
        return $this;
    }

    public function query()
    {
        return User::query()->where('province', $this->province)->where('small_province', $this->smallProvince)->where('sexuality', $this->sexuality);
    }
}


