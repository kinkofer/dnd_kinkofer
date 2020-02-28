<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class CompendiumController extends Controller
{
    public function index() {
        return view('compendium');
    }

    public function compendium(Request $request) {
        $sources = $request->input('sources');

        if (!isset($sources)) {
            return redirect()->action('CompendiumController@index');
        }
        
        // SHA-1 the sources to produce the directory
        $dir = sha1(implode(", ", $sources));

        if (File::exists(public_path("customCompendiums/{$dir}/CustomCompendium.xml"))) {
            return view('compendium', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml"]);
        }
        else {
            File::makeDirectory(public_path("customCompendiums/{$dir}"));
        }

        $compendiumXML = $this->makeCompendiumXML($sources);

        $xslt_doc = new \DOMDocument();
        $xslt_doc->load(public_path("/utilities/merge.xslt"));

        $xml_doc = new \DOMDocument();
        $xml_doc->loadXML($compendiumXML);

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xslt_doc);
        $finalCompendium = $proc->transformToDoc($xml_doc);

        file_put_contents(public_path("customCompendiums/{$dir}/CustomCompendium.xml"), $finalCompendium->saveXML());

        return view('compendium', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml"]);
    }


    private function makeCompendiumXML($sources) {
        $sourcesDir = "/compendiums/sources";

        $compendiumSources = "";
        foreach ($sources as $source) {
            $compendiumSources .= "<doc href='" . public_path("{$sourcesDir}/{$source}.xml") . "' />\n";
        }

        // error_log($compendiumSources);

        $compendiumXML = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                          <collection>
                            {$compendiumSources}
                          </collection>
                          ";

        return $compendiumXML;
    }
}
