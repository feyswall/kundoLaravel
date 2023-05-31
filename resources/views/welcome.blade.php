<!DOCTYPE html>
<html lang="en">

<head>
    @include('_partials.web._partials._head')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        @include('_partials.web._partials._header')
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>Pamoja Tulijenge Taifa Letu</h1>
                    <h2>Wasiliana Kwa ubunifu na Urahisi zaiki na Kundo Information Management System</h2>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('assets/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    {{-- <main id="main">
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Kuhusu Mfumo</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-6">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Huduma Zetu</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-location-plus"></i></div>
                            <h4><a href="">Ujazaji wa data za Maeneo</a></h4>
                            <p>jaza data za maeneo mbalimbali nchini kuanzia ngazi ya mkoa, wilaya, halmashauri, tarafa, kata hadi tawi kwa ajili ya kupata taarifa katika
                                mpangilio mzuri.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxs-user-detail"></i></div>
                            <h4><a href="">Usajili wa viongozi katika maeneo</a></h4>
                            <p>Mchakato wa usajili wa viongozi wa kichama na kiserikali katika maeneo husika kwa njia rahisi na mathubuti ili kupata taarifa zao katika mpangilio mzuri.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxs-user-badge"></i></div>
                            <h4><a href="">Usajili wa viongozi katika kamati</a></h4>
                            <p>Kupata taarifa za kamati mbalimbali za kimaendelo zinazopatikana katika maeneo husika, zenye kusimamiwa na viongozi wa kichama na kiserikali.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-envelope"></i></div>
                            <h4><a href="">Utumaji wa ujumbe mfupi wa maneno</a></h4>
                            <p>Njia rahisi ya kutuma taarifa kwa viongozi mbalimbali katika maeneo yao kuhusu harakati mbalimbali za kimaendeleo.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->





    </main> --}}
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        @include('_partials.web._partials._footer')
    </footer><!-- End Footer -->

    @include('_partials.web._partials._preLoader')

    @include('_partials.web._partials._backToTop')

    @include('_partials.web._partials._script')

</body>

</html>
