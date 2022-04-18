<?php

namespace App\Exports;

use App\Models\Category;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class CategoryExport implements FromQuery, WithStrictNullComparison
{
    protected array $idArr;

    public function __construct($idArr)
    {
        $this->idArr = $idArr;
    }

    public function query()
    {
        return Category::query()->join('departments', 'categories.department_id', '=', 'departments.id')
            ->select('categories.*', 'departments.end_closure_date as end_closure_date')
            ->where('departments.end_closure_date', '<=', Carbon::now())
            ->whereIn('categories.id', $this->idArr);
    }
}
