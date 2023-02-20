<?php

namespace App\Http\Livewire;

use App\Service\ReplicateApiService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ImageHandler extends Component
{

    protected $listeners = ['handleImage'];

    public function render()
    {
        return view('livewire.image-handler');
    }

    public function handleImage($imageUrl)
    {

        Log::info("ImageUpload:handleImage: $imageUrl");

        $replicateApiService = new ReplicateApiService();

        // thinking: we should emit an event when the process starts
        // then show the user a loading screen
        $endpointUrl = $replicateApiService->startImageRenewal($imageUrl);
        $data = $replicateApiService->checkImageRenewalStatus($endpointUrl);
        $this->emit('imageProcessed', $data);
    }
}
