@extends("layout.dashboardLayout")
@section('site-section')
    <div class="page-title">
        <h2>All Questions</h2>
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
    </div>
    <div class="row pb-5">
        <div class="col-md-12 col-lg-8">
            <div class="page-content">
                <div class="page-content-table">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 text-center">
                                <p>ID</p>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-2 col-5 text-left">
                                <p>Questions</p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-3 text-center">
                                <p>Status</p>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 text-center">
                                <p>Action</p>
                            </div>
                        </div>
                    </div>
                    @if (isset($questions))
                        @foreach ($questions as $key => $question)
                            <div class="single-table-row border-bottom py-3 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-lg-2 col-sm-2 col-2 text-center sl-item">
                                        <P> {{ ($questions->currentpage() - 1) * $questions->perpage() + $key + 1 }}</P>
                                    </div>
                                    <div class="col-md-5 col-lg-5 col-sm-5 col-5 ">
                                        <p class="single-table-row-item-name question-name">
                                            {{ $question->question }}</p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-3">
                                        <div
                                            class="status-btn m-auto {{ $question->status->name == 'Active' ? 'status-btn' : 'status-hide' }}">
                                            {{ $question->status->name }}</div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-2 col-2 text-center">
                                        <div class="three-dot position-relative question-tooltip"><img
                                                src="{{ URL::asset('img/dot.png') }}" alt="">
                                            <div class="tool-tip-wrapper ">
                                                <div class="tooltip-content-wrapper">
                                                    <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('questions.status.update', ['id' => $question->id, 'status' => 'Active'])) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Active" class="w-100">
                                                        </form>
                                                    </div>
                                                    <div class="tooltip-item">
                                                        <form
                                                            action="{{ asset(route('questions.status.update', ['id' => $question->id, 'status' => 'Hide'])) }}"
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
                {{ $questions->links() }}
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
        <div class="col-md-12 col-lg-4">
            <form action="{{ asset(route('questions.store')) }}" method="post">
                @csrf
                @method('post')
                <div class="sidecard-content-wrapper">
                    <div class="side-card">
                        <div class="side-card-header">
                            <div class="btn-wrapper d-flex justify-content-between align-items-center">
                                <div class="side-card-title">Add Question</div>
                                <button class="card-add-btn" type="submit">Add</button>
                            </div>
                            <input type="text" class="form-control py-3 my-4" placeholder="Enter Questions" name="name">
                            @if ($errors->has('name'))
                                <div class="error text-danger" id="error">
                                    <p>{{ $errors->first('name') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="side-card-body">
                        <div class="side-card-body-title">
                            <p class="">Topics</p>
                        </div>
                        <select name="topic[]" id="" class="form-control" multiple>
                            <option value="" selected>Select Topic</option>
                            @if (isset($topics))
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('topic'))
                            <div class="error text-danger" id="error">
                                <p>{{ $errors->first('topic') }}</p>
                            </div>
                        @endif
                        {{-- <div class="selected-item-wrapper d-flex align-items-center py-4"> --}}
                        {{-- <div class="selected-item mr-2">Design <img src="{{ URL::asset('img/Vector.png') }}" alt="close" --}}
                        {{-- class="close-btn"></div> --}}
                        {{-- <div class="selected-item mr-2">Invest <img src="{{ URL::asset('img/Vector.png') }}" alt="close" --}}
                        {{-- class="close-btn"></div> --}}
                        {{-- <div class="selected-item mr-2">Leader <img src="{{ URL::asset('img/Vector.png') }}" alt="close" --}}
                        {{-- class="close-btn"></div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // let str = document.getElementsByClassName("trancate");
        // let word = str[0].innerText.substring(0, 5) + "...";
    </script>
@endsection
