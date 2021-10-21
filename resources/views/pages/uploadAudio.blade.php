@extends("layout.dashboardLayout")
@section('site-section')
    @if($errors->has('error'))
        <div class="card mb-3" id="success">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 class="text-danger"> {{$errors->first('error')}}</h5>
                </div>
            </div>
        </div>
    @endif
    <div class="audio-upload-wrapper">
        <form action="{{asset(route('audio.upload'))}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-7">
                    <div class="page-title mt-4">
                        <h2>Add New Audio Qlips</h2>
                    </div>
                    <div class="sidecard-content-wrapper p-4 mb-5">
                        <div class="side-card">
                            <div class="side-card-header">
                                <div class="btn-wrapper">
                                    <div class="side-card-title mb-1">Question</div>
                                </div>
                                <select name="question" id="" class="form-control mb-4">
                                    <option value="">Select Question</option>
                                    @if(isset($questions))
                                        @foreach($questions as $question)
                                            <option value="{{$question->id}}">{{$question->question}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('question'))
                                    <div class="error text-danger" id="error"><p>{{ $errors->first('question') }}</p></div>
                                @endif
                            </div>
                            <div class="topic-input-wrapper mb-4">
                                <label for="">Advisor</label>
                                <select name="advisor" id="" class="form-control">
                                    <option value="">Select Advisor</option>
                                    @if(isset($advisors))
                                        @foreach($advisors as $advisor)
                                            <option value="{{$advisor->id}}">{{$advisor->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('advisor'))
                                    <div class="error text-danger" id="error"><p>{{ $errors->first('advisor') }}</p></div>
                                @endif
                            </div>
                            <div class="topic-input-wrapper">
                                <label for="">Youtube URL</label>
                                <input type="text" class="form-control py-3 mb-4" placeholder="Enter Youtube URL"
                                       name="url">
                                @if($errors->has('url'))
                                    <div class="error text-danger" id="error"><p>{{ $errors->first('url') }}</p></div>
                                @endif
                            </div>
                        </div>
                        <div class="side-card-body">
                            <div class="side-card-body-title">
                                <p class="">Upload Audio Qlips</p>
                            </div>
                            <div class="drag-area" id="dragWrapper">
                                <img src="{{ URL::asset('img/audio.png') }}" alt="image" class="img-fluid drug-drop-icon">
                                <p>Drag and Drop Here (.mp3) <br/>or</p>
                                <button class="custom-file-upload-btn" id="browsButton">Browse Files</button>
                                <input type="file" name="audio" id="browsInput" hidden accept=".mp3,audio/*"/>
                            </div>
                            @if($errors->has('audio'))
                                <div class="error text-danger" id="error"><p>{{ $errors->first('audio') }}</p></div>
                            @endif
                            <div id="preview mt-3">
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upvote" class="side-card-title">Upvotes</label>
                                        <input type="text" class="form-control" placeholder="1254" id="upvote" name="upvote">
                                        @if($errors->has('upvote'))
                                            <div class="error text-danger" id="error"><p>{{ $errors->first('upvote') }}</p></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Listening" class="side-card-title">Listening</label>
                                        <input type="text" class="form-control" placeholder="1254" id="Listening" name="listening">
                                        @if($errors->has('listening'))
                                            <div class="error text-danger" id="error"><p>{{ $errors->first('listening') }}</p></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="audio-clip-submit-btn">Add</button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
    <script>
    </script>
@endsection
