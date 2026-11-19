<div>
    <div class="row m-4">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4">
                <div class="">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                {{--
                                                <script src="https://cdn.lordicon.com/lordicon.js"></script> --}}
                                                <lord-icon src="https://cdn.lordicon.com/pcllgpqm.json" trigger="loop"
                                                    delay="2000" style="width:450px;height:450px">
                                                </lord-icon>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">{{ $formacao->nome }} - Gerenciamento</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>
                                                    {{ $formacao->nome }}</div>
                                                <div class="vr"></div>
                                                <div>Usuário: <span
                                                        class="fw-medium">{{ Auth::user()->getPessoa->nome }}</span>
                                                </div>
                                                <div class="vr"></div>
                                                <div>Tipo : <span
                                                        class="fw-medium">{{ $formacao->getTipoformacao->descricao }}</span>
                                                </div>
                                                <div class="vr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <button type="button" class="btn py-0 fs-16 favourite-btn active">
                                        <i class="ri-star-fill"></i>
                                    </button>
                                    <button type="button" class="btn py-0 fs-16 text-body">
                                        <i class="ri-share-line"></i>
                                    </button>
                                    <button type="button" class="btn py-0 fs-16 text-body">
                                        <i class="ri-flag-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item" wire:ignore>
                                <a class="nav-link text-body active fw-semibold" wire:ignore data-bs-toggle="tab"
                                    href="#project-overview" role="tab">
                                    Visão Geral
                                </a>
                            </li>
                            <li class="nav-item" wire:ignore>
                                <a class="nav-link text-body fw-semibold" wire:ignore data-bs-toggle="tab"
                                    href="#turmas" role="tab">
                                    Turmas
                                </a>
                            </li>
                            <li class="nav-item" wire:ignore>
                                <a class="nav-link text-body fw-semibold" wire:ignore data-bs-toggle="tab"
                                    href="#professores" role="tab">
                                    Professores
                                </a>
                            </li>
                            <li class="nav-item" wire:ignore>
                                <a class="nav-link text-body fw-semibold" wire:ignore data-bs-toggle="tab"
                                    href="#inscricoes" role="tab">
                                    Inscrições
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row m-4">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" wire:ignore id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-bold text-uppercase">Sobre a formação</h6>
                                        <p>{{ $formacao->descricao }}</p>

                                        {{-- <ul class="ps-4 vstack gap-2">
                                            <li>Product Design, Figma (Software), Prototype</li>
                                            <li>Four Dashboards : Ecommerce, Analytics, Project,etc.
                                            </li>
                                            <li>Create calendar, chat and email app pages.</li>
                                            <li>Add authentication pages.</li>
                                            <li>Content listing.</li>
                                        </ul> --}}

                                        {{-- <div>
                                            <button type="button" class="btn btn-link link-success p-0">Read
                                                more</button>
                                        </div> --}}

                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <div class="row">

                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium fs-13">
                                                            Data de início :</p>
                                                        <h5 class="fs-15 mb-0">{{ $formacao->data_inicio }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium fs-13">
                                                            Data de término :</p>
                                                        <h5 class="fs-15 mb-0">{{ $formacao->data_fim }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium fs-13">
                                                            Tipo de formação :</p>
                                                        <div class="badge bg-info fs-12">
                                                            {{ $formacao->getTipoformacao->descricao }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium fs-13">
                                                            Valor da formação :</p>
                                                        <div class="badge bg-warning fs-12">{{ $formacao->valor_custo }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <h6 class="mb-3 fw-bold text-uppercase">Anexos</h6>
                                            <div class="row g-3">
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="border rounded border-dashed p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-secondary rounded fs-24">
                                                                        <i class="ri-folder-zip-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="fs-15 mb-1"><a href="#"
                                                                        class="text-body text-truncate d-block">Programa
                                                                        da formação</a></h5>
                                                                <div>2.2MB</div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="d-flex gap-1">
                                                                    <button type="button"
                                                                        class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                            class="ri-download-2-line"></i></button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-more-fill"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Rename</a></li>
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="border rounded border-dashed p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-secondary rounded fs-24">
                                                                        <i class="ri-file-ppt-2-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="fs-15 mb-1"><a href="#"
                                                                        class="text-body text-truncate d-block">Calendário
                                                                        da formação</a></h5>
                                                                <div>2.4MB</div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="d-flex gap-1">
                                                                    <button type="button"
                                                                        class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                            class="ri-download-2-line"></i></button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-more-fill"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Rename</a></li>
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            {{-- <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Comments</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted">Recent<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Recent</a>
                                                <a class="dropdown-item" href="#">Top Rated</a>
                                                <a class="dropdown-item" href="#">Previous</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <div data-simplebar="init" style="height: 300px;" class="px-3 mx-n3 mb-2">
                                        <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                        aria-label="scrollable content"
                                                        style="height: 100%; overflow: hidden scroll;">
                                                        <div class="simplebar-content" style="padding: 0px 16px;">
                                                            <div class="d-flex mb-4">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-8.jpg" alt=""
                                                                        class="avatar-xs rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-14">Joseph Parker <small
                                                                            class="text-muted ms-2">20 Dec 2021 -
                                                                            05:47AM</small></h5>
                                                                    <p class="text-muted">I am getting message from
                                                                        customers that when they place order always get
                                                                        error message .</p>
                                                                    <a href="javascript: void(0);"
                                                                        class="badge text-muted bg-light"><i
                                                                            class="mdi mdi-reply"></i> Reply</a>
                                                                    <div class="d-flex mt-4">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="assets/images/users/avatar-10.jpg"
                                                                                alt="" class="avatar-xs rounded-circle">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="fs-14">Alexis Clarke <small
                                                                                    class="text-muted ms-2">22 Dec 2021
                                                                                    -
                                                                                    02:32PM</small></h5>
                                                                            <p class="text-muted">Please be sure to
                                                                                check
                                                                                your Spam mailbox to see if your email
                                                                                filters have identified the email from
                                                                                Dell
                                                                                as spam.</p>
                                                                            <a href="javascript: void(0);"
                                                                                class="badge text-muted bg-light"><i
                                                                                    class="mdi mdi-reply"></i> Reply</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex mb-4">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-6.jpg" alt=""
                                                                        class="avatar-xs rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-14">Donald Palmer <small
                                                                            class="text-muted ms-2">24 Dec 2021 -
                                                                            05:20PM</small></h5>
                                                                    <p class="text-muted">If you have further questions,
                                                                        please contact Customer Support from the “Action
                                                                        Menu” on your <a href="javascript:void(0);"
                                                                            class="text-decoration-underline">Online
                                                                            Order
                                                                            Support</a>.</p>
                                                                    <a href="javascript: void(0);"
                                                                        class="badge text-muted bg-light"><i
                                                                            class="mdi mdi-reply"></i> Reply</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-10.jpg" alt=""
                                                                        class="avatar-xs rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-14">Alexis Clarke <small
                                                                            class="text-muted ms-2">26 min ago</small>
                                                                    </h5>
                                                                    <p class="text-muted">Your <a
                                                                            href="javascript:void(0)"
                                                                            class="text-decoration-underline">Online
                                                                            Order
                                                                            Support</a> provides you with the most
                                                                        current
                                                                        status of your order. To help manage your order
                                                                        refer to the “Action Menu” to initiate return,
                                                                        contact Customer Support and more.</p>
                                                                    <div class="row g-2 mb-3">
                                                                        <div class="col-lg-1 col-sm-2 col-6">
                                                                            <img src="assets/images/small/img-4.jpg"
                                                                                alt="" class="img-fluid rounded">
                                                                        </div>
                                                                        <div class="col-lg-1 col-sm-2 col-6">
                                                                            <img src="assets/images/small/img-5.jpg"
                                                                                alt="" class="img-fluid rounded">
                                                                        </div>
                                                                    </div>
                                                                    <a href="javascript: void(0);"
                                                                        class="badge text-muted bg-light"><i
                                                                            class="mdi mdi-reply"></i> Reply</a>
                                                                    <div class="d-flex mt-4">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="assets/images/users/avatar-6.jpg"
                                                                                alt="" class="avatar-xs rounded-circle">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="fs-14">Donald Palmer <small
                                                                                    class="text-muted ms-2">8 sec
                                                                                    ago</small></h5>
                                                                            <p class="text-muted">Other shipping methods
                                                                                are
                                                                                available at checkout if you want your
                                                                                purchase delivered faster.</p>
                                                                            <a href="javascript: void(0);"
                                                                                class="badge text-muted bg-light"><i
                                                                                    class="mdi mdi-reply"></i> Reply</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 607px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar"
                                                style="height: 148px; transform: translate3d(0px, 0px, 0px); display: block;">
                                            </div>
                                        </div>
                                    </div>
                                    <form class="mt-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label text-body">Leave a
                                                    Comments</label>
                                                <textarea class="form-control bg-light border-light"
                                                    id="exampleFormControlTextarea1" rows="3"
                                                    placeholder="Enter your comment..."></textarea>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button"
                                                    class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                                        class="ri-attachment-line fs-16"></i></button>
                                                <a href="javascript:void(0);" class="btn btn-success">Post Comments</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div> --}}
                            <!-- end card -->
                        </div>
                        <!-- ene col -->
                        {{-- <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Skills</h5>
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <div class="badge fw-medium badge-soft-secondary">UI/UX</div>
                                        <div class="badge fw-medium badge-soft-secondary">Figma</div>
                                        <div class="badge fw-medium badge-soft-secondary">HTML</div>
                                        <div class="badge fw-medium badge-soft-secondary">CSS</div>
                                        <div class="badge fw-medium badge-soft-secondary">Javascript
                                        </div>
                                        <div class="badge fw-medium badge-soft-secondary">C#</div>
                                        <div class="badge fw-medium badge-soft-secondary">Nodejs</div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Members</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#inviteMembersModal"><i
                                                class="ri-share-line me-1 align-bottom"></i> Invite
                                            Member</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div data-simplebar="init" style="height: 235px;" class="mx-n3 px-3">
                                        <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                        aria-label="scrollable content"
                                                        style="height: 100%; overflow: hidden scroll;">
                                                        <div class="simplebar-content" style="padding: 0px 16px;">
                                                            <div class="vstack gap-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <img src="assets/images/users/avatar-2.jpg"
                                                                            alt="" class="img-fluid rounded-circle">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Nancy
                                                                                Martino</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <div
                                                                            class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                                            HB
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Henry
                                                                                Baird</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <img src="assets/images/users/avatar-3.jpg"
                                                                            alt="" class="img-fluid rounded-circle">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Frank Hook</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <img src="assets/images/users/avatar-4.jpg"
                                                                            alt="" class="img-fluid rounded-circle">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Jennifer
                                                                                Carter</a></h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <div
                                                                            class="avatar-title bg-soft-success text-success rounded-circle">
                                                                            AC
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Alexis
                                                                                Clarke</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                                        <img src="assets/images/users/avatar-7.jpg"
                                                                            alt="" class="img-fluid rounded-circle">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-0"><a href="#"
                                                                                class="text-body d-block">Joseph
                                                                                Parker</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm">Message</button>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end member item -->
                                                            </div>
                                                            <!-- end list -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 284px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar"
                                                style="height: 194px; transform: translate3d(0px, 0px, 0px); display: block;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-info btn-sm"><i
                                                class="ri-upload-2-fill me-1 align-bottom"></i>
                                            Upload</button>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="vstack gap-2">
                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-folder-zip-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-15 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">App-pages.zip</a>
                                                    </h5>
                                                    <div>2.2MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-file-ppt-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-15 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">Velzon-admin.ppt</a>
                                                    </h5>
                                                    <div>2.4MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-folder-zip-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-15 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">Images.zip</a>
                                                    </h5>
                                                    <div>1.2MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-image-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-15 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">bg-pattern.png</a>
                                                    </h5>
                                                    <div>1.1MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 text-center">
                                            <button type="button" class="btn btn-success">View
                                                more</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div> --}}
                        <!-- end col -->
                    </div>
                </div>

                <div class="tab-pane fade" wire:ignore id="turmas" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-3 text-uppercase">Adicionar Turmas</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-6">
                                            <label for="">Descrição</label>
                                            <input type="text" wire:model="desc_turma" class="form-control">
                                        </div>

                                        <div class="col-6">
                                            <label for="">Capacidade</label>
                                            <input type="text" wire:model="capacidade" class="form-control">
                                        </div>

                                        <div class="col-12 mt-4">
                                            <a wire:click="add_turma()" class="btn btn-success">Salvar</a>
                                        </div>
                                    </div>


                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h6 class="card-title mb-0 flex-grow-1">Listagem das turmas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="tableFixHead">
                                        <table class="table table-hover align-middle table-nowrap mb-0 mt-4 text-center"
                                            id="myTable">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col"># / ID</th>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">Formação</th>
                                                    <th scope="col">Capacidade</th>
                                                    <th scope="col">Alunos</th>
                                                    <th scope="col">Data de registo</th>
                                                    <th scope="col sticky-col first-col"></th>
                                                </tr>
                                            </thead>
                                            <tbody style="height:200px;overflow:auto;">
                                                @foreach ($turmas as $item)
                                                    <tr>
                                                        <td scope="col">{{ $loop->index + 1 . '/' . $item->id }}</td>
                                                        <td scope="col">{{ $item->descricao }}</td>
                                                        <td scope="col">{{ $item->getFormacao->nome }}</td>
                                                        <td scope="col">{{ $item->capacidade }}</td>
                                                        <td scope="col">{{ count($item->getAlunos) }}</td>
                                                        <td scope="col">{{ $item->created_at }}</td>
                                                        <td class="">
                                                            <a wire:click="selecionar({{ $item->id }})"
                                                                class="btn btn-primary"><i class="bx bx-edit-alt"></i></a>
                                                            <a wire:click="eliminar({{ $item->id }})"
                                                                class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- ene col -->

                    </div>
                </div>

                <!-- end tab pane -->
                <div class="tab-pane fade" wire:ignore id="professores" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-3 text-uppercase">Escolher professores</h6>
                                </div>
                                <div class="card-body">


                                    <div class="row">
                                        @if ($formacao->tipoformacao_id == 2)
                                            <div class="col-12">
                                                <label for="">Professor</label>
                                                <select name="professor_id" id="professor_id">
                                                    <option value="">Selecione...</option>
                                                    @foreach ($professores as $item)
                                                        <option value="{{ $item->id }}">{{ $item->getPessoa->nome }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        @if ($formacao->tipoformacao_id == 1)
                                            <div class="col-6">
                                                <label for="">Professor</label>
                                                <select class="form-control" name="professor_id" wire:model="professor_id"
                                                    id="professor_id">
                                                    <option value="">Selecione...</option>
                                                    @foreach ($professores as $item)
                                                        <option value="{{ $item->id }}">{{ $item->getPessoa->nome }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="">Disciplina</label>
                                                <select class="form-control" name="disciplina_id" id="disciplina_id"
                                                    wire:model="disciplina_id">
                                                    <option value="">Selecione...</option>
                                                    @foreach ($disciplinas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->descricao }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-6">
                                            <label for="">Turma</label>
                                            <select class="form-control" name="turma_id" id="turma_id"
                                                wire:model="turma_id">
                                                <option value="">Selecione...</option>
                                                @foreach ($turmas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->descricao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <a wire:click="add_professor()" class="btn btn-success">Adicionar
                                                Professor</a>
                                        </div>
                                    </div>


                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- ene col -->
                        <div class="col-xl-5 col-lg-5">

                            <div class="card">
                                <div class="card-body">
                                    <div class="p-4 d-flex flex-column h-100">
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" data-bs-target="#createProjectModal"
                                                data-bs-toggle="modal"> Professores adicionados</button>
                                        </div>

                                        <div class="px-4 mx-n4" data-simplebar="init"
                                            style="height: calc(100vh - 468px);">
                                            <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" tabindex="0"
                                                            role="region" aria-label="scrollable content"
                                                            style="height: 100%; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 0px 24px;">
                                                                <ul class="to-do-menu list-unstyled"
                                                                    id="projectlist-data">
                                                                    <li>
                                                                        <a data-bs-toggle="collapse" href="#velzonAdmin"
                                                                            class="nav-link fs-14 active collapsed"
                                                                            aria-expanded="false">Ver Professores</a>
                                                                        <div class="collapse" id="velzonAdmin" style="">
                                                                            <ul
                                                                                class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                                                @foreach ($professores_adicionados as $item)
                                                                                    <li>
                                                                                        <a href="#!"><i
                                                                                                class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                                                            {{ $item->getProfessor->getPessoa->nome }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    {{-- <li>
                                                                        <a data-bs-toggle="collapse"
                                                                            href="#projectManagement"
                                                                            class="nav-link fs-14 collapsed"
                                                                            aria-expanded="false">Project
                                                                            Management</a>
                                                                        <div class="collapse" id="projectManagement"
                                                                            style="">
                                                                            <ul
                                                                                class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                                                        v2.1.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                                                        v2.2.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                                                        v2.3.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>
                                                                                        v2.4.0</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <a data-bs-toggle="collapse" href="#skoteAdmin"
                                                                            class="nav-link fs-14 collapsed"
                                                                            aria-expanded="false">Skote Admin &amp;
                                                                            Dashboard</a>
                                                                        <div class="collapse" id="skoteAdmin" style="">
                                                                            <ul
                                                                                class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                                                        v4.1.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                                                        v4.2.0</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <a data-bs-toggle="collapse"
                                                                            href="#ecommerceProject"
                                                                            class="nav-link fs-14">Doot - Chat App
                                                                            Template</a>
                                                                        <div class="collapse" id="ecommerceProject">
                                                                            <ul
                                                                                class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                                                        v1.0.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                                                        v1.1.0</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#!"><i
                                                                                            class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                                                        v1.2.0</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li> --}}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 204px;">
                                                </div>
                                            </div>
                                            {{-- <div class="simplebar-track simplebar-horizontal"
                                                style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="width: 0px; display: none;">
                                                </div>
                                            </div> --}}
                                            {{-- <div class="simplebar-track simplebar-vertical"
                                                style="visibility: visible;">
                                                <div class="simplebar-scrollbar"
                                                    style="height: 128px; display: block; transform: translate3d(0px, 0px, 0px);">
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
                <!-- end tab pane -->

                <div class="tab-pane fade" wire:ignore id="inscricoes" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-3 text-uppercase">Lista de Inscrições</h6>

                                    <form action="">

                                    @csrf

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                <select name="turma_id_select" id="turma_id_select"
                                                    class="form-control">
                                                    <option value="0">Selecione a turma</option>
                                                    @foreach ($turmas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->descricao }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                                                <a id="enviar-referencias" class="btn btn-success">Enviar
                                                    Referências</a>
                                                <a id="novas-referencias" class="btn btn-primary">Novas Referências</a>
                                            </div>

                                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                                <a class="">{{ $vet_inscricoes[0] }} Pendentes /</a>
                                                <a class="">{{ $vet_inscricoes[1] }} Aprovados /</a>
                                                <a class="">{{ $vet_inscricoes[2] }} Pagos</a>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="card-body" style="max-height: 500px; overflow: auto;">
                                    <div class="tableFixHead">
                                        <table class="table table-hover align-middle table-nowrap mb-0 text-center"
                                            id="myTable">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Candidato</th>
                                                    <th scope="col">Formação</th>

                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Pagamento</th>
                                                    <th scope="col">Data de inscrição</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($candidaturas as $item)
                                                    <tr>
                                                        <td scope="col">{{ $loop->index + 1 }}</td>
                                                        <td scope="col">{{ $item->codigo }}</td>
                                                        <td scope="col">{{ $item->getPessoa->nome }}</td>
                                                        <td scope="col">
                                                            <span
                                                                class="badge text-bg-primary">{{ $item->getFormacao->nome }}</span>

                                                        </td>


                                                        <td scope="col">{{ $item->estado }}</td>
                                                        <td scope="col">{{ $item->pago }}</td>
                                                        <td scope="col">{{ $item->created_at }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- ene col -->

                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

</div>

@section('script-aux')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script src="{{ asset('assets/system/js/gerenciar-formacoes.js') }}"></script>
@endsection