@switch($document->mime_type)
    @case('text/plain')
        <img class="card-img-top img-fluid" src="{{ asset('public/images/document-extensions/file-lines.svg') }}" alt="{{ $media->name }}">
        @break
    @case('application/vnd.openxmlformats-officedocument.presentationml.presentation')
        <img class="card-img-top img-fluid" src="{{ asset('public/images/document-extensions/file-pdf.svg') }}" alt="{{ $media->name }}">
        @break
    @case('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        <img class="card-img-top img-fluid" src="{{ asset('public/images/document-extensions/file-excel.svg') }}" alt="{{ $media->name }}">
        @break
    @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
        <img class="card-img-top img-fluid" src="{{ asset('public/images/document-extensions/file-word.svg') }}" alt="{{ $media->name }}">
        @break
    @default
        <img class="card-img-top img-fluid" @if($loadingAttributeValue) loading="{{ $loadingAttributeValue }}"@endif src="{{ $media->getUrl($conversion) }}" alt="{{ $media->name }}">
        @break
@endswitch
