<?php

namespace Champ\Championship;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Mockery as m;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use TestCase;

class ImageUploaderTest extends TestCase
{
    public function testShouldGetEmptyStringWhenCallingImagePath()
    {
        $imageManager = m::mock(ImageManager::class);
        $imageUploader = new ImageUploader($imageManager);

        $this->assertEmpty($imageUploader->getImagePath());
    }

    public function testShouldUploadImage()
    {
        $imageManager = m::mock(ImageManager::class);
        $imageManager->dirname = 'images';
        $imageManager->basename = '1234567890.jpg';
        $uploadedFile = m::mock(UploadedFile::class);
        $imageUploader = new ImageUploader($imageManager);
        $tempPath = 'tmp/path/image.jpg';

        $uploadedFile->shouldReceive('getRealPath')
            ->withNoArgs()
            ->once()
            ->andReturn($tempPath);

        $imageManager->shouldReceive('make')
            ->with($tempPath)
            ->once()
            ->andReturnSelf();

        $imageManager->shouldReceive('resize')
            ->with(1140, 400)
            ->once()
            ->andReturnSelf();

        $imageManager->shouldReceive('save')
            ->withAnyArgs()
            ->once()
            ->andReturnSelf();

        $imageUploader->upload($uploadedFile);
    }
}
