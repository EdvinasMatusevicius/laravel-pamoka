<?php
declare(strict_types=1);

namespace Modules\Product\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Core\Repositories\Repository;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Builder;


class ProductRepository extends Repository
{
    public function model(): string
    {
        return Product::class;
    }

    public function paginateWithRelations(array $with = [],bool $active = false, array $columns = ['*']): LengthAwarePaginator
    {
        return  $this->withRelationsBuilder($with,$active)->paginate(self::DEFAULT_PER_PAGE, $columns);
    }

    public function getByCategorySlug(string $categorySlug): LengthAwarePaginator
    {
        return $this->withRelationsBuilder(['images', 'categories', 'suppliers'], true)
            ->whereHas('categories', function (Builder $query) use ($categorySlug) {
                $query->where('slug', '=', $categorySlug);
            })
            ->paginate();
    }

    
    public function getBySlug(string $slug){
        return $this->withRelationsBuilder([], true)
        ->where('slug', '=', $slug)
        ->firstOrFail();
    }
    
    private function withRelationsBuilder(array $with = [], bool $active = false): Builder
    {
        $query = $this->makeQuery()->with($with);

        if ($active === true) {
            $query->where('active', '=', true);
        }

        return $query;
    }
    
}