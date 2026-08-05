<?php
$files = [
    'app/Filament/Admin/Resources/PostResource.php',
    'app/Filament/Admin/Resources/StudentResource.php',
    'app/Filament/Admin/Resources/UserResource.php',
    'app/Filament/Admin/Resources/DonorResource.php',
    'app/Filament/Admin/Resources/DonationResource.php',
    'app/Filament/Admin/Resources/PageResource.php',
    'app/Filament/Admin/Resources/ProjectResource.php',
    'app/Filament/Donor/Resources/DonationHistoryResource.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        // Remove the invalid use statement
        $content = str_replace("use Filament\Tables\Actions\ViewAction;\n", "", $content);
        // Replace Tables\Actions\ with \Filament\Actions\
        $content = str_replace("Tables\Actions\\", "\Filament\Actions\\", $content);
        file_put_contents($file, $content);
        echo "Fixed $file\n";
    }
}
