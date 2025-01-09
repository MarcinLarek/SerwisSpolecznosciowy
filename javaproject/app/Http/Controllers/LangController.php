<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;


class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function change($lan)
    {
        App::setLocale($lan);
        SESSION::put('locale', $lan);


        return redirect()->back();
    }
}
