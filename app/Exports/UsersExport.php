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
            'ایمیل',
            'شماره موبایل',
            'نام', 
            'نام خانوادگی', 'نام استان', 'نام شهرستان', 'تاریخ ثبت نام',
        ];
    }

    public function query()
    {
        return User::query()->select(['id','email','mobile','first_name','last_name','province','small_province','created_at'])->where('province', $this->province)->where('small_province', $this->smallProvince)->where('sexuality', $this->sexuality);
    }
}


