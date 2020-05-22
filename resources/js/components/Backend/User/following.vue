<template>
    <div class="container">
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                <li class="nav-item">
                    <router-link tag="a" :to="{name: 'Followers'}" class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill"
                       href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home"
                       aria-selected="false">Followers</router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" :to="{name: 'Following'}" class="nav-link"
                                 id="custom-content-above-profile-tab" data-toggle="pill"
                                 href="#custom-content-above-profile" role="tab"
                                 aria-controls="custom-content-above-profile"
                                 aria-selected="false">Following
                    </router-link>
                </li>

            </ul>
            <div class="tab-content" id="custom-content-above-tabContent">
                <div class="tab-pane fade active show" id="custom-content-above-home" role="tabpanel"
                     aria-labelledby="custom-content-above-home-tab">
                    <!-- Default box -->
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            Digital Strategist
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX /
                                                        Graphic
                                                        Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Address: Demo
                                                            Street
                                                            123, Demo City 04312, NJ
                                                        </li>
                                                        <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span>
                                                            Phone #: + 800 - 12 12 23 52
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="" alt="" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-sm bg-teal">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-user"></i> View Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>

                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel"
                     aria-labelledby="custom-content-above-profile-tab">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            Digital Strategist
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX /
                                                        Graphic
                                                        Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Address: Demo
                                                            Street
                                                            123, Demo City 04312, NJ
                                                        </li>
                                                        <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span>
                                                            Phone #: + 800 - 12 12 23 52
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="" alt="" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-sm bg-teal">
                                                    <i class="fas fa-comments"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-user"></i> View Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>

                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

            </div>
        </div>
        <section class="content">


            <!-- /.card -->

        </section>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
