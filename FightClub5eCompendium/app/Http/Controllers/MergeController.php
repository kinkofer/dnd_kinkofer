<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;


class MergeController extends Controller
{
    public function index() {
        return view('custom-merge');
    }


    public function merge(Request $request) {
        $files = $request->file('sources');

        if (!isset($files)) {
            return redirect()->action('MergeController@index');
        }

        // Validate source extensions
        $filterExtensions = function($n) { return !in_array($n->extension(), ["xml"]); };
        $invalidExtension = array_filter($files, $filterExtensions);

        if (!empty($invalidExtension)) {
            return view('custom-merge', ['mergeError' => "Found an invalid file extension. Only xml files are alllowed."]);
        }

        // Get filenames
        $getFileNames = function($n) { return pathinfo($n->getClientOriginalName())["filename"]; };
        $sources = array_map($getFileNames, $files);

        // SHA-1 the sources to produce the directory
        $dir = sha1(implode(", ", $sources));

        if (File::exists(public_path("customCompendiums/{$dir}/CustomCompendium.xml"))) {
            return view('compendium', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml"]);
        }
        else {
            File::makeDirectory(public_path("customCompendiums/{$dir}"));
        }

        $compendiumXML = $this->makeCompendiumXML($files);

        $xslt_doc = new \DOMDocument();
        $xslt_doc->load(public_path("/utilities/merge.xslt"));

        $xml_doc = new \DOMDocument();
        $xml_doc->loadXML($compendiumXML);

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xslt_doc);
        $finalCompendium = $proc->transformToDoc($xml_doc);

        file_put_contents(public_path("customCompendiums/{$dir}/CustomCompendium.xml"), $finalCompendium->saveXML());

        return view('custom-merge', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml",
                                    "sources" => $sources]);
    }


    // Construct Compendium XML from uploaded files
    private function makeCompendiumXML($files) {
        $compendiumfiles = "";
        foreach ($files as $file) {
            $compendiumfiles .= "<doc href='" . $file->path() . "' />\n";
        }

        // error_log($compendiumfiles);

        $compendiumXML = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                          <collection>
                            {$compendiumfiles}
                          </collection>
                          ";

        return $compendiumXML;
    }
}
