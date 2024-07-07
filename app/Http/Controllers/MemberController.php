<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = User::where('level_id', 2)->latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.member.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    function show(User $user)
    {
        $data = $user;

        return view('admin.member.show', compact('data'));
    }

    function ban(User $user)
    {
        $user->banned = true;
        $user->save();

        return redirect()->route('admin-member.index')->with('success', 'Member ' . $user->name . ' berhasil di banned.');
    }

    function unban(User $user)
    {
        $user->banned = false;
        $user->save();

        return redirect()->route('admin-member.index')->with('success', 'Member ' . $user->name . ' berhasil di unbanned.');
    }
}
