import React from 'react';

const Navbar = () => {
  const menuItems = [
    { name: 'home', route: '/' },
    { name: 'Tournament Results', route: '/tournaments' },
    { name: 'Season Tour Points', route: '/seasonTourPoints' },
  ];

  return (
    <div className="display:flex ">
      <div className="container">
        {menuItems.map(item => (
          <div>{item.name}</div>
        ))}
      </div>
      <div className="nabar-right"></div>
    </div>
  );
};

export default Navbar;
