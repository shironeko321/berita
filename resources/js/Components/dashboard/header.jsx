import { Fragment } from "react";
import { Popover, Transition } from "@headlessui/react";
import { ChevronDownIcon, Bars3Icon } from "@heroicons/react/20/solid";

import image from "../../assets/react.svg";

export default function Header({ openCloseMenu }) {
  return (
    <header className="inline-flex items-center justify-between bg-blue-700 p-2">
      <div className="inline-flex items-center gap-2 text-white">
        <button className="p-2" onClick={openCloseMenu}>
          <Bars3Icon className="h-5 w-5" />
        </button>
        <span>Berita</span>
      </div>

      <Popover className="relative">
        <Popover.Button className="inline-flex items-center gap-2 p-2 text-white">
          <img src={image} alt="n" className="h-5 w-5 rounded-full border" />
          <span>user</span>
          <ChevronDownIcon className="h-5 w-5" aria-hidden="true" />
        </Popover.Button>

        <Transition
          as={Fragment}
          enter="transition ease-out duration-200"
          enterFrom="opacity-0 translate-y-1"
          enterTo="opacity-100 translate-y-0"
          leave="transition ease-in duration-150"
          leaveFrom="opacity-100 translate-y-0"
          leaveTo="opacity-0 translate-y-1"
        >
          <Popover.Panel className="absolute z-10 mt-1">
            <div className="flex flex-col items-center justify-center gap-2 overflow-hidden rounded bg-white p-2">
              <img
                src={image}
                alt="n"
                className="h-10 w-10 rounded-full border"
              />
              <span>user</span>
              <button className="rounded border p-2">Logout</button>
            </div>
          </Popover.Panel>
        </Transition>
      </Popover>
    </header>
  );
}
