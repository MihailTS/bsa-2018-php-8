<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Currency;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Currency market";
        $currencies = Currency::all();
        return view('currencies',['currencies'=>$currencies, 'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add currency';
        return view('currencies.create',['title'=>$title]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  CurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $currency = new Currency();
        $currency->title = $request->getTitle();
        $currency->short_name = $request->getShortName();
        $currency->logo_url = $request->getLogoUrl();
        $currency->price = $request->getPrice();
        $currency->save();

        Session::flash('success_msg', 'Currency successfully added!');
        return redirect()->route('currencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('currencies.show',['currency'=>$currency, 'title'=>$currency->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('currencies.edit',['currency'=>$currency, 'title'=>$currency->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurrencyRequest  $request
     * @param  Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        if($request->has('title')) {
            $currency->title = $request->getTitle();
        }
        if($request->has('short_name')) {
            $currency->short_name = $request->getShortName();
        }
        if($request->has('logo_url')) {
            $currency->logo_url = $request->getLogoUrl();
        }
        if($request->has('price')) {
            $currency->price = $request->getPrice();
        }

        $currency->save();

        Session::flash('success_msg', 'Currency successfully updated!');
        return redirect()->route('currencies.show', $currency->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Currency $currency
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        Session::flash('success_msg', 'Currency successfully deleted!');
        return redirect()->route('currencies.index');
    }
}
