<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
        <span class="brand-text font-weight-light text-center">Adm Maharani</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard_home') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard_home'? 'active': '' }}">
                        <i class="fa-solid fa-house-user"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ request()->route()->getName() == 'category.index'? 'active': '' }}">
                        <i class="fa-solid fa-c"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('tags.index') }}"
                      class="nav-link {{ request()->route()->getName() == 'tags.index'? 'active': '' }}">
                      <i class="fa-solid fa-tag"></i>
                      <p>
                          Tag
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('article.index') }}"
                    class="nav-link {{ (request()->route()->getName() == 'article.index') ? 'active': '' }} @switch(request()->route()->getName())
                        @case(1)
                            
                            @break
                        @case(2)
                            
                            @break
                        @default
                            
                    @endswitch">
                    <i class="fa-solid fa-newspaper"></i>
                    <p>
                        Artikel
                    </p>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
