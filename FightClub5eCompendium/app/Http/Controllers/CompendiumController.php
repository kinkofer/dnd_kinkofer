<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompendiumController extends Controller
{
    public function index() {
        return view('compendium');
    }

    public function compendium(Request $request) {
        $sources = $request->input('sources');
        
        $compendiumSources = "";
        foreach ($sources as $source) {
            $compendiumSources .= "<doc href='" . public_path("/compendiums/sources/{$source}.xml") . "' />\n";
        }

        // error_log($compendiumSources);

        if ($compendiumSources != "") {
            $compendiumXML = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                              <collection>
                                {$compendiumSources}
                              </collection>
                              ";

            $xslt_doc = new \DOMDocument();
            // $xslt_doc->load(asset("/utilities/merge.xslt"));
            $xslt_doc->load(public_path("/utilities/merge.xslt"));

            $xml_doc = new \DOMDocument();
            $xml_doc->loadXML($compendiumXML);

            $proc = new \XSLTProcessor();
            $proc->importStylesheet($xslt_doc);
            $finalCompendium = $proc->transformToDoc($xml_doc);

            file_put_contents(public_path("/compendiums/collections/custom/CustomCompendium.xml"), $finalCompendium->saveXML());
        }

        return view('compendium');
    }
}
