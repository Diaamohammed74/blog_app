<?php

namespace App\Http\Traits;



trait PaginateResponse
{
    public static function paginateResponse($data)
    {
        $current_page = $data->currentPage();
        $last_page    = $data->lastPage();
        $per_page     = $data->perPage();
        $total        = $data->total();

        return [
            'current_page' => $current_page,
            'last_page'    => $last_page,
            'per_page'     => $per_page,
            'total'        => $total,
            'data'         => $data->items(),
        ];
    }
}
