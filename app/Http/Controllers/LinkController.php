<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Requests\StoreLink;
use App\Http\Responses\LinkResponse;
use Illuminate\Support\Facades\Cache;

class LinkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreLink  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLink $request)
    {
        if (!request('code') && ($link = Link::hasRandomCode()->whereUrl(request('url'))->first())) {
            return new LinkResponse($link);
        }

        if (request('code') && (Link::whereCode(request('code'))->count() > 0)) {
            return response()->json([
                'errors' => [
                    'code' => 'Code already exists',
                ],
            ], 409);
        }

        $link = Link::create([
            'url' => request('url'),
            'code' => $code = request('code') ?? str_random(6),
            'has_custom_code' => request()->has('code'),
        ]);

        Cache::forever('link.' . $code, $link);

        return new LinkResponse($link);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($code)
    {
        $link = Link::whereCode($code)->firstOrFail();

        return redirect()->to($link);
    }
}
