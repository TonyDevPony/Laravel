<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;


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

    /**
     * Получить список статей для вывода в списке
     * (Админка)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate() {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with([
                // Доступно два варианта получения нужных полей из таблиц
                // Первый вариант в запросе к таблице категории выбрать два поля 'id' и 'title'
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },

                // Второй вариант (из таблици user достать поля id и name)
                'user:id,name',
            ])
            ->paginate(25);

        return $result;
    }
}