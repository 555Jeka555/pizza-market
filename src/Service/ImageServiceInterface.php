<?php

declare(strict_types=1);
namespace App\Service;

interface ImageServiceInterface
{
    public function moveImageToUploads(array $fileInfo): string;

    public function getUploadPath(string $fileName): string;

    public function getUploadUrlPath(string $fileName): string;

    public function moveFileToUploads(array $fileInfo, string $destFileName): string;
}