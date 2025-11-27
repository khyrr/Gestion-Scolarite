<?php

namespace App\Services;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class QrService
{
    /**
     * Generate a PNG data-uri for the given payload (typically an otpauth:// URI).
     */
    public static function generateDataUri(string $payload, int $size = 240): string
    {
        $writer = new PngWriter();

        $qr = QrCode::create($payload)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->setSize($size)
            ->setMargin(8);

        $result = $writer->write($qr);

        return $result->getDataUri();
    }
}
