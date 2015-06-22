<?php namespace App\Libraries\Image;

// We need to add these namespaces
// in order to have access to these classes.
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class Image
{

    protected $imagine;

    // We instantiate the Imagine library with Imagick or GD
    public function __construct($library = null)
    {
        if (!$this->imagine) {
            if (!$library and class_exists('Imagick')) {
                $this->imagine = new \Imagine\Imagick\Imagine();
            } else {
                $this->imagine = new \Imagine\Gd\Imagine();
            }
        }
    }

    /*
     * Resize function.
     * @param string filename
     * @param string sizeString
     *
     * @return blob image contents.
     */
    public function resize($user_id, $code, $extension, $w, $h, $name)
    {

        // We can read the output path from our configuration file.
        $outputDir = Config::get('assets.images.paths.output');

        // Create an output file path from the size and the filename.
        $outputFile = $outputDir . '/' . $user_id . '/' . $code . '_' . $w . 'x' . $h . '.' . $extension;

        // File doesn't exist yet, so we will resize the original.
        $inputDir = Config::get('assets.images.paths.input');
        $inputFile = $inputDir . '/' . $user_id . '/' . $code . '.' . $extension;

        if (!File::isFile($inputFile)) {
            $inputFile = $inputDir . '/assets/images/default/no-image.jpg';
            $outputFile = $outputDir . '/assets/images/default/no-image_' . $w . 'x' . $h . '.jpg';
        }

        // If the resized file already exists we will just return it.
        if (File::isFile($outputFile)) {
            return File::get($outputFile);
        }

        // Get the width and the height of the chosen size from the Config file.
        // $sizeArr = Config::get('assets.images.sizes.' . $sizeString);
        // $width = $sizeArr['width'];
        // $height = $sizeArr['height'];
        $width = $w;
        $height = $h;

        // We want to crop the image so we set the resize mode and size.
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        // $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;

        // Create the output directory if it doesn't exist yet.
        if (!File::isDirectory($outputDir)) {
            File::makeDirectory($outputDir);
        }

        // Open the file, resize it and save it.
        $this->imagine->open($inputFile)
             ->thumbnail($size, $mode)
             ->save($outputFile, array('quality' => 80));

        // Return the resized file.
        return File::get($outputFile);

    }

    /*
     * Resize function.
     * @param string filename
     * @param string sizeString
     *
     * @return blob image contents.
     */
    public function resize2($section, $code, $extension, $w, $h, $name)
    {

        // We can read the output path from our configuration file.
        $outputDir = Config::get('assets.images.paths.output');

        // Create an output file path from the size and the filename.
        $outputFile = $outputDir . '/assets/images/' . $section . '/' . $code . '_' . $w . 'x' . $h . '.' . $extension;

        // If the resized file already exists we will just return it.
        if (File::isFile($outputFile)) {
            return File::get($outputFile);
        }

        // File doesn't exist yet, so we will resize the original.
        $inputDir = Config::get('assets.images.paths.input');
        $inputFile = $inputDir . '/assets/images/' . $section . '/' . $code . '.' . $extension;

        if (!File::isFile($inputFile)) {
            $inputFile = $inputDir . '/assets/images/default/no-image.jpg';
            $outputFile = $outputDir . '/assets/images/default/no-image_' . $w . 'x' . $h . '.jpg';
        }

        // If the resized file already exists we will just return it.
        if (File::isFile($outputFile)) {
            return File::get($outputFile);
        }

        // Get the width and the height of the chosen size from the Config file.
        // $sizeArr = Config::get('assets.images.sizes.' . $sizeString);
        // $width = $sizeArr['width'];
        // $height = $sizeArr['height'];
        $width = $w;
        $height = $h;

        // We want to crop the image so we set the resize mode and size.
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

        // Create the output directory if it doesn't exist yet.
        if (!File::isDirectory($outputDir)) {
            File::makeDirectory($outputDir);
        }

        // Open the file, resize it and save it.
        $this->imagine->open($inputFile)
             ->thumbnail($size, $mode)
             ->save($outputFile, array('quality' => 80));

        // Return the resized file.
        return File::get($outputFile);

    }

    /**
     * @param string $filename
     * @return string mimetype
     */
    public function getMimeType($filename)
    {

        // Make the input file path.
        $inputDir = Config::get('assets.images.paths.input');
        $inputFile = $inputDir . '/' . $filename;

        if (!File::isFile($inputFile)) {
            return false;
        }

        // Get the file mimetype using the Symfony File class.
        $file = new \Symfony\Component\HttpFoundation\File\File($inputFile);
        return $file->getMimeType();
    }

    public function resizeToFit($targetWidth, $targetHeight, $sourceFilename)
    {
        // Box is Imagine Box instance
        // Point is Imagine Point instance
        $target = new \Imagine\Image\Box($targetWidth, $targetHeight);
        $originalImage = $this->imagine->open($sourceFilename);
        $orgSize = $originalImage->getSize();
        if ($orgSize->width > $orgSize->height) {
            // Landscaped.. We need to crop image by horizontally
            $w = $orgSize->width * ($target->height / $orgSize->height);
            $h = $target->height;
            $cropBy = new \Imagine\Image\Point((max($w - $target->width, 0)) / 2, 0);
        } else {
            // Portrait..
            $w = $target->width; // Use target box's width and crop vertically
            $h = $orgSize->height * ($target->width / $orgSize->width);
            $cropBy = new \Imagine\Image\Point(0, (max($h - $target->height, 0)) / 2);
        }

        $tempBox = new \Imagine\Image\Box($w, $h);
        $img = $originalImage->thumbnail($tempBox, \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND);
        // Here is the magic..
        return $img->crop($cropBy, $target); // Return "ready to save" final image instance
    }

    public function pad(\Imagine\Gd\Imagine $img, \Imagine\Image\Box $size, $fcolor = '#000', $ftransparency = 100)
    {
        $tsize = $img->getSize();
        $x = $y = 0;
        if ($size->getWidth() > $tsize->getWidth()) {
            $x = round(($size->getWidth() - $tsize->getWidth()) / 2);
        } elseif ($size->getHeight() > $tsize->getHeight()) {
            $y = round(($size->getHeight() - $tsize->getHeight()) / 2);
        }
        $pasteto = new \Imagine\Image\Point($x, $y);
        $imagine = new \Imagine\Gd\Imagine();
        $color = new \Imagine\Image\Color($fcolor, $ftransparency);
        $image = $imagine->create($size, $color);

        $image->paste($img, $pasteto);

        return $image;
    }

    public function transformation()
    {
        $inputDir = Config::get('assets.images.paths.input');
        $path = $inputDir . '/1/2015061801263329557859_1.png';
        $size = new \Imagine\Image\Box(50, 50);
        $resize = new \Imagine\Image\Box(200, 200);
        $angle = 90;
        // $background = new \Imagine\Image\Color('fff', 100);
        $transformation = new \Imagine\Filter\transformation();

        $transformation->resize($resize)
            ->copy()
            // ->rotate($angle, $background)
            ->thumbnail($size, \Imagine\Image\ImageInterface::THUMBNAIL_INSET)
            ->save($path);

        $path = $inputDir . '/1/2015061801263329557859_1.png';
        $imagine = new \Imagine\Gd\Imagine();
        $transformation->apply($imagine->open($path));
    }
}
