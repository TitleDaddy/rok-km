<?php

namespace App\Domain\News\Query\Query;

use App\Common\CQRS\PaginatedQuery;
use App\Common\CQRS\QueryInterface;

class ListAllNewsPostQuery extends PaginatedQuery implements QueryInterface
{
}
