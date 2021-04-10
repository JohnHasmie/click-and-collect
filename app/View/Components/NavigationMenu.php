<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Cart;

class NavigationMenu extends Component
{
    public $cartTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function __construct()
    {
        $this->cartTotal = Cart::getContent()->count();
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('navigation-menu');
    }

    public function updateCartTotal(): void
    {
        $this->cartTotal = Cart::getContent()->count();
    }
}
