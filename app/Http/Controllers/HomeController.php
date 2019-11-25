<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $products = collect([
            (object)[
              'id' => 1,
              'price'=> '50',
              'title'=> 'Mixed Vegetable Box',
              'description'=> 'We will ensure there is good random mix of all vegetables'
            ],
            (object)[
              'id' => 2,
              'price'=> '25',
              'title'=> 'Fresh Chicken Box',
              'description'=> 'Live whole chicken cut on the same day delivery'
            ],
            (object)[
              'id' => 3,
              'price'=> '35',
              'title'=> 'Local Goat Box',
              'description'=> 'Live local goat cut on the same day delivery'
            ],
            (object)[
              'id' => 4,
              'price'=> '50',
              'title'=> 'Lamb Box',
              'description'=> 'Good And Fresh Frozen lamb box delivery'
            ],
            (object)[
              'id' => 5,
              'price'=> '35',
              'title'=> 'Beef Box',
              'description'=> 'Live local beef cut on the same day delivery'
            ],
            (object)[
              'id' => 6,
              'price'=> '50',
              'title'=> 'Seafood Box',
              'description'=> 'Fresh and good mix of fish, Prawns, Crabs, Squids'
            ],

          ]);
        return view('index', compact('products'));
    }
}
