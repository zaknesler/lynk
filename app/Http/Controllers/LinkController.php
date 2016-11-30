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
        $link = $link->create([
            'url' => $request->input('url'),
            'code' => $request->input('code') ?? str_random(6),
            'has_custom_code' => $request->input('code') ? true : false,
        ]);
        
        return 'https://lynk.ml/' . $link->code;
    }
}
