import React, { useState } from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';
import MobileMenu from './MobileMenu';
import menuItems from '../../constants/MenuItems';
import { Link } from '@tanstack/react-router';

const Navbar = () => {
  const [showMenu, setShowMenu] = useState(false);

  const toggleMenu = () => {
    setShowMenu(!showMenu);
  };

  return (
    <div className="bg-dgblack font-main uppercase text-dgsoftwhite">
      <div className="flex justify-between">
        <div className=" p-5 sm:hidden" onClick={toggleMenu}>
          <Bars3Icon className="h-5" />
        </div>
        {showMenu ? (
          <MobileMenu menuItems={menuItems} toggleMenu={toggleMenu} />
        ) : (
          ''
        )}
        <div className="hidden sm:flex sm:flex-row">
          {menuItems.map(item => (
            <Link to={item.route}>
              <div key={item.name} className="p-4">
                {item.name}
              </div>
            </Link>
          ))}
        </div>
        <div className="p-4">Disc Golf Sim League</div>
      </div>
    </div>
  );
};

export default Navbar;
