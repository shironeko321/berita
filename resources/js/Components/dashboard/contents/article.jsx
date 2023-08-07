import { Popover, Transition } from "@headlessui/react";
import { PlusIcon } from "@heroicons/react/20/solid";

export default function ArticleContent() {
  return (
    <div className="flex flex-col gap-3 p-5">
      <div className="inline-flex w-full items-center justify-between gap-2 rounded border p-2">
        <span className="text-xl">Pages</span>
        <button className="inline-flex items-center rounded border bg-blue-600 px-3 py-2 text-white">
          Tambah
          <PlusIcon className="ml-2 h-5 w-5" />
        </button>
      </div>
      <div className="w-full rounded border p-2">
        <table className="w-full">
          <thead className="bg-blue-600 text-white">
            <tr>
              <th className="border p-2">No</th>
              <th className="border p-2">Nama</th>
              <th className="border p-2">Url</th>
              <th className="border p-2">slug</th>
              <th className="border p-2">Tgl upload</th>
              <th className="border p-2">action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td className="border p-2 text-center">No</td>
              <td className="border p-2 text-center">Nama</td>
              <td className="border p-2 text-center">Url</td>
              <td className="border p-2 text-center">slug</td>
              <td className="border p-2 text-center">Tgl Upload</td>
              <td className="border p-2 text-center">
                <div className="inline-flex w-full items-center">
                  <button className="m-1 w-full flex-1 bg-blue-600 p-2 text-white">
                    Ubah
                  </button>
                  <Popover className="relative w-full flex-1">
                    <Popover.Button className="m-1 w-full bg-red-600 p-2 text-white">
                      Hapus
                    </Popover.Button>
                    <Transition
                      enter="trnsition duration-100 ease-out"
                      enterFrom="transform scale-95 opacity-0"
                      enterTo="transform scale-100 opacity-100"
                      leave="trnsition duration-100 ease-out"
                      leaveFrom="transform scale-100 opacity-100"
                      leaveTo="transform scale-95 opacity-0"
                    >
                      <Popover.Panel className="absolute left-1/2 z-10 mt-3 w-full -translate-x-1/2 rounded border bg-white p-2">
                        {({ close }) => (
                          <div className="flex flex-col">
                            <span>ingin hapus item ini?</span>
                            <div className="inline-flex items-center justify-center">
                              <button
                                className="m-1 bg-blue-600 px-2 py-1 text-white"
                                onClick={close}
                              >
                                Tidak
                              </button>
                              <button
                                className="m-1 bg-red-600 px-2 py-1 text-white"
                                onClick={() => close()}
                              >
                                Ya
                              </button>
                            </div>
                          </div>
                        )}
                      </Popover.Panel>
                    </Transition>
                  </Popover>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  );
}
