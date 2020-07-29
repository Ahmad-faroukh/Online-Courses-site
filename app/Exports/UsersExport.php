<?php

namespace App\Exports;

use App\Course;
use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($users)
    {
        $this->users = $users ;
    }

    public function collection()
    {
        return User::whereIn('id',$this->users)->get();
    }
}
