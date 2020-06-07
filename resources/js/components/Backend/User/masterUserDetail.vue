<template>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img :src="getUserImage(user.display_image)"
                    class="img-circle elevation-2"
                    alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{user.name}}</a>
        </div>
    </div>
</template>

<script>
    import {userEvent} from '../../../app.js'

    export default {
        props: ['auth_user'],
        data() {
            return {
                user: this.auth_user
            }
        },
        methods:{
            getUserImage(image){
                if(image == null || image == undefined){
                    let photo = 'images/user.png';
                    return photo;
                }else{
                    let photo = 'Backend/ProfileImages/' + image;
                    return photo;
                }
            }
        },

        created(){
            userEvent.$on('userUpdated',(data)=>{
                this.user = data
            });
        }
    }
</script>

<style scoped>

</style>