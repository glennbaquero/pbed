<?php

namespace App\Exports\Users;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromArray, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function array(): array
    {
    	$result = [];

    	foreach ($this->items as $item) {
    		$result[] = [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'position' => $item->position,
                // 'user_classification' => $item->classification->name,
                'status' => $item->renderAccountStatus(),
                'created_at' => $item->renderDate(),
            ];
    	}

        return $result;
    }

    public function headings(): array
    {
        return [
            '#',
            'Full Name',
            'Primary Email',
            'Position',
            'User Classification',
            'Status',
            'Registration Date',
        ];
    }
}