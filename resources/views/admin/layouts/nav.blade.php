{{-- website --}}


  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-globe"></i>

      <p>
        <i class="fas fa-angle-right left"></i>

        website
      </p>

    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link">

            <i class="far fa-circle nav-icon"></i>
            <p>home</p>

        </a>
      </li>


    </ul>
  </li>





{{-- Customer --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>

      <p>
        <i class="fas fa-angle-right left"></i>

       customers

      </p>

    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/customers/create')}}" class="nav-link">

            <i class="far fa-circle nav-icon"></i>
            <p>create new</p>

        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/customers/')}}" class="nav-link">

            <i class="far fa-circle nav-icon"></i>
            <p>all customers</p>

        </a>
      </li>

    </ul>
  </li>
{{-- Categories --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <i class="fas fa-angle-right left "></i>

      <p>
       Categories
      </p>

    </a>

    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/backend/categories/create')}}" class="nav-link">

          <i class="far fa-circle nav-icon"></i>
          <p>Create Category   </p>

        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/backend/categories')}}" class="nav-link">

          <i class="far fa-circle nav-icon"></i>
          <p>All Categories  </p>

        </a>
      </li>

    </ul>
  </li>



  {{-- Categories --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <p>
        <i class="nav-icon fas fa-box"></i>
        <i class="fas fa-angle-right left"></i>

        Products

      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/backend/products/create')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p> Create Product    </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/backend/products')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>All Products  </p>
        </a>
      </li>

    </ul>
  </li>




{{--  Facebook Pages --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <p>
        <i class="nav-icon fab fa-facebook"></i>
        <i class="fas fa-angle-right left"></i>

        Facebook Pages

      </p>

    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/backend/facebook_pages/create')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>Create Facebook Page   </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/backend/facebook_pages')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>All Facebook Pages  </p>
        </a>
      </li>

    </ul>
  </li>

{{--  Instagram Accounts --}}
@if (Auth::user()->can('isAdmin'))

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <p>
        <i class="nav-icon fab fa-instagram"></i>
        <i class="fas fa-angle-right left"></i>

         Instagram Accounts

      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/backend/instagram_accounts/create')}}" class="nav-link">
            <i class=" fab fa-youtube-squaree nav-icon"></i>

          <p>Create Instagram Account   </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/backend/instagram_accounts')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>All Instagram Account  </p>
        </a>
      </li>

    </ul>
  </li>

@endif




{{--   YouTube Channels --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <p>
        <i class="nav-icon fab fa-youtube"></i>
        <i class="fas fa-angle-right left"></i>

         YouTube Channels

    </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/backend/youtube_channels/create')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>Create YouTube Channel   </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/backend/youtube_channels')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>

          <p>All YouTube Channels  </p>
        </a>
      </li>

    </ul>
  </li>








            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">

              <p>
             <!--  -->
             <i class="nav-icon fas fa-circle text-danger"></i>

                <i class="fas fa-angle-right left"></i>
               {{Auth::user()->name}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">

                 <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

 <form id="logout-form"  action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                    </form>



                </a>
              </li>


            </ul>
          </li>
