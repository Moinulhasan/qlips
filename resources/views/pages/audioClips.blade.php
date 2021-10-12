@extends("layout.dashboardLayout")
@section('site-section')
    <div class="page-title-wrapper d-flex justify-content-between">
        <div class="page-title">
            <h2>All Questions</h2>
        </div>
        <div class="add-button-wrapper">
            <a href="{{ route('uploadAudio') }}"><img src="{{ URL::asset('img/plus.png') }}" alt="img" />Add New
                Qlips</a>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-md-12 col-lg-12">
            <div class="page-content audio-qlips">
                <div class="page-content-table audio-clips">
                    <div class="table-header border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center">
                                <p>ID</p>
                            </div>
                            <div class="col-md-2 text-left">
                                <p>Audio Qlips</p>
                            </div>
                            <div class="col-md-3">
                                <p>Questions</p>
                            </div>
                            <div class="col-md-3">
                                <p>Advisors</p>
                            </div>
                            <div class="col-md-1 text-center">
                                <p>Status</p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p>Actions</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-table-row border-bottom py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center sl-item">
                                <P>01</P>
                            </div>
                            <div class="col-md-2">
                                <p class="single-table-row-item-name trancate">Audio.mp3</p>
                            </div>
                            <div class="col-md-3">
                                <p class="single-table-row-item-name trancate">How have you built and managed an</p>
                            </div>
                            <div class="col-md-3">
                                <div class="advisor-image d-flex align-items-center"><img
                                        src="{{ URL::asset('img/user.png') }}" alt="image">
                                    <div class="advisor-name ml-2">
                                        <p>Sarah Drinkwater</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="status-btn m-auto status-hide">Active</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="three-dot"><img src="{{ URL::asset('img/dot.png') }}" alt="">
                                    <div class="tool-tip-wrapper">
                                        <div class="tooltip-content-wrapper">
                                            <img src="{{ URL::asset('img/polygon.png') }}" alt="">
                                            <div class="tooltip-item">Active</div>
                                            <div class="tooltip-item">Hide</div>
                                            <div class="tooltip-item">Recent</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination-wrapper d-flex justify-content-end align-items-center my-4">
                <ul class="">
                    <li class="pagination-item"><a href="#"><img src="{{ URL::asset('img/leftArrow.png') }}" alt="image"
                                class="pagination-arrow pagination-arrow-disabled"></a></li>
                    <li class="pagination-item"><a class="" href="#">1</a></li>
                    <li class="pagination-item"><a class="" href="#">2</a></li>
                    <li class="pagination-item"><a class="" href="#">3</a></li>
                    <li class="pagination-item"><a class="" href="#">4</a></li>
                    <li class="pagination-item"><a href="#" class="m-0"><img
                                src="{{ URL::asset('img/rightArrow.png') }}" alt="" class="pagination-arrow"></a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
