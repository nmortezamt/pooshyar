<?php

namespace App\Http\Livewire\Home\Order;

use App\Models\cart;
use App\Models\footerTitle;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Completed extends Component
{
    public function render()
    {
        $userIp = Request::ip();
        if (auth()->user()) {
            $carts = cart::where('user_id', auth()->user()->id)->where('status',0)->get();
        } else {
            $carts = cart::where('ip', $userIp)->where('status',0)->get();
        }


        SEOMeta::setTitle('تکمیل سفارش');
        $description = footerTitle::get();
        SEOMeta::setDescription($description[5]->title);
        OpenGraph::setDescription($description[5]->title);
        OpenGraph::setTitle('تکمیل سفارش' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::addProperty('locale:alternate', ['fa_IR']);
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);
        OpenGraph::addImage(['url' => 'http://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        return view('livewire.home.order.completed',compact('carts'))->layout('layouts.product');
    }
}
