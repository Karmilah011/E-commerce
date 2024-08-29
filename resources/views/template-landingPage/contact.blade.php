@extends('template-landingPage.master')
@section('title','Contact')
@section('content')
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Jakarta</h4>
                            <p>101 E Parker Southcity, Parker, CO 801 <br>+62 8982-314-0958</p>
                        </li>
                        <li>
                            <h4>Bandung</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br>+62 8345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Message"></textarea>
                                <button type="submit" class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection