<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{

    public function geInformation()
    {
        $user = User::first(); // auth()->user()
        $user->document->getMedia('attachments');
        return response()->json($user->document);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateInformati(Request $request)
    {
        $user = User::first();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'degree_date' => 'required|date_format:Y-m-d'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $updated = $user->document->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'degree_date'=> $request->degree_date
        ]);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'بارگذاری ناموفق بود!'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'اطلاعات با موفقیت ثبت شد.',
        ], Response::HTTP_OK);
    }

    public function uploadFile(Request $request)
    {
        $user = User::first(); // auth()->user()

        if (!$user || !$user->document) {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات یافت نشد!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $file = $user->document->addMedia($request->file)->toMediaCollection('attachments');

        return response()->json([
            'success' => true,
            'message' => 'فایل با موفقیت بارگذاری شد.',
            'data'=> $file
        ], Response::HTTP_OK);
    }

    public function deleteFile(int $mediaId)
    {
        $user = User::first(); // auth()->user()

        if (!$user || !$user->document) {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات یافت نشد!'
            ], 404);
        }

        $media = $user->document->getMedia('attachments')->find($mediaId);

        if ($media) {
            $media->delete();
            return response()->json([
                'success' => true,
                'message' => 'فایل با موفقیت بارگذاری شد.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'فایل یافت نشد!',
        ], 404);
    }
}
