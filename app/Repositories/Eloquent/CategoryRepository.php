<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll(): object
    {
        $categories = $this->category->get();

        return $categories;
    }

    public function create(array $data): object
    {
        $category = $this->category->create($data);

        return $category;
    }

    public function show(string $slug): object
    {
        $category = $this->category->where('url', $slug)
                                            ->firstOrFail();

        return $category;
    }

    public function update(string $slug, array $data): bool
    {
        $response = $this->category->where('url', $slug)
                                            ->firstOrFail()
                                                ->update($data);

        return $response;
    }

    public function delete(string $slug): bool
    {
        $response = $this->category->where('url', $slug)
                                            ->firstOrFail()
                                                    ->delete();

        return $response;
    }
}

