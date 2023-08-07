import parse from "html-react-parser";
import "react-quill/dist/quill.snow.css";

import Header from "../Components/home/header";

export default function Article() {
  const value = ""

  return (
    <div className="flex flex-col gap-5">
      <Header />
      <article className="ql-editor prose">{parse(value)}</article>
    </div>
  );
}
