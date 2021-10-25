@extends("layout.dashboardLayout")
@section('site-section')
    <div class="page-title">
        <h2>All Topics</h2>
    </div>
    @if (\Session::has('success'))
        <div class="card mb-3" id="success">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 class="text-success"> {!! \Session::get('success') !!}</h5>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->has('error'))
        <div class="card mb-3" id="success">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 class="text-danger"> {{ $errors->first('error') }}</h5>
                </div>
            </div>
        </div>
    @endif

    <div class="row pb-5">
        <div class="col-md-8 col-lg-8">
            <div class="page-content">
                <div class="page-content-table">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <p>Icon</p>
                            </div>
                            <div class="col-md-5">
                                <p>Topic</p>
                            </div>
                            <div class="col-md-3">
                                <p>Status</p>
                            </div>
                            <div class="col-md-2">
                                <p>Action</p>
                            </div>
                        </div>
                    </div>
                    @if (isset($data))
                        @foreach ($data as $item)
                            <div class="single-table-row border-bottom py-3 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-2"><img src="{{ asset('/storage/' . $item->thumbnail) }}"
                                            alt="" class="table-content-icon "></div>
                                    <div class="col-md-5">
                                        <p class="single-table-row-item-name">{{ $item->name }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div
                                            class="status-btn m-auto {{ $item->status->name == 'Active' ? 'status-btn' : 'status-hide' }}">
                                            {{ $item->status->name }}</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                            <div class="tool-tip-wrapper">
                                                <div class="tooltip-content-wrapper">
                                                    <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('topic.status.update', ['id' => $item->id, 'status' => 'Active'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Active" class="w-100">
                                                        </form>
                                                    </div>
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('topic.status.update', ['id' => $item->id, 'status' => 'Hide'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Hide" class="w-100">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-between ">
                <div></div>
                {{ $data->links() }}
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="sidecard-content-wrapper">
                <form action="{{ asset(route('topics.create')) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="side-card">
                        <div class="side-card-header">
                            <div class="btn-wrapper d-flex justify-content-between align-items-center">
                                <div class="side-card-title">Add new topic</div>
                                <button class="card-add-btn" type="submit">Add</button>
                            </div>
                            <input type="text" class="form-control py-3 my-4" name="name" placeholder="Enter topic name">
                            @if ($errors->has('name'))
                                <div class="error text-danger" id="error">
                                    <p>{{ $errors->first('name') }}</p>
                                </div>
                            @endif

                        </div>
                    </div>
                    {{-- <input type="file" value="" id="customInput"> --}}

                    <div class="side-card-body">
                        <div class="side-card-body-title">
                            <p class="">Upload Icon</p>
                        </div>
                        <div class="drag-area" id="dragWrapper">
                            <img src="{{ URL::asset('img/image.png') }}" alt="image" class="img-fluid drug-drop-icon">
                            <button class="custom-file-upload-btn" id="browsButton">Browse Files</button>
                            <input type="file" name="thumbnail" id="browsInput" hidden accept="image/*" />
                        </div>
                        @if ($errors->has('thumbnail'))
                            <div class="error text-danger" id="error">
                                <p>{{ $errors->first('thumbnail') }}</p>
                            </div>
                        @endif

                    </div>


                </form>
                <div id="preview mt-3">
                    <img src="" alt="" id="output" class="w-100" />
                </div>
            </div>

        </div>
    </div>
@endsection
