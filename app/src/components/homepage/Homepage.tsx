import PlayerBlock from './PlayerBlock';
import Divider from './Divider';
import UpdateBlock from './UpdateBlock';
import React from 'react';

const Homepage = () => {
  return (
    <div>
      <PlayerBlock />
      <Divider color="dgbackground" />
      <UpdateBlock />
    </div>
  );
};

export default Homepage;
