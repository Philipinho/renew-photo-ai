<form action="{{ route('process.upload') }}" class="dropzone" id="upload_area"></form>

<script>

    document.addEventListener('livewire:load', function () {
        let element_id = "#upload_area";

        let dropzone = new Dropzone(element_id, {
            url: '{{ route('process.upload') }}',
            paramName: 'file', // The name that will be used to transfer the file
            maxFileCount: 1,    // Max files
            maxFilesize: 2, //MB
            acceptedFiles: 'image/*', //acceptedFiles: ".jpeg,.jpg,.png,.gif"
            addRemoveLinks: true,
            dictDefaultMessage: "Drop your images here or click to browse",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            init: function () {
                this.on('error', function (file, errorMessage, xhr) {
                    if (xhr) {
                        let errorResponse = JSON.parse(xhr.responseText);
                        this.emit('error', file, errorResponse.message);
                    } else {
                        this.emit('error', file, errorMessage);
                    }
                });
                this.on('success', function (file, response) {
                    console.log("Uploaded");
                    console.log(response);
                    console.log(response.url);
                    Livewire.emit('imageUploaded', response.url);
                });
            }
        });

        dropzone.on('success', function (file, response) {
            console.log("cool");
            console.log(response);
        });


        Livewire.on('imageRenewed', function (url) {
            console.log("imageRenewed");
            console.log(url);
            //dropzone.removeAllFiles();
        });



    });

</script>


{{--
<script>

    dropzone.on('dragenter', e => {
        e.preventDefault();
        console.log('dragenter');
        element.classList.add('bg-emerald-200');
    });

    dropzone.on('dragleave', () => {
        element.classList.remove('bg-emerald-200');
    });
    })
    ;
</script>
--}}

