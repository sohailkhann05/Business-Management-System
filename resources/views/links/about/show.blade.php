@extends('layouts.template')
@section('title','About')
@section('body_content')

    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('shop.show',session('shop')->id) }}">home</a></li>
                            <li>/</li>
                            <li>about us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="overview_img">
                        <a href="about.html#"><img src="{{ asset('uploads/about/about-image.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about_content">
                        <h3>THE STANDARD LOREM IPSUM PASSAGE</h3>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                        <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu nisi ac mi malesuada vestibulum. Phasellus tempor nunc eleifend cursus molestie. Mauris lectus arcu, pellentesque at sodales sit amet, condimentum id nunc. Donec ornare mattis suscipit. Praesent fermentum accumsan vulputate. Sed velit nulla, sagittis non erat id, dictum vestibulum ligula. Maecenas sed enim sem. Etiam scelerisque gravida purus nec interdum. Phasellus venenatis ligula in faucibus consequat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="skill-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="skill_list progressbar_area">
                        <h2>OUR SKILLS</h2>
                        <div class="progress_skill">
                            <div class="progress">
                                <div class="progress-bar one about_prog wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".3s" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                    <span class="progress_persent">HTML/CSS</span>
                                </div>
                            </div>
                            <span class="progress_discount">60%</span>
                        </div>
                        <div class="progress_skill">
                            <div class="progress">
                                <div class="progress-bar two about_prog wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">

                                    <span class="progress_persent">WORDPRESS THEME </span>
                                </div>

                            </div>
                            <span class="progress_discount">90%</span>
                        </div>
                        <div class="progress_skill">
                            <div class="progress">
                                <div class="progress-bar three about_prog wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">

                                    <span class="progress_persent">Typhography </span>
                                </div>

                            </div>
                            <span class="progress_discount">70%</span>
                        </div>
                        <div class="progress_skill">
                            <div class="progress">
                                <div class="progress-bar four about_prog wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">

                                    <span class="progress_persent">Branding  </span>
                                </div>

                            </div>
                            <span class="progress_discount">80%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="skill_list our_experince">
                        <h2>OUR EXPERIENCES</h2>
                        <p><strong> FUSCE FRINGILLA PORTTITOR IACULI SED QUAM LIBERO, ADIPISCING SED ERAT ID</strong></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu nisi ac mi malesuada vestibulum.</p>
                        <p>Donec ornare mattis suscipit. Praesent fermentum accumsan vulputate. Sed velit nulla, sagittis non erat id, dictum vestibulum ligula. Maecenas sed enim sem.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="skill_list our_works">
                        <h2>OUR WORKS</h2>
                        <div class="works_list">
                            <div class="list_number">
                                <span>1</span>
                            </div>
                            <div class="works_desc">
                                <h3>LOREM IPSUM DOLOR SIT AMET </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                            </div>
                        </div>
                        <div class="works_list">
                            <div class="list_number">
                                <span>1</span>
                            </div>
                            <div class="works_desc">
                                <h3>DONEC FERMENTUM EROS  </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                            </div>
                        </div>
                        <div class="works_list">
                            <div class="list_number">
                                <span>1</span>
                            </div>
                            <div class="works_desc">
                                <h3>PRAESENT ANTE </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner_section banner_column1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner">
                        <a href="index-5.html#"><img src="{{ asset('uploads/bg/banner7.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection