<?php

namespace MemoChou1993\Localize\Tests;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class Client extends TestCase
{
    /**
     * @return Response
     */
    public static function fetchProject()
    {
        $data = file_get_contents(__DIR__.'/data/project.json');

        return new Response(200, [], $data);
    }
}
