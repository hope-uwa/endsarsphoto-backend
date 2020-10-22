<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\PostInterface;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostPicturesRequest;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostInterface $postInterface)
    {
        $this->post = $postInterface;

    }

    /**
     * Index method
     *
     * @return Collection
     */
    public function index()
    {
        return $this->post->getAllPost();
    }

    /**
     * Show method
     *
     * @param integer $id
     * @return Collection
     */
    public function show(int $id)
    {
        return $this->post->getSinglePost($id);
    }

    /**
     * Update Method
     *
     * @param UpdatePostRequest $request
     * @param integer $id
     * @return Collection
     */
    public function update(UpdatePostRequest $request, int $id)
    {
        return $this->post->updatePost($request->validated(), $id);
    }

    /**
     * Create Method
     *
     * @param CreatePostPicturesRequest $request
     * @return Collection
     */
    public function create(CreatePostPicturesRequest $request)
    {
        return $this->post->storePostPicture($request->validated());
    }

    /**
     * Destroy method
     *
     * @param integer $id
     * @return Collection
     */
    public function destroy(int $id)
    {
        return $this->post->deletePost($id);
    }
}
