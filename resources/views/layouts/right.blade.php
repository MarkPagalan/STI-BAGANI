<!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
             
            <!-- #User Info -->
            <div class="card">

                        <div class="header">
                            
                           <h2>
                                You are logged in as
                            </h2>
                             
                            <div class="media">
                                <div class="media-left">
                                    <a href="javascript:void(0);">
                                        <img class="media-object" src="{{ asset('images/user.png') }}" width="60" height="60" alt="User">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="javascript:void(0);" class="name"> {{ Auth::user()->email }} </a></h4> <i class="material-icons">face</i> Active
                                </div>        
                            </div>
                            </div>
                            <div class="list-group">
                                <!--
                                <button type="button" class="btn btn-lg list-group-item   waves-effect">
                                    <i class="material-icons">person</i>
                                        <a href="javascript:void(0);">
                                            <span>Profile</span>
                                        </a>    
                                </button>
                                <button type="button" class="btn btn-lg list-group-item   waves-effect">
                                    <i class="material-icons">group</i>
                                        <a href="javascript:void(0);">
                                            <span>Followers</span>
                                        </a>    
                                </button>
                                <button type="button" class="btn btn-lg list-group-item   waves-effect">
                                    <i class="material-icons">shopping_cart</i>
                                        <a href="javascript:void(0);">
                                            <span>Sales</span>
                                        </a>    
                                </button>
                                <button type="button" class="btn btn-lg list-group-item   waves-effect">
                                    <i class="material-icons">favorite</i>
                                        <a href="javascript:void(0);">
                                            <span>Likes</span>
                                        </a>    
                                </button>-->
                                <button type="button" class="btn btn-lg list-group-item   waves-effect">
                                    <i class="material-icons">input</i>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span>Sign Out</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>   
                                </button>
                                
                            </div>

                        <!--
                        <div class="body">
                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                        </div>-->
            </div>
            <!-- #User Info -->
        </aside>
        <!-- #END# Right Sidebar -->
    </section>