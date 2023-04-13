import React, { useState } from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';
import MobileMenu from './MobileMenu';
import menuItems from '../../constants/MenuItems';
import LoginButton from '../../util/LoginButton';
import LogoutButton from '../../util/LogoutButton';
import { useAuth0 } from '@auth0/auth0-react';
import { Link } from '@tanstack/react-router';
import Avatar from '../../util/Avatar';
import { useAtom } from 'jotai/index';
import { customColors } from '../../jotai/Atoms';

const Navbar = () => {
  const [showMenu, setShowMenu] = useState(false);
  const [displayCustomColors, setDisplayCustomColors] = useAtom(customColors);

  const toggleMenu = () => {
    setShowMenu(!showMenu);
  };

  const { user, isAuthenticated } = useAuth0();

  const toggleSwitch = () => {
    setDisplayCustomColors(!displayCustomColors);
    console.log(displayCustomColors);
  };

  return (
    <div className="bg-dgblack px-5 font-main uppercase text-dgsoftwhite">
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
              <Link to={item.route} search={{}} params={{}}>
                {item.name}
              </Link>
            </div>
          ))}
        </div>
        <div className="p-4">Disc Golf Sim League</div>
        <div className="flex justify-center">
          <input
            className="checked:bg-primary checked:after:bg-primary checked:focus:border-primary checked:focus:bg-primary dark:checked:bg-primary dark:checked:after:bg-primary mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
            type="checkbox"
            role="switch"
            id="flexSwitchCheckDefault"
            onClick={toggleSwitch}
          />
          <label
            className="inline-block pl-[0.15rem] hover:cursor-pointer"
            htmlFor="flexSwitchCheckDefault"
          >
            Custom Colors
          </label>
        </div>

        {isAuthenticated ? <LogoutButton /> : <LoginButton />}
      </div>
    </div>
  );
};

export default Navbar;
