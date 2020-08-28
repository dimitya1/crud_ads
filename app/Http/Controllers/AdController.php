<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

final class AdController
{
    public function create($id = null)
    {
        $button = 'Create';
        $ad = null;

        if ($id !== null) {
            $ad = \App\Ad::find($id);
            $button = 'Save';
        }

        return view('ad-form', ['ad' => $ad, 'button' => $button]);
    }

    public function save($id = null)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'title' => 'required|min:10|max:255',
                'description' => 'required|min:25|max:65535',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('ad.create', ['id' => $id !== null ? $id : null])
                ->withErrors($validator->errors())
                ->withInput(request()->all());
        }

        if ($id !== null) {
            $ad = \App\Ad::find($id);

            if ($ad->title == request()->get('title')
                && $ad->description == request()->get('description')) {
                return redirect()
                    ->route('home')
                    ->with('nothing to update', 'Nothing to update');
            }

            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            $ad->save();

        } else {
            $ad = new \App\Ad();
            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            auth()->user()->ads()->save($ad);
        }

        return redirect()
            ->route('home')
            ->with('success', "Ad \"{$ad->title}\" was successfully " . ($id === null ? 'created' : 'updated' . '.'));
    }

    public function delete($id = null)
    {
        $ad = \App\Ad::find($id);

        $ad->delete();

        return redirect()
            ->route('home')
            ->with('success', "Ad \"{$ad->title}\" was successfully deleted!");
    }
}
