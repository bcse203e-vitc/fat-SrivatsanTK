<?php
$file=file_get_contents("file.txt");
function normalize_text($file, $mode) {
    try {
        $content = file_get_contents($fileName);
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage() . "\n";
        return null;
    }
    $content = preg_replace('/\s+/', ' ', $content);


    $lines = explode("\n", $content);
    $lines = array_map(function($line) {
        return trim($line);
    }, $lines);

    if ($mode == 'compress') {
        $lines = array_filter($lines, function($line) {
            return $line !== '';
        });
        $lines[] = "\n";

    elseif ($mode == 'expand') {
        if (count($lines)) {
            array_unshift($lines, "\n");
        } else {
            echo "No lines to expand.\n";
            return null;
        }
    }

    $punctuation_lines = 0;
    foreach ($lines as $line) {
        if (preg_match('/[[:punct:]]/', $line)) {
            $punctuation_lines++;
        }
    }
    echo "Lines with only punctuation symbols: $punctuation_lines\n";

    try {
        file_put_contents($fileName, implode("\n", $lines));
    } catch (Exception $e) {
        echo "An error occurred while overwriting the file: " . 
$e->getMessage() . "\n";
    }
}

?>