<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Models\Auction;

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
        $auction->active = $validated["active"];
        $auction->endtime = $validated["endtime"];
        $auction->bid_start = $validated["bid_start"];
        $auction->bid_increment = $validated["bid_increment"];
        $auction->rules = $validated["rules"];
        $auction->save();

        return redirect()->back()
            ->with('success', 'Data lelang berhasil disimpan!');
    }

    function update(UpdateAuctionRequest $request, Auction $auction)
    {
        $validated = $request->validated();

        $auction->active = $validated["active"];
        $auction->endtime = $validated["endtime"];
        $auction->bid_start = $validated["bid_start"];
        $auction->bid_increment = $validated["bid_increment"];
        $auction->rules = $validated["rules"];
        $auction->save();

        return redirect()->back()
            ->with('success', 'Data lelang berhasil diubah!');
    }
    //
}
