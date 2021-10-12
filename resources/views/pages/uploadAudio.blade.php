@extends("layout.dashboardLayout")
@section('site-section')
    <div class="audio-upload-wrapper">
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
                            <select name="" id="" class="form-control mb-4">
                                <option value="" selected>What did you do as a woman in tech that...</option>
                            </select>
                        </div>
                        <div class="topic-input-wrapper mb-4">
                            <label for="">Advisor</label>
                            <select name="" id="" class="form-control">
                                <option value="" selected>Royal Reza</option>
                            </select>
                        </div>
                    </div>
                    <div class="side-card-body">
                        <div class="side-card-body-title">
                            <p class="">Upload Audio Qlips</p>
                        </div>
                        <div class="drag-area" id="dragWrapper">
                            <img src="{{ URL::asset('img/audio.png') }}" alt="image" class="img-fluid drug-drop-icon">
                            <p>Drag and Drop Here (.mp3) <br />or</p>
                            <button class="custom-file-upload-btn" id="browsButton">Browse Files</button>
                            <input type="file" name="audio" id="browsInput" hidden accept=".mp3,audio/*" />
                        </div>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upvote" class="side-card-title">Upvotes</label>
                                    <input type="text" class="form-control" placeholder="1254" id="upvote">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Listening" class="side-card-title">Listening</label>
                                    <input type="text" class="form-control" placeholder="1254" id="Listening">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="audio-clip-submit-btn">Add</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
    </script>
@endsection
