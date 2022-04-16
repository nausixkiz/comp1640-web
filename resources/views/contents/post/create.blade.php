@extends('layouts.main-layout')
@section('title', __('Create New Idea'))

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('CREATE NEW IDEA') }}</h4>
                <p class="card-title-desc">Lorem</p>
            </div>
            <div class="card-body">
                <form class="create-new-idea-form" action="{{ route('posts.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="col-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name" value="{{ old('name') }}"
                                   required/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="short-description">Short Description</label>
                        <div>
                            <textarea required class="form-control @error('short-description') is-invalid @enderror"
                                      id="short-description" name="short-description"
                                      rows="5">{{ old('short-description') }}</textarea>
                            @error('short-description')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content-editor" class="form-label">Contents</label>
                        @error('contents')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <textarea id="content-editor" name="contents">{{ old('contents') }}</textarea>
                    </div>
                    <div class="mb-3 d-flex">

                        <div class="col-6">
                            <div class="col-sm-8 justify-content-between align-content-center text-center  offset-sm-2">
                                <label for="contents" class="form-label">Image Preview</label>
                                <input type="file" class="form-control @error('thump') is-invalid @enderror" id="thump"
                                       name="thump" accept="image/*" required>
                                @error('thump')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-sm-8 justify-content-between align-content-center text-center  offset-sm-2">
                                <label for="category-select" class="form-label">Category</label>
                                <select class="form-control" id="category-select" name="category">
                                    @foreach($categories['data'] as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contents" class="form-label">Document Attached</label>
                        @error('document-list-file')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <input type="file" id="document-file" name="documents[]"
                               data-overwrite-initial="false" multiple>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                   id="terms" name="terms">
                            <label class="form-check-label" for="terms">
                                I acknowledge that I have read and agree to the <a href="javascript:void(0)"
                                                                                   onclick="$('#term-modal').modal('show');">Terms
                                    and Conditions</a> and
                                <a href="">Privacy Policy</a>.
                            </label>
                            @error('terms')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal fade bs-example-modal-xl" id="term-modal" tabindex="-1" role="dialog"
                             aria-labelledby="termModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termModalLabel">Terms and Conditions</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-4"><strong>AGREEMENT TO TERM</strong></p>
                                        <p class="text-justify text-break font-weight-normal">These Term of Use
                                            constitute a legally binding
                                            agreement made between you, whether personally or on behalf of an
                                            entity and our company concerning your access to and use of our website
                                            as well as any other media form, media channel, mobile website or mobile
                                            application related, linked, or otherwise connect thereto.
                                        </p>
                                        <p class="text-justify text-break font-weight-normal">You agree that by
                                            accessing our website, you
                                            have read,
                                            understood, and agree to be bound by all of these Terms of Use. If you do
                                            not
                                            agree with all these term, then you are expressly prohibited from using the
                                            Site
                                            and you must be ban immediately.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="text-justify text-danger ml-4"> Thank you!</span>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    <script src="{{ asset( mix('js/plugins/bootstrap-fileinput.js') ) }}"></script>
    <script src="{{ asset( mix('js/plugins/ckeditor.js') ) }}"></script>
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#content-editor'), {
                // plugins: [ CKFinder],
                // toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                // heading: {
                //     options: [
                //         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                //         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                //         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                //         { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                //         { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                //         { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                //         { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                //     ]
                // }
            })
            .catch(error => {
                console.error(error);
            });
        $('#document-file').fileinput({
            // 'theme': 'fa',
            showUpload: false,
            overwriteInitial: false,
            maxFileSize: 50000,
            showCancel: true,
            allowedFileExtensions: ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'zip', 'rar', 'txt', 'jpg', 'jpeg', 'png', 'bmp'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            },
            previewFileExtSettings: {
                'doc': function (ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function (ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function (ext) {
                    return ext.match(/(ppt|pptx)$/i);
                }
            }
        });
        $('#category-select').select2();
    </script>
@endpush
