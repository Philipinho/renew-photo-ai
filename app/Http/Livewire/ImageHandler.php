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

        $prediction = $replicateApiService->startImageRenewal($imageUrl);
        sleep(2);
        $prediction = $replicateApiService->checkImageRenewalStatus($prediction->replicate_id);

        //$data = '{"success":true,"input_image_url":"https://i.ibb.co/QNqWjyZ/E-NQc-Jc-XEAch-Po-G.jpg","output_image_url":"https://i.ibb.co/QNqWjyZ/E-NQc-Jc-XEAch-Po-G.jpg","code":200}';

        $this->emit('imageProcessed', $prediction);

        $this->loading = false;

        if ($prediction->status === 'succeeded') {
            $this->emit('imageSucceeded', $prediction->output_image_url);
            $this->redirect('/result?uuid=' . $prediction->uuid);
        } else if ($prediction->status === 'failed') {
            $this->emit('imageFailed', $prediction->error);
        } else {
            $this->emit('imagePending', 'Unknown error');
        }

    }
}
