<style>
    .search-menu-link-block
    {
        width: 50vw;
        max-width: 600px;
    }

    .search-menu-link-block ul
    {
        width: 50vw;
        max-width: 600px;        
        list-style: none;
        padding: 0;
        margin: 0;
        position: fixed;
        z-index: 1;        
        background-color: var(--bs-topbar-search-bg);
        border: var(--bs-border-color) solid var(--bs-border-color);
        border-radius: 0 0 5px 5px;
    }

    .search-menu-link-block ul li
    {
        padding : 8px;
        border-bottom: 1px solid var(--bs-border-color);
    }

    .search-menu-link-block ul li a{
        display: block;
    }

    .search-menu-link-block ul li:hover{
        background-color: var(--bs-border-color);
    }
</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/home" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                    </span>
                </a>

                <a href="/home" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block search-menu-link-block">
                <div class="position-relative">
                    <input id="search_menu_link" type="text" class="form-control" placeholder="Search Menu Link">
                    <ul id="search_menu_autocomplete">
                    </ul>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @php
                        $user = Auth::user();
                    @endphp
                    @if(isset($user->profile_image) && $user->profile_image)
                        <img class="rounded-circle header-profile-user" src="{{ FileUtility::get($user->profile_image) }}" alt="Header Avatar">
                    @endif
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">
                        {{ Auth::user()->name }}
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
            @endguest
        </div>
    </div>
</header>

<script>
    $(function(){
        $("#mode-setting-btn").click(function(){
            var mode = $("body").attr("data-layout-mode");
            if (mode)
            {
                localStorage.setItem("layout-mode", mode);
            }
        });
    });
</script>

<script type="text/javascript">
    //search menu link
    var menu_autocomplete_list = JSON.parse('<?= json_encode($menu_autocomplete_list) ?>');
    console.log(menu_autocomplete_list);
    $(document).ready(function()
    {
        function search_simple(search_text, limit)
        {
            var list = []
            for (var i in menu_autocomplete_list)
            {
                var link = menu_autocomplete_list[i];

                if (link['title'].toLowerCase().indexOf(search_text) >= 0)
                {
                    list.push(link);
                }

                if (list.length > limit)
                {
                    return list;
                }
            }

            return list;
        }

        function search_list_in_string(search_list, limit)
        {
            var list = [];
            for (var i in menu_autocomplete_list)
            {
                var link = menu_autocomplete_list[i];

                var is_all_part_found = true;
                for(var a in search_list)
                {
                    var part = search_list[a].trim();

                    if (part.length >= 2)
                    {
                        if (link['title'].toLowerCase().indexOf(part) == -1)
                        {
                            is_all_part_found = false;
                        }
                    }
                }

                if (is_all_part_found)
                {
                    list.push(link);
                }

                if (list.length > limit)
                {
                    return list;
                }
            }

            return list;
        }

        function show_autocomplete_list(search_text)
        {
            search_text = search_text.toLowerCase();
            var list = search_simple(search_text, 10);

            if (list.length < 10)
            {
                var sub_parts = search_text.split(" ");
                var list2 = search_list_in_string(sub_parts, 10);

                for (var a in list2)
                {
                    var link2 = list2[a];
                    var is_found = false;
                    for (var i in list)
                    {
                        var link = list[a];

                        if (link['title'] == link2['title'])
                        {
                            is_found = true;
                        }
                    }

                    if (!is_found)
                    {
                        list.push(link2);
                    }
                }
            }

            var html = "";
            for (var i in list)
            {
                var link = list[i];
                html += "<li>"
                    html += '<a href="' + link["url"] + '">' + link["title"] + '</a>';
                html += "</li>";
            }

            $("#search_menu_autocomplete").html(html).show();
        }

        $("#search_menu_link").keyup(function(e)
        {
            if (e.key == "Escape")
            {
               $(this).val("");
            }

            if ($(this).val().length > 2)
            {
                show_autocomplete_list($(this).val());
            }
            else
            {
                $("#search_menu_autocomplete").html("").hide();
            }
        });

        $("#search_menu_autocomplete").hide();
    });
</script>