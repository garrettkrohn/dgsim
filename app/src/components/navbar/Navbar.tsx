import React from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';

const Navbar = () => {
  const menuItems = [
    { name: 'home', route: '/' },
    { name: 'Schedule', route: '/schedule' },
    { name: 'Tournaments', route: '/tournaments' },
    { name: 'Standings', route: '/standings' },
  ];

  return (
    <div className=" bg-dgblack font-main uppercase text-dgsoftwhite">
      <div className="p-5 sm:hidden">
        <Bars3Icon className="h-5" />
      </div>
      <div className="hidden sm:flex sm:flex-row">
        {menuItems.map(item => (
          <div className="p-5 ">{item.name}</div>
        ))}
      </div>
      <div className=""></div>
    </div>
  );
};

export default Navbar;
