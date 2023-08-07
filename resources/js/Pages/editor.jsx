import { useState } from "react";
import ReactQuill from "react-quill";
import parse from "html-react-parser";

import "react-quill/dist/quill.snow.css";

export default function PageEditor() {
  const [value, setValue] = useState("");

  return (
    <main className="container m-5 mx-auto flex h-screen flex-col">
      <div className="m-2 rounded border p-2">
        <form action="" method="post" className="flex flex-col gap-2">
          <div className="flex flex-col gap-2">
            <label htmlFor="title">Title</label>
            <input type="text" name="title" id="title" className="form-input" />
          </div>
          <button type="submit" className="rounded bg-blue-600 py-2 text-white">
            Simpan
          </button>
        </form>
      </div>

      <div className="m-2 inline-flex w-full gap-2 rounded border p-2">
        <ReactQuill
          theme="snow"
          value={value}
          onChange={setValue}
          className="flex-1"
        />
        <div className="flex flex-1 flex-col border p-2">
          <article className="ql-editor prose">{parse(value)}</article>
        </div>
      </div>
    </main>
  );
}
