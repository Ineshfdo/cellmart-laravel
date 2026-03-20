<?php
$viewsDir = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents($file);
        
        $replacements = [
            'asset($product->image)' => 'asset(str_replace(\'Images/\', \'images/\', $product->image))',
            'asset($item[\'product\']->image)' => 'asset(str_replace(\'Images/\', \'images/\', $item[\'product\']->image))',
            'asset($product[\'image\'])' => 'asset(str_replace(\'Images/\', \'images/\', $product[\'image\']))',
            '$product[\'image\']' => 'str_replace(\'Images/\', \'images/\', $product[\'image\'])', // For success.blade.php
            '$item[\'product\']->image' => 'str_replace(\'Images/\', \'images/\', $item[\'product\']->image)',
            '$product->image' => 'str_replace(\'Images/\', \'images/\', $product->image)'
        ];

        // Only do specific targeting to avoid corrupting conditionals or loops
        // The safest targets in views:
        $newContent = str_replace(
            ['asset($product->image)', 'asset($item[\'product\']->image)', 'asset($product[\'image\'])'], 
            ['asset(str_replace(\'Images/\', \'images/\', ltrim($product->image, "/")))', 'asset(str_replace(\'Images/\', \'images/\', ltrim($item[\'product\']->image, "/")))', 'asset(str_replace(\'Images/\', \'images/\', ltrim($product[\'image\'], "/")))'], 
            $content
        );

        if ($content !== $newContent) {
            file_put_contents($file, $newContent);
            echo "Updated: " . $file->getPathname() . "\n";
        }
    }
}
