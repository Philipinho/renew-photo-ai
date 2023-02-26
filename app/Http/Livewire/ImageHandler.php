<?php

namespace App\Http\Livewire;

use App\Service\ReplicateApiService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ImageHandler extends Component
{

    protected $listeners = ['handleImage'];
    public $loading = false;

    public function render()
    {
        return view('livewire.image-handler');
    }

    public function handleImage($imageUrl)
    {

        Log::info("ImageUpload:handleImage: $imageUrl");

        $replicateApiService = new ReplicateApiService();
        $this->loading = true;

        $endpointUrl = $replicateApiService->startImageRenewal($imageUrl);

        dd($endpointUrl->uuid);

        //$data = $replicateApiService->checkImageRenewalStatus($endpointUrl);
        sleep(5); // for testing
        //$data = '{"success":true,"input_image_url":"https://i.ibb.co/QNqWjyZ/E-NQc-Jc-XEAch-Po-G.jpg","output_image_url":"https://i.ibb.co/QNqWjyZ/E-NQc-Jc-XEAch-Po-G.jpg","code":200}';

        $this->emit('imageProcessed', $data);

        $this->loading = false;

        // next take them to the results page?
        $this->redirect('/results');
    }
}
