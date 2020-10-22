<?php

namespace App\Repository;

interface PostInterface
{
    /**
     * 
     * Stores Post Pictures
     * 
     * @param array $data
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function storePostPicture(array $data);

    /**
     * 
     * Gets all posts
     * 
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function getAllPost();

    /**
     * 
     * Gets a single post
     * 
     * @param int $id
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function getSinglePost(int $id);

    /**
     * 
     * Update Posts
     * 
     * @param array $data
     * @param int $id
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function updatePost(array $data, int $id);
    

    /**
     * 
     * Delete Post
     * 
     * @param int $id
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function deletePost(int $id);
}
