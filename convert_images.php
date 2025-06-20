<?php
// Functie om JPEG naar WEBP te converteren
function convertToWebP($source, $destination, $quality = 80) {
    $image = imagecreatefromjpeg($source);
    if ($image === false) {
        return false;
    }
    
    // Converteer naar WEBP
    $result = imagewebp($image, $destination, $quality);
    
    // Vrijgeven van geheugen
    imagedestroy($image);
    
    return $result;
}

// Directory met afbeeldingen
$imageDir = __DIR__ . '/assets/images/';

// Controleer of de directory bestaat
if (!is_dir($imageDir)) {
    die("Directory niet gevonden: " . $imageDir);
}

// Zoek alle JPEG bestanden
$files = glob($imageDir . '*.{jpg,jpeg}', GLOB_BRACE);

$converted = 0;
$failed = 0;

foreach ($files as $file) {
    // Maak de bestandsnaam voor het WEBP bestand
    $webpFile = pathinfo($file, PATHINFO_DIRNAME) . '/' . 
                pathinfo($file, PATHINFO_FILENAME) . '.webp';
    
    // Converteer het bestand
    if (convertToWebP($file, $webpFile)) {
        echo "Geconverteerd: " . basename($file) . " -> " . basename($webpFile) . "\n";
        $converted++;
    } else {
        echo "Fout bij converteren: " . basename($file) . "\n";
        $failed++;
    }
}

echo "\nConversie voltooid!\n";
echo "Succesvol geconverteerd: $converted\n";
echo "Mislukt: $failed\n";
?>