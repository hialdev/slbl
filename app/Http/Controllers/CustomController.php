<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function getContentBasedOnType(Request $request, $slug, $row, $options = null, $nameSlug = null)
    {
        if ($row->type == 'image')
        {
            return (new VoyagerImageType($request, $slug, $row, $options, $nameSlug))->handle();
        }

        return parent::getContentBasedOnType($request, $slug, $row, $options);
    }
}
