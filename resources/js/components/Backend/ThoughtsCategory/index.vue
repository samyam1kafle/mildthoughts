<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Thoughts Category</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="addCategoryModel">Add New <i
                                    class="fab fa-cuttlefish fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category name</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cat in categories">
                                <td>{{cat.id}}</td>
                                <td>{{cat.category_name}}</td>
                                <td v-if="cat.description.length < 50">{{cat.description}}</td>
                                <td v-else>{{cat.description.substring(0,50)+".."}}</td>
                                <td>{{cat.created_at | cleanTime}}</td>
                                <td><a @click="editCategoryModel(cat)"><i class="fa fa-edit green"></i></a> / <a
                                        @click="deleteCategory(cat.id)"><i
                                        class="fa fa-trash red"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form @submit.prevent="editMode ? editCategory() : addCategory()">
                    <div id="categoryModel" tabindex="-1" role="dialog" aria-labelledby="categoryModelLabel"
                         aria-hidden="true" class="modal fade">
                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"><h5 id="categoryModelLabel" class="modal-title">Fill
                                    the Details</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close"
                                            class="close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category Title</label>
                                        <input v-model="form.category_name" type="text" name="category_name"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('category_name') }">
                                        <has-error :form="form" field="category_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Description
                                            <small>(Short description here)</small>
                                        </label>
                                        <textarea v-model="form.description" type="text" rows="4" cols="auto"
                                                  name="description"
                                                  class="form-control"
                                                  :class="{ 'is-invalid': form.errors.has('description') }">
                                        </textarea>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">
                                        Close
                                    </button>
                                    <button v-if="!editMode" type="Submit" class="btn btn-outline-primary">Add
                                        Category
                                    </button>
                                    <button v-else type="Submit" class="btn btn-outline-info">Update Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    'id': '',
                    'category_name': '',
                    'description': ''
                }),
                categories: {},
                editMode: false
            }
        },
        methods: {
            deleteCategory(id){
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
                        this.form.delete('api/category/' + id).then((response) => {
                            const responseMsg = response.data.message;
                            Swal.fire(
                                'Deleted!',
                                responseMsg,
                                'success'
                            );
                            Fire.$emit('categoryEvent');
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong while deleting the category !',
                            });
                            this.$Progress.fail();
                        });

                    }
                })
            },
            editCategory() {
                this.$Progress.start();
                this.form.put('api/category/' + this.form.id).then((response) => {
                    const responseMsg = response.data.message;
                    Fire.$emit('categoryEvent');
                    $('#categoryModel').modal('hide');
                    Toast.fire({
                        icon: 'info',
                        title: responseMsg
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong please try again'
                    });
                    this.$Progress.finish();
                });
            },
            addCategoryModel() {
                this.editMode = false;
                this.form.reset();
                $('#categoryModel').modal('show');
            },
            editCategoryModel(data) {
                this.editMode = true;
                this.form.reset();
                $('#categoryModel').modal('show');
                this.form.fill(data);
            },
            addCategory() {
                this.$Progress.start();
                this.form.post('api/category').then((response) => {
                    Fire.$emit('categoryEvent');
                    $('#categoryModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Thought Category Created successfully'
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went Wrong while adding the Category.'
                    });
                    this.$Progress.fail();

                })
            },
            loadData() {
                this.$Progress.start();
                axios.get('api/category').then((response) => {
                    this.categories = response.data.categories;
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something Went Wrong While Fetching The Data.'
                    });
                    this.$Progress.fail();
                });
            }
        },
        created() {
            this.loadData();
            Fire.$on('categoryEvent', () => {
                this.loadData();
            })
        }
    }
</script>
