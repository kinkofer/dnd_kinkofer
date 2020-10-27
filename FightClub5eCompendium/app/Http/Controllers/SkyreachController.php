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
            return view('skyreach', ['runes' => ['blood', 'journey', 'life', 'sacred', 'wind']]);
        }
        else if($navigator == 'reichart') {
            return view('skyreach', ['runes' => ['enemy', 'ice', 'king', 'mountain', 'stone']]);
        }
        else if($navigator == 'vovin') {
            return view('skyreach', ['runes' => ['death', 'dragon', 'hill', 'storm', 'war']]);
        }
        else if($navigator == 'mama-coco') {
            return view('skyreach', ['runes' => ['cloud', 'fire', 'friend', 'light', 'shield']]);
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
