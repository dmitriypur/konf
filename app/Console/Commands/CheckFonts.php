<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckFonts extends Command
{
    protected $signature = 'fonts:check';
    protected $description = 'Check if WOFF2 fonts exist';

    public function handle()
    {
        $this->info('Проверка шрифтов...');

        $fonts = [
            'public/fonts/Montserrat/Montserrat-Regular.woff2',
            'public/fonts/Montserrat/Montserrat-Medium.woff2',
            'public/fonts/Montserrat/Montserrat-SemiBold.woff2',
            'public/fonts/Montserrat/Montserrat-Bold.woff2',
            'public/fonts/SoyuzGrotesk/SoyuzGrotesk.woff2',
        ];

        $missing = [];
        $existing = [];

        foreach ($fonts as $font) {
            if (file_exists($font)) {
                $size = filesize($font);
                $existing[] = [$font, $this->formatBytes($size)];
            } else {
                $missing[] = $font;
            }
        }

        if (!empty($existing)) {
            $this->info('Найденные WOFF2 шрифты:');
            $this->table(['Файл', 'Размер'], $existing);
        }

        if (!empty($missing)) {
            $this->warn('Отсутствующие WOFF2 шрифты:');
            foreach ($missing as $font) {
                $this->line("  - {$font}");
            }
            $this->info('Запустите: ./convert-fonts.sh для конвертации');
        }

        return 0;
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        return round($size, $precision) . ' ' . $units[$i];
    }
} 