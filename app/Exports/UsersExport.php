<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
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
    public function headings(): array
    {
        return [
            '#',
            'نام',
            'نام خانوادگی',
            'کدملی', 
             'ایمیل','شماره موبایل', 'تاریخ ثبت نام',
        ];
    }

    public function query()
    {
        return User::query()->select(['id','first_name','last_name','national_code','email','mobile','created_at'])->where('province', $this->province)->where('small_province', $this->smallProvince)->where('sexuality', $this->sexuality);
    }
}


