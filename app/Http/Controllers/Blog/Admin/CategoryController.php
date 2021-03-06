<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{

    /**
     * @var $blogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {

        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paginator = BlogCategory::paginate(11);
        $paginator = $this->blogCategoryRepository->getAllWidthPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(__METHOD__);
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository
            ->getForComboBox();

        return view( 'blog.admin.categories.edit', compact('item', 'categoryList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        // dd(__METHOD__);

        $data = $request->input();
//        if(empty($data['slug'])) {
//            $data['slug'] = str_slug($data['title']);
//        }

        // Create object and add him in database
        $item = (new BlogCategory())->create($data);

        if($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->width(['success' => 'Успешно виполнено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository
            ->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BlogCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository
            ->getEdit($id);

        if(empty($item)) {
            return back()
                    ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                    ->withInput();
        }

        $data = $request->all();
//        if(empty($data['slug'])) {
//            $data['slug'] = str_slug($data['title']);
//        }

        $result = $item->update($data);

        if($result) {
            return redirect()
                    ->route('blog.admin.categories.edit', $item->id)
                    ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                    ->withErrors(['msg' => 'Ошибка сохранения'])
                    ->withInput();
        }
    }

}
