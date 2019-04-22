    @extends('layouts.app')

    @section('content')
    <dl mt-5>
        <div class="p-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <dt>
                            <h3><strong>About us</strong></h3>
                        </dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec nunc tincidunt, facilisis
                            neque sit amet, pharetra justo. Vestibulum hendrerit dolor ex, vel aliquet nibh placerat
                            convallis. Mauris justo metus, aliquam ut placerat eget, vestibulum vitae sem. Nunc
                            elementum
                            facilisis odio, eget laoreet dui aliquam quis. Mauris non pulvinar eros. In vestibulum justo
                            ac
                            odio aliquam, at porta mi condimentum. In eu nisi ultricies, condimentum turpis sit amet,
                            tincidunt nulla. Nunc pellentesque diam nisi, eu consectetur leo placerat id.</dd>
                    </div>
                    <div class="col-lg-6 p-5 text-center d-none d-lg-block">
                        <img id="logo-card" src="../assets/logo-card.svg">
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-wrapper p-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 p-5 text-center d-none d-lg-block">
                        <img id="logo-card" src="../assets/faq-card.png">
                    </div>
                    <div class="col-12 col-lg-6">
                        <dt>
                            <h3><strong>FAQs</strong></h3>
                        </dt>
                        <dd class="faq">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a class="font-weight-bold pl-0 text-decoration-none" data-toggle="collapse"
                                        href="#ans1" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Suspendisse non mi quis elit rutrum vehicula convallis vel lorem?
                                    </a>
                                    <div class="collapse" id="ans1">
                                        <p>
                                            Maecenas elementum massa sed nunc consectetur gravida.
                                        </p>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <a class="font-weight-bold pl-0 text-decoration-none" data-toggle="collapse"
                                        href="#ans2" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Suspendisse non mi quis elit rutrum vehicula convallis vel lorem?
                                    </a>
                                    <div class="collapse" id="ans2">
                                        <p>
                                            Maecenas elementum massa sed nunc consectetur gravida.
                                        </p>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <a class="font-weight-bold pl-0 text-decoration-none" data-toggle="collapse"
                                        href="#ans3" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Suspendisse non mi quis elit rutrum vehicula convallis vel lorem?
                                    </a>
                                    <div class="collapse" id="ans3">
                                        <p>
                                            Maecenas elementum massa sed nunc consectetur gravida.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <dt class="mb-4">
                            <h3><strong>Contacts</strong></h3>
                        </dt>
                        <dd class="row">
                            <div class="col-md-4 col-12 mb-3 mb-md-0">
                                <span class="contact-title">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <strong>Address</strong>
                                </span>
                                <p class="mt-2">R. Dr. Roberto Frias s/n<br>4400 Paranhos<br>
                                    Porto, Portugal<br></p>
                            </div>
                            <div class="col-md-4 col-12 mb-3 mb-md-0">
                                <span class="contact-title">
                                    <i class="fa fa-envelope mr-2"></i>
                                    <strong>E-mail</strong>
                                </span>
                                <p class="mt-2">support@sound.hub </p>
                            </div>
                            <div class="col-md-4 col-12">
                                <span class="contact-title">
                                    <i class="fa fa-phone mr-2"></i>
                                    <strong>Phone</strong>
                                </span>
                                <p class="mt-2">(+351) 707 221 122</p>
                            </div>
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </dl>
    @endsection