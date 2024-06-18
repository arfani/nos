<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notice = Notice::latest()->first();

        return view('admin.notice.index', compact('notice'));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $validated = $request->validated();

        $notice->message = $validated["message"];
        $notice->link = $validated["link"];
        
        $notice->save();
        
        return redirect()->route('notice.index')
            ->with('success', 'Notice berhasil tersimpan!');
    }

}
