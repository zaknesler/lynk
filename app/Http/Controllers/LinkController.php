<?php

namespace Lynk\Http\Controllers;

use Lynk\Link;
use Illuminate\Http\Request;

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
     * @param  Request  $request
     * @param  Lynk\Link  $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Link $link)
    {
        $link = $link->create([
            'url' => $request->input('url'),
        ]);

        $link->update([
            'code' => $request->input('code') ?? generate_code($link->id),
            'has_custom_code' => $request->input('code') ? true : false,
        ]);
    }
}
