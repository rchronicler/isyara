<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\UserSavedWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSavedWordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'entry_id' => 'required|exists:dictionaries,entry_id',
        ]);

        UserSavedWord::firstOrCreate([
            'user_id' => Auth::id(),
            'dictionary_id' => $request->entry_id,
        ]);

        return redirect()->back()->with('success', 'Kata berhasil disimpan!');
    }

    public function index()
    {
        $savedWords = UserSavedWord::where('user_id', Auth::id())->with('dictionary.category')->get();
        return view('saved-words', compact('savedWords'));
    }

    public function destroy($saved_id) {
        $savedWord = UserSavedWord::where('id', $saved_id)->first();
        $savedWord->delete();
        return redirect()->back()->with('success', 'Kata berhasil dihapus!');
    }
}
