<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ImportProducts implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        HeadingRowFormatter::default('none');
        return new Product([
            'pro_code'     => $row[0],
            'pro_name'    => $row[1],
            'pro_slug'    => $row[2],
            'pro_avatar'    => $row[3],
            'pro_seo_description'    => $row[4],
            'pro_seo_keyword'    => $row[5],
            'pro_status'    => $row[6],
            'admin_create'    => $row[7],
            'type_pro_id'    => $row[8],
            'brand_id'    => $row[9],
        ]);
    }
}
