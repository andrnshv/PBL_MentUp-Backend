<div class="w-full">
    @if($url)
        <div class="relative w-full rounded-lg overflow-hidden bg-gray-900 border border-gray-700" style="height: 80vh;">
            <iframe
                src="{{ $url }}#view=FitH"
                type="application/pdf"
                width="100%"
                height="100%"
                class="absolute inset-0 w-full h-full"
                style="border: none;"
            ></iframe>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 text-gray-400 border-2 border-dashed border-gray-700 rounded-lg">
            <p class="italic font-medium">Berkas CV tidak ditemukan.</p>
        </div>
    @endif
</div>