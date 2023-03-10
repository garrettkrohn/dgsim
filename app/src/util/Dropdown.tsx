import React, { useState } from 'react';

const Dropdown = (props: {
  items: string[];
  setIndex: Function;
  title: string;
}) => {
  const [showDropdown, setShowDropdown] = useState(true);

  const toggleDropdown = () => {
    setShowDropdown(!showDropdown);
  };

  return (
    <div className="relative">
      <div
        className="inline-flex items-center divide-x divide-gray-100 overflow-hidden rounded-md border bg-white"
        onClick={toggleDropdown}
      >
        <a
          href="#"
          className="px-4 py-2 text-sm leading-none text-gray-600 hover:bg-gray-50 hover:text-gray-700"
        >
          {props.title}
        </a>

        <button
          className="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700"
          onClick={toggleDropdown}
        >
          <span className="sr-only">Menu</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            className="h-4 w-4"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fillRule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clipRule="evenodd"
            />
          </svg>
        </button>
      </div>
      {showDropdown ? (
        <div
          className="absolute right-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-white shadow-lg"
          role="menu"
        >
          <div className="p-2">
            {props.items.map((item, index) => (
              <a
                href="#"
                className="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                role="menuitem"
                onClick={() => {
                  props.setIndex(index);
                  toggleDropdown();
                }}
              >
                {item}
              </a>
            ))}
          </div>
        </div>
      ) : (
        ''
      )}
    </div>
  );
};

export default Dropdown;
