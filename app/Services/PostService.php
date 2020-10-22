<?php

namespace App\Services;

use Exception;
use App\Models\Post;
use App\Models\Picture;
use App\Repository\PostInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService implements PostInterface
{

    /**
     * Gets all post
     *
     * @return Collection
     */
    public function getAllPost()
    {
        try {

            $posts = Post::with('picture')->paginate(6);

            return formatResponse(200, 'Posts Retrieved', true, $posts);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Get a single post
     *
     * @param integer $id
     * @return Collection
     */
    public function getSinglePost(int $id)
    {
        try {
           $post = Post::with('picture')->findOrFail($id);

           return formatResponse(200, 'Post Retrieved', true, $post);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Stores posts and pictures
     *
     * @param array $data
     * @return Collection
     */
    public function storePostPicture(array $data)
    {
        try {
            DB::beginTransaction();

            $post = Post::create([
                'user_id' => auth()->user()->id,
                'state_id' => $data['state_id'],
                'event_date' => $data['event_date'],
                'event_time' => $data['event_time'],
                'location' => $data['location'],
                'description' => $data['description'],
                'note' => $data['note']
            ]);

            if (! empty($data['photos'])) {
                
                foreach($data['photos'] as $file) {
                    $post->picture()->create([
                        'url' => $file->storeOnCloudinary()->getSecurePath()
                    ]);
                }
            }

            DB::commit();

            return formatResponse(201, 'Post created', true, $this->getPost($post['id']));
        } catch (Exception $e) {
            DB::rollback();
            info($e->getMessage()); //logs error message to console
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * updates a post
     *
     * @param array $data
     * @param integer $id
     * @return Collection
     */
    public function updatePost(array $data, int $id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($post->user_id != auth()->user()->id) {
                return formatResponse(400, 'unauthorized to delete this post');
            }

            $post->state_id = $data['state_id'];
            $post->event_date = $data['event_date'];
            $post->event_time = $data['event_time'];
            $post->location = $data['location'];
            $post->description = $data['description'];
            $post->note = $data['note'];

            if (! $post->isDirty()) {
                return formatResponse(200, 'No changes made. Update not required for posts', true, collect($post));
            }

            $post->update();

            return formatResponse(200, 'Changes made on Post', true, $this->getPost($id));
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Deletes a post
     *
     * @param integer $id
     * @return Collection
     */
    public function deletePost(int $id)
    {
        try {

            DB::transaction(function () use ($id) {
                $post = Post::findOrFail($id);

                if ($post->user_id != auth()->user()->id) {
                    return formatResponse(400, 'unauthorized to delete this post');
                }

                $post->delete();

            
                Picture::where('post_id', $id)->delete();
            });

            return formatResponse(200, 'Post deleted', true);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            if ($e instanceof ModelNotFoundException) {
                return formatResponse(404, 'Post not found');
            }
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }

    /**
     * Gets posts
     *
     * @param integer $id
     * @return Collection
     */
    private function getPost(int $id)
    {
        return Post::where('id', $id)->with(['picture' => function($query) use ($id) {
            return $query->where('post_id', $id);
        }])->get();
    }
}
