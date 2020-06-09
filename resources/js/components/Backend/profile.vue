<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info" style="height: 162px;">
                        <h3 class="widget-user-username">UserName: {{form.name | capitilize}}</h3>
                        <h5 class="widget-user-desc">Role: {{user.roles.role | capitilize}}</h5>
                    </div>
                    <div class="widget-user-image" style="top: 47px;">
                        <img class="img-circle elevation-5" :src="getProfileImage()"
                             alt="User Avatar" style="width: 104px; height:100px">

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{user.thoughts_count}}</h5>
                                    <span class="description-text">Thoughts</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h5 class="description-header">{{user.followers_count}}</h5>
                                    <a type="button" style="cursor: pointer; color: black;" @click="follower">
                                        <span class="description-text">FOLLOWERS</span>
                                    </a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{user.followings_count}}</h5>
                                    <a type="button" @click="following"
                                       style="cursor: pointer; color: black">
                                        <span class="description-text">FOLLOWING</span>
                                    </a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link " href="#activity"
                                                    data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                                    data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane " id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                             src="" alt="user image">
                                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i
                                                class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                           placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                             src="" alt="User Image">
                                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                             src="" alt="User Image">
                                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src=""
                                                         alt="Photo">
                                                    <img class="img-fluid" src=""
                                                         alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src=""
                                                         alt="Photo">
                                                    <img class="img-fluid" src=""
                                                         alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i
                                                class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                           placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">User Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" v-model="form.name" class="form-control"
                                                   id="inputName"
                                                   placeholder="User-name"
                                                   :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" v-model="form.email" class="form-control"
                                                   id="inputEmail"
                                                   placeholder="Email"
                                                   :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Password
                                            <small>(Leave empty if you don't want to update)</small>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="password" v-model="form.password" class="form-control"
                                                   id="inputExperience"
                                                   :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Display Picture</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="updatePhoto"
                                                   class="form-control" id="inputSkills"
                                                   placeholder="Profile"
                                                   :class="{ 'is-invalid': form.errors.has('display_image') }">
                                            <has-error :form="form" field="display_image"></has-error>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputcoverSkills" class="col-sm-2 col-form-label">Cover Picture</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="updateCoverPhoto"
                                                   class="form-control" id="inputcoverSkills"
                                                   placeholder="Cover Picture"
                                                   :class="{ 'is-invalid': form.errors.has('cover_image') }">
                                            <has-error :form="form" field="cover_image"></has-error>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" @click.prevent="updateInfo" class="btn btn-success">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
        <!--Profile Model-->

        <div class="modal fade" id="followmodel" tabindex="-1" role="dialog"
             aria-labelledby="followmodelCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followmodelLongTitle" v-if="followMode == false">followers
                            Details</h5>
                        <h5 class="modal-title" id="followmodelLongTitle" v-else>Following Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Image</th>
                                        <th v-if="this.followMode == false">Followed on</th>
                                        <th v-else>Following From</th>
                                        <th style="width: 40px" v-if="this.followMode == false">Follow Back</th>
                                        <th v-else>Unfollow User</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="followMode == true" v-for="follow in followings" :key="follow.id">
                                        <td>{{follow.name}}</td>
                                        <td><img :src="getUsersImage(follow.display_image)" alt="Image" width="40px">
                                        </td>
                                        <td>
                                            {{follow.created_at | cleanTime}}
                                        </td>
                                        <td><a type="button" @click="unfollowUser(follow.id)"><i
                                                class="fas fa-user-minus red"></i></a></td>
                                    </tr>
                                    <tr v-if="followMode == false" v-for="follower in followers" :key="follower.id">
                                        <td>{{follower.name}}</td>
                                        <td><img :src="getUsersImage(follower.display_image)" alt="Image" width="40px">
                                        </td>
                                        <td>
                                            {{follower.created_at | cleanTime}}
                                        </td>
                                        <td><a type="button" @click="followUser(follower.id)"><i
                                                class="fas fa-user-plus blue"></i></a></td>
                                    </tr>

                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <!--<div class="callout callout-info"-->
                            <!--v-if="((followMode == true) && (followings == emptyObject))">-->
                            <!--<h5>You have not followed anyone feel free to explore more users.</h5>-->
                            <!--</div>-->
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import {userEvent} from '../../app.js'

    export default {
        data() {
            return {
                form: new Form({
                    'id': '',
                    'name': '',
                    'email': '',
                    'display_image': '',
                    'password': '',
                    'role_id': '',
                    'cover_image': '',
                }),
                user: {},
                followers: {},
                followings: {},
                followMode: false
            }
        },
        methods: {
            follower() {
                this.followMode = false; // follower model to be shown
                $('#followmodel').modal('show');
            },
            following() {
                this.followMode = true; // following model to be shown
                $('#followmodel').modal('show');
            },
            followUser(id) {
                axios.put('api/follow/' + id).then((response) => {
                    this.$Progress.start();
                    $("#followmodel").modal('show').trigger("change");
                    Fire.$emit('ProfileEvent');
                    Swal.fire({
                        icon: 'success',
                        text: 'Successfully followed the user',
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        text: 'Something went wrong please try again after some time.',
                    });
                    this.$Progress.fail();
                });
            },
            unfollowUser(id) {
                axios.put('api/unfollow/' + id).then(() => {
                    this.$Progress.start();
                    $("#followmodel").modal('show').trigger("change");
                    // $('#').modal('hide');
                    Fire.$emit('ProfileEvent');
                    Swal.fire({
                        icon: 'success',
                        title: 'UnFollowed',
                        text: 'Successfully',
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessful',
                        text: 'There occurred some problem while followed this user',
                    });
                    this.$Progress.fail();
                });
            },
            getUsersImage(image) {
                let photo = 'Backend/ProfileImages/' + image;
                return photo;
            },
            getProfileImage() {
                if (this.form.display_image == null || this.form.display_image == undefined) {
                    let photo = 'images/user.png';
                    return photo;
                } else {
                    let photo = (this.form.display_image.length > 200) ? this.form.display_image : 'Backend/ProfileImages/' + this.form.display_image;
                    return photo;
                }

            },
            updateInfo() {
                this.$Progress.start();
                if (this.form.password == "") {
                    this.form.password = undefined;
                }
                this.form.put('api/profile').then((response) => {
                    let userData = response.data.userdata;
                    Fire.$emit('ProfileEvent');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile Updated Successfully!',
                    });
                    userEvent.$emit('userUpdated', userData);
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },
            updatePhoto(event) {
                let profile = event.target.files[0];
                let reader = new FileReader();
                if (profile['size'] < 2111775) {
                    reader.onloadend = (profile) => {
                        this.form.display_image = reader.result;
                    };
                    reader.readAsDataURL(profile);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File Size cannot exceed 2 MB!',
                    });
                }

            },
            updateCoverPhoto(event) {
                let profile = event.target.files[0];
                let reader = new FileReader();
                if (profile['size'] < 2111775) {
                    reader.onloadend = (profile) => {
                        this.form.cover_image = reader.result;
                    };
                    reader.readAsDataURL(profile);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File Size cannot exceed 2 MB!',
                    });
                }

            },

            loadData() {
                axios.get('api/profile').then(({data}) => {
                    this.form.fill(data);
                    this.user = data;
                    this.followers = this.user.followers;
                    this.followings = this.user.followings;

                });
                this.form.password = '';
            }
        },
        created() {
            this.loadData();
            Fire.$on('ProfileEvent', () => {
                this.loadData();
            });
        }
    }
</script>
