export default function Header() {
  const menu = [
    { url: "/article", label: "Article" },
    { url: "/contact", label: "Contact" },
    { url: "/about", label: "About" },
  ];

  return (
    <header className="flex bg-blue-600 px-5 py-3 text-white">
      <nav className="inline-flex flex-1 items-center justify-between">
        <span className="text-2xl">Berita</span>
        <menu className="inline-flex items-center">
          {menu.map((value, index) => (
            <a
              key={index}
              href={value.url}
              className="rounded px-3 py-2 transition hover:bg-blue-700"
            >
              {value.label}
            </a>
          ))}
        </menu>
      </nav>
    </header>
  );
}
