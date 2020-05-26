<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newRole">Add New <i
                                    class="fas fa-registered fa-fw"></i></button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Access</th>
                                <th>Created Date</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="role in roles" :key="role.id">
                                <td>{{role.id}}</td>
                                <td>{{role.role | capitilize}}</td>
                                <td>{{role.access | capitilize}}</td>
                                <td>{{role.created_at |cleanTime}}</td>
                                <td>
                                    <a href="#" @click="editRole(role)">
                                        <i class="fa fa-edit green"></i>
                                    </a> / <a href="#" @click="deleteRole(role.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- Modal -->
                <form @submit.prevent="editMode ? updateRole() : createRole()">
                    <!--<form action="">-->
                    <div class="modal fade" id="RolesModel" tabindex="-1" role="dialog"
                         aria-labelledby="RolesModelLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RolesModelLabel">Fill the form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <input v-model="form.role" type="text" name="role"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                                        <has-error :form="form" field="role"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Access
                                            <small>(Short description here)</small>
                                        </label>
                                        <textarea v-model="form.access" name="access"
                                                  class="form-control"
                                                  :class="{ 'is-invalid': form.errors.has('access') }"></textarea>
                                        <has-error :form="form" field="access"></has-error>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button v-if="!editMode" type="Submit" class="btn btn-primary">Create Role</button>
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
                    role: '',
                    access: '',
                }),
                roles: {},
                editMode: false
            }
        },
        methods: {
            updateRole() {
                this.form.put('api/roles/' + this.form.id).then(() => {
                    Fire.$emit('roleEvent');
                    $('#RolesModel').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Role',
                        text: 'Updated successfully!',
                    });


                    this.$Progress.finish();
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                });
            },
            newRole() {
                this.editMode = false;
                this.form.reset();
                $('#RolesModel').modal('show');
            },
            editRole(role) {
                this.editMode = true;
                this.form.clear();
                $('#RolesModel').modal('show');
                this.form.fill(role);
            },
            deleteRole(id) {
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
                        this.form.delete('api/roles/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('roleEvent');
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
            createRole() {
                this.$Progress.start();
                this.form.post('api/roles').then(() => {
                    Fire.$emit('roleEvent');
                    $('#RolesModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Role Created successfully'
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail()
                });


            },
            loadRolesData() {
                axios.get('api/roles').then(({data}) => (this.roles = data));
            }
        },
        created() {
            this.loadRolesData();
            Fire.$on('roleEvent', () => {
                this.loadRolesData();
            });
        }
    }
</script>
