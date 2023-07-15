<?php

namespace App\Http\Livewire\Home\BankPayment;

use App\Models\footerTitle;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Index extends Component
{
    public $payment;

    public function mount($order_number)
    {
        $this->payment = $order_number;
    }
    public function render()
    {
        header("refresh:3;url=/payment/pooshyar");
        SEOMeta::setTitle('پرداخت');
        $description = footerTitle::get();
        SEOMeta::setDescription($description[5]->title);
        OpenGraph::setDescription($description[5]->title);
        OpenGraph::setTitle('پرداخت' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');
        return view('livewire.home.bank-payment.index')->layout('layouts.product');
    }
}
