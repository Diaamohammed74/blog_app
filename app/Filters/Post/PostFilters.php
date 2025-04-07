<?php

namespace App\Filters\Post;

use Essa\APIToolKit\Filters\QueryFilters;


class PostFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [
        'title',
    ];
}
