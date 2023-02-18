<?php

namespace App\Http\Livewire;

use App\Service\ReplicateApiService;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $image;

    protected $listeners = ['imageUploaded' => 'renewImage'];

    public function render()
    {
        return view('livewire.image-upload');
    }

    public function renewImage($imageUrl)
    {
        $replicateApiService = new ReplicateApiService();
        $endpointUrl = $replicateApiService->startImageRenewal($imageUrl);

        $renewedImage = $replicateApiService->checkImageRenewalStatus($endpointUrl);

        $this->emit('imageRenewed', $renewedImage);
        //session()->flash('message', 'Processed successfully.');
    }
}
