import React from 'react';

const MobileMenu: React.FC<{
  menuItems: { name: string; route: string }[];
  toggleMenu: Function;
}> = props => {
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
