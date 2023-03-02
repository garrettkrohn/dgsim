import React from 'react';
import { Link } from '@tanstack/react-router';

const MobileMenu: React.FC<{
  menuItems: { name: string; route: string }[];
  toggleMenu: Function;
}> = props => {
  const route = (item: string) => {
    return `/${item}`;
  };
  return (
    <>
      <div
        className="fixed h-screen w-screen backdrop-blur-sm"
        onClick={() => props.toggleMenu()}
      ></div>
      <div className="fixed flex flex-col bg-dgblack ">
        {props.menuItems.map(item => (
          <div key={item.name} className="p-4">
            {item.name}
          </div>
        ))}
      </div>
    </>
  );
};

export default MobileMenu;
