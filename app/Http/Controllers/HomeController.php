<?php

namespace App\Http\Controllers;

final class HomeController
{
    public function __invoke()
    {
        $ads = \App\Ad::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('home', ['ads' => $ads]);
    }
}

