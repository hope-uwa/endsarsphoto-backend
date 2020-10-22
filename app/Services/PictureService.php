<?php

namespace App\Services;

use Exception;
use App\Models\Post;
use App\Repository\PictureInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PictureService implements PictureInterface
{
    /**
     * Gets all pictures for a post
     *
     * @param integer $postId
     * @return Collection
     */
    public function getAllPicture(int $postId)
    {
        try {
            $post = Post::findOrFail($postId)
                ->picture()
                ->where('post_id', $postId)
                ->get();

            return formatResponse(200, 'Pictures retrieved', true, $post);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }

    }

    /**
     * Gets a single picture for a post
     *
     * @param integer $postId
     * @param integer $pictureId
     * @return Collection
     */
    public function getSinglePicture(int $postId, int $pictureId)
    {
        try {
            $post = Post::findOrFail($postId)
                ->picture()
                ->where(
                    [
                    'post_id' => $postId, 
                    'id' => $pictureId
                    ]
                )
                ->get();
            
                if ($post->isEmpty()) {
                    return formatResponse(404, 'Pictures not found', false);
                }

            return formatResponse(200, 'Pictures retrieved', true, $post);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Store pictures for a post
     *
     * @param array $data
     * @param integer $postId
     * @return Collection
     */
    public function storePicture(array $data, int $postId)
    {
        try {
            $post = Post::findOrFail($postId);

            if ($post->user_id !== auth()->user()->id) {
                return formatResponse(400, 'Not authorized to add photos', false);
            }

            foreach($data['photos'] as $file) {
                $post->picture()->create([
                    'url' => $file->storeOnCloudinary()->getSecurePath()
                ]);
            }

            return formatResponse(200, 'Pictures added', true, $this->getPictures($postId));
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Deletes Picture for a post
     *
     * @param integer $postId
     * @param integer $pictureId
     * @return Collection
     */
    public function deletePicture(int $postId, int $pictureId)
    {
        try {

            $post = Post::findOrFail($postId);
            
            if ($post->user_id !== auth()->user()->id) {
                return formatResponse(400, 'Not authorized to add photos', false);
            }

            $post->picture()
                ->where(
                    [
                        'post_id' => $postId, 
                        'id' => $pictureId
                    ]
                )->delete();
            
            return formatResponse(200, 'Picture deleted', true);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * get pictures
     *
     * @param integer $postId
     * @return Collection
     */
    private function getPictures(int $postId)
    {
        return Post::findOrFail($postId)
        ->picture()
        ->where('post_id', $postId)
        ->get();
    }
}
