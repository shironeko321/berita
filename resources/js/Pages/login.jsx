export default function Login() {
  return (
    <main className="flex h-screen items-center justify-center">
      <div className="flex w-72 flex-col gap-5 rounded border px-4 py-8">
        <span className="text-center text-3xl">Login</span>
        <form action="" method="post" className="flex flex-col gap-2">
          <div className="flex flex-col gap-2">
            <label htmlFor="email">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="email@mail.com"
              className="form-input rounded"
            />
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="******"
              className="form-input rounded"
            />
          </div>
          <button
            type="submit"
            className="rounded border bg-blue-600 p-2 text-white transition hover:bg-blue-700"
          >
            Login
          </button>
        </form>
      </div>
    </main>
  );
}
