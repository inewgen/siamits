<?php

class Images
{
    public function saveImage($inPath, $outPath)
    {
        //Download images from remote server
        $in  = fopen($inPath, "rb");
        $out = fopen($outPath, "w+");

        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);

        return $outPath;
    }

    public function makeFolder($targetFolder)
    {
        return mkdir($targetFolder, 0755);
    }

    public function deleteFile($path)
    {
        return File::delete($path);
    }
}
