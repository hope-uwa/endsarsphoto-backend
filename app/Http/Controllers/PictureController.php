<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\PictureInterface;
use App\Http\Requests\CreatePictureRequest;

class PictureController extends Controller
{

    protected $picture;

    public function __construct(PictureInterface $pictureInterface)
    {
        $this->picture = $pictureInterface;
    }

    /**
     * Index method
     *
     * @param integer $postId
     * @return Collection
     */
    public function index(int $postId)
    {
        return $this->picture->getAllPicture($postId);
    }

    /**
     * Show methods
     *
     * @param integer $postId
     * @param integer $pictureId
     * @return Collection
     */
    public function show(int $postId, int $pictureId)
    {
        return $this->picture->getSinglePicture($postId, $pictureId);
    }

    /**
     * Store Method
     *
     * @param CreatePictureRequest $request
     * @param integer $postId
     * @return Collection
     */
    public function store(CreatePictureRequest $request, int $postId)
    {
        return $this->picture->storePicture($request->validated(), $postId);
    }

    /**
     * Destroy method
     *
     * @param integer $postId
     * @param integer $pictureId
     * @return Collection
     */
    public function destroy(int $postId, int $pictureId)
    {
        return $this->picture->deletePicture($postId, $pictureId);
    }
}
