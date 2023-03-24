import React, { useState } from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';
import MobileMenu from './MobileMenu';
import menuItems from '../../constants/MenuItems';
import LoginButton from '../../util/LoginButton';
import LogoutButton from '../../util/LogoutButton';
import { useAuth0 } from '@auth0/auth0-react';
import { Link } from '@tanstack/react-router';

const Navbar = () => {
  const [showMenu, setShowMenu] = useState(false);

  const toggleMenu = () => {
    setShowMenu(!showMenu);
  };

  const { user, isAuthenticated } = useAuth0();

  return (
    <div className="bg-dgblack font-main uppercase text-dgsoftwhite">
      <div className="flex justify-between">
        <div className=" p-5 lg:hidden" onClick={toggleMenu}>
          <Bars3Icon className="h-5" />
        </div>
        {showMenu ? (
          <MobileMenu menuItems={menuItems} toggleMenu={toggleMenu} />
        ) : (
          ''
        )}
        <div className="hidden lg:flex lg:flex-row">
          {menuItems.map(item => (
            <div key={item.name} className="p-5 ">
              <Link to={item.route}>{item.name}</Link>
            </div>
          ))}
        </div>
        <div className="p-4">Disc Golf Sim League</div>
        {isAuthenticated ? <LogoutButton /> : <LoginButton />}
      </div>
    </div>
  );
};

export default Navbar;
