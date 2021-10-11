@extends("layout.dashboardLayout")
@section("site-section")
    <div class="page-title">
        <h2>All Topics</h2>
    </div>
    <div class="row pb-5">
        <div class="col-md-8 col-lg-8">
            <div class="page-content">
                <div class="page-content-table">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><p>Icon</p></div>
                            <div class="col-md-5"><p>Topic</p> </div>
                            <div class="col-md-3"><p>Status</p></div>
                            <div class="col-md-2"><p>Action</p></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-2"><img src="{{ URL::asset("img/design.svg") }}" alt="" class="table-content-icon"></div>
                            <div class="col-md-5"><p class="single-table-row-item-name">Design</p> </div>
                            <div class="col-md-3"><div class="status-btn">Active</div></div>
                            <div class="col-md-2 text-center"><div class="three-dot"><img src="{{ URL::asset("img/dot.png") }}" alt=""></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="sidecard-content-wrapper">
                <div class="side-card">
                    <div class="side-card-header">
                        <div class="btn-wrapper d-flex justify-content-between align-items-center">
                            <div class="side-card-title">Add new topic</div>
                            <button class="card-add-btn">Add</button>
                        </div>
                        <input type="text" class="form-control py-3 my-4" placeholder="Enter topic name">
                    </div>
                </div>
                <div class="side-card-body">
                    <div class="side-card-body-title">
                        <p class="">Upload Icon</p>
                    </div>
                    <div class="drag-area" id="dragWrapper">
                        <img src="{{ URL::asset("img/image.png") }}" alt="image" class="img-fluid drug-drop-icon">
                        <p>Drag and Drop Here (100 X 100px) <br />or</p>
                        <button class="custom-file-upload-btn" id="browsButton">Browse Files</button>
                        <input type="file" name="image" id="browsInput" hidden accept="image/*" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection