import React, { useEffect, useState } from 'react';
import { Bars3Icon } from '@heroicons/react/20/solid';
import MobileMenu from './MobileMenu';
import menuItems from '../../constants/MenuItems';
import LoginButton from '../../util/LoginButton';
import LogoutButton from '../../util/LogoutButton';
import { useAuth0 } from '@auth0/auth0-react';
import { Link } from '@tanstack/react-router';
import { useMutation, useQuery } from '@tanstack/react-query';
import { createOrGetUser, getUser } from '../../services/UserApi';
import UserIcon from './UserIcon';

const Navbar = () => {
  const [showMenu, setShowMenu] = useState(false);

  const toggleMenu = () => {
    setShowMenu(!showMenu);
  };

  const { user, isAuthenticated } = useAuth0();

  const { data: mutatedUser, mutate } = useMutation({
    mutationFn: () =>
      createOrGetUser({
        // @ts-ignore
        Auth0: user.sub,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => console.log('complete'),
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      mutate();
    }
  }, [isAuthenticated, user]);

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
        {mutatedUser ? <UserIcon user={mutatedUser} /> : ''}
        {isAuthenticated ? <LogoutButton /> : <LoginButton />}
      </div>
    </div>
  );
};

export default Navbar;
