<?php

namespace App\Exports;

use App\Models\Shipping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ShippingsExport implements FromArray,ShouldAutoSize
{
    public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function array(): array
	{
		return $this->data;
	}
}
