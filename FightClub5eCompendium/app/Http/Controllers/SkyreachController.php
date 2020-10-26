<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SelectRune;


class SkyreachController extends Controller
{
    public function index() {
        return view('skyreach');
    }


    public function navigate($navigator) {
        if($navigator == 'admin') {
            return view('skyreach', ['admin' => true,
                                     'runes' => ['blood', 'cloud', 'death', 'dragon', 'enemy',
                                                'fire', 'friend', 'hill', 'ice', 'journey',
                                                'king', 'life', 'light', 'mountain', 'sacred',
                                                'shield', 'stone', 'storm', 'war', 'wind']]);
        }
        else if($navigator == 'wynn') {
            return view('skyreach', ['runes' => ['blood', 'cloud', 'death', 'dragon', 'enemy']]);
        }
        else if($navigator == 'reichart') {
            return view('skyreach', ['runes' => ['fire', 'friend', 'hill', 'ice', 'journey']]);
        }
        else if($navigator == 'vovin') {
            return view('skyreach', ['runes' => ['king', 'life', 'light', 'mountain', 'sacred']]);
        }
        else if($navigator == 'mama-coco') {
            return view('skyreach', ['runes' => ['shield', 'stone', 'storm', 'war', 'wind']]);
        }
        else {
            return view('skyreach');
        }
    }


    public function selectRune(Request $request) {
        $rune = $request->input('rune');
        event(new SelectRune($rune));
    }


    public function handout($type) {
        switch ($type) {
            case 'marks':
                return view('handout', ['marks' => true]);
                break;
            case 'grid':
                return view('handout', ['grid' => true]);
                break; 
            case 'maps':
                return view('handout', ['maps' => true]);
                break;
            default:
                return view('handout');
                break;
        }
    }
}
