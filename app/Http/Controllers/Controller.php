<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Validate Freelance Website Link.
     * 
     * TODO: remove any unwanted url queries
     *
     * @param  string  $freelanceWebsiteLink
     * @return string
     */
    public function validateFreelanceWebsiteLink($freelanceWebsiteLink): ?string
    {
        $url = Str::of($freelanceWebsiteLink)->replace(' ', '');

        return $url != '' ? $url : null;
    }
}
