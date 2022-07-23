 <div class="left side-menu">

     <div class="sidebar-inner slimscrollleft">
         <div class="user-details">

             <div class="user-info">
                 <div class="dropdown">
                     <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name}}</a>

                 </div>

                 <p class="text-muted m-0">
                     {{ Auth::user()->name }}
                 </p>
             </div>
         </div>
         <div id="sidebar-menu" class="">

             <ul>

                 <!-- <li class="menu-title">Main</li> -->






                 <li>

                     <a href="{{route('blogs.index')}}" class="waves-effect active"><i class="ti-home"></i><span>Blogs<span class="badge badge-primary float-right"></span></span></a>

                 </li>






             </ul>

         </div>

         <div class="clearfix"></div>

     </div>

     <!-- end sidebarinner -->

 </div>