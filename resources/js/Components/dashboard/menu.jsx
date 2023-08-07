import { Fragment } from "react";
import { Transition } from "@headlessui/react";

export default function Menu({ open, navigation, changeView, selectMenu }) {
  return (
    <Transition
      show={open}
      as={Fragment}
      enter="transition-all ease-out duration-200"
      enterFrom="min-w-0 px-0"
      enterTo="min-w-[208px] px-1"
      leave="transition-all ease-in duration-150"
      leaveFrom="min-w-[208px] px-1"
      leaveTo="min-w-0 px-0"
    >
      <menu className="flex min-w-[208px] flex-col overflow-hidden border-r py-2">
        <nav className="flex flex-col">
          {navigation.map(({ nav }, index) => {
            return (
              <a
                key={index}
                className={`${
                  nav === selectMenu && "bg-blue-600 text-white"
                } cursor-pointer p-2 capitalize text-blue-600`}
                onClick={() => changeView(nav)}
              >
                {nav}
              </a>
            );
          })}
        </nav>
      </menu>
    </Transition>
  );
}
