<?php

namespace App\Http\Responses;

use App\Link;
use Illuminate\Contracts\Support\Responsable;

class LinkResponse implements Responsable
{
    /**
     * Link for the response.
     *
     * @var App\Link
     */
    protected $link;

    /**
     * Create a new link response.
     *
     * @param App\Link  $link
     */
    function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return response()->json([
            'code' => $this->link->code,
            'original_url' => $this->link->url,
            'shortened_url' => config('app.url') . '/' . $this->link->code,
        ]);
    }
}
