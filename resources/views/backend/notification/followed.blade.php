<a href="#" class="dropdown-item">
    {{--<i class="fas fa-user-plus mr-2"></i>--}}

    <div class="widget-user-image" style="top: 21px;"><img
                src="{{asset('Backend/ProfileImages/'.$notifications->data['follower']['display_image'])}}" alt="User Avatar"
                class="img-circle elevation-2"
                style="width: 40px; height: auto;">
        <strong>{{$notifications->data['follower']['name']}}</strong> started
        following you
    </div>

</a>