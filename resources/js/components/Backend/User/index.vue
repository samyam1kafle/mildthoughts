<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="createUserModel">Add New <i
                                    class="fas fa-user-plus fa-fw"></i></button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Verified</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.roles.role}}</td>
                                <td>
                                    <p v-if="user.email_verified_at !== null">
                                        <i class="fas fa-check-circle blue"></i>
                                    </p>
                                    <p v-else>
                                        <i class="fas fa-times-circle red"></i>
                                    </p>
                                </td>
                                <td>
                                    <a @click="viewDetail(user)" type="button">
                                        <i class="fas fa-eye purple"></i>
                                    </a> /
                                    <a @click="updateUserModel(user)" type="button">
                                        <i class="fa fa-edit green"></i>
                                    </a> / <a @click="deleteUser(user.id)" type="button">
                                    <i class="fa fa-trash red"></i> </a>

                                </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!--Profile Model-->

                <div class="modal fade" :id="viewid.id" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{viewid.name}} Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">

                                    <!-- Profile Image -->
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 :src="getProfileImage(viewid.display_image)"
                                                 alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">{{viewid.name}}</h3>

                                        <p class="text-muted text-center">{{viewid.email}}<br>
                                            <small v-if="viewid.email_verified_at">(Email Verified)</small>
                                            <small v-else>(Email Not Verified)</small>
                                        </p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Followers</b> <a class="float-right">{{viewid.followers_count}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Following</b> <a class="float-right">{{viewid.followings_count}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Total Post</b> <a class="float-right">12</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Joined</b> <a class="float-right">{{viewid.created_at |
                                                cleanTime}}</a>
                                            </li>
                                        </ul>
                                        <form @submit.prevent="follow ? unfollowUser(viewid.id) : followUser(viewid.id)">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                    v-if="follow == false"><b>Follow</b>
                                            </button>
                                            <button type="submit" class="btn btn-outline-danger btn-block"
                                                    v-else><b>UnFollow</b>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <form @submit.prevent="editMode ? updateUser() : createUser()">
                    <!--<form action="">-->
                    <div class="modal fade" id="UsersModel" tabindex="-1" role="dialog"
                         aria-labelledby="UsersModelLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UsersModelLabel">Fill the form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <div class="form-group" v-if="!editMode">
                                        <label>Email</label>
                                        <input v-model="form.email" type="email" name="email"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                    <div class="form-group" v-if="!editMode">
                                        <label>Password</label>
                                        <input v-model="form.password" type="password" name="password"
                                               class="form-control"

                                               :class="{ 'is-invalid': form.errors.has('password') }"
                                               placeholder="Password">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                    <div class="form-group" v-if="!editMode">
                                        <label>Confirm Password</label>
                                        <input v-model="form.password_confirmation" type="password"
                                               name="password_confirmation"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('password') }"
                                               placeholder="Confirm Password">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Roles</label>
                                        <select v-model="form.role_id" name="role_id" class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('role_id') }">
                                            <option :value="role.id" v-for="role in roles" :key="role.id">
                                                {{role.role}}
                                            </option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload Display Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" @change="addPhoto" class="custom-file-input"
                                                       id="exampleInputFile"
                                                       :class="{ 'is-invalid': form.errors.has('display_image') }">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    Image</label>
                                                <has-error :form="form" field="display_image"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button v-if="!editMode" type="Submit" class="btn btn-primary">Add User</button>
                                    <button v-else type="Submit" class="btn btn-primary">Update Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->


    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    role_id: '',
                    display_image: '',
                    password_confirmation: ''
                }),
                users: {},
                roles: {},
                viewid: '',
                follow: false,
                editMode: false
            }
        },
        methods: {
            followUser(id) {
                axios.put('api/follow/' + id).then(() => {
                    this.$Progress.start();
                    $('#' + id).modal('hide');
                    Fire.$emit('userEvent');
                    Swal.fire({
                        icon: 'success',
                        title: 'Followed',
                        text: 'Successfully followed the user',
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
            unfollowUser(id) {
                axios.put('api/unfollow/' + id).then(() => {
                    this.$Progress.start();
                    $('#' + id).modal('hide');
                    Fire.$emit('userEvent');
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
            getProfileImage(image) {
                let photo = 'Backend/ProfileImages/' + image;
                return photo;
            },
            viewDetail(user) {
                this.$Progress.start();
                this.viewid = user;
                const Usermodel = this.viewid.id;
                axios.get('api/followed/' + Usermodel).then((response) => {
                    if (response.data.following == false) {
                        this.follow = false;
                    } else {
                        this.follow = true;
                    }
                    $('#' + Usermodel).modal('show');
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessful',
                        text: 'There occurred some problem while followed this user',
                    });
                    this.$Progress.fail();
                });

            },
            deleteUser(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/users/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('userEvent');
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                            this.$Progress.fail();
                        });

                    }
                })
            },
            updateUserModel(data) {
                this.editMode = true;
                this.form.clear();
                this.form.reset();
                $('#UsersModel').modal('show');
                this.form.fill(data);
            },
            updateUser() {
                this.$Progress.start();
                this.form.put('api/users/' + this.form.id).then(() => {
                    Fire.$emit('userEvent');
                    $('#UsersModel').modal('hide');
                    Swal.fire({
                        icon: 'info',
                        title: 'User Info',
                        text: 'Updated successfully!',
                    });

                    this.$Progress.finish();
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                    this.$Progress.fail();
                });
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/users').then((response) => {
                    $('#UsersModel').modal('hide');
                    Fire.$emit('userEvent');
                    Swal.fire({
                        icon: 'success',
                        title: 'Successful',
                        text: 'User Added Successfully.',
                    });
                    this.$Progress.finish();
                }).catch(() => {

                    this.$Progress.fail();
                });
            },
            addPhoto(event) {
                let profile = event.target.files[0];
                // console.log(profile);
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
            loadUserData() {
                axios.get('api/users').then((response) => {
                    this.users = response.data.users;
                    this.roles = response.data.roles;
                }).catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There Occurred Some Error While Fetching The Data.',
                    });
                });
            },
            createUserModel() {
                this.editMode = false;
                this.form.clear();
                this.form.reset();
                $('#UsersModel').modal('show');
            }
        },
        created() {
            this.loadUserData();
            Fire.$on('userEvent', () => {
                this.loadUserData();
            })
        }
    }
</script>
