<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;


/**
 * Class BlogCategoryRepository
 *
 *@package App\Repositories
 */


class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }

}