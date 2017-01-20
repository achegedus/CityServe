<template>

    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="/cityserve.jpeg" alt="Logo">
            </a>
            <!-- End Logo -->

            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <li><a href="page_login.html">Login</a></li>
                </ul>
            </div>
            <!-- End Topbar -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <!-- Home -->
                    <li class="active">
                        <a>Home</a>
                    </li>
                    <!-- End Home -->

                    <!-- Blog -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            History
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Large Image</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar1.html">Right Sidebar</a></li>
                                    <li><a href="blog_large_left_sidebar1.html">Left Sidebar</a></li>
                                    <li><a href="blog_large_full_width1.html">Full Width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Medium Image</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_medium_right_sidebar1.html">Right Sidebar</a></li>
                                    <li><a href="blog_medium_left_sidebar1.html">Left Sidebar</a></li>
                                    <li><a href="blog_medium_full_width1.html">Full Width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Item Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar_item1.html">Right Sidebar Item</a></li>
                                    <li><a href="blog_large_left_sidebar_item1.html">Left Sidebar Item</a></li>
                                    <li><a href="blog_large_full_width_item1.html">Full Width Item</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Simple Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar.html">Right Sidebar Large</a></li>
                                    <li><a href="blog_medium_right_sidebar.html">Right Sidebar Medium</a></li>
                                    <li><a href="blog_large_full_width.html">Full Width</a></li>
                                    <li><a href="blog_large_right_sidebar_item.html">Right Sidebar Item</a></li>
                                    <li><a href="blog_large_full_width_item.html">Full Width Item</a></li>
                                </ul>
                            </li>
                            <li><a href="blog_masonry_3col.html">Masonry Grid Blog</a></li>
                            <li><a href="blog_timeline.html">Blog Timeline</a></li>
                        </ul>
                    </li>
                    <!-- End Blog -->

                    <!-- Blog -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            Projects
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Large Image</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar1.html">Right Sidebar</a></li>
                                    <li><a href="blog_large_left_sidebar1.html">Left Sidebar</a></li>
                                    <li><a href="blog_large_full_width1.html">Full Width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Medium Image</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_medium_right_sidebar1.html">Right Sidebar</a></li>
                                    <li><a href="blog_medium_left_sidebar1.html">Left Sidebar</a></li>
                                    <li><a href="blog_medium_full_width1.html">Full Width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Item Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar_item1.html">Right Sidebar Item</a></li>
                                    <li><a href="blog_large_left_sidebar_item1.html">Left Sidebar Item</a></li>
                                    <li><a href="blog_large_full_width_item1.html">Full Width Item</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0);">Blog Simple Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_large_right_sidebar.html">Right Sidebar Large</a></li>
                                    <li><a href="blog_medium_right_sidebar.html">Right Sidebar Medium</a></li>
                                    <li><a href="blog_large_full_width.html">Full Width</a></li>
                                    <li><a href="blog_large_right_sidebar_item.html">Right Sidebar Item</a></li>
                                    <li><a href="blog_large_full_width_item.html">Full Width Item</a></li>
                                </ul>
                            </li>
                            <li><a href="blog_masonry_3col.html">Masonry Grid Blog</a></li>
                            <li><a href="blog_timeline.html">Blog Timeline</a></li>
                        </ul>
                    </li>
                    <!-- End Blog -->


                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->
</template>


<style>


</style>


<script>

    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },

        components:{

        }
    }

</script>
