<?php
namespace App\Support;

use PhpKairos\PhpKairos;

class KairosFacialRecognition
{
    public $client;
    public function __construct()
    {
        $api = 'http://api.kairos.com/';
        $app_id = 'f0103446';
        $app_key = '37ce807d81410faf72d2e82289460861';
        $this->client = new PhpKairos($api, $app_id, $app_key);
    }

    public function enroll(array $data)
    {
        $image = array_get($data, 'image');
        $subject_id = array_get($data, 'subject_id');
        $gallery_name = 'atmsimulation';
        $options = [
            'selector' => 'SETPOSE',
            'symmetricFill' => true,
        ];

        $response = $this->client->enroll($image, $subject_id, $gallery_name, $options);
        $result = $response->getBody()->getContents();
        return $result;
    }

    public function detectOrVerify($image)
    {
        $gallery_name = "atmsimulation";

        $response = $this->client->recognize($image, $gallery_name);
        return $response->getBody()->getContents();
    }
}
