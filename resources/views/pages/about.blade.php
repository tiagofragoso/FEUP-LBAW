    @extends('layouts.app')

    @section('title', 'About')
    @section('container', 'about-page')

    @section('content')
        <dl mt-5>
            <div class="p-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <dt>
                                <h3><strong>About us</strong></h3>
                            </dt>
                            <dd><strong>sound.hub</strong> is a music event management platform that aims to encourage users to 
                                collaboratively organise their events. By providing an easy way for hosts to interact with 
                                artists and participants, we aim to simplify the planning phase of the event. We also provide
                                a social network feel which keeps users engaged and looking forward to <strong>YOUR</strong> event.</dd>
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
                                            Are there any region restrictions?
                                        </a>
                                        <div class="collapse" id="ans1">
                                            <p>
                                                No, <strong>sound.hub</strong> is available worldwide.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="font-weight-bold pl-0 text-decoration-none" data-toggle="collapse"
                                            href="#ans2" role="button" aria-expanded="false"
                                            aria-controls="collapseExample">
                                            Can I create events without monetizing them?
                                        </a>
                                        <div class="collapse" id="ans2">
                                            <p>
                                                Of course! You choose how to run your event, <strong>sound.hub</strong> is only here to help.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="font-weight-bold pl-0 text-decoration-none" data-toggle="collapse"
                                            href="#ans3" role="button" aria-expanded="false"
                                            aria-controls="collapseExample">
                                            Is there a fee to host an event through the platform?
                                        </a>
                                        <div class="collapse" id="ans3">
                                            <p>
                                                No! <strong>sound.hub</strong> is available for every event for free.
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