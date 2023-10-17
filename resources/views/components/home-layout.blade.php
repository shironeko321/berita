{{-- <nav class="navbar sticky-top navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Berita</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $article]) href="{{ route('article') }}">Article</a>
        </li>
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $category]) href="{{ route('category') }}">Category</a>
        </li>
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $tags]) href="{{ route('tags') }}">Tags</a>
        </li>
      </ul>
    </div>
  </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
  <div class="container-fluid">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ route('home') }}">Berita</a>

    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#menu"
      aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $article]) href="{{ route('article') }}">Article</a>
        </li>
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $category]) href="{{ route('category') }}">Category</a>
        </li>
        <li class="nav-item">
          <a @class(['nav-link', 'active' => $tags]) href="{{ route('tags') }}">Tags</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-3">
  {{ $slot }}
</main>
