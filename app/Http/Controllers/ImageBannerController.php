<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image_banners;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class ImageBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('api:auth', ['except' => ['add_imagebanner', 'update_imagebanner', 'delete_imagebanner']]);
     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_imagebanner(Request $request)
    {
        //
         $validator = Validator::make(request()->all(), [
            'user_id' => 'required',
            'merchant' => 'required',
            'index' => 'required',
            'content_type' => 'required',
            'name' => 'required',
            'status' => 'required',
            'preview_image' => 'required|image|mimes:png,jpg',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages());

            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200,
            );
        }

        if ($request->file('preview_image')) {
            $path = $request->file('preview_image')->store('preview_image');
        }
        $image_banner = Image_banners::create([
            'user_id' => request('user_id'),
            'merchant' => request('merchant'),
            'index' => request('index'),
            'content_type' => request('content_type'),
            'name' => request('name'),
            'status' => request('status'),
            'preview_image' => $path,
            'createby' => request('createby'),
            'updateby' => request('updateby'),
        ]);
        if ($image_banner) {
            return response()->json(
                [
                    'status' => true,
                    'error' => false,
                    'message' => 'success',
                    'data' => $image_banner,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image_banner  $image_banner
     * @return \Illuminate\Http\Response
     */
    public function show(image_banner $image_banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image_banner  $image_banner
     * @return \Illuminate\Http\Response
     */
    public function edit(image_banner $image_banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\image_banner  $image_banner
     * @return \Illuminate\Http\Response
     */
    public function update_imagebanner(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required',
            'merchant' => 'required',
            'index' => 'required',
            'content_type' => 'required',
            'name' => 'required',
            'status' => 'required',
            'preview_image' => 'required|file|mimes:png,jpg',
        ]);
        if ($validator->fails()) {
            // return response()->json($validator->messages());

            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200,
            );
        }
        $updateimage_banner = Image_banners::find($id);
        if ($request->file('preview_image')) {
            if ($request->preview_image) {
                Storage::delete($updateimage_banner->preview_image);
            }
            $path = $request->file('preview_image')->store('preview_image');
 
        }

        $image_banner = $updateimage_banner->update([
            'user_id' => request('user_id'),
            'merchant' => request('merchant'),
            'index' => request('index'),
            'content_type' => request('content_type'),
            'name' => request('name'),
            'status' => request('status'),
            'preview_image' => $path,
            'createby' => request('createby'),
            'updateby' => request('updateby'),
        ]);

        if ($image_banner) {
            // return response()->json(['message' => 'Pendaftaran']);

            return response()->json(
                [
                    'status' => true,
                    'error' => false,
                    'message' => 'success',
                    'data' => $image_banner,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image_banner  $image_banner
     * @return \Illuminate\Http\Response
     */
    public function delete_imagebanner(Request $request, $id)
    {
        //
        $deleteimage_banner = Image_banners::find($id);
        if ($deleteimage_banner->preview_image) {
            Storage::delete($deleteimage_banner->preview_image);
        }
    $image_banner = $deleteimage_banner->delete();

    if ($image_banner) {
        // return response()->json(['message' => 'Pendaftaran']);

        return response()->json(
            [
                'status' => true,
                'error' => false,
                'message' => 'success',
                'data' => $image_banner,
            ],
            200,
        );
    } else {
        return response()->json(
            [
                'status' => false,
                'error' => false,
                'message' => 'Error',
                'data' => null,
            ],
            200,
        );
    }
    }
}
