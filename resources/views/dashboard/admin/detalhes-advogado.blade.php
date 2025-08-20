@section('css-aux')
    <link href="{{ asset('assets/template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/template/src/assets/css/light/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/template/src/assets/css/dark/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                <div class="col-lg-12">
                    <div class="widget-content searchable-container grid">

                        <div class="searchable-items grid">
                          
                            <div class="items">
                                <div class="item-content">
                                    <div class="user-profile">
                                        <div class="n-chk align-self-center text-center">
                                            <div class="form-check form-check-primary me-0 mb-0">
                                                <input class="form-check-input inbox-chkbox contact-chkbox"
                                                    type="checkbox">
                                            </div>
                                        </div>
                                        <img src="{{ asset('assets/template/src/assets/img/profile-5.jpg') }}" alt="avatar">
                                        <div class="user-meta-info">
                                            <p class="user-name" data-name="Alan Green">{{$pessoa->nome}}</p>
                                            <p class="user-work" data-occupation="Web Developer">{{ $advogado->categoria }}</p>
                                        </div>
                                    </div>
                                    <div class="user-email">
                                        <p class="info-title">Email: </p>
                                        <p class="usr-email-addr" data-email="alan@mail.com">{{$pessoa->email}}</p>
                                    </div>
                                    <div class="user-location">
                                        <p class="info-title">Nº Cédula: </p>
                                        <p class="usr-location" data-location="Boston, USA">{{ $advogado->num_cedula_advogado }}</p>
                                    </div>
                                    <div class="user-phone">
                                        <p class="info-title">Phone: </p>
                                        <p class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $pessoa->telefone1 }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/template/src/assets/js/apps/contact.js') }}"></script>
@endsection