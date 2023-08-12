<div class="vh-100 d-flex flex-column overflow-hidden">
  <header class="d-inline-flex align-items-center justify-content-between py-2 px-3 bg-primary" data-bs-theme="dark">
    <div class="navbar d-inline-flex align-items-center gap-2">
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="{{ route('home') }}" class="h4 text-light link-underline link-underline-opacity-0">Berita</a>
    </div>
    <div class="d-inline-flex align-items-center gap-2">
      <span class="text-light">{{ $firstname }} {{ $lastname }}</span>
      <a href="{{ route('auth_logout') }}" class="text-light link-underline link-underline-opacity-0">Logout</a>
    </div>
  </header>
  <main class="h-100 d-flex gap-2 mh-100 overflow-hidden">
    <ul class="collapse collapse-horizontal nav flex-column nav-pills border rounded show" id="menu">
      <li class="nav-item px-2">
        <a style="padding-right: 5rem" @class(['nav-link', 'active' => $dashboard]) href="{{ route('dashboard_home') }}">Dashboard</a>
      </li>
      <li class="nav-item px-2">
        <a style="padding-right: 5rem" @class(['nav-link', 'active' => $article]) href="{{ route('dashboard_article') }}">Article</a>
      </li>
      <li class="nav-item px-2">
        <a style="padding-right: 5rem" @class(['nav-link', 'active' => $users]) href="{{ route('dashboard_users') }}">Users</a>
      </li>
    </ul>

    <div class="container py-3 mh-100 overflow-auto">
      {{ $slot }}
    </div>
  </main>
</div>
