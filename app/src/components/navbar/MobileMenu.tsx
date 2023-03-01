import React from 'react';

const MobileMenu: React.FC<{
  menuItems: { name: string; route: string }[];
}> = props => {
  return (
    <div>
      <div className="fixed h-screen w-screen backdrop-blur-sm"></div>
      <div className="fixed flex flex-col bg-dgblack ">
        {props.menuItems.map(item => (
          <div key={item.name} className="p-4">
            {item.name}
          </div>
        ))}
      </div>
    </div>
  );
};

export default MobileMenu;
