import React from 'react';

const MobileMenu: React.FC<{
  menuItems: { name: string; route: string }[];
}> = props => {
  return (
    <div>
      {props.menuItems.map(item => (
        <div>{item.name}</div>
      ))}
    </div>
  );
};

export default MobileMenu;
