<?php
declare(strict_types=1);

namespace Modules\Core\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface RepositoryContract
{
    public function model(): string;

    public function makeQuery(): Builder;
}