<?php

namespace App\Code\Framework\Config\Helper;

use App\Code\Framework\Data\Context;

class File
{
    /**
     * @var string
     */
    const ROOT_DIRECTORY_SPECIFICATION = 'Code';

    private Context $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getDirectoryFiles($directory): \Generator
    {
        $targetDirectory =
            $this->context->getRootDirectory() . $directory;

        if (is_dir($targetDirectory)) {
            $handle = opendir($targetDirectory);

            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                    yield pathinfo($file, PATHINFO_FILENAME);
                }
            }

            closedir($handle);
        }
    }

    public function getAllFiles($pattern)
    {
        $files = [];
        $rootDirectory = $this->context->getRootDirectory() . DIRECTORY_SEPARATOR . self::ROOT_DIRECTORY_SPECIFICATION;
        $directories = glob($rootDirectory . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {
            $file = $directory . $pattern;
            if (file_exists($file)) {
                $files[] = $file;
            }
        }
        return $files;
    }

    public function getRootDirectory()
    {
        return $this->context->getRootDirectory();
    }

    public function mergeXmlFiles($outputFile, ...$inputFile) {
        // Create a new DOMDocument object and set its properties
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
      
        // Create the root element
        $root = $dom->createElement('root');
        $dom->appendChild($root);
      
        // Load each input file into a SimpleXMLElement object
        foreach ($inputFile as $file) {
          $xml = simplexml_load_file($file);
      
          // Add each child node to the root element
          foreach ($xml->children() as $child) {
            $node = dom_import_simplexml($child);
            $root->appendChild($dom->importNode($node, true));
          }
        }
      
        // Save the merged XML file
        $dom->save($outputFile);
      }
}
