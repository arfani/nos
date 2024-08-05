<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Comment;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    function store(AuctionRequest $request)
    {
        $validated = $request->validated();

        if ($validated["id"]) {
            $auction = Auction::find($validated["id"]);
        } else {
            $auction = new Auction();
        }
        $auction->product_id = $validated["product_id"];
        $auction->active = $validated["active"] ?? false;
        $auction->endtime = $validated["endtime"];
        $auction->bid_start = $validated["bid_start"];
        $auction->bid_increment = $validated["bid_increment"];
        $auction->rules = $validated["rules"];
        $auction->save();

        return redirect()->back()->with('success', 'Data lelang berhasil disimpan!');
    }

    function bid(Request $request)
    {
        $validated = $request->validate([
            'auction_id' => ['required'],
            'value' => ['required'],
        ]);

        $bid = new Bid();
        $bid->auction_id = $validated["auction_id"];
        $bid->user_id = auth()->user()->id;
        $bid->value = $validated["value"];
        $bid->save();

        return redirect()->back()->with('success', 'Bid Anda tersimpan!');
    }
    
    function comment(Request $request)
    {
        $validated = $request->validate([
            'auction_id' => ['required'],
            'comment' => ['required'],
        ]);

        $bid = new Comment();
        $bid->auction_id = $validated["auction_id"];
        $bid->user_id = auth()->user()->id;
        $bid->comment = $validated["comment"];
        $bid->save();

        return redirect()->back()->with('success', 'Komentar tersimpan!');
    }
}
