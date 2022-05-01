<?php
declare(strict_types=1);

namespace App\Service;


use Symfony\Component\Serializer\SerializerInterface;

class ExportService
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function export(array $data, string $format): void
    {
        $serialized = $this->serializer->serialize($data, $format);

        file_put_contents(
            sprintf('/var/www/html/var/%s.%s', uniqid('', true), $format),
            $serialized
        );
    }
}