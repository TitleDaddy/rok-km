<?php

namespace App\Domain\Commander\Query\Query;

use App\Common\CQRS\PaginatedQuery;
use App\Common\CQRS\QueryInterface;

class ListAllCommanderQuery extends PaginatedQuery implements QueryInterface
{
}
