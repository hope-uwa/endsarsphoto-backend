<?php

namespace App\Repository;

interface PictureInterface
{
    /**
     * 
     * Gets all Pictures
     * 
     * @param int $postId
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function getAllPicture(int $postId);

    /**
     * 
     * Get single Picture
     * 
     * @param int $postId
     * @param int $id
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function getSinglePicture(int $postId, int $id);

    /**
     * 
     * Stores Pictures
     * 
     * @param array $data
     * @param int $postId
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function storePicture(array $data, int $postId);

    /**
     * 
     * Delete Picture
     * 
     * @param int $postId
     * @param int $pictureId
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed 
     */
    public function deletePicture(int $postId, int $pictureId);
}
