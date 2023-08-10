<div class="vh-100 d-flex flex-column overflow-hidden">
  <header class="d-inline-flex align-items-center justify-content-between py-2 px-3 bg-primary" data-bs-theme="dark">
    <a href="/" class="h4 text-light link-underline link-underline-opacity-0">Berita</a>
    <div class="d-inline-flex align-items-center gap-2">
      <span class="text-light">Name</span>
      <a href="/auth/logout" class="text-light link-underline link-underline-opacity-0">Logout</a>
    </div>
  </header>
  <main class="h-100 d-flex gap-2 mh-100 overflow-hidden">
    <ul style="width: 280px" class="nav flex-column nav-pills p-2 border rounded">
      <li class="nav-item">
        <a @class(['nav-link', 'active' => $dashboard]) href="/dashboard">Dashboard</a>
      </li>
      <li class="nav-item">
        <a @class(['nav-link', 'active' => $article]) href="/dashboard/article">Article</a>
      </li>
      <li class="nav-item">
        <a @class(['nav-link', 'active' => $users]) href="/dashboard/users">Users</a>
      </li>
    </ul>

    <div class="container my-3 mh-100 overflow-auto">
      {{ $slot }}
    </div>
  </main>
</div>
