<?php

use App\Models\BannerSection;
use Intervention\Image\Facades\Image;

function wm($imagePath,$watermark = ""){
    $image = Image::make($imagePath);
    $watermark = Image::make($watermark !== "" ? $watermark : setting('site.watermark'));

    // Letakkan watermark di atas gambar utama
    $image->insert($watermark, 'bottom-right', 10, 10);

    // Simpan gambar baru dengan watermark
    $image->save($imagePath);

    return $imagePath;
}

function section($code){
    $sections = BannerSection::all();
    $sectionData = null;
    foreach ($sections as $section) {
        $pages = $section->pages;
        foreach ($pages as $page) {
            if ($page->slug == (string) $code) {
                $sectionData = $section;
                break;
            }
        }
    }
    return $sectionData;
}

function makeDate($created_at) {
    // Konversi ke objek DateTime jika belum
    if (!$created_at instanceof DateTime) {
        $created_at = new DateTime($created_at);
    }

    // Array asosiatif untuk konversi nama bulan
    $monthNames = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
        9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec',
    ];

    // Format tanggal sesuai kebutuhan
    $formattedDate = $created_at->format('d') . ' ' . $monthNames[$created_at->format('n')] . ' ' . $created_at->format('Y');

    return $formattedDate;
}