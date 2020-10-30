<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ZipArchive;


class MergeController extends Controller
{
    public function index() {
        return view('custom-merge');
    }


    public function merge(Request $request) {
        // UploadedFile[] type - https://github.com/symfony/symfony/blob/3.0/src/Symfony/Component/HttpFoundation/File/UploadedFile.php
        $files = $request->file('sources');

        // Get original filenames
        $getFileName = function($n) { return $n->getClientOriginalName(); };
        $originalFileNames = array_map($getFileName, $files);

        if (!isset($files)) {
            return redirect()->action('MergeController@index');
        }

        // Validate source extensions
        $filterExtensions = function($n) { return !in_array($n->extension(), ["xml","zip"]); };
        $invalidExtension = array_filter($files, $filterExtensions);

        if (!empty($invalidExtension)) {
            return view('custom-merge', ['mergeError' => "Found an invalid file extension. Only xml and zip files are alllowed."]);
        }

        // Create tmp directory for compendium files
        $uuid = Str::uuid();
        $tmpDir = public_path("tmp/{$uuid}");
        File::makeDirectory($tmpDir);

        // Move each compendium file into the tmp directory
        foreach ($files as $file) {
            switch ($file->extension()) {
            case "xml":
                $file->move($tmpDir, $file->getClientOriginalName());
                break;
            case "zip":
                $this->moveCompendiumFromZip($file, $tmpDir);
                break;
            }
        }

        // TODO: Validate compendium xml

        // Get all compendium files moved to the tmp directory, returned as SplFileInfo[] type
        $compendiumFiles = File::files($tmpDir);

        // Get filenames
        $getFileName = function($n) { return $n->getFilename(); };
        $sources = array_map($getFileName, $compendiumFiles);

        // SHA-1 the sources to produce the directory
        $dir = sha1(implode(", ", $sources));

        if (File::exists(public_path("customCompendiums/{$dir}/CustomCompendium.xml"))) {
            // Return the existing custom compendium
            return view('custom-merge', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml"]);
        }
        else {
            File::makeDirectory(public_path("customCompendiums/{$dir}"));
        }

        $compendiumXML = $this->makeCompendiumXML($compendiumFiles);

        $xslt_doc = new \DOMDocument();
        $xslt_doc->load(public_path("/utilities/merge.xslt"));

        $xml_doc = new \DOMDocument();
        $xml_doc->loadXML($compendiumXML);

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xslt_doc);
        $finalCompendium = $proc->transformToDoc($xml_doc);

        file_put_contents(public_path("customCompendiums/{$dir}/CustomCompendium.xml"), $finalCompendium->saveXML());
        $this->deleteDirectory($tmpDir);
        
        return view('custom-merge', ["customCompendium" => "customCompendiums/{$dir}/CustomCompendium.xml",
                                    "sources" => $originalFileNames]);
    }


    /// Construct Compendium XML from uploaded files
    /// @param SplFileInfo[] $files
    private function makeCompendiumXML($files) {
        $compendiumFiles = "";
        foreach ($files as $file) {
            $compendiumFiles .= "<doc href='" . $file->getPathname() . "' />\n";
        }

        // error_log($compendiumFiles);

        $compendiumXML = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                          <collection>
                            {$compendiumFiles}
                          </collection>
                          ";

        return $compendiumXML;
    }


    /// Takes a zip file and moves a containing compendium.xml to the indicated directory
    /// @param UploadedFile $file
    /// @param string $dir
    private function moveCompendiumFromZip($file, $dir) {
        // Get the filename to rename containing compendium.xml
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Unzip and find compendium xml file
        $zip = new ZipArchive;
        $res = $zip->open($file->path());
        if ($res === TRUE) {
            $zipDir = "{$dir}/{$filename}";
            File::makeDirectory($zipDir);
            $zip->extractTo($zipDir);
            $zip->close();

            if (File::exists("{$zipDir}/compendium.xml")) {
                File::move("{$zipDir}/compendium.xml", "{$dir}/{$filename}.xml");
            }
            else if (File::exists("{$zipDir}/{$filename}/compendium.xml")) {
                File::move("{$zipDir}/{$filename}/compendium.xml", "{$dir}/{$filename}.xml");
            }
            else {
                // TODO: Throw error
                echo "No compendium exists in this zip";
            }

            $this->deleteDirectory($zipDir);
        } 
        else {
            // TODO: Throw error
            echo "Failed to open zip with error: " . $res;
        }
    }


    private function deleteDirectory($dir) {
        system('rm -rf -- ' . escapeshellarg($dir), $retval);
        return $retval == 0; // UNIX commands return zero on success
    }
}
