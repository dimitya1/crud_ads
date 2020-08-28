<?php

namespace App\Http\Controllers;

final class ReadOneController
{
    public function __invoke($id = null)
    {
        $ad = \App\Ad::find($id);

        if ($ad !== null) {
            return view('read-one', ['ad' => $ad]);
        } else return redirect()
            ->route('home')
            ->withErrors(['ad not found' => 'Requested ad was not found!']);
    }
}
