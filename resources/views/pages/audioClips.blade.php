@extends("layout.dashboardLayout")
@section('site-section')
    @if (\Session::has('success'))
        <div class="card mb-3" id="success">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 class="text-success"> {!! \Session::get('success') !!}</h5>
                </div>
            </div>
        </div>
    @endif
    <div class="page-title-wrapper d-flex justify-content-between">
        <div class="page-title">
            <h2>All Audio Clips</h2>

        </div>
        <div class="add-button-wrapper">
            <a href="{{ asset(route('audio.uploadAudio')) }}"><img src="{{ URL::asset('img/plus.png') }}"
                    alt="img" />Add
                New
                Qlips</a>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-md-12 col-lg-12">
            <div class="page-content audio-qlips">
                <div class="page-content-table audio-clips">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 col-lg-1 col-sm-1 col-1 text-center">
                                <p>ID</p>
                            </div>
                            <div class="col-md-6 col-lg-2 col-sm-8 col-8 text-left">
                                <p>Audio Qlips</p>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6 col-6">
                                <p>Questions</p>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6 col-6">
                                <p>Advisors</p>
                            </div>
                            <div class="col-md-6 col-lg-1 col-sm-6 col-6 text-center">
                                <p>Status</p>
                            </div>
                            <div class="col-md-6 col-lg-2 col-sm-6 col-6 text-center">
                                <p>Actions</p>
                            </div>
                        </div>
                    </div>
                    @if (isset($data))
                        @foreach ($data as $key => $item)
                            <div class="single-table-row border-bottom py-3 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-1 col-lg-1 col-sm-1 col-1 text-center sl-item">
                                        <P>{{ ($data->currentpage() - 1) * $data->perpage() + $key + 1 }}</P>
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-sm-8 col-8">
                                        {{-- <p class="single-table-row-item-name trancate"> --}}
                                        <audio controls src="{{ asset('storage/' . $item->content) }}"
                                            class="w-100"></audio>
                                        {{-- </p> --}}
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-sm-6 col-6">
                                        <p class="single-table-row-item-name audioclips-name">
                                            {{ $item->question->question }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-sm-6 col-6">
                                        <div class="advisor-image d-flex align-items-center"><img
                                                src="{{ asset('storage/' . $item->advisor->image) }}" alt="image">
                                            <div class="advisor-name ml-2">
                                                <p>{{ $item->advisor->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-1 col-sm-6 col-6 text-center">
                                        <div
                                            class="status-btn m-auto {{ $item->status->name == 'Active' ? 'status-btn' : 'status-hide' }}">
                                            {{ $item->status->name }}</div>
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-sm-6 col-6  text-center">
                                        <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                            <div class="tool-tip-wrapper">
                                                <div class="tooltip-content-wrapper">
                                                    <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('audio.status.update', ['id' => $item->id, 'status' => 'Active'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Active" class="w-100">
                                                        </form>
                                                    </div>
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('audio.status.update', ['id' => $item->id, 'status' => 'Hide'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Hide" class="w-100">
                                                        </form>
                                                    </div>
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('audio.status.update', ['id' => $item->id, 'status' => 'Recent'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Recent" class="w-100">
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
            {{-- <div class="pagination-wrapper d-flex justify-content-end align-items-center my-4"> --}}
            {{-- <ul class=""> --}}
            {{-- <li class="pagination-item"><a href="#"><img src="{{ URL::asset('img/leftArrow.png') }}" alt="image" --}}
            {{-- class="pagination-arrow pagination-arrow-disabled"></a> --}}
            {{-- </li> --}}
            {{-- <li class="pagination-item"><a class="" href="#">1</a></li> --}}
            {{-- <li class="pagination-item"><a class="" href="#">2</a></li> --}}
            {{-- <li class="pagination-item"><a class="" href="#">3</a></li> --}}
            {{-- <li class="pagination-item"><a class="" href="#">4</a></li> --}}
            {{-- <li class="pagination-item"><a href="#" class="m-0"><img --}}
            {{-- src="{{ URL::asset('img/rightArrow.png') }}" alt="" class="pagination-arrow"></a></li> --}}
            {{-- </ul> --}}
            {{-- </div> --}}
        </div>
    </div>

@endsection
