<template>
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Thoughts</h3>
                <div class="card-tools">
                    <button class="btn btn-outline-success" @click="thoughtAddModel">Add New <i
                            class="fab fa-tumblr fa-fw"></i></button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover" v-if="userThoughts.length > null">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Thought</th>
                        <th>Created Date</th>
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="thought in userThoughts">
                        <td>{{thought.id}}</td>
                        <td>{{thought.title}}</td>
                        <td>{{thought.category.category_name}}</td>
                        <td v-if="thought.thought.length < 50">{{thought.thought}}</td>
                        <td v-else>{{thought.thought.slice(0,50) + ".."}}</td>
                        <td>{{thought.created_at | cleanTime}}</td>
                        <td><a @click="editThoughtModal(thought)"><i class="fa fa-edit green"></i></a> / <a
                                @click="deleteThought(thought.id)"><i
                                class="fa fa-trash red"></i></a></td>
                    </tr>
                    </tbody>
                </table>
                <div class="card-body" v-else>
                    You have no any thoughts posted till now. <br>
                    <strong>Add a new thought to see your writings.</strong>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <form @submit.prevent="editMode ? editThought() : createThought()">
            <!--<form action="">-->
            <div class="modal fade" id="thoughtsModel" tabindex="-1" role="dialog"
                 aria-labelledby="thoughtsModelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="thoughtsModelLabel" v-if="!editMode">Add Your Thought</h5>
                            <h5 class="modal-title" id="thoughtsModelLabel" v-else>Update Your Thought</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Thought Type</label>
                                <select v-model="form.thoughtCategory_id" name="thoughtCategory_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('thoughtCategory_id') }">
                                    <option :value="thought.id" v-for="thought in thoughtCategories"
                                            :key="thought.id">
                                        {{thought.category_name}}
                                    </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Title for the Thought</label>
                                <input v-model="form.title" type="text" name="title"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Thought
                                </label>
                                <textarea v-model="form.thought" name="thought"
                                          class="form-control"
                                          :class="{ 'is-invalid': form.errors.has('thought') }"></textarea>
                                <has-error :form="form" field="thought"></has-error>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload thought image</label>
                                <small>(Optional)</small>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" @change="addPhoto" class="custom-file-input"
                                               id="exampleInputFile"
                                               :class="{ 'is-invalid': form.errors.has('image') }">
                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                            Image</label>
                                        <has-error :form="form" field="image"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button v-if="!editMode" type="Submit" class="btn btn-outline-primary">Publish Thought
                            </button>
                            <button v-else type="Submit" class="btn btn-outline-success">Update Thought</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
    import {userEvent} from '../../../app.js'
    export default {
        data() {
            return {
                form: new Form({
                    id: '',
                    title: '',
                    thought: '',
                    image: '',
                    thoughtCategory_id: ''
                }),
                userThoughts: {},
                thoughtCategories: {},
                editMode: false
            }
        },

        methods: {
            deleteThought(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/thoughts/' + id).then((response) => {
                            const responseMsg = response.data.message;
                            Swal.fire(
                                'Deleted!',
                                responseMsg,
                                'success'
                            );
                            Fire.$emit('thoughtEvent');
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong while deleting the Thought !',
                            });
                            this.$Progress.fail();
                        });

                    }
                })
            },
            editThought() {
                this.$Progress.start();
                this.form.put('api/thoughts/' + this.form.id).then((response) => {
                    let msg = response.data.msg;
                    Fire.$emit('thoughtEvent');
                    $('#thoughtsModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: msg
                    });
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred a problem Updating Your Thought. Please try again.'
                    });
                    this.$Progress.fail();
                });
            },
            editThoughtModal(data) {
                this.editMode = true;
                this.form.reset();
                $('#thoughtsModel').modal('show');
                this.form.fill(data);
            },
            createThought() {
                this.$Progress.start();
                this.form.post('api/thoughts').then((response) => {
                    let msg = response.data.msg;
                    Fire.$emit('thoughtEvent');
                    $('#thoughtsModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: msg
                    });
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred a problem creating the post. Please try again.'
                    });
                    this.$Progress.fail();
                });
            },
            addPhoto(event) {
                let profile = event.target.files[0];
                // console.log(profile);
                let reader = new FileReader();
                if (profile['size'] < 2111775) {
                    reader.onloadend = (profile) => {
                        this.form.image = reader.result;
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
            thoughtAddModel() {
                this.editMode = false;
                this.form.reset();
                $('#thoughtsModel').modal('show');
            },
            loadThoughts() {
                this.$Progress.start();
                axios.get('api/thoughts').then((response) => {
                    this.userThoughts = response.data.userThought;
                    this.thoughtCategories = response.data.thoughtCategories;
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while fetching your data.'
                    });
                    this.$Progress.fail();
                });
            }
        },
        created() {
            this.loadThoughts();
            Fire.$on('thoughtEvent', () => {
                this.loadThoughts();
            })
        }
    }
</script>
