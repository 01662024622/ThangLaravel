<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



class ImageUploadController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUpload()

    {

        return view('imageUpload');

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUploadPost(Request $request )

    {
        $path = $request->file('avatar')->store('public/images');

        return $data;

    }

}
