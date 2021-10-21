@extends("layout.dashboardLayout")
@section('site-section')
    <div class="page-title">
        <h2>All Advisor </h2>
        @if (\Session::has('success'))
            <div class="card mb-3" id="success">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h5 class="text-success"> {!! \Session::get('success') !!}</h5>
                    </div>
                </div>
            </div>
        @endif
        @if($errors->has('error'))
            <div class="card mb-3" id="success">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h5 class="text-danger"> {{$errors->first('error')}}</h5>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row pb-5">
        <div class="col-md-8 col-lg-8">
            <div class="page-content">
                <div class="page-content-table">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <p>Advisor</p>
                            </div>
                            <div class="col-md-3 text-left">
                                <p>Profession</p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p>Status</p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p>Action</p>
                            </div>
                        </div>
                    </div>
                    @if(isset($data))
                        @foreach($data as $item)
                            <div class="single-table-row border-bottom py-3 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4  advisor-wrapper">
                                        <div class="advisor-image d-flex align-items-center"><img
                                                src="{{asset('storage/'.$item->image)}}" alt="image">
                                            <div class="advisor-name ml-3">
                                                <p>{{$item->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="single-table-row-item-name trancate">{{$item->profession}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div
                                            class="status-btn m-auto {{$item->status->name == 'Active'?'status-btn':'status-hide'}}">{{$item->status->name}}</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                            <div class="tool-tip-wrapper">
                                                <div class="tooltip-content-wrapper">
                                                    <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                                    <div class="tooltip-item">
                                                        <form action="{{asset(route('advisor.status.update',['id'=>$item->id,'status'=>'Active']))}}" method="post">
                                                            @csrf
                                                            @method('post')
                                                            <input type="submit" value="Active" class="w-100">
                                                        </form>
                                                    </div>
                                                    <div class="tooltip-item">
                                                        <form action="{{asset(route('advisor.status.update',['id'=>$item->id,'status'=>'Hide']))}}" method="post">
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
                {{$data->links()}}
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <form action="{{asset(route('store.advisor'))}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="sidecard-content-wrapper">
                    <div class="side-card">
                        <div class="side-card-header">
                            <div class="btn-wrapper d-flex justify-content-between align-items-center">
                                <div class="side-card-title">Add new topic</div>
                                <button class="card-add-btn" type="submit">Add</button>
                            </div>
                            <input type="text" class="form-control py-3 my-4" placeholder="Enter Advisor name"
                                   name="name">
                            @if($errors->has('name'))
                                <div class="error text-danger" id="error"><p>{{ $errors->first('name') }}</p></div>
                            @endif
                        </div>
                        <div class="topic-input-wrapper">
                            <label for="">Add Profession</label>
                            <input type="text" class="form-control py-3 mb-4" placeholder="Enter Profession"
                                   name="profession">
                            @if($errors->has('profession'))
                                <div class="error text-danger" id="error"><p>{{ $errors->first('profession') }}</p></div>
                            @endif
                        </div>
                    </div>
                    <div class="side-card-body">
                        <div class="side-card-body-title">
                            <p class="">Upload Profile Image</p>
                        </div>
                        <div class="drag-area" id="dragWrapper">
                            <img src="{{ URL::asset('img/image.png') }}" alt="image" class="img-fluid drug-drop-icon">
                            <p>Drag and Drop Here (100 X 100px) <br/>or</p>
                            <button class="custom-file-upload-btn" id="browsButton">Browse Files</button>
                            <input type="file" name="image" id="browsInput" hidden accept="image/*"/>
                        </div>
                        @if($errors->has('image'))
                            <div class="error text-danger" id="error"><p>{{ $errors->first('image') }}</p></div>
                        @endif
                    </div>
                    <div id="preview mt-3">
                        <img src="" alt="" id="output" class="w-100"/>
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
