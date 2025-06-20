<?php
// Script om afbeeldingsreferenties bij te werken naar WebP

// Afbeeldingsextensies die we willen vervangen
$extensions_to_replace = ['jpeg', 'jpg', 'png'];

// Functie om afbeeldingsreferenties bij te werken in een bestand
function update_image_references($file_path) {
    if (!file_exists($file_path)) {
        return [
            'status' => false,
            'message' => 'Bestand bestaat niet: ' . $file_path
        ];
    }
    
    // Lees de inhoud van het bestand
    $content = file_get_contents($file_path);
    $original_content = $content;
    
    // Bepaal het bestandstype
    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    
    $replacements = 0;
    
    if ($ext === 'php' || $ext === 'html') {
        // Bijwerken van <img src="..."> tags
        $patterns = [
            '/<img[^>]*src=["\'](.*?\.(?:' . implode('|', $extensions_to_replace) . '))["\'][^>]*>/i'
        ];
        
        foreach ($patterns as $pattern) {
            $replacements += preg_match_all($pattern, $content, $matches);
            foreach ($matches[1] as $match) {
                $webp_path = str_replace(['.jpeg', '.jpg', '.png'], '.webp', $match);
                $content = str_replace($match, $webp_path, $content);
            }
        }
    } elseif ($ext === 'css') {
        // Bijwerken van url() referenties in CSS
        $pattern = '/url\(["\']?(.*?\.(?:' . implode('|', $extensions_to_replace) . '))["\']?\)/i';
        $replacements += preg_match_all($pattern, $content, $matches);
        
        foreach ($matches[1] as $match) {
            $webp_path = str_replace(['.jpeg', '.jpg', '.png'], '.webp', $match);
            $content = str_replace($match, $webp_path, $content);
        }
    }
    
    // Sla het bestand alleen op als er wijzigingen zijn gemaakt
    if ($content !== $original_content) {
        // Maak een backup van het originele bestand
        $backup_path = $file_path . '.bak';
        file_put_contents($backup_path, $original_content);
        
        // Schrijf de gewijzigde inhoud naar het bestand
        file_put_contents($file_path, $content);
        
        return [
            'status' => true,
            'message' => 'Bestand bijgewerkt: ' . $file_path,
            'replacements' => $replacements
        ];
    }
    
    return [
        'status' => false,
        'message' => 'Geen wijzigingen gemaakt in: ' . $file_path
    ];
}

// Functie om een map recursief te scannen
function scan_directory($directory) {
    $results = [];
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($files as $file) {
        if ($file->isFile()) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['php', 'html', 'css'])) {
                $results[] = $file->getPathname();
            }
        }
    }
    
    return $results;
}

// Mappen die moeten worden gescand
$directories = [
    'pages',
    'includes',
    'assets/css'
];

// Resultaten bijhouden
$updated_files = [];
$skipped_files = [];

// Bijwerken van bestanden in elke map
foreach ($directories as $directory) {
    if (file_exists($directory) && is_dir($directory)) {
        $files = scan_directory($directory);
        
        foreach ($files as $file) {
            $result = update_image_references($file);
            
            if ($result['status']) {
                $updated_files[] = [
                    'file' => $file,
                    'replacements' => $result['replacements']
                ];
            } else {
                $skipped_files[] = [
                    'file' => $file,
                    'reason' => $result['message']
                ];
            }
        }
    }
}

// Toon resultaten
echo '<html><head><title>WebP Referentie Update Resultaten</title>';
echo '<style>
        body { font-family: Arial, sans-serif; line-height: 1.6; max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { color: #3563e9; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f5f5f5; }
        .success { color: green; }
        .warning { color: orange; }
      </style>';
echo '</head><body>';
echo '<h1>WebP Referentie Update Resultaten</h1>';

if (!empty($updated_files)) {
    echo '<h2 class="success">Bijgewerkte bestanden: ' . count($updated_files) . '</h2>';
    echo '<table>';
    echo '<tr><th>Bestand</th><th>Aantal vervangingen</th></tr>';
    
    foreach ($updated_files as $file) {
        echo '<tr>';
        echo '<td>' . $file['file'] . '</td>';
        echo '<td>' . $file['replacements'] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
}

if (!empty($skipped_files)) {
    echo '<h2 class="warning">Overgeslagen bestanden: ' . count($skipped_files) . '</h2>';
    echo '<table>';
    echo '<tr><th>Bestand</th><th>Reden</th></tr>';
    
    foreach ($skipped_files as $file) {
        echo '<tr>';
        echo '<td>' . $file['file'] . '</td>';
        echo '<td>' . $file['reason'] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
}

echo '<h2>Volgende stappen</h2>';
echo '<p>Controleer handmatig of alle afbeeldingsreferenties correct zijn bijgewerkt.</p>';
echo '<p>Voor bestanden met inline stijlen of JavaScript waarin afbeeldingsreferenties voorkomen, kan handmatige aanpassing nodig zijn.</p>';

echo '</body></html>';
?>