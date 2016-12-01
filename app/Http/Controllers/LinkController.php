<?php

namespace Lynk\Http\Controllers;

use Lynk\Link;
use Illuminate\Http\Request;
use Lynk\Http\Requests\Links\StoreLinkFormRequest;

class LinkController extends Controller
{
    /**
     * Redirect to a url by a shortcode.
     *
     * @param  Lynk\Link  $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Link $link)
    {
        return redirect()->to($link->url);
    }

    /**
     * Show the page to create a new link.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store the link in the database.
     *
     * @param  Lynk\Http\Requests\Links\StoreLinkFormRequest  $request
     * @param  Lynk\Link  $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLinkFormRequest $request, Link $link)
    {
        if ($request->code) {
            $link = $link->create([
                'url' => $request->url,
                'code' => $request->code,
                'has_custom_code' => true,
            ]);

            return $link;
        }

        $linkFromUrl = $link->where('has_custom_code', false)->where('url', $request->url)->get();

        if ($linkFromUrl->count()) {
            return $linkFromUrl->first();
        }

        $link = $link->create([
            'url' => $request->url,
            'code' => str_random(6),
            'has_custom_code' => false,
        ]);

        return $link;
    }
}
