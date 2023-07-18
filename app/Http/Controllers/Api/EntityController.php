<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Models\Category;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    function getEntitiesByCategory(Category $category) {

        return EntityResource::collection($category->entities)->additional(['success' => true]);
    }
}
