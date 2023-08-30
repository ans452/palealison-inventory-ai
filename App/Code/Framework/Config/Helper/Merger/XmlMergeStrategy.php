<?php

namespace App\Code\Framework\Config\Helper\Merger;

use App\Code\Framework\Config\Helper\IMergeStrategy;

class XmlMergeStrategy implements IMergeStrategy
{
    public function merge($outputFile, ...$files): void
    {
        // Create a new DOMDocument object and set its properties
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
      
        // Create the root element
        $root = $dom->createElement('root');
        $dom->appendChild($root);
      
        // Load each input file into a SimpleXMLElement object
        foreach ($files as $file) {
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

