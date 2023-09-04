<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoyagerController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function getContentBasedOnType(Request $request, $slug, $row, $options = null)
    {
        if ($row->type == 'image')
        {
            return (new VoyagerImageType($request, $slug, $row, $options))->handle();
        }else if ($row->type == 'multiple_images') {
            return (new VoyagerMultipleImageType($request, $slug, $row, $options))->handle();
        }
        
        return parent::getContentBasedOnType($request, $slug, $row, $options);
    }
}
