<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image as InterventionImage;
use TCG\Voyager\Facades\Voyager;

class VoyagerImageType extends \TCG\Voyager\Http\Controllers\ContentTypes\Image
{
    protected $nameSlug;

    public function __construct($request, $slug, $row, $options = null, $nameSlug = null)
    {
        parent::__construct($request, $slug, $row, $options);
        $this->nameSlug = $nameSlug;
    }

    public function handle()
    {
        if ($this->request->hasFile($this->row->field)) {
            $file = $this->request->file($this->row->field);

            $path = $this->slug.DIRECTORY_SEPARATOR.date('FY').DIRECTORY_SEPARATOR;

            $filename = $this->generateFileNameFromSlug($file, $path);

            $image = InterventionImage::make($file)->orientate();

            $fullPath = $path.$filename.'123.'.$file->getClientOriginalExtension();

            $resize_width = null;
            $resize_height = null;
            if (isset($this->options->resize) && (
                isset($this->options->resize->width) || isset($this->options->resize->height)
            )) {
                if (isset($this->options->resize->width)) {
                    $resize_width = $this->options->resize->width;
                }
                if (isset($this->options->resize->height)) {
                    $resize_height = $this->options->resize->height;
                }
            } else {
                $resize_width = $image->width();
                $resize_height = $image->height();
            }

            $resize_quality = isset($this->options->quality) ? intval($this->options->quality) : 75;

            $image->insert($this->getWatermarkImage($resize_width), 'center');

            $image = $image->resize(
                $resize_width,
                $resize_height,
                function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    if (isset($this->options->upsize) && !$this->options->upsize) {
                        $constraint->upsize();
                    }
                }
            )->encode($file->getClientOriginalExtension(), $resize_quality);

            if ($this->is_animated_gif($file)) {
                Storage::disk(config('voyager.storage.disk'))->put($fullPath, file_get_contents($file), 'public');
                $fullPathStatic = $path.$filename.'-static.'.$file->getClientOriginalExtension();
                Storage::disk(config('voyager.storage.disk'))->put($fullPathStatic, (string) $image, 'public');
            } else {
                Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public');
            }

            if (isset($this->options->thumbnails)) {
                foreach ($this->options->thumbnails as $thumbnails) {
                    if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                        $scale = intval($thumbnails->scale) / 100;
                        $thumb_resize_width = $resize_width;
                        $thumb_resize_height = $resize_height;

                        if ($thumb_resize_width != null && $thumb_resize_width != 'null') {
                            $thumb_resize_width = intval($thumb_resize_width * $scale);
                        }

                        if ($thumb_resize_height != null && $thumb_resize_height != 'null') {
                            $thumb_resize_height = intval($thumb_resize_height * $scale);
                        }

                        $image = InterventionImage::make($file)->orientate();
                        $image->insert($this->getWatermarkImage($thumb_resize_width), 'center');

                        $image->resize(
                                $thumb_resize_width,
                                $thumb_resize_height,
                                function (Constraint $constraint) {
                                    $constraint->aspectRatio();
                                    if (isset($this->options->upsize) && !$this->options->upsize) {
                                        $constraint->upsize();
                                    }
                                }
                            )->encode($file->getClientOriginalExtension(), $resize_quality);
                    } elseif (isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                        $crop_width = $thumbnails->crop->width;
                        $crop_height = $thumbnails->crop->height;

                        $image = InterventionImage::make($file)->orientate();
                        $image->insert($this->getWatermarkImage($crop_width), 'center');

                        $image->fit($crop_width, $crop_height)
                            ->encode($file->getClientOriginalExtension(), $resize_quality);
                    }

                    Storage::disk(config('voyager.storage.disk'))->put(
                        $path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension(),
                        (string) $image,
                        'public'
                    );
                }
            }

            return $fullPath;
        }
    }

    private function getWatermarkImage ($imageWidth)
    {
        $scale = 0.5;
        $width = intval($imageWidth * $scale);

        if ($file_wm = Voyager::image(setting('site.watermark')))
        {
            $watermark = $file_wm;

            if (file_exists($watermark))
            {
                //return InterventionImage::make($watermark)->resize(intval($imageWidth * $scale));
                return InterventionImage::make($watermark)->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }

        return InterventionImage::canvas($width, intval($width / 2));
    }

    private function is_animated_gif($filename)
    {
        $raw = file_get_contents($filename);

        $offset = 0;
        $frames = 0;
        while ($frames < 2) {
            $where1 = strpos($raw, "\x00\x21\xF9\x04", $offset);
            if ($where1 === false) {
                break;
            } else {
                $offset = $where1 + 1;
                $where2 = strpos($raw, "\x00\x2C", $offset);
                if ($where2 === false) {
                    break;
                } else {
                    if ($where1 + 8 == $where2) {
                        $frames++;
                    }
                    $offset = $where2 + 1;
                }
            }
        }

        return $frames > 1;
    }

    protected function generateFileNameFromSlug($file, $path)
    {
        $filename = $this->nameSlug . '_' . Str::random(20);

        // ...

        return $filename;
    }
}