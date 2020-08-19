<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->loadCategories();
        return response()->json($categories);
    }

    /**
     * @return array
     */
    public function loadCategories()
    {
        $categories = Category::get()->toArray();
        $tree = $this->buildTree($categories);
        return $tree;
    }

    /**
     * Method recursive
     * @param array $categories
     * @param int $parentId
     * @return array
     */
    public function buildTree(array $categories, $parentId = 0)
    {
        $branch = array();
        foreach ($categories as $category) {
            if ($category['category_id'] == $parentId) {
                $children = $this->buildTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }
        return $branch;
    }
}
