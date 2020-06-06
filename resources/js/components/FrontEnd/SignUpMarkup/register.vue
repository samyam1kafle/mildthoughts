<template>
    <form class="signup-inner--form" @submit.prevent="createUser">
        <div class="row">
            <div class="col-12">
                <input placeholder="Email" v-model="form.email" type="email" name="email"
                       class="single-field" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
            </div>
            <div class="col-12">
                <input v-model="form.name" placeholder="Username" type="text" name="name"
                       class="single-field" :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
            </div>
            <div class="col-md-6">
                <input v-model="form.password" type="password" name="password"
                       class="single-field"
                       :class="{ 'is-invalid': form.errors.has('password') }"
                       placeholder="Password">
                <has-error :form="form" field="password"></has-error>
            </div>
            <div class="col-md-6">
                <input v-model="form.password_confirmation" type="password"
                       name="password_confirmation"
                       class="single-field"
                       :class="{ 'is-invalid': form.errors.has('password') }"
                       placeholder="Confirm Password">
                <has-error :form="form" field="password"></has-error>
            </div>

            <div class="col-12">
                <button class="submit-btn" type="submit">Create My Account</button>
            </div>
        </div>

    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    email: '',
                    name: '',
                    password: '',
                    password_confirmation: ''
                })
            }
        },
        methods: {
            createUser(){
                this.form.post('register').then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Welcome To Our Site. Please login to continue.'
                    });
                }).catch(()=>{
                    Toast.fire({
                        icon: 'info',
                        title: 'There occurred some problem while creating your account.'
                    });
                });
            }
        },
        mounted(){
            this.form.clear();
        }
    }
</script>

<style scoped>

</style>