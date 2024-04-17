<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'contact.index'
        );
    }

    /**
     * Store the form for creating a new resource.
     */
    public function store()
    {
        return;
    }
}
