import React, { useState } from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';
import MobileMenu from './MobileMenu';
import menuItems from '../../Constants/MenuItems';

const Navbar = () => {
  const [showMenu, setShowMenu] = useState(true);

  const toggleMenu = () => {
    setShowMenu(!showMenu);
  };

  return (
    <div className=" bg-dgblack font-main uppercase text-dgsoftwhite">
      <div className="p-5 sm:hidden" onClick={toggleMenu}>
        <Bars3Icon className="h-5" />
      </div>
      {showMenu ? <MobileMenu menuItems={menuItems} /> : ''}
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
